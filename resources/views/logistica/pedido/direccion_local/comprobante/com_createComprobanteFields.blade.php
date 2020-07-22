<div class="row">
  @if($comprobante->met_de_entreg_de_log == 'Paquetería')
    <div class="form-group col-sm btn-sm">
      <label for="numero_de_guia">{{ __('Número de guia') }} *</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-text-width"></i></span>
        </div>
          {!! Form::text('numero_de_guia', null, ['v-model' => 'numero_de_guia', 'class' => 'form-control', 'maxlength' => 60, 'placeholder' => __('Número de guia')]) !!}
      </div>
      <span v-if="errors.numero_de_guia" class="text-danger" v-text="errors.numero_de_guia[0]"></span>
    </div>
  @endif
  <div class="form-group col-sm btn-sm">
    <label for="costo_por_envio">{{ __('Costo por envío') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
        {!! Form::text('costo_por_envio', null, ['v-model' => 'costo_por_envio', 'v-on:change' => 'getDecimales()', 'id' => 'costo_por_envio', 'class' => 'form-control', 'maxlength' => 15, 'placeholder' => __('Costo por envío')]) !!}
    </div>
    <span v-if="errors.costo_por_envio" class="text-danger" v-text="errors.costo_por_envio[0]"></span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comprobante_de_entrega">{{ __('Comprobante de entrega') }} *</label>
      {!! Form::hidden('mydataComprobantdeentrega', null, ['id' => 'mydataComprobantdeentrega', 'class' => 'form-control']) !!}
      <div id="my_camera_comprobante_de_entrega"></div>
      <input type=button value="{{ __('Capturar foto') }}" v-on:click="capturarFoto('mydataComprobantdeentrega', 'resultsComprobantdeentrega')">
      <input type=button value="{{ __('Quitar foto') }}" v-on:click="quitarFoto('mydataComprobantdeentrega', 'resultsComprobantdeentrega')">
      <div id="resultsComprobantdeentrega" ></div>
    <span v-if="errors.comprobante_de_entrega" class="text-danger" v-text="errors.comprobante_de_entrega[0]"></span>
  </div>
</div>
{{-- 
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comprobante_costo_por_envio">{{ __('Comprobante costo por envío') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
      </div>
      <div class="custom-file"> 
        {!! Form::file('comprobante_costo_por_envio', ['class' => 'custom-file-input', 'lang' => Auth::user()->lang]) !!}
        <label class="custom-file-label" for="archivo">Max. 1MB</label>
      </div>
    </div>
    <span class="text-danger">{{ $errors->first('comprobante_costo_por_envio') }}</span>
  </div>
</div>
--}}