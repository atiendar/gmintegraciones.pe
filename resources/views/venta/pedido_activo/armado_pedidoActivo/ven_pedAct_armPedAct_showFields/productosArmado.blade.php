@php 
  $list_productos = ''; 
@endphp
@foreach ($armado->productos as $productos)
  @php 
    $list_productos .= $productos->cant . ' - ' . $productos->produc . PHP_EOL; 
  @endphp
@endforeach

<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="productos">{{ __('Productos') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::textarea('productos', $list_productos, ['class' => 'form-control disabled', 'maxlength' => 0, 'placeholder' => __('Productos'), 'rows' => 25, 'cols' => 4, 'readonly' => 'readonly']) !!}
    </div>
  </div>
</div>