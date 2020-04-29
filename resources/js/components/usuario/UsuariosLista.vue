<template>
  <table id="usuario-tabla" class="table table-hover table-striped table-sm table-bordered">
    <thead class=" border-0" style="background:#343A40;color:#FFF">
      <tr>
        <th>-</th>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="usuario in usuarios" :title="`Usuario: ${usuario.nom} ${usuario.apell}`">
        <td width="1rem">
          <div class="icheck-primary" @click.prevent="check(usuario.id)">
            <input type="checkbox" :id="usuario.id">
            <label :for="usuario.id"></label>
          </div>
        </td>
        <td width="1rem" v-text="usuario.id"></td>







        <td :title="`Detalles usuario: ${usuario.nom} ${usuario.apell}`"><a href="#" v-on:click.prevent="usuarioShow(usuario)"><span v-text="usuario.nom + ' ' + usuario.apell"></span></a></td>
        <td v-text="usuario.email"></td>
        <td width="1rem" :title="`Editar usuario: ${usuario.nom} ${usuario.apell}`"><a href="#" class="btn btn-light btn-sm p-1"><i class="fas fa-edit"></i></a></td>
        <td width="1rem" :title="`Eliminar usuario: ${usuario.nom} ${usuario.apell}`"><a href="#" class="btn btn-light btn-sm p-1"><i class="far fa-trash-alt"></i></a></td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <th>-</th>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th colspan="2"></th>
      </tr>
    </tfoot>
  </table>
</template>

<script>  
  import datatables from '../../mixins/datatables';
  export default {
    data() {
      return {
        usuarios: [],
        ids_seleccionados: [],
        showUsuario: {
          'id': '',
          'nombre': '',
        },

      }
    },
    mixins: [datatables],
    mounted() {
      axios.get('usuario/listado').then(res => {
        this.usuarios = res.data.data;
        this.tabla();
      }).catch(err => {
        console.log(err.response.data);
      })
      EventBus.$on('usuario-creado', usuario => {
        this.usuarios.unshift(usuario);
      })
    },
    methods: {
      check($usuario_id) {
        if(this.ids_seleccionados.includes($usuario_id)) { // Verifica si el elemento existe en el array
          var $indice = this.ids_seleccionados.indexOf($usuario_id); // Obtiene la posición (índex) del elemento seleccionado
          this.ids_seleccionados.splice($indice, 1); // Elimina 1 elemento dentro del índex seleccionado
        } else {
          this.ids_seleccionados.push($usuario_id); // Agrega el elemento seleccionado al array
        }
      },

      usuarioShow(usuario) {
        console.log(usuario);
        this.showUsuario.id         = usuario.id;
        this.showUsuario.nombre     = usuario.nom;
        $('#usu_show').modal('show');
      }

    }
  };
</script>

<style>
    
</style>