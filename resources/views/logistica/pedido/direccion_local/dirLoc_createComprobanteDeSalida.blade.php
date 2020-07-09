@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar comprobante de salida').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    @include('logistica.pedido.direccion_local.dirLoc_opcionesComprobantes')
    <h5>{{ __('Registrar comprobante de salida') }}: {{ $direccion->est }}</h5>
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

      cantidad:                     null,
      metodo_de_entrega:            null,
      metodo_de_entrega_espesifico: null,
      comprobante_de_salida:        null
    },
    methods: {
      async create() {
      //  this.checarBotonSubmitDisabled("btnsubmit")


       
        data.append('cantidad', this.cantidad)
        data.append('metodo_de_entrega', this.metodo_de_entrega)
        data.append('metodo_de_entrega_espesifico', this.metodo_de_entrega_espesifico)
        
        console.log(data)


        axios.post('/logistica/direccion-local/almacenar-comprobante-de-salida/'+{{ $direccion->id }}, data, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(res => {
          console.log(res)
          /*
          Swal.fire({
            title: 'Éxito',
            text: '¡Comprobante registrado exitosamente!',
          }).then((value) => {
            location.reload()
          })
          */
        }).catch(error => {
        //  this.checarBotonSubmitEnabled("btnsubmit")
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
        console.log(this.metodo_de_entrega)
        axios.get('/logistica/direccion-local/metodo-de-entrega-espescifico/'+this.metodo_de_entrega).then(res => {
          console.log(res.data);
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
        document.getElementById('results').innerHTML = 
            '<img src=""/>';
      },
      async capturarFoto() {
        var data_uri = Webcam.snap( function(data_uri, canvas, context) {
   
          fetch(data_uri)
          .then(res => res.blob())
          .then(blob => {
            var fd = new FormData()
            fd.append('image', blob, 'filename')
            
           
            console.log(blob)


            let data = new FormData()
            data.append('comprobante_de_salida', blob)

            console.log(data)
            
            // Upload
            // fetch('upload', {method: 'POST', body: fd})
          })

          document.getElementById('results').innerHTML = 
            '<img src="'+data_uri+'"/>';
        });
    //    console.log(data)
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