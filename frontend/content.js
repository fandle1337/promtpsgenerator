import {createApp} from "vue";
import "./src/css/main.css";
import PrimeVue from 'primevue/config';
import store from "./src/js/store";
import router from "./src/js/router";
import Index from "./src/js/Pages/Index.vue"
import ToastService from "primevue/toastservice";
import ConfirmationService from 'primevue/confirmationservice';
import Tooltip from "primevue/tooltip";
import LinkSliderManager from "./src/js/class/LinkSliderManager";
import "primevue/resources/themes/lara-light-indigo/theme.css";

store.dispatch("settings/updateAppSettings").then(e => {
    (new LinkSliderManager(store.state.settings.domain)).start()
    createApp(Index)
        .use(PrimeVue)
        .use(router)
        .use(store)
        .use(ToastService)
        .use(ConfirmationService)
        .directive('tooltip', Tooltip)
        .mount('#app');
})

