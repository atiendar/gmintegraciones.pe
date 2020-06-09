<div class="form-group col-sm btn-sm">
  <label for="copia_de_identificacion">{{ __('Copia de identificación') }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
    </div>
    <div class="custom-file"> 
      {!! Form::file('copia_de_identificacion', ['class' => 'custom-file-input', 'accept' => 'image/jpeg,image/png,image/jpg,application/pdf', 'lang' => Auth::user()->lang]) !!}
      <label class="custom-file-label" for="archivo">Max. 1MB</label>
    </div>
    <a href="https://www.ilovepdf.com/es/comprimir_pdf/" target="_blank" class="btn btn-light border ml-1" title="Si tu archivo rebasa 1MB comprímela aquí"><i class="fas fa-compress-arrows-alt"></i></a>
  </div>
  <span class="text-danger">{{ $errors->first('copia_de_identificacion') }}</span>
</div>