@extends('layouts.private.escritorio.dashboard')
@section('titulo')
<div class="col-sm-6">
  <h1 class="m-0 text-dark"> {{ __('Inicio') }}</h1>
</div>
@endsection
@section('contenido')
<title>@section('title', __('Inicio'))</title>
@if(auth()->user()->hasRole(config('app.rol_cliente')))


  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h3><i class="icon fas fa-info"></i> Info</h3>
    <h4>
      {{ __('Bienvenido a') }} {{ Sistema::datos()->sistemaFindOrFail()->emp }} {{ __('en este portal podrás darle seguimiento a tus pedidos, solicitar tus facturas y registrar tus pagos') }}.
    </h4>
  </div>
  
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h3><i class="icon fas fa-info"></i> Info</h3>
    <h4>
      {{ __('Asegúrate de que este completa toda tu información en el sistema: Comprobante de pago cargado, factura solicitada, direcciones de entrega asignadas a cada partida del pedido') }}.
    </h4>
  </div>

  <div class="row">
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h2>
            <a href="https://canastasyarcones.mx/contacto/" target="_blank" class="text-dark">{{ __('Cotizar') }} <i class="fas fa-arrow-circle-right"></i></a>
          </h2>
          <p>{{ __('Llenar formulario') }}</p>
        </div>
        <div class="icon">
          <i class="ion fas far fa-plus-square"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h2>
            <a href="{{ route('rolCliente.pedido.index') }}" class="text-dark">{{ __('Ver pedidos') }} <i class="fas fa-arrow-circle-right"></i></a>
            <br><br>
          </h2>
        </div>
        <div class="icon">
          <i class="ion fas fa-shopping-bag"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h2>
            <a href="{{ route('rolCliente.pago.create') }}" class="text-dark">{{ __('Registrar pago') }} <i class="fas fa-arrow-circle-right"></i></a>
            <br><br>
          </h2>
        </div>
        <div class="icon"> 
          <i class="ion fas far fa-plus-square"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h2>
            <a href="{{ route('rolCliente.factura.create') }}" class="text-dark">{{ __('Solicitar factura') }} <i class="fas fa-arrow-circle-right"></i></a>
            <br><br>
          </h2>
        </div>
        <div class="icon">
          <i class="ion fas far fa-plus-square"></i>
        </div>
      </div>
    </div>
  </div>
{{-- 
  <div class="alert alert-primary alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>
      {{ __('Te gusto nuestro servicio califícanos en ') }}  <a href="https://www.google.com.mx/maps/place/ARCONES+NAVIDE%C3%91OS+Y+CANASTAS+NAVIDE%C3%91AS/@19.455287,-99.2207556,18.5z/data=!4m8!1m2!2m1!1scanastas+y+arcones!3m4!1s0x0:0xb8c67a4ea0565225!8m2!3d19.45584!4d-99.2203232" target="_blank">{{ __('Google Maps') }}</i></a> y <a href="{{ Sistema::datos()->sistemaFindOrFail()->red_fbk }}" target="_blank">{{ __('Facebook') }}</i></a>.
    </h4>
  </div>
  --}}
@endif

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
    h = f.getHours();
    m = f.getMinutes();
    s = f.getSeconds();
    if(h < 10) h = "0" + h;
    else h = h;
    if(m < 10) m = "0" + m;
    else m = m;
    if(s < 10) s = "0" + s;
    else s = s;
    horafinal = h + ":" + m;
    ctx.fillStyle = "#ffffff";        
    ctx.fillStyle = "#111";
    ctx.font="25px Monospace";
    ctx.fillText('Nombre:', 5,20);
    ctx.fillText('Fecha:'+horafinal, 5,100);
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
--}}
@endsection