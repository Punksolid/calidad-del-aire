<template>
  <div>
    <el-container direction="vertical" class="h-screen">
      <topheader/>
      <el-main>
        <transition name="fade" mode="out-in">
          <router-view/>
        </transition>
        </el-main>
      <el-footer id="Footer" class="text-white text-xs flex items-center justify-center" height="30px">
        <div><p>Calidad del Aire © 2019 - Todos los derechos reservados</p></div>
      </el-footer>
    </el-container>
  </div>
</template>

<script>
import topheader from "./views/layout/header";
export default {
  name: 'app',
  components: {
    topheader
  }
}
</script>

<style>
#app {
}
.el-menu--horizontal > .el-menu-item {
  display: flex;
}
 #Footer {
   background: #8DA1C5;
 }
</style>
