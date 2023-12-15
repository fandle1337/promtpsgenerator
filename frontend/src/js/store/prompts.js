import RequestBuilder from "../class/RequestBuilder";
import OptionList from "../class/OptionList";

/**
 *  @AUTH_OBJECT объект авторизации API
 *  @PLACEMENT_OPTIONS объект параметров bitrix24 placement
 */
export default {
    namespaced: true,
    state() {
        return {
            isLoading: false,
            promptsList: [],
            options: {
                placements: OptionList.getCategoryList(),
            },
            filter: {
                placement: null,
                showTemplates: true,
            }
        }
    },
    mutations: {
        addCountForPlacements(state, promptList) {
            state.options.placements.forEach(placement => {
                placement.count = promptList.reduce((count, prompt) => {
                    if (prompt.categories && prompt.categories.includes(placement.code)) {
                        return count + 1
                    }
                    return count
                }, 0)
            })
        },
        addIconToPlacement(state, {code, icon, color}) {
            const placement = state.options.placements.find(p => p.code === code)
            if (placement) {
                placement.icon = icon
                placement.color = color
            }
        },
        addIconsToPrompts(state) {
            state.promptsList.forEach(prompt => {
                prompt.iconCategoryList = []
                prompt.categories.forEach(category => {
                    const placement = state.options.placements.find(p => p.code === category)
                    if (placement && placement.icon) {
                        prompt.iconCategoryList.push({
                            icon: placement.icon,
                            color: placement.color,
                            name: placement.name,
                        })
                    }
                })
            })
        },
        updatePromptList(state, value) {
            state.promptsList = value.result
        },
        updateFilter(state, value) {
            state.filter.showTemplates = value.result.showTemplates
            state.filter.placement = value.result.placement
        },
    },
    actions: {
        addIconToPlacement(context) {
            context.commit("addIconToPlacement", {code: "livefeed", icon: "pi pi-bookmark-fill", color: "teal-400"})
            context.commit("addIconToPlacement", {code: "livefeed_comments", icon: "pi pi-comment", color: "teal-300"})
            context.commit("addIconToPlacement", {code: "tasks", icon: "pi pi-check-circle", color: "blue-400"})
            context.commit("addIconToPlacement", {code: "tasks_comments", icon: "pi pi-comment", color: "blue-300"})
            context.commit("addIconToPlacement", {code: "chat", icon: "pi pi-comments", color: "red-400"})
            context.commit("addIconToPlacement", {code: "mail", icon: "pi pi-at", color: "purple-400"})
            context.commit("addIconToPlacement", {code: "mail_crm", icon: "pi pi-envelope", color: "purple-300"})
            context.commit("addIconToPlacement", {code: "landing", icon: "pi pi-desktop", color: "pink-400"})
        },
        addIconsToPrompts(context) {
            context.commit('addIconsToPrompts')
        },
        addCountForPlacements(context, promptList) {
            context.commit('addCountForPlacements', promptList)
        },
        async updatePromptList(context, payload = {
            category: this.state.prompts.filter.placement,
            showTemplates: this.state.prompts.filter.showTemplates
        }) {
            this.state.prompts.isLoading = true
            const response = await context.dispatch('fetchPromptList', payload)
            context.commit('updatePromptList', response)
            await context.dispatch('addIconsToPrompts')
            this.state.prompts.isLoading = false
        },
        async updateOptions(context, payload) {
            const response = await context.dispatch('fetchOptions', payload)
            context.commit('updateOptions', response)
        },
        async updateFilter(context, payload) {
            const response = await context.dispatch('fetchFilter')
            context.commit('updateFilter', response)
        },
        async fetchPromptList(context, payload) {
            return (new RequestBuilder(AUTH_OBJECT)).fetch('/api/app/prompt/list/', {
                method: 'POST',
                body: JSON.stringify(payload)
            })
        },
        async fetchOptions(context, payload) {
            return (new RequestBuilder(AUTH_OBJECT)).fetch('/api/app/options/list/', {
                method: 'GET',
                body: JSON.stringify(payload)
            })
        },
        async addPrompt(context, payload) {
            return (new RequestBuilder(AUTH_OBJECT)).fetch('/api/app/prompt/add/', {
                method: 'POST',
                body: JSON.stringify(payload)
            })
        },
        async deletePrompt(context, payload) {
            return (new RequestBuilder(AUTH_OBJECT)).fetch('/api/app/prompt/delete/', {
                method: 'POST',
                body: JSON.stringify(payload)
            })
        },
        async copyTemplate(context, payload) {
            return (new RequestBuilder(AUTH_OBJECT)).fetch('/api/app/template/copy/', {
                method: 'POST',
                body: JSON.stringify(payload)
            })
        },
        async fetchFilter(context, payload) {
            return (new RequestBuilder(AUTH_OBJECT)).fetch('/api/app/filter/get/', {
                method: 'POST',
                body: JSON.stringify(payload)
            })
        },
    },
    getters: {}
}