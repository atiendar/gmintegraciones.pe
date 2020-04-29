<?php
namespace App\Exports\armado;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
// Models
use App\Models\Armado;

class generarCatalogoDeArmadosExport implements FromView {
    use Exportable;
    public function query() {
        return Armado::query();
    }
    public function view(): View {
        return view('armado.export.arm_exp_disCatArm', [
            'armados' => Armado::with('productos')->where('clon', '0')->orderBy('id', 'DESC')->get()
        ]);
    }
}
