@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar salida').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Registrar salida') }}:</strong>
      @can('logistica.direccionLocal.show')
        <a href="{{ route('logistica.direccionLocal.show', Crypt::encrypt($direccion->id)) }}" class="text-white">{{ $direccion->est }} ({{ Sistema::dosDecimales($direccion->cant) }})</a>
      @else
        {{ $direccion->est }} ({{ Sistema::dosDecimales($direccion->cant) }})
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $direccion->id }}</small>
    </div>
  </div>
  <div class="card-body">
    <form @submit.prevent="create" enctype="multipart/form-data">
      @include('logistica.pedido.direccion_local.comprobante.com_createFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <a href="{{ route('logistica.direccionLocal.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
        </div>
      </div>
    </form>
  </div>
</div>
@include('logistica.pedido.direccion_local.comprobante.com_index')
@endsection

@section('css')
<style>
  #my_camera{
    width: 320px;
    height: 240px;
    border: 1px solid black;
  }
</style>
@endsection

@section('vuejs')
<script src="{{ asset('plugins/webcam-js/webcamjs/webcam.min.js') }}"></script>
<script>
  var app4 = new Vue({
    el: '#dashboard',
    data: {
      errors: [],
      metodos_de_entrega_espesificos: [],
      cantidad:                     [],
      nombre_de_la_persona_que_se_lleva_el_pedido: [],
      metodo_de_entrega:            [],
      metodo_de_entrega_espesifico: [],
    },
    methods: {
       create() {
        this.checarBotonSubmitDisabled("btnsubmit")
        const formData = new FormData()
        formData.append('cantidad', this.cantidad)
        formData.append('nombre_de_la_persona_que_se_lleva_el_pedido', this.nombre_de_la_persona_que_se_lleva_el_pedido)
        formData.append('metodo_de_entrega', this.metodo_de_entrega)
        formData.append('metodo_de_entrega_espesifico', this.metodo_de_entrega_espesifico)
  
        axios.post('/logistica/direccion/local/comprobante/salida/almacenar/'+{{ $direccion->id }}, formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(res => {
          Swal.fire({
            title: 'Éxito',
            text: '¡Comprobante registrado exitosamente!',
          }).then((value) => {
            location.reload()
          })
        }).catch(error => {
          this.checarBotonSubmitEnabled("btnsubmit")
          if(error.response.status == 422) {
            this.errors = error.response.data.errors
          } else {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          }
        });
        
      },
      async getMetodosDeEntregaEspesificos() {
        if(this.metodo_de_entrega != '') {
          axios.get('/logistica/direccion/metodo-de-entrega-espescifico/'+this.metodo_de_entrega).then(res => {
            this.metodos_de_entrega_espesificos = res.data
            metodo_de_entrega_espesifico = document.getElementById('metodo_de_entrega_espesifico')
            metodo_de_entrega_espesifico.style.display = 'none';
            if(Object.keys(res.data).length != 0) { 
              metodo_de_entrega_espesifico.style.display = 'block';
            }
          }).catch(error => {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          });
        }
      },
      async checarBotonSubmitDisabled(id_btn) {
        document.getElementById(id_btn).value = "Espere un momento...";
        document.getElementById(id_btn).disabled = true;
        return true;
      },
      async checarBotonSubmitEnabled(id_btn) {
        document.getElementById(id_btn).value = "Espere un momento...";
        document.getElementById(id_btn).disabled = false;
        return true;
      },
    }
  });
</script>
@endsection