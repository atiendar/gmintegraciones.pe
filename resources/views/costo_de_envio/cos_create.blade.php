@extends('layouts.private.escritorio.dashboard')
@section('contenido')
<title>@section('title', __('Registrar costo de envío'))</title>
<div class="card">
  <div class="card-header p-1">
    <ul class="nav nav-pills">
      @include('costo_de_envio.cos_menu')
    </ul>
  </div>
  <div class="card-body">
    <form @submit.prevent="create" enctype="multipart/form-data">
      @include('costo_de_envio.cos_createFields')
      <div class="row">
        <div class="form-group col-sm btn-sm">
          <a href="{{ route('costoDeEnvio.index') }}" class="btn btn-default w-50 p-2 border"><i class="fas fa-sign-out-alt text-dark"></i> {{ __('Regresar') }}</a>
        </div>
        <div class="form-group col-sm btn-sm">
          <button type="submit" id="btnsubmit" class="btn btn-info w-100 p-2"><i class="fas fa-check-circle text-dark"></i> {{ __('Registrar') }}</button>
        </div>
      </div>
    {{--   @include('layouts.private.plugins.priv_plu_select2') --}}
    </form>
  </div>
</div>
@endsection

@section('vuejs')
<script>
  var app4 = new Vue({
    el: '#dashboard',
    data: {
      errors: [],
      metodos_de_entrega: [],
      estados:            [],
      
      foraneo_o_local:    null,
      cuenta_con_seguro:  null,
      metodo_de_entrega:  null,
      estado:             null,
      costo_por_envio:    null
    },
    methods: {
      async create() {
      //  this.checarBotonSubmitDisabled("btnsubmit")
        axios.post('/costo-de-envio/almacenar', {
          foraneo_o_local:    this.foraneo_o_local,
          cuenta_con_seguro:  this.cuenta_con_seguro,
          metodo_de_entrega:  this.metodo_de_entrega,
          estado:             this.estado,
        }).then(res => {
          console.log(res);
          Swal.fire({
            title: 'Éxito',
            text: '¡Costo de envío registrado exitosamente!',
          }).then((value) => {
          //  location.reload()
          })
        }).catch(error => {
       //   this.checarBotonSubmitEnabled("btnsubmit")
          if(error.response.status == 422) {
            this.errors   = error.response.data.errors
          } else {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          }
        });
      },
      async getMetodosDeEntrega() {
        console.log('entro')
        if(this.foraneo_o_local != '') {
          axios.get('/logistica/direccion/metodo-de-entrega/'+this.foraneo_o_local).then(res => {
          
            console.log(res.data)
            this.metodos_de_entrega = res.data
            
            metodo_de_entrega = document.getElementById('metodo_de_entrega')
            metodo_de_entrega.style.display = 'none';
            if(Object.keys(res.data).length != 0) { 
              metodo_de_entrega.style.display = 'block';
            }
          }).catch(error => {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          });
        }
      },
      async getMetodosDeEntregaEspesificos() {
        if(this.metodo_de_entrega != '') {
          axios.get('/logistica/direccion/metodo-de-entrega-espescifico/'+this.metodo_de_entrega).then(res => {
            this.metodos_de_entrega_espesificos = res.data
            metodo_de_entrega_espesifico = document.getElementById('metodo_de_entrega_espesifico')
            metodo_de_entrega_espesifico.style.display = 'none';
            if(Object.keys(res.data).length != 0) { 
              metodo_de_entrega_espesifico.style.display = 'block';
            }
          }).catch(error => {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          });
        }
      },
      async getDecimal() {
        costo_por_envio = document.getElementById("costo_por_envio").value;
        if (isNaN(parseFloat(costo_por_envio))) {
          costo_por_envio = 0;
        }
        costo_por_envio_decimal   = Number.parseFloat(costo_por_envio).toFixed(2);
        this.costo_por_envio = costo_por_envio_decimal;
      },
      async checarBotonSubmitDisabled(id_btn) {
        document.getElementById(id_btn).value = "Espere un momento...";
        document.getElementById(id_btn).disabled = true;
        return true;
      },
      async checarBotonSubmitEnabled(id_btn) {
        document.getElementById(id_btn).value = "Espere un momento...";
        document.getElementById(id_btn).disabled = false;
        return true;
      }
    }
  });
</script>
@endsection


