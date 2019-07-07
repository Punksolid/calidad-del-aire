<template>
    <el-col class="slide-wrapper">
        <div class="parallax-wrapper"></div>
        <div class="info">
            <div class="texto">
                <h1 class="font-extrabold text-white">Cuidemos</h1>
                <h5 class="text-white">El medio ambiente</h5>
            </div>
            <div class="semaforo">

            </div>
        </div>
    </el-col>
</el-col>
</template>

<script>
    export default {
        name: "Slide"
    }
</script>

<style scoped>
.slide-wrapper {
    width: 100vw;
    display: flex;
    position: relative;
    overflow: hidden;
    align-items: center;
    text-align: left;
    justify-content: center;
    margin: -20px -20px 20px -20px;
    height: 550px;
    background: linear-gradient(271deg, #618fdb, #355791);
    background-size: 400% 400%;
    -webkit-animation: CalidadBuena 9s ease infinite;
    -moz-animation: CalidadBuena 9s ease infinite;
    -o-animation: CalidadBuena 9s ease infinite;
    animation: CalidadBuena 9s ease infinite;
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
    height:520px;
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
    background-blend-mode: multiply;
    background: url('~@/assets/slide/NubesSlide.png') no-repeat;
    position: absolute;
    z-index: -1;
    transform:translateZ(-1px) scale(2);
}
.info {
    z-index: 20;
    display: flex;
    width: 100%;
}
.info .texto {
    flex: 1;
    text-shadow: 3px 7px 5px #0000002b;
    text-align: right;
}
.info .texto h1 {
    font-size: 7rem;
    line-height: 1em;
}
.info .semaforo {
    flex: 1;
    }
</style>
