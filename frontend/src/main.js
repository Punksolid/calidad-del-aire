import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import "./registerServiceWorker";
import "./plugins/element.js";
import "./assets/tailwind.css";
// import 'echarts/lib/echarts'

import ECharts from "vue-echarts/components/ECharts";
// import ECharts modules manually to reduce bundle size
import "echarts/lib/chart/bar";
import "echarts/lib/component/tooltip";
require("dotenv").config();
// register component to use
Vue.component("chart", ECharts);

Vue.config.productionTip = false;

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount("#app");
