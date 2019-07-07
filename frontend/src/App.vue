<template>
    <el-container direction="vertical" class="h-screen">
        <topheader />
        <el-main class="content p-0 overflow-x-hidden">
            <transition name="fade" mode="out-in">
                <router-view class="content_wrapper" />
            </transition>
            <Footer/>
        </el-main>
    </el-container>
</template>

<script>
import topheader from "./views/layout/header";
import Footer from "./views/layout/Footer";
export default {
    name: "app",
    components: {
        Footer,
        topheader
    }
};
</script>

<style>
html {
    overflow: hidden;
}
body {
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
.el-menu--horizontal > .el-menu-item {
    display: flex;
}
</style>
