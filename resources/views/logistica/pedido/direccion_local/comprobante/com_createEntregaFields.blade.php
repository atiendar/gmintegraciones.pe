<div class="row">
  @if($direccion->met_de_entreg_de_log == 'Paquetería')
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