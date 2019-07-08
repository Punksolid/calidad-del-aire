<template>
    <el-col class="bg-gray-200 text-gray-600 p-5">
        <h3 class="text-center" @click="detalles = !detalles">{{detalles ? 'Ocultar':'Ver'}} Tabla de Detalles</h3>
        <transition name="fade">
            <div v-if="detalles" class="detalles mt-5">
            <div id="TablaRiesgos" class="flex flex-row">
                <el-table
                    :data="tablaRiesgos"
                    class="w-full"
                    header-row-class-name="text-base text-gray-600"
                    :highlight-current-row="false"
                    cell-class-name="rounded-lg px-2"
                    :row-class-name="tableRowClass">
                    <el-table-column
                        prop="categoria"
                        label="Categoría"
                        align="center"
                        label-class-name="text-gray-600"
                        class-name="text-white text-lg font-bold"
                        width="130">
                    </el-table-column>
                    <el-table-column
                        prop="intervalo"
                        label="Intervalo"
                        align="center"
                        label-class-name="text-gray-600"
                        class-name="text-white text-lg font-bold"
                        width="130">
                    </el-table-column>
                    <el-table-column
                        prop="descripcion"
                        label="Riesgo a la Salud"
                        label-class-name="text-gray-600 opacity-100 text-center"
                        class-name="text-white opacity-75"
                        min-width="300"
                    >
                        <template slot-scope="scope">
                            <span class="font-bold">{{scope.row.riesgo}}</span>
                            <br>
                            {{scope.row.descripcion}}
                        </template>
                    </el-table-column>
                    <el-table-column
                        prop="recomendacion"
                        label="Recomendaciones"
                        label-class-name="text-gray-600 opacity-100 text-center"
                        class-name="text-white opacity-75"
                        min-width="300"
                    >
                    </el-table-column>
                </el-table>
            </div>
        </div>
        </transition>
        <div class="text-center mt-5" v-if="detalles" @click="detalles = !detalles">
            <i class="fas fa-2x fa-chevron-up"></i>
            <!-- <i class="fas fa-2x" :class="[detalles ? 'fa-chevron-up' : 'fa-chevron-down']"></i> -->
        </div>
    </el-col>
</template>

<script>
export default {
    name: "TablaRiesgos",
    data() {
        return {
            detalles: false,
            tablaRiesgos: [{
                    categoria: "Buena",
                    color: 'bg-buena',
                    intervalo: '0-50',
                    riesgo: 'Bajo',
                    descripcion: 'Existe poco o ningún riesgo para la salud.',
                    recomendacion: 'Se puede realizar cualquier actividad al aire libre.'
                },
                {
                    categoria: 'Regular',
                    color: 'bg-regular',
                    intervalo: '51-100',
                    riesgo: 'Moderado',
                    descripcion: 'Los grupos susceptibles pueden presentar síntomas en la salud.',
                    recomendacion: 'Las personas que son extremadamente susceptibles a la contaminación deben considerar limitar la exposición aire libre.'
                },
                {
                    categoria: 'Mala',
                    color: 'bg-mala',
                    intervalo: '101-150',
                    riesgo: 'Alto',
                    descripcion: 'Los grupos susceptibles presentan efectos en la salud.',
                    recomendacion: 'Los niños, adultos mayores, personas con enfermedades respiratorias y cardiovasculares, así como personas que realizan actividad física al aire libre deben limitar la exposición.'
                },
                {
                    categoria: 'Muy mala',
                    color: 'bg-muymala',
                    intervalo: '151-200',
                    riesgo: 'Muy alto',
                    descripcion: 'Todos pueden presentar efectos en la salud; quienes pertenecen a los grupos susceptiblesexperimentan efectos graves.',
                    recomendacion: 'Los niños, adultos mayores, personas que realizan actividad física intensa o con enfermedades respiratorias y cardiovasculares, deben evitar la exposición al aire libre y el resto de la población debe limitar la exposición al aire libre.' +
                        ''
                },
                {
                    categoria: 'Extremadamente mala',
                    color: 'bg-extremada',
                    intervalo: '201-300',
                    riesgo: 'Extremadamente alto',
                    descripcion: 'Toda la población tiene probabilidades de experimentar efectos graves en la salud.',
                    recomendacion: 'Toda la población debe evitar la exposición al aire libre.'
                },
                {
                    categoria: 'Peligrosa',
                    color: 'bg-peligrosa',
                    intervalo: '301-500',
                    riesgo: 'Peligro',
                    descripcion: 'Toda la población experimenta efectosgraves en la salud.',
                    recomendacion: 'Suspensión de actividades al aire libre.'
                }
            ]
        }
    },
    methods: {
        tableRowClass({row, rowIndex}) {
            return row.color
        }
    }
}
</script>

<style lang="scss">
#TablaRiesgos {
    .el-table {
        background-color: transparent;
    }
    td, th {
        border: 2px solid #eef2f7;
    }
    .el-table--enable-row-hover .el-table__body tr:hover>td {
        background-color: initial !important;
    }
    .bg-buena {
        background: #48bb78 !important;
    }
    .bg-regular {
        background: #ecc94b !important;
    }
    .bg-mala {
        background: #ed8936 !important;
    }
    .bg-muymala {
        background: #f56565 !important;
    }
    .bg-extremada {
        background: #805ad5 !important;
    }
    .bg-peligrosa {
        background: #9b2c2c !important;
    }
}
</style>
