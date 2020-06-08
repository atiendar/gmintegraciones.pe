@extends('layouts.private.escritorio.dashboard') 
@section('contenido')
<title>@section('title', __('Editar dirección').' '.$direccion->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar dirección') }}: </strong>{{ $direccion->est }}
      <strong>{{ __('del armado') }}: </strong>{{ $direccion->armado->nom }}
    </h5>  
  </div>
  <div class="card-body">
    @include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_editFields')
  </div>
</div>
@include('cotizacion.armado_cotizacion.direccion_armado.cot_arm_dir_costosDeEnvio')
@endsection

@section('vuejs')
<script>
  var app4 = new Vue({
    el: '#dashboard',
    data: {
      errors: [],
      hasError: false,
      costos: [],
      filtrar: [
        metodo_de_entrega  = null,
        estado             = null,
        tipo_de_envio      = null,
      ],

      metodo_de_entrega:        "{{ $direccion->met_de_entreg }}",
      estado_al_que_se_cotizo:  "{{ $direccion->est }}",
      foraneo_o_local:          "{{ $direccion->for_loc }}",
      tipo_de_envio:            "{{ $direccion->tip_env }}",
      costo_de_envio:           "{{ $direccion->cost_por_env }}",
      cantidad:                 "{{ $direccion->cant }}",
      detalles_de_la_ubicacion: "{{ $direccion->detalles_de_la_ubicacion }}",

      costo_seleccionado: [],
      cost_por_env: null,
      costo_de_envio_origin: "{{ $direccion->cost_por_env }}",
      cant_origin: "{{ $direccion->cant }}",
      costo: null
    },
    methods: {
      async edit() {
        this.checarBotonSubmit("btnsubmit")
        axios.put('/cotizacion/armado/direccion/actualizar/'+{{ $direccion->id }}, {
          metodo_de_entrega:        this.metodo_de_entrega,
          estado_al_que_se_cotizo:  this.estado_al_que_se_cotizo,
          foraneo_o_local:          this.foraneo_o_local,
          tipo_de_envio:            this.tipo_de_envio,
          costo_de_envio:           this.costo_de_envio,
          cantidad:                 this.cantidad,
          detalles_de_la_ubicacion: this.detalles_de_la_ubicacion,
          costo_seleccionado:       this.costo_seleccionado
        }).then(res => {
          Swal.fire({
            title: 'Éxito',
            text: '¡Dirección actualizada exitosamente!',
          }).then((value) => {
            location.reload()
          })
        }).catch(error => {
          if(error.response.status == 422) {
            this.errors   = error.response.data.errors,
            this.hasError = true
          } else {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          }
        });
      },
      async getCostos() {
        var urlCostos = '/costo-de-envio/obtener';
        axios.get(urlCostos, {
          params: {
            metodo_de_entrega:  this.filtrar.metodo_de_entrega,
            estado:             this.filtrar.estado,
            tipo_de_envio:      this.filtrar.tipo_de_envio,
          }
        }).then(res => {
          this.costos = res.data
        }).catch(error => {
          Swal.fire({
            title: 'Algo salio mal',
            text: error,
          })
        }); 19.70
      },
      async getCostoSeleccionado(costo_env) {
        this.costo_seleccionado      = costo_env
        this.metodo_de_entrega       = costo_env.met_de_entreg
        this.estado_al_que_se_cotizo = costo_env.est
        this.foraneo_o_local         = costo_env.for_loc
        this.tipo_de_envio           = costo_env.tip_env
        this.costo_de_envio          = costo_env.cost_por_env
        this.getCostoDeEnvio()
      },
      async getCostoDeEnvio() {
        // VERIFICA SI EL OBJETO ESTA VACIO O NO
        if(Object.keys(this.costo_seleccionado).length === 0) {
          this.costo = 0
          this.costo = parseFloat(this.costo_de_envio_origin) / parseFloat(this.cant_origin)
          this.cost_por_env = parseFloat(this.costo) * parseFloat(this.cantidad)
        } else {
          this.cost_por_env = parseFloat(this.costo_seleccionado.cost_por_env) * parseFloat(this.cantidad)
        }

        if (isNaN(parseFloat(this.cost_por_env))) {
          this.cost_por_env = this.costo_de_envio
        }
        this.costo_de_envio = Number.parseFloat(this.cost_por_env).toFixed(2)

        if (isNaN(parseFloat(this.cost_por_env))) {
          this.costo_de_envio = null
        }
      },
      async checarBotonSubmit(id_btn) {
        document.getElementById(id_btn).value = "Espere un momento...";
        document.getElementById(id_btn).disabled = true;
        return true;
      },
    }
  });
</script>
@endsection