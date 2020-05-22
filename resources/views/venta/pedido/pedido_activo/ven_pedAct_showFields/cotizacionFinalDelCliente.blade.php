@if($pedido->cot_fin_de_client_nom != null)
  <div class="col-md-5">
    <div class="pad box-pane-right no-padding" style="min-height: 280px">
      <div style="display: none;">
          {!! Form::text('cot_fin_de_client_nom',  $pedido->cot_fin_de_client_nom, ['class' => 'form-control btn-sm disabled', 'maxlength' => 0, 'readonly' => 'readonly']) !!}
      </div>
      <iframe src="{{ Storage::url($pedido->cot_fin_de_client_rut.$pedido->cot_fin_de_client_nom) }}" style="width:100%;border:none;height:25rem;"></iframe>
    </div>
  </div>
@endif