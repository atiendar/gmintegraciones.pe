<td width="1rem" title="Editar: {{ $armado->id }}">
  @if($armado->estat == config('app.productos_completos') OR $armado->estat == config('app.en_produccion'))
    @can('produccion.pedidoActivo.armado.edit')
      <a href="{{ route('produccion.pedidoActivo.armado.edit', Crypt::encrypt($armado->id)) }}" class='btn btn-light btn-sm'><i class="fas fa-edit"></i></a>
    @endcan
  @endif
</td>
<td width="1rem">
  @if($armado->estat == config('app.productos_completos') OR $armado->estat == config('app.en_produccion'))
		@can('produccion.pedidoActivo.armado.edit')
			<button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#modal{{ $armado->id }}"><i class="fas fa-bars"></i></button>
      <div class="modal fade" id="modal{{ $armado->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $armado->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header p-1">
              <h5 class="modal-title" id="modalLabel{{ $armado->id }}">
                {{ __('Editar registro') }}: {{ $armado->cod }} ({{ Sistema::dosDecimales($armado->cant) }})
              </h5>
              <button type="button" class="close p-0 m-0" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['route' => ['produccion.pedidoActivo.armado.updateModal', Crypt::encrypt($armado->id)], 'method' => 'patch', 'id' => 'produccionPedidoActivoArmadoUpdateModal'.$armado->id]) !!}
              <div class="modal-body">
                <div class="row">
                  <label for="ubicacion_rack">{{ __('Se marcara como:') }} {{ config('app.en_almacen_de_salida') }}</label>
                </div>
                <div class="row">
                  <div class="form-group col-sm btn-sm" id="ubicacion-rack">
                    <label for="ubicacion_rack">{{ __('Ubicación rack') }} * </label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
                      </div>
                      {!! Form::text('ubicacion_rack', $armado->ubic_rack	, ['class' => 'form-control' . ($errors->has('ubicacion_rack') ? ' is-invalid' : ''), 'maxlength' => 50, 'placeholder' => __('Ubicación rack')]) !!}
                    </div>
                    <span class="text-danger">{{ $errors->first('ubicacion_rack') }}</span>
									</div>
								</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default p-2 border" data-dismiss="modal"><i class="fas fa-times"></i> {{ __('Cerrar') }}</button>
                <button type="submit" id="btnsubmit{{ $armado->id }}" class="btn btn-info p-2" onclick="return check('btnsubmit{{ $armado->id }}', 'produccionPedidoActivoArmadoUpdateModal{{ $armado->id }}', '¡Alerta!', '¿Estás seguro quieres actualizar el registro?', 'info', 'Continuar', 'Cancelar', 'false');"><i class="fas fa-edit text-dark"></i> {{ __('Actualizar armado') }}</button>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    @endcan
  @endif
</td>