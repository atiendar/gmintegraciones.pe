<div class="card {{ empty($errors->first()) ? 'card-info' : 'card-danger border border-danger' }} card-outline card-tabs position-relative bg-white">
    <div class="card-header p-0 m-0" id="hcollapse">
      <h5>
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#acollapse" aria-expanded="false" aria-controls="acollapse">
          <strong>{{ __('Registrar dirección') }}</strong>
        </button>
      </h5>
    </div>
    <div id="acollapse" class="collapse" aria-labelledby="hcollapse">
      <div class="card-body">
        {!! Form::open(['route' => ['cliente.show.direccion.store', Crypt::encrypt($cliente->id)], 'onsubmit' => 'return checarBotonSubmit("btnsubmit")']) !!}
          @include('rolCliente.direccion.dir_createFields')
          <div class="row">
            <div class="form-group col-sm btn-sm">
              <center><button type="submit" id="btnsubmit" class="btn btn-info w-50 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button></center>
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>