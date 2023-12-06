import {createStore} from "vuex";
import settings from "./store/settings.js";
import prompts from "./store/prompts.js";

/**
 *  @AUTH_OBJECT объект авторизации API
 *  @PLACEMENT_OPTIONS объект параметров bitrix24 placement
 */
export default createStore({
    modules: {
        settings: settings,
        prompts: prompts,
    }
})