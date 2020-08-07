<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="foraneo_o_local">{{ __('Foráneo o local') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('foraneo_o_local', config('opcionesSelect.select_foraneo_local'), null, ['v-model' => 'foraneo_o_local', 'v-on:change' => 'getMetodosDeEntrega()', 'class' => 'form-control select2' . ($errors->has('foraneo_o_local') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span v-if="errors.foraneo_o_local" class="text-danger" v-text="errors.foraneo_o_local[0]"></span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="cuenta_con_seguro">{{ __('Cuenta con seguro') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('cuenta_con_seguro', config('opcionesSelect.select_si_no'), null, ['v-model' => 'cuenta_con_seguro', 'class' => 'form-control select2' . ($errors->has('cuenta_con_seguro') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span v-if="errors.cuenta_con_seguro" class="text-danger" v-text="errors.cuenta_con_seguro[0]"></span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" id="metodo_de_entrega" style="display:none">
    <label for="metodo_de_entrega">{{ __('Método de entrega') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      <select v-model='metodo_de_entrega' class ='form-control' data-old='{{ old('metodo_de_entrega')}}' name='metodo_de_entrega'>
        <option value="">Seleccione. . .</option>
        <option v-for="metodo_de_entrega in metodos_de_entrega" v-bind:value="metodo_de_entrega" v-text="metodo_de_entrega"></option>
      </select>
    </div>
    <span v-if="errors.metodo_de_entrega" class="text-danger" v-text="errors.metodo_de_entrega[0]"></span>
  </div>
  <div class="form-group col-sm btn-sm" id="metodo_de_entrega" style="display:none">
    <label for="estado">{{ __('Estado') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      <select v-model='estado' class ='form-control' data-old='{{ old('estado')}}' name='estado'>
        <option value="">Seleccione. . .</option>
        <option v-for="estado in estados" v-bind:value="estado" v-text="estado"></option>
      </select>
    </div>
    <span v-if="errors.estado" class="text-danger" v-text="errors.estado[0]"></span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="tipo_de_empaque">{{ __('Tipo de empaque') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo_de_empaque', config('opcionesSelect.select_tipo_de_empaque'), null, ['class' => 'form-control select2' . ($errors->has('tipo_de_empaque') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('tipo_de_empaque') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="tiempo_de_entrega">{{ __('Tiempo de entrega') }} ({{ __('Dias') }})*</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
      </div>
      {!! Form::text('tiempo_de_entrega', null, ['class' => 'form-control' . ($errors->has('tiempo_de_entrega') ? ' is-invalid' : ''), 'placeholder' => __('Tiempo de entrega')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('tiempo_de_entrega') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="tipo_de_envio">{{ __('Tipo de envío') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo_de_envio', config('opcionesSelect.select_tipo_de_envio_plus'), null, ['class' => 'form-control select2' . ($errors->has('tipo_de_envio') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('tipo_de_envio') }}</span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="costo_por_envio">{{ __('Costo por envío') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
      </div>
      {!! Form::text('costo_por_envio', null, ['v-model' => 'costo_por_envio', 'v-on:change' => 'getDecimal()', 'id' => 'costo_por_envio', 'class' => 'form-control' . ($errors->has('costo_por_envio') ? ' is-invalid' : ''), 'placeholder' => __('Costo por envío')]) !!}
      <div class="input-group-append">
        <span class="input-group-text">.00</span>
      </div>
    </div>
    <span v-if="errors.costo_por_envio" class="text-danger" v-text="errors.costo_por_envio[0]"></span>
  </div>
</div>