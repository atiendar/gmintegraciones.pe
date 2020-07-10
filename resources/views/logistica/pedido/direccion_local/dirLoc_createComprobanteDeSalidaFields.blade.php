<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad">{{ __('Cantidad') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('cantidad', null, ['v-model' => 'cantidad','class' => 'form-control', 'maxlength' => 10, 'placeholder' => __('Cantidad'), 'required']) !!}
    </div>
    <span v-if="errors.cantidad" class="text-danger" v-text="errors.cantidad[0]"></span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="metodo_de_entrega">{{ __('Método de entrega') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('metodo_de_entrega', $metodos_de_entrega, $direccion->met_de_entreg, ['v-model' => 'metodo_de_entrega', 'v-on:change' => 'getMetodosDeEntregaEspesificos()', 'class' => 'form-control select2', 'placeholder' => __(''), 'required']) !!}
    </div>
    <span v-if="errors.metodo_de_entrega" class="text-danger" v-text="errors.metodo_de_entrega[0]"></span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="metodo_de_entrega_espesifico">{{ __('Método de entrega espesifico') }}</label>
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
  <div class="form-group col-sm btn-sm">
    <label for="comprobante_de_salida">{{ __('Comprobante de salida') }} *</label>
      {!! Form::hidden('mydata', null, ['id' => 'mydata', 'class' => 'form-control']) !!}
      <div id="my_camera"></div>
      <input type=button value="{{ __('Capturar foto') }}" v-on:click="capturarFoto()">
      <input type=button value="{{ __('Quitar foto') }}" v-on:click="quitarFoto()">
      <div id="results" ></div>
    <span v-if="errors.comprobante_de_salida" class="text-danger" v-text="errors.comprobante_de_salida[0]"></span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <a href="{{ route('logistica.direccionLocal.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
  </div>
</div>