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
            isLoading: true,
            promptsList: [],
            options: {
                placements: OptionList.getCategoryList(),
                promptsCollapsed: true,
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
        updatePromptList(state, value) {
            state.promptsList = value
        },
        updateFilter(state, value) {
            state.filter.showTemplates = value.showTemplates
            state.filter.placement = value.placement
        },
        togglePromptsCollapsed(state, value) {
            state.options.promptsCollapsed = !state.options.promptsCollapsed
        },
    },
    actions: {
        addCountForPlacements(context, promptList) {
            context.commit('addCountForPlacements', promptList)
        },
        async updatePromptList(context, payload = {
            category: this.state.prompts.filter.placement,
            showTemplates: this.state.prompts.filter.showTemplates
        }) {
            const response = await context.dispatch('fetchPromptList', payload)
            context.commit('updatePromptList', response)
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