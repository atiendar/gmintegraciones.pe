<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="cantidad">{{ __('Cantidad') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('cantidad', null, ['v-model' => 'cantidad', 'class' => 'form-control', 'maxlength' => 10, 'placeholder' => __('Cantidad'), 'required']) !!}
    </div>
    <span v-if="errors.cantidad" class="text-danger" v-text="errors.cantidad[0]"></span>
  </div>
  <div class="form-group col-sm btn-sm">
    <label for="nombre_de_la_persona_que_se_lleva_el_pedido">{{ __('Nombre de la persona que se lleva el pedido') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
       {!! Form::text('nombre_de_la_persona_que_se_lleva_el_pedido', null, ['v-model' => 'nombre_de_la_persona_que_se_lleva_el_pedido', 'class' => 'form-control', 'maxlength' => 150, 'placeholder' => __('Nombre de la persona que se lleva el pedido'), 'required']) !!}
    </div>
    <span v-if="errors.nombre_de_la_persona_que_se_lleva_el_pedido" class="text-danger" v-text="errors.nombre_de_la_persona_que_se_lleva_el_pedido[0]"></span>
  </div>
</div>
<div class="row">
  <div class="form-group col-sm btn-sm">
    <label for="metodo_de_entrega">{{ __('Método de entrega') }} *</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      {!! Form::select('metodo_de_entrega', $metodos_de_entrega, $direccion->met_de_entreg, ['v-model' => 'metodo_de_entrega', 'v-on:change' => 'getMetodosDeEntregaEspesificos()', 'class' => 'form-control select2', 'placeholder' => __(''), 'required']) !!}
    </div>
    <span v-if="errors.metodo_de_entrega" class="text-danger" v-text="errors.metodo_de_entrega[0]"></span>
  </div>
  <div class="form-group col-sm btn-sm" id="metodo_de_entrega_espesifico" style="display:none">
    <label for="metodo_de_entrega_espesifico">{{ __('Método de entrega espesifico') }}</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-text-width"></i></span>
      </div>
      <select v-model='metodo_de_entrega_espesifico' class ='form-control' data-old='{{ old('metodo_de_entrega_espesifico')}}' name='metodo_de_entrega_espesifico'>
        <option value="">Seleccione. . .</option>
        <option v-for="metodo_de_entrega_esp in metodos_de_entrega_espesificos" v-bind:value="metodo_de_entrega_esp" v-text="metodo_de_entrega_esp"></option>
      </select>
    </div>
    <span v-if="errors.metodo_de_entrega_espesifico" class="text-danger" v-text="errors.metodo_de_entrega_espesifico[0]"></span>
  </div>
</div>