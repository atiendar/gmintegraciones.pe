@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Editar costo de envío').' '.$costo_de_envio->est)</title>
<div class="card {{ config('app.color_card_primario') }} card-outline card-tabs position-relative bg-white">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_primario') }}">
    <h5>
      <strong>{{ __('Editar registro') }}: </strong>
      @can('costoDeEnvio.show')
        <a href="{{ route('costoDeEnvio.show', Crypt::encrypt($costo_de_envio->id)) }}" class="text-white">{{ $costo_de_envio->est }}</a>
      @else
        {{ $costo_de_envio->est }}
      @endcan
    </h5>
  </div>
  <div class="ribbon-wrapper">
    <div class="ribbon {{ config('app.color_bg_primario') }}"> 
      <small>{{ $costo_de_envio->id }}</small>
    </div>
  </div>
  <div class="card-body">
    <form @submit.prevent="update" enctype="multipart/form-data">
      @include('costo_de_envio.cos_createFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <a href="{{ route('costoDeEnvio.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
        </div>
      </div>
    {{--   @include('layouts.private.plugins.priv_plu_select2') --}}
    </form>
  </div>
</div>
@endsection

@section('vuejs')
<script>
  var app4 = new Vue({
    el: '#dashboard',
    data: {
      errors:                         [],
      metodos_de_entrega:             [],
      metodos_de_entrega_espesificos: [],
      estados:                        [],
      tipos_de_envio:                 [],

      foraneo_o_local:              "{{ $costo_de_envio->for_loc }}",
      metodo_de_entrega:            "{{ $costo_de_envio->met_de_entreg }}",
      metodo_de_entrega_espesifico: "{{ $costo_de_envio->met_de_entreg_esp }}",
      cuenta_con_seguro:            "{{ $costo_de_envio->seg }}",
      estado:                       "{{ $costo_de_envio->est }}",
      tamano:                       "{{ $costo_de_envio->tam }}",
      tipo_de_empaque:              "{{ $costo_de_envio->tip_emp }}",
      tiempo_de_entrega:            "{{ $costo_de_envio->tiemp_ent }}",
      tipo_de_envio:                "{{ $costo_de_envio->tip_env }}",
      costo_por_envio:              "{{ $costo_de_envio->cost_por_env }}"
    },
    mounted() {
      this.getMetodosDeEntrega(1)
      this.getTiposDeEnvio(1)
    },
    methods: {
      async update() {
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
          reverseButtons: true,
        }).then((result) => {
          if (result.value) {
            this.checarBotonSubmitDisabled("btnsubmit")
            axios.put('/costo-de-envio/actualizar/'+{{ $costo_de_envio->id }}, {
              foraneo_o_local:              this.foraneo_o_local,
              metodo_de_entrega:            this.metodo_de_entrega,
              metodo_de_entrega_espesifico: this.metodo_de_entrega_espesifico,
              cuenta_con_seguro:            this.cuenta_con_seguro,
              estado:                       this.estado,
              tamano:                       this.tamano,
              tipo_de_empaque:              this.tipo_de_empaque,
              tiempo_de_entrega:            this.tiempo_de_entrega,
              tipo_de_envio:                this.tipo_de_envio,
              costo_por_envio:              this.costo_por_envio,
              tipos_de_envio:               this.tipos_de_envio,
            }).then(res => {
              Swal.fire({
                title: 'Éxito',
                text: '¡Costo de envío actualizado exitosamente!',
              }).then((value) => {
                location.reload()
              })
            }).catch(error => {
              this.checarBotonSubmitEnabled("btnsubmit")
              if(error.response.status == 422) {
                this.errors   = error.response.data.errors
              } else {
                Swal.fire({
                  title: 'Algo salio mal',
                  text: error,
                })
              }
            });
          }
        });
      },
      async getMetodosDeEntrega($val) {
        if($val == 2) {
          this.metodo_de_entrega            = null
          this.metodo_de_entrega_espesifico = null
          this.estado                       = null
          this.tipo_de_envio                = null
          this.tiempo_de_entrega            = null
        }

        if(this.foraneo_o_local != '') {
          if(this.foraneo_o_local == 'Local') {
            this.tiempo_de_entrega = 'De 1 a 4 dias'
          } else {
            this.tiempo_de_entrega = 'De 7 a 10 dias'
          }
          // TREA TODOS LOS METODOS DE ENTREGA CORRESPONDIENTES
          axios.get('/logistica/direccion/metodo-de-entrega/'+this.foraneo_o_local).then(res => {
            this.metodos_de_entrega = res.data
            metodo_de_entrega = document.getElementById('metodo_de_entrega')
            metodo_de_entrega.style.display = 'none';
            if(Object.keys(res.data).length != 0) { 
              metodo_de_entrega.style.display = 'block';
            }
          }).catch(error => {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          }); 
          this.getEstados()
        }
      },
      async getEstados() {
        // TREA TODOS LOS ESTADOS CORRESPONDIENTES
        axios.get('/estado/obtener/'+this.foraneo_o_local).then(res => {
          this.estados = res.data
          estado = document.getElementById('estado')
          estado.style.display = 'none';
          if(Object.keys(res.data).length != 0) { 
            estado.style.display = 'block';
          }
        }).catch(error => {
          Swal.fire({
            title: 'Algo salio mal',
            text: error,
          })
        });
      },
      async getTiposDeEnvio($val) {
        if($val == 2) {
          this.metodo_de_entrega_espesifico = null
          this.tipo_de_envio                = null
        }

        // TREA TODOS LOS METODOS DE ENVIO
        if(this.metodo_de_entrega != '') {
          axios.get('/metodo-de-entrega/obtener/'+this.metodo_de_entrega).then(res => {
            this.tipos_de_envio = res.data
            tipo_de_envio = document.getElementById('tipo_de_envio')
            tipo_de_envio.style.display = 'none';
            if(Object.keys(res.data).length != 0) { 
              tipo_de_envio.style.display = 'block';
            }
          }).catch(error => {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          });
        }
        if(this.metodo_de_entrega == 'Paquetería') {
          this.getMetodosDeEntregaEspesificos()
        } else {
          metodo_de_entrega_espesifico = document.getElementById('metodo_de_entrega_espesifico')
          metodo_de_entrega_espesifico.style.display = 'none';
        }
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
      async getDecimal() {
        costo_por_envio = document.getElementById("costo_por_envio").value;
        if (isNaN(parseFloat(costo_por_envio))) {
          costo_por_envio = 0;
        }
        costo_por_envio_decimal   = Number.parseFloat(costo_por_envio).toFixed(2);
        this.costo_por_envio = costo_por_envio_decimal;
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
      }
    }
  });
</script>
@endsection