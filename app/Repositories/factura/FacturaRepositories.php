<?php
namespace App\Repositories\factura;
// Models
use App\Models\Factura;
// Notifications
use App\Notifications\Factura\NotificacionFacturaGenerada;
use App\Notifications\Factura\NotificacionFacturaCancelada;
// Events
use App\Events\layouts\ActividadRegistrada;
use App\Events\layouts\ArchivoCargado;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\pago\PagoRepositories;
use App\Repositories\sistema\plantilla\PlantillaRepositories;
use App\Repositories\sistema\sistema\SistemaRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class FacturaRepositories implements FacturaInterface {
  protected $serviceCrypt;
  protected $papeleraDeReciclajeRepo;
  protected $pagoRepo;
  protected $plantillaRepo;
  protected $sistemaRepo;
  public function __construct(ServiceCrypt $serviceCrypt, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories, PagoRepositories $pagoRepositories, PlantillaRepositories $plantillaRepositories, SistemaRepositories $sistemaRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
    $this->pagoRepo                 = $pagoRepositories;
    $this->plantillaRepo            = $plantillaRepositories;
    $this->sistemaRepo              = $sistemaRepositories;
  }
  public function getFacturaFindOrFailById($id_factura, $relaciones, $estatus) {
    $id_factura = $this->serviceCrypt->decrypt($id_factura);
    return Factura::with($relaciones)->estatus($estatus)->findOrFail($id_factura);
  }
  public function getPagination($request) {
    // falta ordenar por el estatus
    return Factura::with('usuario')->buscar($request->opcion_buscador, $request->buscador)->orderByRaw('est_fact DESC, id DESC')->paginate($request->paginador);
  }
  public function store($request) {
    try { DB::beginTransaction();
      $pago = $this->pagoRepo->getPagoForCodigoFacturacionFindOrFail($request->codigo_de_facturacion, []);

      $factura = new Factura();
      $factura->nom_o_raz_soc = $request->nombre_o_razon_social;
      $factura->rfc           = $request->rfc;
      $factura->lad_fij       = $request->lada_telefono_fijo;
      $factura->tel_fij       = $request->telefono_fijo;
      $factura->ext           = $request->extension;
      $factura->lad_mov       = $request->lada_telefono_movil;
      $factura->tel_mov       = $request->telefono_movil;
      $factura->calle         = $request->calle;
      $factura->no_ext        = $request->no_exterior;
      $factura->no_int        = $request->no_interior;
      $factura->pais          = $request->pais;
      $factura->ciudad        = $request->ciudad;
      $factura->col           = $request->colonia;
      $factura->del_o_munic   = $request->delegacion_o_municipio;
      $factura->cod_post      = $request->codigo_postal;
      $factura->corr          = $request->correo;
      $factura->uso_de_cfdi                     = $request->uso_de_cfdi;
      $factura->met_de_pag                      = $request->metodo_de_pago;
      $factura->form_de_pag                     = $request->forma_de_pago;
      $factura->banc_de_cuent_de_retir          = $request->banco_cuenta_de_retiro;
      $factura->ulti_cuatro_dig_cuent_de_retir  = $request->ultimos_4_digitos_cuenta_de_retiro;
      $factura->concept                         = $request->concepto;
      $factura->coment_u_obs_us                 = $request->comentarios_cliente;

      $factura->pago_id             = $pago->id;
      $factura->user_id             = $request->cliente;
      $factura->created_at_fact = Auth::user()->email_registro;
      $factura->save();

      /*
      * Cambia el estatus de la factura del pago a Pendiente
      */
      $this->pagoRepo->cambiarEstatusFacturaDelPago($pago, config('app.pendiente'));

      DB::commit();
      return $factura;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function update($request, $id_factura) {
    dd('update');
  }
  public function destroy($id_factura) {
    try { DB::beginTransaction();
      $factura = $this->getFacturaFindOrFailById($id_factura, ['usuario', 'pago'], null);
      $factura->forceDelete();
     
      /*
      * Cambia el estatus de la factura del pago a Pendiente
      */
      if($factura->est_fact == config('app.pendiente') OR $factura->est_fact == config('app.error_del_cliente')) {
        $estatus = config('app.cancelado');
      } elseif($factura->est_fact == config('app.facturado')) {
        $estatus = config('app.facturado_eliminado');
      }
      $this->pagoRepo->cambiarEstatusFacturaDelPago($factura->pago, $estatus);
      
      // ENVIA UN CORREO AL CLIENTE DE QUE SU FACTURA HA SIDO CANCELADA
      $plantilla = $this->plantillaRepo->plantillaFindOrFailById($this->sistemaRepo->datos('plant_fac_cancelado'));
      $factura->usuario->notify(new NotificacionFacturaCancelada($factura->usuario, $plantilla)); // Envió de correo electrónico
    
      DB::commit();
      return $factura;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
  public function updateSubirArchivos($request, $id_factura) {
    try { DB::beginTransaction();
      $factura = $this->getFacturaFindOrFailById($id_factura, ['usuario', 'pago'], null);

      dd(     $factura );
      /*
      if($request->hasfile('imagen')) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->file('imagen'), // Archivo blob
          'public/perfil/' . date("Y-m") . '/', // Ruta en la que guardara el archivo
          'perfil-' . time() . '.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $factura->fact_pdf_rut  = $imagen[0]['ruta'];
        $factura->fact_pdf_nom      = $imagen[0]['nombre'];
      }
    */
      $factura->save();

      // ENVIA UN CORREO AL CLIENTE DE QUE SU FACTURA HA SIDO GENERADA
      $plantilla = $this->plantillaRepo->plantillaFindOrFailById($this->sistemaRepo->datos('plant_fac_generada'));
      $factura->usuario->notify(new NotificacionFacturaGenerada($factura->usuario, $plantilla)); // Envió de correo electrónico

      DB::commit();
      return $factura;
    } catch(\Exception $e) { DB::rollback(); throw $e; }
  }
}