@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar comprobante de salida').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    @include('logistica.pedido.direccion_local.dirLoc_opcionesComprobantes')
    <h5>{{ __('Registrar comprobante de salida') }}: {{ $direccion->est }} ({{ Sistema::dosDecimales($direccion->cant) }})</h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $direccion->id }}</small>
    </div>
  </div>
  <div class="card-body">
    <form @submit.prevent="create" enctype="multipart/form-data">
      @include('logistica.pedido.direccion_local.dirLoc_createComprobanteDeSalidaFields')
    </form>
  </div>
</div>
@include('logistica.pedido.pedido_activo.armado_activo.direccion_armado.comprobante_de_entrega.comEnt_index')
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
      metodo_de_entrega:            [],
      metodo_de_entrega_espesifico: [],
      comprobante_de_salida:        [],
      mydata: null
    },
    methods: {
       create() {
        this.checarBotonSubmitDisabled("btnsubmit")
        fetch(mydata.value)
          .then(res => res.blob())
          .then(blob => {
            const formData = new FormData()
            formData.append('cantidad', this.cantidad)
            formData.append('metodo_de_entrega', this.metodo_de_entrega)
            formData.append('metodo_de_entrega_espesifico', this.metodo_de_entrega_espesifico)
            formData.append('comprobante_de_salida', blob, 'filename')
            formData.append('mydata', this.mydata)
      
            axios.post('/logistica/direccion-local/almacenar-comprobante-de-salida/'+{{ $direccion->id }}, formData, {
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
         });
      },
      async getMetodosDeEntregaEspesificos() {
        axios.get('/logistica/direccion-local/metodo-de-entrega-espescifico/'+this.metodo_de_entrega).then(res => {
          this.metodos_de_entrega_espesificos = res.data
        }).catch(error => {
          Swal.fire({
            title: 'Algo salio mal',
            text: error,
          })
        });
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
      async quitarFoto() {
        document.getElementById('mydata').value = '';
        document.getElementById('results').innerHTML = 
            '<img src=""/>';
      },
      async capturarFoto() {
        var data_uri = Webcam.snap( function(data_uri, canvas, context) {
          document.getElementById('mydata').value = data_uri;
          document.getElementById('results').innerHTML = 
            '<img src="'+data_uri+'"/>';
        });
      },
    }
  });
  Webcam.set({
    width: 320,
    height: 240,
    image_format: 'jpeg',
    jpeg_quality: 90
  });
  Webcam.attach('#my_camera');
</script>
@endsection