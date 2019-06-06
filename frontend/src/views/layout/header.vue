<template>
    <el-row justify="center">
        <el-col class="logo">
            <img :src="require(`@/assets/logo_alt.svg`)" width="200px" alt="Calidad del Aire Culiacán"/>
        </el-col>
        <el-col class="text-center">
        <el-header class="px-0">
            <el-menu
                    mode="horizontal"
                    background-color="#4B648C"
                    text-color="#fff"
                    active-text-color="#ffd04b"
            class="flex justify-center object-center">
                    <el-menu-item index="1"><router-link to="/">Inicio</router-link></el-menu-item>
                    <el-menu-item index="2"><router-link to="/about">Acerca de</router-link></el-menu-item>
                    <el-menu-item index="3"><router-link to="/upload">Subir Archivo</router-link></el-menu-item>
            </el-menu>
        </el-header>
        </el-col>
    </el-row>
</template>

<script>
    export default {
        name: "topheader"
    }
</script>

<style scoped>
.logo {
    background: #8DA1C5;
}
.logo img {
    margin: auto;
    padding: 10px 0px;
}
</style>
