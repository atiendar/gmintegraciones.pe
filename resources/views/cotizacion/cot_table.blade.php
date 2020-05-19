<div class="card-body table-responsive p-0" id="div-tabla-scrollbar" style="height: 40em;">
  <table class="table table-head-fixed table-hover table-striped table-sm table-bordered">
    @if(sizeof($cotizaciones) == 0)
      @include('layouts.private.busquedaSinResultados')
    @else 
      <thead>
        <tr>
          <th>{{ __('SERIE') }}</th>
          <th>{{ __('ESTATUS') }}</th>
          <th>{{ __('VALIDEZ') }}</th>
          <th>{{ __('CORREO') }}</th>
          <th>{{ __('TOTAL') }}</th>
          <th colspan="6">&nbsp</th>
        </tr>
      </thead>
      <tbody> 
        @foreach($cotizaciones as $cotizacion)
          <tr title="{{ $cotizacion->serie }}">
            <td>
              @can('cotizacion.show')
                <a href="{{ route('cotizacion.show', Crypt::encrypt($cotizacion->id)) }}" title="Detalles: {{ $cotizacion->serie }}">{{ $cotizacion->serie }}</a>
              @else
                {{ $cotizacion->serie }}
              @endcan
            </td>
            <td>
              @switch($cotizacion->estat)
                @case(config('app.abierta'))
                  <span class="badge" style="background:{{ config('app.color_a') }};color:{{ config('app.color_0') }};">{{ $cotizacion->estat }}</span>
                  @break
                @case(config('app.cerrada'))
                  <span class="badge" style="background:{{ config('app.color_d') }}">{{ $cotizacion->estat }}</span>
                  @break
                @case(config('app.cancelada'))
                  <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ $cotizacion->estat }}</span>
                  @break
                @default
                  {{ $cotizacion->estat }}
              @endswitch
            </td>
            <td width="1rem">
              @if($cotizacion->valid >= date("Y-m-d")) 
                <span class="badge" style="background:{{ config('app.color_g') }}">{{ $cotizacion->valid }}</span>
              @else
                <span class="badge" style="background:{{ config('app.color_c') }};color:{{ config('app.color_0') }};">{{ $cotizacion->valid }}</span>
              @endif
            </td>
            <td>{{ $cotizacion->email_cliente }}</td>
            <td width="1rem">{{ $cotizacion->tot }}</td>
            @include('cotizacion.cot_tableOpciones')
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>