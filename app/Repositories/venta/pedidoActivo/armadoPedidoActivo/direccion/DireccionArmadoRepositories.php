<?php
namespace App\Repositories\venta\pedidoActivo\armadoPedidoActivo\direccion;
// Models
use App\Models\PedidoArmadoTieneDireccion;
// Repositories
use App\Repositories\rolCliente\direccion\DireccionRepositories;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
use App\Events\layouts\ArchivosEliminados;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class DireccionArmadoRepositories implements DireccionInterface {
  protected $serviceCrypt;
  protected $direccionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, DireccionRepositories $direccionRepositories) {
    $this->serviceCrypt   = $serviceCrypt;
    $this->direccionRepo  = $direccionRepositories;
  } 
  public function direccionFindOrFailById($id_direccion, $relaciones) { // 'productos', 'direcciones', 'pedido'
    $id_direccion = $this->serviceCrypt->decrypt($id_direccion);
    $direccion = PedidoArmadoTieneDireccion::with($relaciones)->findOrFail($id_direccion);
    return $direccion;
  }
  public function update($request, $id_direccion) {
    try { DB::beginTransaction();
      $direccion = $this->direccionFindOrFailById($id_direccion, ['armado']);
      $direccion->tip_tarj_felic  = $request->tipo_de_tarjeta_de_felicitacion;
      if($direccion->tip_tarj_felic ==  config('opcionesSelect.select_tarjeta_de_felicitacion.Personalizada')) {
        $direccion->mens_dedic      = $request->mensaje_de_dedicatoria;
      } else {
        $direccion->mens_dedic = null;
      }
      $direccion = $this->direccionRepo->storeFields($direccion, $request);

      if($direccion->isDirty()) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        ActividadRegistrada::dispatch(
          'Ventas/Pedido Activo/Armado (direcciones)', // Módulo
          'venta.pedidoActivo.armado.direccion.show', // Nombre de la ruta
          $id_direccion, // Id del registro debe ir encriptado
          $this->serviceCrypt->decrypt($id_direccion), // Id del registro a mostrar, este valor no debe sobrepasar los 100 caracteres
          array('Tipo de tarjeta de felicitación', 'Mensaje de dedicatoria', 'Nombre de referencia uno', 'Nombre de referencia dos', 'Lada teléfono fijo', 'Teléfono fijo', 'Extensión', 'Lada teléfono móvil', 'Teléfono móvil', 'Calle ', 'No. Exterior', 'No. Interior', 'País', 'Ciudad', 'Colonia', 'Delegación o municipio', 'Código postal', 'Referencias zona de entrega'), // Nombre de los inputs del formulario
          $direccion, // Request
          array('tip_tarj_felic', 'mens_dedic', 'nom_ref_uno', 'nom_ref_dos', 'lad_fij', 'tel_fij', 'ext', 'lad_mov', 'tel_mov', 'calle', 'no_ext', 'no_int', 'pais', 'ciudad', 'col', 'del_o_munic', 'cod_post', 'ref_zon_de_entreg') // Nombre de los campos en la BD
        ); 
        $direccion->updated_at_direc_arm  = Auth::user()->email_registro;
      }

      // Elimina la tarjeta diseñada por el cliente en caso de que el tipo de tarjeta de felicitacion cambie
      if($direccion->isDirty('tip_tarj_felic')) {
        ArchivosEliminados::dispatch(array($direccion->tarj_dise_rut.$direccion->tarj_dise_nom));
        $direccion->tarj_dise_rut   = null;
        $direccion->tarj_dise_nom   = null;
      }
      
      if($direccion->tip_tarj_felic == config('opcionesSelect.select_tarjeta_de_felicitacion.Diseñada por el cliente')) {
        if($request->hasfile('tarjeta_disenada_por_el_cliente')) {
          // Dispara el evento registrado en App\Providers\EventServiceProvider.php
          $imagen = ArchivoCargado::dispatch(
            $request->file('tarjeta_disenada_por_el_cliente'), // Archivo blob
            'pedidos/'.date("Y").'/tarjetas_diseñadas_por_el_cliente', // Ruta en la que guardara el archivo
            'tarjeta_diseñadas_por_el_cliente-'.time().'.', // Nombre del archivo
            $direccion->tarj_dise_nom // Ruta y nombre del archivo anterior
          ); 
          $direccion->tarj_dise_rut  = $imagen[0]['ruta'];
          $direccion->tarj_dise_nom  = $imagen[0]['nombre'];
        }
      }

      $direccion->save();
      $this->estatusDireccionesDetalladas($direccion, $direccion->armado);
      
      DB::commit();
      return $direccion;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }

  public function estatusDireccionesDetalladas($direccion, $armado) {
    if($armado->cant != $armado->cant_direc_carg) {
      $armado->cant_direc_carg += $direccion->cant;
      $armado->save();
      \App\Models\Pedido::getEstatusVentas($armado->pedido);
    }
  }
}