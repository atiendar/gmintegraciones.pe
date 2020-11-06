<div class="row">
	<div class="form-group col-sm btn-sm">
		<label for="ruta">{{ __('Ruta') }} *</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fas fa-list"></i></span>
			</div>
			{!! Form::select('ruta', $rutas, $envio->rut, ['class' => 'form-control select2' . ($errors->has('ruta') ? ' is-invalid' : ''), 'placeholder' => __('')]) !!}
		</div>
		<span class="text-danger">{{ $errors->first('ruta') }}</span>
	</div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm" >
    <a href="{{ route('rolFerro.envioLocal.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
  </div>
  <div class="form-group col-sm btn-sm">
    <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2" onclick="return check('btnsubmit', 'rolFerroEnvioLocalUpdate', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar') }}</button>
  </div>
</div>
@include('layouts.private.plugins.priv_plu_select2')