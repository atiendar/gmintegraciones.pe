<div class="form-group col-sm btn-sm">
  <label for="proveedor">{{ __('Proveedor') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
    </div>
      {!! Form::text('proveedor', $material->lob, ['class' => 'form-control', 'maxlength' => 0, 'placeholder' => __('Proveedor'), 'readonly' => 'readonly']) !!}
  </div>
</div>