import RequestBuilder from "../class/RequestBuilder"

/**
 *  @AUTH_OBJECT объект авторизации API
 *  @PLACEMENT_OPTIONS Дополнительные параметры
 */
export default {
    namespaced: true,
    state() {
        return {
            domain: null,
            moduleCode: null,
            userId: null,
            userPermissionGroup: null,

        }
    },
    mutations: {
        updateDomain(state, value) {
            state.domain = value
        },
        updateModuleCode(state, value) {
            state.moduleCode = value
        },
        updateUserId(state, value) {
            state.userId = value
        },
        updateUserPermissionGroup(state, value) {
            state.userPermissionGroup = value
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
            context.commit("updateDomain", response.domain)
            context.commit("updateModuleCode", response.module_code)
            context.commit("updateUserId", response.user_id)
            context.commit("updateUserPermissionGroup", response.user_permission_group)
        },
    },
}