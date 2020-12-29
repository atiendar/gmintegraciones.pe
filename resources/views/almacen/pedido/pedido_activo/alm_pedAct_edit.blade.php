
@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido activo almacén').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->per_reci_alm) ? config('app.color_card_warning') : config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ empty($pedido->per_reci_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusAlmacenHeader')
    </div>
    <h5>
      <strong>{{ __('Editar pedido almacén') }}: </strong>
      @can('almacen.pedidoActivo.show')
        <a href="{{ route('almacen.pedidoActivo.show', Crypt::encrypt($pedido->id)) }}" class="text-white">{{ $pedido->num_pedido }}</a>
      @else
        {{ $pedido->num_pedido }}
      @endcan
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ empty($pedido->per_reci_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
</div>
<div class="row">
  @can('almacen.pedidoActivo.edit')
    <div class="col-md-7">
      <div class="pad">
          <div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
            <div class="card-body">
              {!! Form::open(['route' => ['almacen.pedidoActivo.update', Crypt::encrypt($pedido->id)], 'method' => 'patch', 'id' => 'almacenPedidoActivoUpdate']) !!}
                @include('almacen.pedido.pedido_activo.alm_pedAct_editFields')
              {!! Form::close() !!}
            </div>
          </div>
      </div>
    </div>
  @endcan
  @include('venta.pedido.pedido_activo.ven_pedAct_showFields.numeroDePedidoUnificado', ['alto' => 'height: 17.6em;'])
</div>
@include('almacen.pedido.pedido_activo.armado_activo.alm_pedAct_armAct_index')
@endsection



{{--

@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar pedido activo almacén').' '.$pedido->num_pedido)</title>
<div class="card {{ empty($pedido->per_reci_alm) ? config('app.color_card_warning') : config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ empty($pedido->per_reci_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}">
    <div class="float-right mr-5">
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.estatusAlmacenHeader')
    </div>
    <h5>
      <strong>{{ __('Editar pedido almacén') }}: </strong>
      @can('almacen.pedidoActivo.show')
        <a href="{{ route('almacen.pedidoActivo.show', Crypt::encrypt($pedido->id)) }}" class="text-white">{{ $pedido->num_pedido }}</a>
      @else
        {{ $pedido->num_pedido }}
      @endcan
      @include('venta.pedido.pedido_activo.ven_pedAct_showFields.entr_xprs_urg_foraneo_gratis')
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ empty($pedido->per_reci_alm) ? config('app.color_bg_warning') : config('app.color_bg_primario') }}"> 
      <small>{{ $pedido->num_pedido }}</small>
    </div>
  </div>
</div>






{{-- ========================================================================================= --}}
{{--
@section('css')
<style>
  canvas {
      width: 600px;
      height: 200px;
      background-color: #fff;
      border: rgb(0, 0, 0) solid 1px;
  } 
</style>
@endsection

<div class="row">
  <canvas id="pizarra"></canvas>
</div>
<div class="row">
  <button type="button" id="limpiar" class="btn btn-info btn-sm">Limpiar</button>
  <button type="button" id="guardar" class="btn btn-success btn-sm">Guardar</button>
</div>

@section('js1')
<script>
  //======================================================================
  // VARIABLES
  //======================================================================
  let miCanvas = document.querySelector('#pizarra');
  let lineas = [];
  let correccionX = 0;
  let correccionY = 0;
  let pintarLinea = false;
  // Marca el nuevo punto
  let nuevaPosicionX = 0;
  let nuevaPosicionY = 0;

  let posicion = miCanvas.getBoundingClientRect()
  correccionX = posicion.x;
  correccionY = posicion.y;

  miCanvas.width = 600;
  miCanvas.height = 200;

  //======================================================================
  // FUNCIONES
  //======================================================================
  /**
   * Funcion que guarda la información
  */
  var guardar = document.getElementById("guardar");
  guardar.addEventListener("click",function(){	
    miCanvas.src = miCanvas.toDataURL("image/png");

    fetch(miCanvas.src)
      .then(res => res.blob())
      .then(blob => {
        const formData = new FormData()
        formData.append('imagen', blob, 'filename')

        axios.post('/prueba', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }).then(res => {
          Swal.fire({
            title: 'Éxito',
            text: '¡Imagen guardada exitosamente!',
          }).then((value) => {
            console.log(res)
          })
        }).catch(error => {
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
  },false);

  /**
   * Funcion que limpia lo que se escriba
  */
  var limpiar = document.getElementById("limpiar");
  limpiar.addEventListener('click', function(evt) {
    var ctx = miCanvas.getContext("2d");
    ctx.clearRect(0, 0, miCanvas.width, miCanvas.height);
    lineas = [];
    texto();
  }, false);

  /**
   * Funcion que muentra el texto en el canvas
  */
  $(document).ready(texto);
  function texto(){
    let ctx = miCanvas.getContext('2d')
    f = new Date();
    fecha = f.getDate()+'/'+f.getMonth()+'/'+f.getFullYear();
    horafinal = f.getHours(); + ":" + f.getMinutes();

    ctx.fillStyle = "#ffffff";        
    ctx.fillStyle = "#111";
    ctx.font="25px Monospace";
    ctx.fillText('Nombre:', 5,20);
    ctx.fillText('Fecha:'+fecha+' '+horafinal, 5,100);
    ctx.fillText('Firma:', 5,180);
  };

  /**
   * Funcion que empieza a dibujar la linea
   */
  function empezarDibujo () {
      pintarLinea = true;
      lineas.push([]);
  };
  
  /**
   * Funcion que guarda la posicion de la nueva línea
   */
  function guardarLinea() {
      lineas[lineas.length - 1].push({
          x: nuevaPosicionX,
          y: nuevaPosicionY
      });
  }

  /**
   * Funcion dibuja la linea
   */
  function dibujarLinea (event) {
      event.preventDefault();
      if (pintarLinea) {
          let ctx = miCanvas.getContext('2d')

          // Estilos de linea
          ctx.lineJoin = ctx.lineCap = 'round';
          ctx.lineWidth = 1;
          // Color de la linea
          ctx.strokeStyle = '#000';
          // Marca el nuevo punto
          if (event.changedTouches == undefined) {
              // Versión ratón
              nuevaPosicionX = event.layerX;
              nuevaPosicionY = event.layerY;
          } else {
              // Versión touch, pantalla tactil
              nuevaPosicionX = event.changedTouches[0].pageX - correccionX;
              nuevaPosicionY = event.changedTouches[0].pageY - correccionY;
          }
          // Guarda la linea
          guardarLinea();
          // Redibuja todas las lineas guardadas
          ctx.beginPath();
          lineas.forEach(function (segmento) {
              ctx.moveTo(segmento[0].x, segmento[0].y);
              segmento.forEach(function (punto, index) {
                  ctx.lineTo(punto.x, punto.y);
              });
          });
          ctx.stroke();
      }
  }

  /**
   * Funcion que deja de dibujar la linea
   */
  function pararDibujar () {
      pintarLinea = false;
      guardarLinea();
  }

  //======================================================================
  // EVENTOS
  //======================================================================

  // Eventos raton
  miCanvas.addEventListener('mousedown', empezarDibujo, false);
  miCanvas.addEventListener('mousemove', dibujarLinea, false);
  miCanvas.addEventListener('mouseup', pararDibujar, false);

  // Eventos pantallas táctiles
  miCanvas.addEventListener('touchstart', empezarDibujo, false);
  miCanvas.addEventListener('touchmove', dibujarLinea, false);

</script>
@endsection

{{-- ========================================================================================= --}}






















{{--





<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5><strong>{{ __('PRODUCTOS') }}</h5>
  </div>
  <div class="card-body">
    <div class="card-body table-responsive p-0" id="div-tabla-scrollbar2" style="height: 40em;">
      <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
        <tbody>
        @foreach($productos as $producto)
        <tr>
          <td>
            <div class="card p-0 m-0">
              <div class="card-header p-0 m-0" id="h{{ $producto['id'] }}">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#a{{ $producto['id'] }}" aria-expanded="false" aria-controls="a{{ $producto['id'] }}">
                  <strong>{{ $producto['cantidad'] }} - {{ $producto['nombre_producto'] }}</strong>
                </button>
              </div>
              <div id="a{{ $producto['id'] }}" class="collapse" aria-labelledby="h{{ $producto['id'] }}">
                <div class="card-body p-1">
                  {!! Form::open(['route' => ['almacen.pedidoActivo.armado.sistituto.store', Crypt::encrypt($producto['id'])], 'onsubmit' => 'return checarBotonSubmit("btnAlmacenPedidoActivoArmadoSistitutoStore")']) !!}
                    <div class="form-group row p-0 m-0">
                      <div class="col-sm-12">
                        <div class="input-group-append">
                          {!! Form::text('cantidad', null, ['class' => 'form-control input-sm' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'maxlength' => 10, 'placeholder' => __('Cantidad')]) !!}
                          &nbsp&nbsp&nbsp{!! Form::select('sustituto', $producto['list_sustitutos'], [], ['class' => 'form-control select2 input-sm' . ($errors->has('sustituto') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
                          &nbsp&nbsp&nbsp<button type="submit" id="btnAlmacenPedidoActivoArmadoSistitutoStore" class="btn btn-info rounded" title="{{ __('Cargar') }}"><i class="fas fa-check-circle text-dark"></i></button>
                        </div>
                        <span class="text-danger">{{ $errors->first('cantidad') }}<br></span>
                        <span class="text-danger">{{ $errors->first('sustituto') }}</span>
                      </div>
                    </div>
                  {!! Form::close() !!}
                  <hr>
                  {{ __('SUSTITUTOS') }}
                  @foreach($producto['sustitutos'] as $sustituto)
                    <div class="input-group text-muted ml-4">
                      {{ $sustituto['cantidad'] }} - {{ $sustituto['producto'] }}
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
--}}