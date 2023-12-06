import RequestBuilder from "../class/RequestBuilder"

/**
 *  @AUTH_OBJECT объект авторизации API
 *  @PLACEMENT_OPTIONS Дополнительные параметры
 */
export default {
    namespaced: true,
    state() {
        return {
            appSettings: {
                domain: null,
                moduleCode: null,
                userId: null,
                isAdmin: null,
                isAvailable: null,
            },
        }
    },
    mutations: {
        updateAppSettings(state, value) {
            state.appSettings.domain = value.domain
            state.appSettings.moduleCode = value.module_code
            state.appSettings.userId = value.user_id
            state.appSettings.isAdmin = value.is_admin
            state.appSettings.isAvailable = value.is_available
        }
    },
    actions: {
        async fetchAppSettings(context, payload) {
            return (new RequestBuilder(AUTH_OBJECT)).fetch("/api/app/settings/", {
                method: 'GET',
                body: JSON.stringify(payload)
            })
        },
        async updateAppSettings(context, payload) {
            const response = await context.dispatch("fetchAppSettings", payload)
            context.commit("updateAppSettings", response)
        },
    },
}