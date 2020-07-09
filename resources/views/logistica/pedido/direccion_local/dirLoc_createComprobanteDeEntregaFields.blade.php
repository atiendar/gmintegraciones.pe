




    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="numero_de_guia">{{ __('Número de guia') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-text-width"></i></span>
          </div>
           {!! Form::text('numero_de_guia', null, ['class' => 'form-control' . ($errors->has('numero_de_guia') ? ' is-invalid' : ''), 'maxlength' => 60, 'placeholder' => __('Número de guia')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('numero_de_guia') }}</span>
      </div>
    </div>
    
    
    
    
    
    
    
    
    
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="comprobante_de_entrega">{{ __('Comprobante de entrega') }}</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-folder-open"></i></span>
          </div>
         <div class="custom-file"> 
            {!! Form::file('comprobante_de_entrega', ['class' => 'custom-file-input', 'lang' => Auth::user()->lang]) !!}
            <label class="custom-file-label" for="archivo">Max. 1MB</label>
          </div>
        </div>
        <span class="text-danger">{{ $errors->first('comprobante_de_entrega') }}</span>
      </div>
    </div>
    
    
    
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
    
    
    
    <div class="row">
      <div class="form-group col-sm btn-sm">
        <label for="costo_por_envio">{{ __('Costo por envío') }} *</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-text-width"></i></span>
          </div>
           {!! Form::text('costo_por_envio', null, ['class' => 'form-control' . ($errors->has('costo_por_envio') ? ' is-invalid' : ''), 'maxlength' => 0, 'placeholder' => __('Costo por envío')]) !!}
        </div>
        <span class="text-danger">{{ $errors->first('costo_por_envio') }}</span>
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