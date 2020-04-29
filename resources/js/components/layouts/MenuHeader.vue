<template>
  <a href="" class="nav-link" @click.prevent="sidebar"><i class="fas fa-bars"></i></a>
</template>

<script>
  export default {
    methods: {
      sidebar() {
        axios.get('/layouts').then(res => {
          location.reload(); // Recarga la pagina para visualizar los cambios
        }).catch(err => {
          console.log(err.response.data)
        })
      }
    }
  };
</script>