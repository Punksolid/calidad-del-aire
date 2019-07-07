<template>
    <div class="home">
        <Slide />
        <el-row :gutter="15">
            <el-col :xs="24" :sm="5" class="mb-5">
                <div class="bg-gray-400 p-2 rounded mb-2">
                    <h4>Selecciona un elemento:</h4>
                    <el-select
                        v-model="indicator_selected"
                        placeholder="Selecione un elemento"
                        class="block w-auto pb-2"
                        @change="changeCollection"
                    >
                        <el-option
                            v-for="indicator in indicators"
                            :key="indicator.value"
                            :label="indicator.name"
                            :value="indicator.value"
                        />
                    </el-select>
                </div>
                <el-card class="box-card">
                    <div slot="header" class="clearfix">
                        <span>Tabla de Información</span>
                        <el-button
                            style="float: right; padding: 3px 0"
                            icon="el-icon-remove-outline"
                            type="text"
                            @click="cardCollapse = !cardCollapse"
                        ></el-button>
                    </div>
                    <div v-if="cardCollapse" class="px-3">
                        <ul class="text-xs list-disc">
                            <li>O3 (Ozono)</li>
                            <li>NO NO2 (Dióxido de nitrógeno)</li>
                            <li>NOx (Oxidos de Nitrogeno)</li>
                            <li>CO (Monóxido de carbono)</li>
                            <li>SO2 (dióxido de azufre)</li>
                            <li>
                                PM2.5 (Partículas menores a 2.5 micrómetros)
                            </li>
                        </ul>
                        <p class="text-xs">ppb ppb ppb ppb ppm ppb ug/m3</p>
                    </div>
                </el-card>
            </el-col>
            <el-col :xs="24" :sm="15">
                <div class="border rounded mb-5">
                    <div class="w-auto bg-gray-400 p-2">
                        <h4 v-if="indicator_selected" class="text-lg">
                            <b>Visualizando:</b> {{ indicator_selected }}
                        </h4>
                    </div>
                    <div class="p-2">
                        <Trend
                            class=""
                            :data="datacollection"
                            :gradient="['#ffd04b', '#8DA1C5', '#4b648c']"
                            auto-draw
                            smooth
                        >
                        </Trend>
                    </div>
                </div>
            </el-col>

            <el-col :xs="24" :sm="4">
                <tacometro />
            </el-col>
        </el-row>
    </div>
</template>

<script>
import Trend from "vuetrend";
import axios from "axios";
import Tacometro from "../components/Tacometro.vue";
import Slide from "./layout/slide";

export default {
    name: "home",
    components: {
        Slide,
        Trend,
        Tacometro
    },
    data() {
        return {
            cardCollapse: true,
            indicator_selected: null,
            indicators: [
                {
                    name: "CO",
                    value: "co"
                },
                {
                    name: "NO",
                    value: "no"
                },
                {
                    name: "O3",
                    value: "o3"
                },
                {
                    name: "NOx",
                    value: "nox"
                },
                {
                    name: "SO2",
                    value: "pm25"
                }
            ],
            datacollection: null,
            co: [],
            no: [],
            o3: [],
            nox: [],
            so2: [],
            pm25: []
        };
    },
    methods: {
        changeCollection() {
            switch (this.indicator_selected) {
                case "co":
                    this.datacollection = this.co;
                    break;
                case "no":
                    this.datacollection = this.no;
                    break;
                case "o3":
                    this.datacollection = this.o3;
                    break;
                case "nox":
                    this.datacollection = this.nox;
                    break;
                case "so2":
                    this.datacollection = this.so2;
                    break;
                case "pm25":
                    this.datacollection = this.pm25;
                    break;

                default:
                    break;
            }
        },
        getRegistries() {
            axios
                .get(process.env.VUE_APP_BACKEND_URL + "/api/v1/registries")
                .then(response => {
                    this.datacollection = response.data.data;
                    this.co = response.data.data.map(function(reg) {
                        return reg.CO;
                    });
                    this.no = response.data.data.map(function(reg) {
                        return reg.NO;
                    });
                    this.o3 = response.data.data.map(function(reg) {
                        return reg.O3;
                    });
                    this.nox = response.data.data.map(function(reg) {
                        return reg.NOx;
                    });
                    this.so2 = response.data.data.map(function(reg) {
                        return reg.SO2;
                    });
                    this.pm25 = response.data.data.map(function(reg) {
                        return reg.PM25;
                    });
                    // return response.data.data;
                });
        }
    },
    mounted() {
        this.getRegistries();
    }
};
</script>
