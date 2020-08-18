<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="foraneo_o_local">{{ __('Foráneo o local') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('foraneo_o_local', config('opcionesSelect.select_foraneo_local'), null, ['v-model' => 'foraneo_o_local', 'v-on:change' => 'getMetodosDeEntrega(2)', 'id' => 'foraneo_o_local', 'class' => 'form-control select2' . ($errors->has('foraneo_o_local') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span v-if="errors.foraneo_o_local" class="text-danger" v-text="errors.foraneo_o_local[0]"></span>
  </div>
  <div class="form-group col-sm btn-sm" id="metodo_de_entrega" style="display:none">
    <label for="metodo_de_entrega">{{ __('Método de entrega') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      <select v-model='metodo_de_entrega' v-on:change='getTiposDeEnvio(2)' class ='form-control' data-old='{{ old('metodo_de_entrega')}}' name='metodo_de_entrega'>
        <option value="">Seleccione. . .</option>
        <option v-for="metodo_de_entrega in metodos_de_entrega" v-bind:value="metodo_de_entrega" v-text="metodo_de_entrega"></option>
      </select>
    </div>
    <span v-if="errors.metodo_de_entrega" class="text-danger" v-text="errors.metodo_de_entrega[0]"></span>
  </div>
  <div class="form-group col-sm btn-sm" id="metodo_de_entrega_espesifico" style="display:none">
    <label for="metodo_de_entrega_espesifico">{{ __('Método de entrega espesifico') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      <select v-model='metodo_de_entrega_espesifico' class ='form-control' data-old='{{ old('metodo_de_entrega_espesifico')}}' name='metodo_de_entrega_espesifico'>
        <option value="">Seleccione. . .</option>
        <option v-for="metodo_de_entrega_esp in metodos_de_entrega_espesificos" v-bind:value="metodo_de_entrega_esp" v-text="metodo_de_entrega_esp"></option>
      </select>
    </div>
    <span v-if="errors.metodo_de_entrega_espesifico" class="text-danger" v-text="errors.metodo_de_entrega_espesifico[0]"></span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" id="estado" style="display:none">
    <label for="estado">{{ __('Estado') }} *</label>
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
  <div class="form-group col-sm btn-sm" id="tipo_de_envio" style="display:none">
    <label for="tipo_de_envio">{{ __('Tipo de envío') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      <select v-model='tipo_de_envio' class ='form-control' data-old='{{ old('tipo_de_envio')}}' name='tipo_de_envio'>
        <option value="">Seleccione. . .</option>
        <option v-for="tipo_de_envio in tipos_de_envio" v-bind:value="tipo_de_envio" v-text="tipo_de_envio"></option>
      </select>
    </div>
    <span v-if="errors.tipo_de_envio" class="text-danger" v-text="errors.tipo_de_envio[0]"></span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="tamano">{{ __('Tamaño') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('tamano', config('opcionesSelect.select_tamano'), null, ['v-model' => 'tamano', 'class' => 'form-control select2' . ($errors->has('tamano') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
      </div>
      <span v-if="errors.tamano" class="text-danger" v-text="errors.tamano[0]"></span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" id="tipo_de_empaque">
    <label for="tipo_de_empaque">{{ __('Tipo de empaque') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-list"></i></span>
      </div>
      {!! Form::select('tipo_de_empaque', config('opcionesSelect.select_tipo_de_empaque'), null, ['v-model' => 'tipo_de_empaque', 'class' => 'form-control select2' . ($errors->has('tipo_de_empaque') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
    </div>
    <span v-if="errors.tipo_de_empaque" class="text-danger" v-text="errors.tipo_de_empaque[0]"></span>
  </div>
  <div class="form-group col-sm btn-sm" id="cuenta_con_seguro">
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
  <div class="form-group col-sm btn-sm" id="tiempo_de_entrega">
    <label for="tiempo_de_entrega">{{ __('Tiempo de entrega') }} ({{ __('Dias') }})*</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
      </div>
      {!! Form::text('tiempo_de_entrega', null, ['v-model' => 'tiempo_de_entrega', 'class' => 'form-control' . ($errors->has('tiempo_de_entrega') ? ' is-invalid' : ''), 'placeholder' => __('Tiempo de entrega')]) !!}
    </div>
    <span v-if="errors.tiempo_de_entrega" class="text-danger" v-text="errors.tiempo_de_entrega[0]"></span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="costo_por_envio">{{ __('Costo por envío') }} ({{ __('Con IVA') }}) *</label>
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