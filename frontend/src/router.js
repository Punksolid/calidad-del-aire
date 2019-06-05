import Vue from "vue";
import Router from "vue-router";
import Home from "./views/Home.vue";
import Upload from "./views/Upload.vue";

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
            title: "Calidad del Aire",
            meta: {
                title: 'Calidad Del Aire - Culiacán',
                metaTags: [
                    {
                        name: 'description',
                        content: 'Indicadores de la calidad del aire de la Ciudad de Culiacán, Sinaloa.'
                    },
                    {
                        property: 'og:description',
                        content: 'Indicadores de la calidad del aire de la Ciudad de Culiacán, Sinaloa.'
                    }
                ]
            }
        },
        {
            path: "/upload",
            name: "upload",
            component: Upload
        },
        {
            path: "/about",
            name: "about",
            // route level code-splitting
            // this generates a separate chunk (about.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () =>
                import(/* webpackChunkName: "about" */ "./views/About.vue")
        }
    ]
});
