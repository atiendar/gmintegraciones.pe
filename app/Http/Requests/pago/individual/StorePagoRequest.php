<?php
namespace App\Http\Requests\pago\individual;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StorePagoRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    $id_pedido = Crypt::decrypt($this->id_pedido);
    $pedido = \App\Models\Pedido::select('id', 'mont_tot_de_ped')->with('pagos')->findOrFail($id_pedido);
    $sum_mont_de_pag = $pedido->pagos()->sum('mont_de_pag');
    $max_monto = $pedido->mont_tot_de_ped - $sum_mont_de_pag;
    return [
      'comprobante_de_pago'     => 'nullable|mimes:pdf,jpg,jpeg,png|max:1024',
      'forma_de_pago'           => 'required|in:Cheque,Efectivo (Jonathan),Efectivo (Gabriel),Efectivo (Fernando),Paypal,Tarjeta de credito (Pagina),Tarjeta de credito (Clip),Tarjeta de debito,Transferencia RUT Yolanda,Transferencia Canastas y Arcones S.A de C.V,Otro',
      'copia_de_identificacion' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1024',
      'monto_del_pago'          => 'required|numeric|min:0|max:'.$max_monto.'|alpha_decimal15',
    ];
  }
}
// |required_if:forma_de_pago,Paypal,Tarjeta de credito (Pagina)