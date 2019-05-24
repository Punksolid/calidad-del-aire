<template>
    <div class="home">
        <div class="flex content-start flex-wrap bg-gray-200">
            <div>
                O3(Ozono),	NO	NO2(dióxido de nitrógeno),	NOx(Oxidos de Nitrogeno),
                CO( monóxido de carbono ),	SO2(dióxido de azufre),	PM2.5(partículas menores a 2.5 micrómetros )
            </div>
            <div>
                ppb	ppb	ppb	ppb	ppm	ppb	ug/m3
            </div>
        </div>
        <el-select 
        v-model="indicator_selected" 
        placeholder="Indicator"
        @change="changeCollection"
        >
          <el-option v-for="indicator in indicators" 
          :key="indicator.value"
          :label="indicator.name"
          :value="indicator.value"
          ></el-option>
        </el-select>
        <trend
            :data="datacollection"
            :gradient="['#6fa8dc', '#42b983', '#2c3e50']"
            auto-draw
            smooth
            >
        </trend>
        <tacometro></tacometro>
    </div>
</template>

<script>
import Trend from "vuetrend";
import axios from "axios";
import Tacometro from "@/components/Tacometro.vue"

export default {
    name: "home",
    components:{
        Trend,
        Tacometro
    },
    data () {
      return {
        indicator_selected: null,
        indicators: [{
            name: "CO",
            value: "co"
        },{
            name: "NO",
            value: "no"
        },{
            name: "O3",
            value: "o3"
        },{
            name: "NOx",
            value: "nox"
        },{
            name: "SO2",
            value: "pm25"
        }],
        datacollection: null,
        co:[],
        no:[],
        o3:[],
        nox:[],
        so2:[],
        pm25:[],
      }
    },
    methods: {
        changeCollection(){
            switch (this.indicator_selected) {
                case "co":
                    this.datacollection = this.co
                    break;
                case "no":
                    this.datacollection = this.no
                    break;
                case "o3":
                    this.datacollection = this.o3
                    break;
                case "nox":
                    this.datacollection = this.nox
                    break;
                case "so2":
                    this.datacollection = this.so2
                    break;
                case "pm25":
                    this.datacollection = this.pm25
                    break;
            
                default:
                    break;
            }
        },
        getRegistries() {
            axios.get('http://localhost:8000/api/v1/registries')
                .then(response => {
                    this.datacollection = response.data.data
                    this.co = response.data.data.map(function(reg){
                        return reg.CO
                    })
                    this.no = response.data.data.map(function(reg){
                        return reg.NO
                    })
                    this.o3 = response.data.data.map(function(reg){
                        return reg.O3
                    })
                    this.nox = response.data.data.map(function(reg){
                        return reg.NOx
                    })
                    this.so2 = response.data.data.map(function(reg){
                        return reg.SO2
                    })
                    this.pm25 = response.data.data.map(function(reg){
                        return reg.PM25
                    })
                    // return response.data.data;
                })
        }
    },
    mounted() {
        this.getRegistries()
    }
};


</script>
