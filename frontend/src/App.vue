<template>
  <div id="app">
    <el-container direction="vertical">
      <el-header class="px-0">
        <el-menu
        class="el-menu-demo"
        mode="horizontal"
        background-color="#38a169"
        text-color="#fff"
        active-text-color="#ffd04b">
        <el-menu-item index="1"><router-link to="/">Inicio</router-link></el-menu-item>
        <el-menu-item index="1"><router-link to="/about">Acerca de</router-link></el-menu-item>
        <el-menu-item index="2"><router-link to="/upload">Subir Archivo</router-link></el-menu-item>
      </el-menu>
      </el-header>
      <el-main>
        <router-view></router-view>
        </el-main>
      <el-footer class="bg-green-200 text-center">
        <div><p>Calidad del Aire © 2019 - Todos los derechos reservados</p></div>
      </el-footer>
    </el-container>
  </div>
</template>

<script>
export default {
  name: 'app',
  components: {
  },
  watch: {
    $Route(to, from) {
      document.title = to.meta.title || 'Calidad del Aire Culiacán';
    }
  }
}
</script>

<style>
#app {

}
</style>
