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
                <div class="redessociales text-lg mt-5">
                    <a href="#">
                    <span class="fa-stack">
                      <i class="fab fa-facebook fa-2x text-white"></i>
                    </span>
                    </a>
                    <a href="#">
                    <span class="fa-stack">
                      <i class="fas fa-circle fa-stack-2x"></i>
                      <i class="fab fa-twitter fa-stack-1x text-blue-800"></i>
                    </span>
                    </a>
                    <a href="#">
                    <span class="fa-stack">
                        <i class="fab fa-github fa-2x text-white"></i>
                    </span>
                    </a>
                </div>
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
