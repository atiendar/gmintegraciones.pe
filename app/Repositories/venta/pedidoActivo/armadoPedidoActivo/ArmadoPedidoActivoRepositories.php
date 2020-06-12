<?php
namespace App\Repositories\venta\pedidoActivo\armadoPedidoActivo;
// Models
use App\Models\PedidoArmado;
use App\Models\PedidoArmadoTieneProducto;
// Servicios
use App\Repositories\servicio\crypt\ServiceCrypt;
// Repositories
use App\Repositories\armado\ArmadoRepositories;
use App\Repositories\papeleraDeReciclaje\PapeleraDeReciclajeRepositories;
use App\Repositories\venta\pedidoActivo\PedidoActivoRepositories;
use App\Repositories\cotizacion\CotizacionRepositories;
// Otros
use Illuminate\Support\Facades\Auth;
use DB;

class ArmadoPedidoActivoRepositories implements ArmadoPedidoActivoInterface {
  protected $serviceCrypt;
  protected $armadoRepo;
  protected $papeleraDeReciclajeRepo;
  protected $pedidoActivoRepo;
  protected $cotizacionRepo;
  public function __construct(ServiceCrypt $serviceCrypt, ArmadoRepositories $armadoRepositories, PapeleraDeReciclajeRepositories $papeleraDeReciclajeRepositories, PedidoActivoRepositories $pedidoActivoRepositories, CotizacionRepositories $cotizacionRepositories) {
    $this->serviceCrypt             = $serviceCrypt;
    $this->armadoRepo               = $armadoRepositories;
    $this->papeleraDeReciclajeRepo  = $papeleraDeReciclajeRepositories;
    $this->pedidoActivoRepo         = $pedidoActivoRepositories;
    $this->cotizacionRepo           = $cotizacionRepositories;
  } 
  public function armadoFindOrFailById($id_armado, $relaciones) { // 'productos', 'direcciones', 'pedido'
    $id_armado = $this->serviceCrypt->decrypt($id_armado);
    $armado = PedidoArmado::with($relaciones)->findOrFail($id_armado);
    return $armado;
  }
}