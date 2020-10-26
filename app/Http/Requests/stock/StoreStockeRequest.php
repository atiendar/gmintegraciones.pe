<?php
namespace App\Http\Requests\stock;
use Illuminate\Foundation\Http\FormRequest;

class StoreStockeRequest extends FormRequest {
  public function authorize() {
    return true;
  }
  public function rules() {
    return [
      'armado'      => 'required|min:40|string',
      'cantidad'    => 'required|max:40|string',
    ];
  }
}