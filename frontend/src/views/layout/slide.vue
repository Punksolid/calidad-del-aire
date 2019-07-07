<template>
    <div id="slide">
        <el-col class="slide-wrapper">
            <div class="parallax-wrapper"></div>
            <div class="info flex flex-col items-center sm:flex-row rounded-b-lg">
                <div class="texto mb-5 sm:mb-0 flex-1 sm:flex-2 sm:px-8">
                    <p class="font-extrabold text-white">Cuidemos</p>
                    <h5 class="text-white">El medio ambiente de <span class="line-through text-gray-500">Culiacán</span> Guadalajara</h5>
                </div>
                <div class="semaforo w-full float-right text-center bg-white rounded-l-lg">
                    <h2 class="bg-blue-500 text-white text-center py-2 rounded-tl-lg">Calidad actual:</h2>
                    <div class="status-wrapper text-center py-5">
                        <div id="estado" class="bg-green-500 m-auto rounded-lg border-8 border-green-400"></div>
                    </div>
                    <el-button type="primary" class="w-1/2 -mb-5 text-lg shadow-lg">
                        Más detalles
                    </el-button>
                </div>
            </div>
        </el-col>
        <el-col class="niveles justify-center flex flex-col sm:flex-row">
            <h3 class="pr-8">Niveles de contaminación:</h3>
            <ul class="flex flex-col sm:flex-row">
                <li class="bg-green-500 px-5 py-1 rounded">Buena</li>
                <li class="bg-yellow-500 px-5 py-1 rounded">Regular</li>
                <li class="bg-orange-500 px-5 py-1 rounded">Mala</li>
                <li class="bg-red-500 px-5 py-1 rounded">Muy mala</li>
                <li class="bg-purple-500 px-5 py-1 rounded">Extremadamente mala</li>
                <li class="bg-red-800 px-5 py-1 rounded">Peligrosa</li>
            </ul>
        </el-col>
    </div>
</template>

<script>
    export default {
        name: "Slide"
    }
</script>

<style lang="scss" scoped>
#slide {
    .niveles {
        background: #3564b3;
        color: #FFF;
        padding: 10px 25px;
        margin-bottom: 20px;
    }
    .niveles, .niveles ul {
        align-items: center;
        li {
            margin: 0px 5px;
        }
    }
    #estado {
        min-height: 120px;
        min-width: 120px;
        max-width: 150px;
        max-height: 150px;
    }
}
.slide-wrapper {
    width: 100vw;
    display: flex;
    position: relative;
    overflow: hidden;
    align-items: center;
    text-align: left;
    justify-content: center;
    height: 500px;
    background: linear-gradient(271deg, #618fdb, #355791);
    background-size: 400% 400%;
    background-repeat: no-repeat;
    -webkit-animation: CalidadBuena 7s ease infinite;
    -moz-animation: CalidadBuena 7s ease infinite;
    -o-animation: CalidadBuena 7s ease infinite;
    animation: CalidadBuena 7s ease infinite;
    /* background: rgb(53,87,145);
    background: -moz-linear-gradient(129deg, rgba(53,87,145,1) 0%, rgba(71,118,197,1) 100%);
    background: -webkit-linear-gradient(129deg, rgba(53,87,145,1) 0%, rgba(71,118,197,1) 100%);
    background: linear-gradient(129deg, rgba(53,87,145,1) 0%, rgba(71,118,197,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#355791",endColorstr="#4776c5",GradientType=1); */
}
@-webkit-keyframes CalidadBuena {
    0%{background-position:0% 51%}
    50%{background-position:100% 50%}
    100%{background-position:0% 51%}
}
@-moz-keyframes CalidadBuena {
    0%{background-position:0% 51%}
    50%{background-position:100% 50%}
    100%{background-position:0% 51%}
}
@-o-keyframes CalidadBuena {
    0%{background-position:0% 51%}
    50%{background-position:100% 50%}
    100%{background-position:0% 51%}
}
@keyframes CalidadBuena {
    0%{background-position:0% 51%}
    50%{background-position:100% 50%}
    100%{background-position:0% 51%}
}
.parallax-wrapper {
    z-index: 10;
    // height:520px;
    overflow: hidden;
    box-sizing: border-box;
    transform-style: preserve-3d;
 }
.parallax-wrapper::before {
    content:"";
    width: 100vw;
    height: 100vh;
    top:0;
    left:0;
    background-image: linear-gradient(to top, rgba(69, 171, 255, 0.9) 0%, rgba(35, 98, 255, 0.1) 100%), url('~@/assets/slide/NubesSlide.png');
    background-repeat: no-repeat;
    background-size: auto;
    background-position: left top;
    background-blend-mode: multiply;
    position: absolute;
    z-index: -1;
    transform:translateZ(-1px) scale(2);
}
.parallax-wrapper::after {
    content: '';
    width: 100%;
    height: 100%;
}
.info {
    z-index: 20;
    width: 100%;
    .texto {
        text-shadow: 3px 7px 5px #0000002b;
        text-align: right;
        p:first-child {
            font-size: 7em;
            line-height: 1em;
        }
    }
    .semaforo {
        flex: 1;
    }
}
@media screen and (max-width: 640px) {
    .info .texto {
        text-align: center;
        p:first-child {
            font-size: 4em;
        }
    }
    .niveles ul > li {
        margin: 3px 0px !important;
        width: 100%;
        text-align: center;
    }
}
</style>
