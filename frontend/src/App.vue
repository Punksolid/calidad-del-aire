<template>
    <el-container direction="vertical" class="h-screen">
        <topheader />
        <el-main class="content">
            <transition name="fade" mode="out-in">
                <router-view class="content_wrapper" />
            </transition>
        </el-main>
        <el-footer
                id="Footer"
                class="text-white text-xs flex items-center justify-center"
                height="30px"
        >
            <div>
                <p>
                    Calidad del Aire © 2019 - Todos los derechos reservados
                </p>
            </div>
        </el-footer>
    </el-container>
</template>

<script>
import topheader from "./views/layout/header";
export default {
    name: "app",
    components: {
        topheader
    }
};
</script>

<style>
html {
    overflow: hidden;
}
body {
    /* height: 100vh; */
    perspective: 1px;
    transform-style: preserve-3d;
    overflow-x: hidden;
    overflow-y: auto;
}
.content {
    display: flex;
    flex-direction: column;
    background: #FFF;
}
.content_wrapper {
    z-index: 20;
}
.content_wrapper > div {
    z-index: 50;
}
.el-menu--horizontal > .el-menu-item {
    display: flex;
}
#Footer {
    z-index: 100;
    background: #3564b3;
}
</style>
