<?php
namespace App\Exports\almacen\producto;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
// Models
use App\Models\Producto;

class generarReporteDeCompraExport implements FromView {
    use Exportable;
    public function view(): View {

    $sss =  Producto::with(['sustitutos', 'productos_pedido' => function($query) {
        $query->with(['armado' => function($query) {
            $query->where('estat', config('app.pendiente'))->orWhere('estat', config('app.en_espera_de_compra'))->orWhere('estat', config('app.en_revision_de_productos'));
        }]);
    }])->where('id', 2)->first();
    
    dd(   $sss    );

        return view('almacen.producto.exports.alm_pro_exp_generarReporteDeCompra', [
            'productos' => Producto::with(['sustitutos', 'productos_pedido' => function($query) {
                $query->with(['armado' => function($query) {
                    $query->where('estat', config('app.pendiente'))->orWhere('estat', config('app.en_espera_de_compra'))->orWhere('estat', config('app.en_revision_de_productos'));
                }]);
            }])->orderBy('id', 'DESC')->get()
        ]);
    }
}
