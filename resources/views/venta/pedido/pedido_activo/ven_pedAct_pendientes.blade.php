@section('pendientes')
  <li class="nav-item dropdown" title="{{ __('Pendientes') }}">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="fas fa-clipboard-list"></i>&nbsp;
      <span class="badge badge-warning navbar-badge"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-item dropdown-header"> {{ __(' Pendientes') }}</span>
      <div class="dropdown-divider"></div>



      {!! Form::model(Request::all(), ['route' => ['venta.pedidoActivo.index', 'porEntregar'], 'method' => 'GET', 'id' => 'porEntregar']) !!}
        <a href="" onclick="document.getElementById('porEntregar').submit();" class="dropdown-item">
          <small>
            <span class="badge badge-warning">{{ $pen }}</span>
            {{ __('Por entregar') }} (+3d)
          </small>
        </a>        
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}

      {!! Form::model(Request::all(), ['route' => ['venta.pedidoActivo.index', 'yaCaducados'], 'method' => 'GET', 'id' => 'yaCaducados']) !!}
        <a href="" onclick="document.getElementById('yaCaducados').submit();" class="dropdown-item">
          <small>
            {{ $pen }} 
            {{ __('Ya caducados') }} (-5d)
          </small>
        </a>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}

      {!! Form::model(Request::all(), ['route' => ['venta.pedidoActivo.index', 'pteDePago'], 'method' => 'GET', 'id' => 'pteDePago']) !!}
        <a href="" onclick="document.getElementById('pteDePago').submit();" class="dropdown-item">
          <small>
            {{ $pen }} 
            {{ __('Pte. de pago') }}
          </small>
        </a>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}

      {!! Form::model(Request::all(), ['route' => ['venta.pedidoActivo.index', 'pagoRechazado'], 'method' => 'GET', 'id' => 'pagoRechazado']) !!}
        <a href="" onclick="document.getElementById('pagoRechazado').submit();" class="dropdown-item"><small>{{ $pen }} {{ __('Pago rechazado') }}</small></a>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}

      {!! Form::model(Request::all(), ['route' => ['venta.pedidoActivo.index', 'pteDeInformacion'], 'method' => 'GET', 'id' => 'pteDeInformacion']) !!}
        <a href="" onclick="document.getElementById('pteDeInformacion').submit();" class="dropdown-item"><small>{{ $pen }} {{ __('Pte. de información') }}</small></a>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}

      {!! Form::model(Request::all(), ['route' => ['venta.pedidoActivo.index', 'sinEntregaPorFaltaDeInformacion'], 'method' => 'GET', 'id' => 'sinEntregaPorFaltaDeInformacion']) !!}
        <a href="" onclick="document.getElementById('sinEntregaPorFaltaDeInformacion').submit();" class="dropdown-item"><small>{{ $pen }} {{ __('Sin entrega por falta de info.') }}</small></a>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}

      {!! Form::model(Request::all(), ['route' => ['venta.pedidoActivo.index', 'intentoDeEntregaFallido'], 'method' => 'GET', 'id' => 'intentoDeEntregaFallido']) !!}
        <a href="" onclick="document.getElementById('intentoDeEntregaFallido').submit();;" class="dropdown-item"><small>{{ $pen }} {{ __('Intento de entrega fallido') }}</small></a>
        <div class="dropdown-divider"></div>
      {!! Form::close() !!}




    </div>
  </li>
@endsection