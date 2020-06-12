<?php
namespace App\Repositories\papeleraDeReciclaje\tabla\pedidos;

class PedidosRepositories implements PedidosInterface {
  public function metodo($metodo, $consulta) {
    if($metodo == 'destroy') {
      $this->metDestroy($consulta);
    }
  }
  public function metDestroy($consulta) {
    $armados = $consulta->armados()->with(['direcciones'=> function ($query) {
                $query->select('id', 'comp_de_sal_rut', 'comp_de_sal_nom', 'pedido_armado_id')->with(['comprobantesDeEntrega'=> function ($query) {
                $query->select('id', 'comp_ent_rut', 'comp_ent_nom', 'comp_cost_por_env_log_rut', 'comp_cost_por_env_log_nom', 'direccion_id')->withTrashed();
              }])->withTrashed();
            }])->withTrashed()->get(['id', 'tarj_dise_rut', 'tarj_dise_nom']);
                                      
    // FUNCION QUE ELIMINA TODOS LOS ARCHIVOS DE LOS ARMADOS, DIRECCIONES, COMPROBANTES DE ENTREGA QUE ESTEN RELACIONADOS AL PEDIDO
    $cont1 = 0;
    $archivos_a_eliminar = null;
    foreach($armados as $armado) {
      // AÑADE LA RUTA Y NOMBRE DE LAS TARJETAS DE FELICITACION
      if($armado->tarj_dise_nom != null) {
        $archivos_a_eliminar[$cont1] = $armado->tarj_dise_rut.$armado->tarj_dise_nom;
        $cont1 +=1;
      }
      foreach($armado->direcciones as $direccion) {
        // AÑADE LA RUTA Y NOMBRE DE LOS COMPROBANTES DE SALIDA
        if($direccion->comp_de_sal_nom != null) {
          $archivos_a_eliminar[$cont1] = $direccion->comp_de_sal_rut.$direccion->comp_de_sal_nom;
          $cont1 +=1;
        }
        // AÑADE LA RUTA Y NOMBRE DE LOS COMPROBANTES DE ENTREGA Y COMPROBANTE COSTO POR ENVIO
        foreach($direccion->comprobantesDeEntrega as $comprobanteDeEntrega) {
          if($comprobanteDeEntrega->comp_ent_nom != null) {
            $archivos_a_eliminar[$cont1] = $comprobanteDeEntrega->comp_ent_rut.$comprobanteDeEntrega->comp_ent_nom;
            $cont1 +=1;
          }
          if($comprobanteDeEntrega->comp_cost_por_env_log_nom != null) {
            $archivos_a_eliminar[$cont1] = $comprobanteDeEntrega->comp_cost_por_env_log_rut.$comprobanteDeEntrega->comp_cost_por_env_log_nom;
            $cont1 +=1;
          }
        }
      }
    }

    // FUNCION QUE ELIMINA TODOS LOS ARCHIVOS DE LOS PAGOS, COMPROBANTES DE PAGO QUE ESTEN RELACIONADOS AL PEDIDO
    $pagos = $consulta->pagos()->withTrashed()->get(['id', 'comp_de_pag_rut', 'comp_de_pag_nom', 'cop_de_indent_rut', 'cop_de_indent_nom']);
    foreach($pagos as $pago) {
      if($pago->comp_de_pag_nom != null) {
        $archivos_a_eliminar[$cont1] = $pago->comp_de_pag_rut.$pago->comp_de_pag_nom;
        $cont1 +=1;
      }
      if($pago->cop_de_indent_nom != null) {
        $archivos_a_eliminar[$cont1] = $pago->cop_de_indent_rut.$pago->cop_de_indent_nom;
        $cont1 +=1;
      }
    }            
    // Se implementa esta forma de eliminar archivos ya que con la funcion "ArchivosEliminados::dispatch" no lo hace
    \Storage::delete($archivos_a_eliminar);
  }
}