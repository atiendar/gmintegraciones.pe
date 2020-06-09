<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="comentarios">{{ __('Comentarios') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('comentarios', null, ['class' => 'form-control' . ($errors->has('comentarios') ? ' is-invalid' : ''), 'maxlength' => 30000, 'placeholder' => __('Comentarios'), 'rows' => 4, 'cols' => 4]) !!}
    </div>
    <span class="text-danger">{{ $errors->first('comentarios') }}</span>
  </div>
</div>