<template>
    <el-row class="header_wrapper">
        <el-header>
            <el-col :sm="12" :md="5" class="logo">
                <img
                    :src="require(`@/assets/logo_alt.svg`)"
                    width="300px"
                    alt="Calidad del Aire Logo"
                />
            </el-col>
            <el-col :sm="12" :md="19" class="menu_wrapper sm:text-right">
                <el-menu
                    mode="horizontal"
                    background-color="#24447b"
                    text-color="#b4cffe"
                    active-text-color="#FFF"
                    class="sm:float-right flex align-center justify-center">
                    <el-menu-item index="1">
                        <router-link to="/">INICIO</router-link>
                    </el-menu-item>
                    <el-menu-item index="2">
                        <router-link to="/about">ACERCA DE</router-link>
                    </el-menu-item>
                    <el-menu-item index="3" class="archivo">
                        <router-link to="/upload">SUBIR ARCHIVO</router-link>
                    </el-menu-item>
                </el-menu>
            </el-col>
        </el-header>
    </el-row>
</template>

<script>
export default {
    name: "topheader"
};
</script>

<style scoped>
.header_wrapper {
    z-index: 1000;
    padding: 15px 20px;
    background: #24447b;
}
.logo img {
    margin: auto;
}
.el-menu {
    border-bottom: 0px !important;
}
</style>
