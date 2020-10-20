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
      errors:                         [],
      metodos_de_entrega:             [],
      metodos_de_entrega_especificos: [],
      estados:                        [],
      tipos_de_envio:                 [],
      unitario_o_total:               "unitario",
      municipios:                     [],

      foraneo_o_local:              null,
      metodo_de_entrega:            null,
      metodo_de_entrega_especifico: null,
      cantidad:                     null,
      transporte:                   null,
      estado:                       null,
      municipio:                    null,
      tipo_de_envio:                null,
      tamano:                       null,
      aplicar_costo_de_caja:        "Si",
      cuenta_con_seguro:            "No",
      tiempo_de_entrega:            null,
      costo_por_envio:              null
    },
    computed: {
      metChico: function () {
        if(this.metodo_de_entrega == 'Transportes Ferro' && this.tipo_de_envio == 'Consolidado') {
          return "{{ env('COSTO_CHICO_ESP') }}"
        } else {
      
          return "{{ env('COSTO_CHICO') }}"
        }
      },
      metMediano: function () {
        if(this.metodo_de_entrega == 'Transportes Ferro' && this.tipo_de_envio == 'Consolidado') {
          return "{{ env('COSTO_MEDIANO_ESP') }}"
        } else {
      
          return "{{ env('COSTO_MEDIANO') }}"
        }
      },
      metGrande: function () {
        if(this.metodo_de_entrega == 'Transportes Ferro' && this.tipo_de_envio == 'Consolidado') {
          return "{{ env('COSTO_GRANDE_ESP') }}"
        } else {
      
          return "{{ env('COSTO_GRANDE') }}"
        }
      }
    },
    methods: {
      async create() {
        this.checarBotonSubmitDisabled("btnsubmit")
        axios.post('/costo-de-envio/almacenar', {
          foraneo_o_local:              this.foraneo_o_local,
          metodo_de_entrega:            this.metodo_de_entrega,
          metodo_de_entrega_especifico: this.metodo_de_entrega_especifico,
          cantidad:                     this.cantidad,
          transporte:                   this.transporte,
          estado:                       this.estado,
          municipio:                    this.municipio,
          tipo_de_envio:                this.tipo_de_envio,
          tamano:                       this.tamano,
          aplicar_costo_de_caja:        this.aplicar_costo_de_caja,
          cuenta_con_seguro:            this.cuenta_con_seguro,
          tiempo_de_entrega:            this.tiempo_de_entrega,
          costo_por_envio:              this.costo_por_envio,
          tipos_de_envio:               this.tipos_de_envio,
        }).then(res => {
          Swal.fire({
            title: 'Éxito',
            text: '¡Costo de envío registrado exitosamente!',
          }).then((value) => {
            location.reload()
          })
        }).catch(error => {
          this.checarBotonSubmitEnabled("btnsubmit")
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
      async getMetodosDeEntrega($val) {
        this.metodo_de_entrega            = null
        this.metodo_de_entrega_especifico = null
        this.cantidad                     = null
        this.transporte                   = null
        this.estado                       = null
        this.tipo_de_envio                = null
        this.tamano                       = null
        this.tiempo_de_entrega            = null
        this.costo_por_envio              = null
        this.getUnitarioOTotal()

        metodo_de_entrega_especifico  = document.getElementById('metodo_de_entrega_especifico')
        metodo_de_entrega_especifico.style.display = 'none';

        cantidad  = document.getElementById('divcantidad')
        cantidad.style.display = 'none';

        transporte  = document.getElementById('divtransporte')
        transporte.style.display = 'none';

        tipo_de_envio  = document.getElementById('tipo_de_envio')
        tipo_de_envio.style.display = 'none';

        if(this.foraneo_o_local != '') {
          this.getForLoc()
          // TREA TODOS LOS METODOS DE ENTREGA CORRESPONDIENTES
          axios.get('/logistica/direccion/metodo-de-entrega/'+this.foraneo_o_local).then(res => {
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
          this.getEstados()
        }
      },
      async getEstados() {
        // TREA TODOS LOS ESTADOS CORRESPONDIENTES
        axios.get('/estado/obtener/'+this.foraneo_o_local).then(res => {
          this.estados = res.data
          estado = document.getElementById('estado')
          estado.style.display = 'none';
          if(Object.keys(res.data).length != 0) { 
            estado.style.display = 'block';
          }
        }).catch(error => {
          Swal.fire({
            title: 'Algo salio mal',
            text: error,
          })
        });
      },
      async getMunicipios() {
        municipio  = document.getElementById('municipio')
        municipio.style.display = 'none';

        $estad = '';
        for (var i = 0; i< this.estado.length; i++) {
          var caracter = this.estado.charAt(i);
          if(caracter == "(") {
            break;
          } else {
            $estad = $estad + caracter;
          }
          
        }
        $estad.substring(0, $estad.length - 2);

        axios.get('https://api-sepomex.hckdrk.mx/query/get_municipio_por_estado/'+$estad).then(res => {
          this.municipios = res.data.response.municipios;
          municipio.style.display = 'block';
        }).catch(error => {
          Swal.fire({
            title: 'Algo salio mal',
            text: error,
          })
        });
      },
      async getTiposDeEnvio($val) {
        this.metodo_de_entrega_especifico = null
        this.cantidad                     = null
        this.transporte                   = null
        this.tipo_de_envio                = null
        this.getUnitarioOTotal()

        if(this.metodo_de_entrega == 'Transportes Ferro') {
          this.unitario_o_total = "total";
        }
        metodo_de_entrega_especifico  = document.getElementById('metodo_de_entrega_especifico')
        metodo_de_entrega_especifico.style.display = 'none';
        
        cantidad  = document.getElementById('divcantidad')
        cantidad.style.display = 'none';

        transporte  = document.getElementById('divtransporte')
        transporte.style.display = 'none';

        tipo_de_envio  = document.getElementById('tipo_de_envio')
        tipo_de_envio.style.display = 'none';

        // TREA TODOS LOS METODOS DE ENVIO
        if(this.metodo_de_entrega != '') {
          axios.get('/metodo-de-entrega/obtener/'+this.metodo_de_entrega).then(res => {
            this.tipos_de_envio = res.data
            tipo_de_envio.style.display = 'none';
            if(Object.keys(res.data).length != 0) { 
              tipo_de_envio.style.display = 'block';
            }
          }).catch(error => {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          });
        }
        if(this.metodo_de_entrega == 'Paquetería') {
          this.getMetodosDeEntregaEspecificos()
          this.tipo_de_envio="Normal";
          this.metodo_de_entrega_especifico="TresGuerras";
          cantidad.style.display = 'block';
        } else if(this.metodo_de_entrega == 'Transportes Ferro') {
          this.tipo_de_envio="Directo";
          transporte.style.display = 'block';
        } else {
          metodo_de_entrega_especifico.style.display = 'none';
        }
      },
      async getMetodosDeEntregaEspecificos() {
        if(this.metodo_de_entrega != '') {
          axios.get('/logistica/direccion/metodo-de-entrega-espescifico/'+this.metodo_de_entrega).then(res => {
            this.metodos_de_entrega_especificos = res.data
            metodo_de_entrega_especifico = document.getElementById('metodo_de_entrega_especifico')
            metodo_de_entrega_especifico.style.display = 'none';
            if(Object.keys(res.data).length != 0) { 
              metodo_de_entrega_especifico.style.display = 'block';
            }
          }).catch(error => {
            Swal.fire({
              title: 'Algo salio mal',
              text: error,
            })
          });
        }
      },
      async tipPaqueteria() {
        this.cantidad                     = null
        this.tipo_de_envio                = null

        cantidad  = document.getElementById('divcantidad')
        cantidad.style.display = 'none';

        if(this.metodo_de_entrega_especifico == 'TresGuerras') {
          cantidad.style.display = 'block';
        }
      },
      async getTipoDeEnvio() {
        this.getForLoc()
        this.getUnitarioOTotal()
        if(this.tipo_de_envio == "Directo") {
          this.tiempo_de_entrega = "Express";
        }
      },
      async getUnitarioOTotal() {
        this.unitario_o_total = "unitario";
        if(this.tipo_de_envio == "Consolidado" || this.tipo_de_envio == "Directo") {
          this.unitario_o_total = "total";
        }
 
      },
      async getForLoc() {
        if(this.foraneo_o_local == 'Local') {
          this.tiempo_de_entrega = 'De 1 a 4 dias'
        } else {
          this.tiempo_de_entrega = 'De 7 a 10 dias'
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