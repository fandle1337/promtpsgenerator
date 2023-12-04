import {createApp} from "vue";

import "./src/css/main.css";
import store from "./src/js/store";
import Index from "./src/js/Component/Index.vue";

createApp(Index)
    .use(store)
    .mount('#app');
