<template>
    <el-footer
        id="Footer"
        class="text-white text-xs">
        <div class="widgets py-10 flex flex-col sm:flex-row">
            <div class="left-side p-5 flex-1 text-center sm:text-left">
                <img :src="require(`@/assets/icono.svg`)" alt="Logo Calidad del Aire Footer" width="120" class="m-auto sm:float-left sm:m-5">
                <h2 class="font-bold">Calidad del Aire:</h2>
                <p>Es Proyecto libre iniciado por interes ciudadano en la medición de la Calidad del Aire en nuestra ciudad.</p>
                <br>
                <p>Pensando en la transparencia de datos y la iniciativa sobre el cuidado del medio ambiente.</p>
            </div>
            <div class="right-side p-5 flex-1 text-center font-bold">
                <h2>Siguenos en:</h2>
            </div>
        </div>
        <div class="copyright text-center py-4">
            <p>© Calidad del Aire 2019 / Este sitio está bajo una Licencia Creative Commons BY-NC-SA</p>
        </div>
    </el-footer>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style lang="scss" scoped>
#Footer {
    width: 100vw;
    padding: 0px;
    margin: 0px;
    z-index: 100;
    bottom: 0x;
    .widgets {
        background: #2e4c97;
    }
    .copyright {
        background: #3564b3;
        max-height: 50px;
        margin: 0px;
    }
}
</style>
