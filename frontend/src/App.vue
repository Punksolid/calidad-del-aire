<template>
  <div id="app">
    <el-container>
      <el-header>
        <el-menu
        class="el-menu-demo"
        mode="horizontal"
        background-color="#545c64"
        text-color="#fff"
        active-text-color="#ffd04b">
        <el-menu-item index="1"><router-link to="/">Home</router-link></el-menu-item>
        <el-menu-item index="1"><router-link to="/about">About</router-link></el-menu-item>
        <el-menu-item index="2"><router-link to="/upload">Upload</router-link></el-menu-item>
      </el-menu>
      </el-header>
      <el-main>
        <router-view></router-view>
        </el-main>
      <el-footer></el-footer>
    </el-container>
  </div>
</template>

<script>
export default {
  name: 'app',
  components: {
  }
}
</script>

<style>
#app {

}
</style>
