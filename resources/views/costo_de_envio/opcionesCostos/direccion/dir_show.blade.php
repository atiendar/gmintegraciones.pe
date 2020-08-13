<h4><label for="redes_sociales">{{ __('INFORMACIÓN') }}</label></h4>
<div class="border border-primary rounded p-3">
  <div class="form-group col-sm btn-sm">
    <label for="descripcion">{{ __('Descripción') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::text('descripcion', $armado->nom.' ('.$armado->sku.')', ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Descripción'), 'readonly' => 'readonly']) !!}
    </div>
  </div>
  <h6><label for="redes_sociales">{{ __('METODO DE ENTREGA SELECCIONADO') }}</label></h6>
  <div class="border border-secondary rounded p-3">
    <div class="row">
      @include('costo_de_envio.cos_showFields.#')
    </div>
    <div class="row">
      @include('costo_de_envio.cos_showFields.tipoDeEmpaque')
      @include('costo_de_envio.cos_showFields.cuentaConSeguro')
      @include('costo_de_envio.cos_showFields.tiempoDeEntrega')
    </div>
    <div class="row">
      @include('costo_de_envio.cos_showFields.metodoDeEntrega')
      @include('costo_de_envio.cos_showFields.estado')
      @include('costo_de_envio.cos_showFields.foraneoLocal')
    </div>
    <div class="row">
      @include('costo_de_envio.cos_showFields.tipoDeEnvio')
      @include('costo_de_envio.cos_showFields.costoPorEnvio')
    </div>
  </div> 
</div>