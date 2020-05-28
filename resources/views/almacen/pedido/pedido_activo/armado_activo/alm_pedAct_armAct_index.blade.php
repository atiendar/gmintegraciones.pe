<div class="card {{ config('app.color_card_secundario') }} card-outline">
  <div class="card-header p-1 border-bottom {{ config('app.color_bg_secundario') }}">
    <h5>
      <strong>{{ __('Armado(s) registrado(s)') }}: </strong> {{ $pedido->arm_carg }}  <strong>{{('de')}} </strong> {{ $pedido->tot_de_arm }},
      <strong>{{ __('Terminados') }}: </strong>
      {{ $armados_terminados_almacen }}
    </h5>
  </div>
  <div class="card-body">
    {!! Form::model(Request::all(), ['route' => ['almacen.pedidoActivo.edit',Crypt::encrypt($pedido->id)],'method' => 'GET']) !!}
      @include('global.buscador.buscador', ['ruta_recarga' => route('almacen.pedidoActivo.edit',Crypt::encrypt($pedido->id)), 'opciones_buscador' => config('opcionesSelect.select_pedido_armados_index')])
    {!! Form::close() !!}
    @include('almacen.pedido.pedido_activo.armado_activo.alm_pedAct_armAct_table')
    @include('global.paginador.paginador', ['paginar' => $armados])
  </div>
</div>