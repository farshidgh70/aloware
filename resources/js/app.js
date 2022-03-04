window.Vue = require("vue");
import Vuex from "vuex";
Vue.use(Vuex);

import comments from "./components/Comments.vue";

// store
import { module_comment } from "./store/modules/comment";
const store = new Vuex.Store({
    modules: {
        comment: module_comment,
    },
});

const vm = new Vue({
    store,
    components: {
        comments,
    },
}).$mount("#comment");
