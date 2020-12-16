<?php
namespace App\Exports\factura;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;

class reporteFacturadoExport implements FromView {
  use Exportable;
  private $fecha;

  public function __construct($fecha) {
    $this->fecha   = $fecha;
  }
  public function view(): View {
    $facturas = \App\Models\Factura::
      with(['usuario', 'pago' => function($query) {
          $query->with('pedido');
        }])
      ->where('created_at', $this->fecha)
      ->where('est_fact', 'Facturado')
      ->orderBy('id', 'DESC')
      ->get();

  //  dd(          $facturas           );
    return view('factura.export.reporteFactura', ['facturas'    => $facturas]);
  }
}