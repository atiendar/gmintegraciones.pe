<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad">{{ __('Cantidad') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('cantidad', null, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'maxlength' => 5, 'placeholder' => __('Cantidad')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('cantidad') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="metodo_de_entrega">{{ __('Método de entrega') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('metodo_de_entrega', config('opcionesSelect.select_metodo_de_entrega'), null, ['v-on:change' => 'getCostos', 'v-model' => 'metodo_de_entrega', 'class' => 'form-control select2' . ($errors->has('metodo_de_entrega') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}   
    </div>
    <span class="text-danger">{{ $errors->first('metodo_de_entrega') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="estado_al_que_se_cotizo">{{ __('Estado al que se cotizo') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('estado_al_que_se_cotizo', config('opcionesSelect.select_estado'), null, ['v-on:change' => 'getCostos', 'v-model' => 'estado_al_que_se_cotizo', 'class' => 'form-control select2' . ($errors->has('estado_al_que_se_cotizo') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}   
    </div>
    <span class="text-danger">{{ $errors->first('estado_al_que_se_cotizo') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="detalles_de_la_ubicacion">{{ __('Detalles de la ubicación') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('detalles_de_la_ubicacion', null, ['class' => 'form-control' . ($errors->has('detalles_de_la_ubicacion') ? ' is-invalid' : ''), 'maxlength' => 100, 'placeholder' => __('Detalles de la ubicación')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('detalles_de_la_ubicacion') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="tipo_de_envio">{{ __('Tipo de envío') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo_de_envio', config('opcionesSelect.select_tipo_de_envio'), 'Normal', ['v-on:change' => 'getCostos', 'v-model' => 'tipo_de_envio', 'class' => 'form-control select2' . ($errors->has('tipo_de_envio') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}   
    </div>
    <span class="text-danger">{{ $errors->first('tipo_de_envio') }}</span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="costo_de_envio">{{ __('Costo de envío') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('costo_de_envio', null, ['v-model.costo_de_envio' => 'getCostos', 'id' => 'costo_de_envio', 'class' => 'form-control' . ($errors->has('costo_de_envio') ? ' is-invalid' : ''), 'maxlength' => 15, 'placeholder' => __('Costo de envío'), 'onChange' => 'getCostoDeEnvioDecimal();']) !!}
    </div>
    <span class="text-danger">{{ $errors->first('costo_de_envio') }}</span>
  </div>
</div>
@{{ costo_de_envio }}
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('cotizacion.armado.edit', Crypt::encrypt($armado->id)) }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Continuar con el armado') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar dirección') }}</button>
  </div>
</div>







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
      <tbody v-for="todo in costos"> 
        <td v-text="todo.met_de_entreg"></td>
        <td v-text="todo.est"></td>
        <td v-text="todo.tip_env"></td>
        <td v-text="todo.cost_por_env"></td>
        <td width="1rem" title="Seleccionar">
          <a href="" class="btn btn-light btn-sm" @click.prevent="getSeleccionado(todo.id)"><i class="fas fa-check"></i></a>
        </td>
      </tbody>
  </table>
</div>


@section('js1')
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
        var urlCostos = '/costo-de-envio';
        axios.get(urlCostos, {
          params: {
            metodo_de_entrega:  this.metodo_de_entrega,
            estado:             this.estado_al_que_se_cotizo,
            tipo_de_envio:      this.tipo_de_envio,
          }
        }).then(response => {
          this.costos = response.data
        }).catch(error => {
          console.log(error)
          Swal.fire({
            icon: 'error',
            title: 'Algo salio mal',
            text: error,
          })
        });
      },
      getSeleccionado(id) {
   
     
        this.costo_de_envio === id
      }
    }
  })
</script>
@endsection





@include('layouts.private.plugins.priv_plu_select2')
@section('js6')
<script>






  function getCostoDeEnvioDecimal() {
    // Obtiene los valores de los inputs
    costo_de_envio = document.getElementById("costo_de_envio").value;
   
    // Verifica si los inputs son de tipo float de lo contrario les asigan el valor de 0
    if (isNaN(parseFloat(costo_de_envio))) {
      costo_de_envio = 0;
    }

    // Agrega o solo deja dos decimales
    costo_de_envio_decimal  = Number.parseFloat(costo_de_envio).toFixed(2);
    document.getElementById("costo_de_envio").value = costo_de_envio_decimal;
  }
</script>
@endsection