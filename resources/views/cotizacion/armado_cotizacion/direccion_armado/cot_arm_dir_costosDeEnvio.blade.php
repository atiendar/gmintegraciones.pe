<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5>{{ __('Costos de envío') }}</h5>
  </div>
  <div class="card-body">
    <div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 15em;">
      <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
        <thead>
          <tr>
            <th>{{ __('MET. ENTREGA') }}</th>
            <th>{{ __('ESTADO') }}</th>
            <th>{{ __('TIP. ENVÍO') }}</th>
            <th>{{ __('COS. ENVÍO') }}</th>
            <th colspan="1">&nbsp</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="!costos.length"><td colspan="5">@include('layouts.private.busquedaSinResultados')</td></tr>
          <tr v-for="todo in costos">
            <td v-text="todo.met_de_entreg"></td>
            <td v-text="todo.est"></td>
            <td v-text="todo.tip_env"></td>
            <td v-text="todo.cost_por_env"></td>
            <td width="1rem" title="Seleccionar">
              <a href="" class="btn btn-light btn-sm" @click.prevent="getSeleccionado(todo.cost_por_env)"><i class="fas fa-check"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

@section('js6')
<script>
  var app4 = new Vue({
    el: '#dashboard',
    data: {
      costos: [],
      metodo_de_entrega: null,
      estado_al_que_se_cotizo: null,
      tipo_de_envio: null,
      costo_de_envio: null
    },
    mounted() {
      this.getCostos()
    },
    methods: {
      getCostos() {
        var urlCostos = '/costo-de-envio/obtener';
        axios.get(urlCostos, {
          params: {
            metodo_de_entrega:  this.metodo_de_entrega,
            estado:             this.estado_al_que_se_cotizo,
            tipo_de_envio:      this.tipo_de_envio,
          }
        }).then(response => {
          this.costos = response.data
          console.log(this.costos)
        }).catch(error => {
          console.log(error)
          Swal.fire({
            icon: 'error',
            title: 'Algo salio mal',
            text: error,
          })
        });
      },
      getSeleccionado(cost_por_env) {
        this.costo_de_envio = cost_por_env
      }
    }
  })
</script>
@endsection