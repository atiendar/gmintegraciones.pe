<?php
namespace App\Repositories\armado\imagenArmado;
// Models
use App\Models\ArmadoImagen;
// Events
use App\Events\layouts\ArchivoCargado;
use App\Events\layouts\ArchivosEliminados;
// Repositories
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ImagenArmadoRepositories implements ImagenArmadoInterface {
  protected $serviceCrypt;
  public function __construct(ServiceCrypt $serviceCrypt) {
    $this->serviceCrypt     = $serviceCrypt;
  }
  public function imagenArmadoFindOrFailById($id_imagen) {
    $id_imagen = $this->serviceCrypt->decrypt($id_imagen);
    $imagen = ArmadoImagen::findOrFail($id_imagen);
    return $imagen;
  }
  public function store($request, $id_armado) {
    DB::transaction(function() use($request, $id_armado) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $camposBD   = array('img_rut', 'img_nom', 'armado_id', 'created_at_img', 'created_at');
      $hastaC     = count($request->imagenes) - 1;
      $datos      = null;
      $contador3  = 0;
      $id_armado  = $this->serviceCrypt->decrypt($id_armado);
      $email_usuario = Auth::user()->email_registro;
      $fecha = date('Y-m-d h:i:s');
      for($contador2 = 0; $contador2 <= $hastaC; $contador2++) {
        // Dispara el evento registrado en App\Providers\EventServiceProvider.php
        $imagen = ArchivoCargado::dispatch(
          $request->imagenes[$contador2], // Archivo blob
          'public/armado/' . date("Y-m") . '/', // Ruta en la que guardara el archivo
          'armado-' . $contador2 . time() . '.', // Nombre del archivo
          null // Ruta y nombre del archivo anterior
        ); 
        $datos[$contador2][$camposBD[$contador3]] = $imagen[0]['ruta'];
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $imagen[0]['nombre'];
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $id_armado;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $email_usuario;
        $contador3 += 1;
        $datos[$contador2][$camposBD[$contador3]] = $fecha;
        $contador3 = 0;
      }
      ArmadoImagen::insert($datos);
      return true;
    });
  }
  public function destroy($id_imagen) {
    DB::transaction(function() use($id_imagen) {  // Ejecuta una transacción para encapsulan todas las consultas y se ejecuten solo si no surgió algún error
      $img_armado = $this->imagenArmadoFindOrFailById($id_imagen);
      $img_armado->delete();
      // Dispara el evento registrado en App\Providers\EventServiceProvider.php
      ArchivosEliminados::dispatch(
        array($img_armado->img_rut.$img_armado->img_nom), 
      );
    });
  }
}