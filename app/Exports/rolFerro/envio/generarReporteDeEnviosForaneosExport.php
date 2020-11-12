<?php
namespace App\Exports\rolFerro\envio;
use App\Models\PedidoArmadoTieneDireccion;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;


class generarReporteDeEnviosForaneosExport implements FromView {
	use Exportable;
	public function view(): View {
		return view('rolFerro.envio.export.reporteDeEnvios', [
			'envios' => PedidoArmadoTieneDireccion::where('for_loc', 'Foráneo')->where('estat', '!=', config('app.entregado'))->with(['armado'])->get()
		]);
	}
}