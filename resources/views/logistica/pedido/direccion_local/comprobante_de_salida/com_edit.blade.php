@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar comprobante').' '.$comprobante->id)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar comprobante') }}: </strong>
      @can('logistica.direccionLocal.comprobante.show')
        <a href="{{ route('logistica.direccionLocal.comprobante.show', Crypt::encrypt($comprobante->id)) }}" class="text-white">{{ $comprobante->id }}</a>
      @else
        {{ $comprobante->id }}
      @endcan
      <strong>{{ __('de la dirección') }}: </strong>{{ $direccion->est }}
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $comprobante->id }}</small>
    </div>
  </div>
  <div class="card-body">
    <form @submit.prevent="edit" enctype="multipart/form-data">
      @include('logistica.pedido.direccion_local.comprobante_de_salida.com_createComprobanteDeSalidaFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <a href="{{ route('logistica.direccionLocal.comprobanteDeSalida.create', Crypt::encrypt($direccion->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Continuar con la dirección') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Actualizar') }}</button>
        </div>
      </div>
    </form>
  </div>
</div>
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
      cantidad:                     "{{ $comprobante->cant }}",
      metodo_de_entrega:            "{{ $comprobante->met_de_entreg_de_log }}",
      metodo_de_entrega_espesifico: "{{ $comprobante->met_de_entreg_de_log_esp }}",
      comprobante_de_salida:        [],
      mydata: null
    },
    mounted() {
      this.getMetodosDeEntregaEspesificos()
    },
    methods: {
      edit() {
        event.preventDefault();     
        Swal.fire({
          title: '¡Alerta!',
          text: '¿Estás seguro quieres actualizar el registro?',
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Continuar',
          cancelButtonText: 'Cancelar',
          reverseButtons: false,
        }).then((result) => {
          if (result.value) {
        //    this.checarBotonSubmitDisabled("btnsubmit")
            fetch(mydata.value)
              .then(res => res.blob())
              .then(blob => {
                var formData = new FormData()
                formData.append('cantidad', this.cantidad)
                formData.append('metodo_de_entrega', this.metodo_de_entrega)
                formData.append('metodo_de_entrega_espesifico', this.metodo_de_entrega_espesifico)
                if(blob.type != 'text/html') {
                  formData.append('comprobante_de_salida', blob, 'filename')
                  formData.append('mydata', this.mydata)
                }
                axios.put('/logistica/direccion/local/comprobante-de-salida/actualizar/'+{{ $comprobante->id }}, formData, {
                  headers: {
                    'Content-Type': 'multipart/form-data'
                  }
                }).then(res => {
                  console.log(res)
                  Swal.fire({
                    title: 'Éxito',
                    text: '¡Comprobante registrado exitosamente!',
                  }).then((value) => {
                  //  location.reload()
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
    dest_width: 640,
    dest_height: 480,
    image_format: 'jpeg',
    jpeg_quality: 90,
    force_flash: false
  });
  Webcam.attach('#my_camera');
</script>
@endsection


