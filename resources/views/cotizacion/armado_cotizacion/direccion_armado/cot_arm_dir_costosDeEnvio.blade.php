<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5>{{ __('Costos de envío') }}</h5>
  </div>
  <div class="card-body">
    <div class="row border  border-primary rounded mb-3">
      <div class="form-group col-sm btn-sm">
        <label for="filtar_metodo_de_entrega">{{ __('Filtrar método de entrega') }}</label>
        <div class="input-group">
          {!! Form::select('filtar_metodo_de_entrega', config('opcionesSelect.select_metodo_de_entrega'), null, ['v-on:change' => 'getCostos', 'v-model' => 'filtrar.metodo_de_entrega', 'class' => 'form-control form-control-sm select2', 'placeholder' => __('')]) !!}   
        </div>
      </div> 
      <div class="form-group col-sm btn-sm">
        <label for="filtrar_estado">{{ __('Filtrar estado') }}</label>
        <div class="input-group">
          {!! Form::select('filtrar_estado', config('opcionesSelect.select_estado'), null, ['v-on:change' => 'getCostos', 'v-model' => 'filtrar.estado', 'class' => 'form-control form-control-sm select2', 'placeholder' => __('')]) !!}   
        </div>
      </div>
      <div class="form-group col-sm btn-sm">
        <label for="filtrar_tipo_de_envio">{{ __('Filtrar tipo de envío') }}</label>
        <div class="input-group">
          {!! Form::select('filtrar_tipo_de_envio', config('opcionesSelect.select_tipo_de_envio'), null, ['v-on:change' => 'getCostos', 'v-model' => 'filtrar.tipo_de_envio', 'class' => 'form-control form-control-sm select2', 'placeholder' => __('')]) !!}   
        </div>
      </div>
    </div>
    <div class="card-body table-responsive p-0" style="height: 15em;">
      <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
        <thead>
          <tr>
            @include('costo_de_envio.cos_table.th.metodoDeEntrega')
            @include('costo_de_envio.cos_table.th.estado')
            @include('costo_de_envio.cos_table.th.tipoDeEnvio')
            @include('costo_de_envio.cos_table.th.costoPorEnvio')
            <th colspan="1">&nbsp</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="!costos.length"><td colspan="5">@include('layouts.private.busquedaSinResultados')</td></tr>
          <tr v-for="costo in costos">
            <td v-text="costo.met_de_entreg"></td>
            <td v-text="costo.est"></td>
            <td v-text="costo.tip_env"></td>
            <td v-text="costo.cost_por_env"></td>
            <td width="1rem" title="Seleccionar">
              <a href="" class="btn btn-light btn-sm" @click.prevent="getCostoSeleccionado(costo)"><i class="fas fa-check"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>