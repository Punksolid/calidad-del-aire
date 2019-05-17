<template>
    <div class="home">
        <trend
            :data="co"
            :gradient="['#6fa8dc', '#42b983', '#2c3e50']"
            auto-draw
            smooth
            >
        </trend>
    </div>
</template>

<script>
import Trend from "vuetrend";
import axios from "axios";

export default {
    name: "home",
    components:{
        Trend
    },
    data () {
      return {
        datacollection: null,
        co:[]
      }
    },
    methods: {
        getRegistries() {
            axios.get('http://localhost:8000/api/v1/registries')
                .then(response => {
                    this.datacollection = response.data.data
                    this.co = response.data.data.map(function(reg){
                        return reg.CO
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
