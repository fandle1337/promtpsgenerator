import RequestBuilder from "../class/RequestBuilder";

/**
 *  @AUTH_OBJECT объект авторизации API
 *  @PLACEMENT_OPTIONS объект параметров bitrix24 placement
 */
export default {
    namespaced: true,
    state() {
        return {
            promptsList: [
                {
                    code: 'rest_birthday',
                    translate: {
                        ru: 'Поздравление',
                        en: 'greetings',
                    },
                    prompt: 'Поздравь с днем рождения официально',
                    categories: ['tasks', 'chat'],
                    icon: 'fire',
                    parentCode: null,
                    sort: 100,
                    isTemplate: true,
                },
                {
                    code: 'rest_new_year',
                    translate: {
                        ru: 'Поздравление с новым годом',
                        en: 'greetings',
                    },
                    prompt: 'Поздравь с новым годом официально',
                    categories: ['livefeed_comments', 'livefeed'],
                    icon: 'fire',
                    parentCode: null,
                    sort: 100,
                    isTemplate: false,

                },
            ],
            options: {
                placements: [
                    {name: 'Пост ленты новостей', code: 'livefeed', count: 1},
                    {name: 'Комментарий ленты новостей', code: 'livefeed_comments', count: 1},
                    {name: 'Текст задачи', code: 'tasks', count: 1},
                    {name: 'Комментарии задачи', code: 'tasks_comments', count: 1},
                    {name: 'Чат', code: 'chat', count: 1},
                    {name: 'Почта', code: 'mail', count: 1},
                    {name: 'Почта CRM', code: 'mail_crm', count: 1},
                    {name: 'Сайты', code: 'landing', count: 1}
                ],
                showTemplates: true,
            },
            filter: {
                placement: 'landing',
                showTemplates: true,
            }
        }
    },
    mutations: {
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
                        prompt.iconCategoryList.push({ icon: placement.icon, color: placement.color})
                    }
                })
            })
        },
        updatePromptList(state, value) {
            state.promptsList = value
        },
    },
    actions: {
        addIconToPlacement({commit}) {
            commit("addIconToPlacement", {code: "livefeed", icon: "pi pi-bookmark-fill", color: "teal-400"})
            commit("addIconToPlacement", {code: "livefeed_comments", icon: "pi pi-comment", color: "teal-300"})
            commit("addIconToPlacement", {code: "tasks", icon: "pi pi-check-circle", color: "blue-400"})
            commit("addIconToPlacement", {code: "tasks_comments", icon: "pi pi-comment", color: "blue-300"})
            commit("addIconToPlacement", {code: "chat", icon: "pi pi-comments", color: "red-400"})
            commit("addIconToPlacement", {code: "mail", icon: "pi pi-at", color: "purple-400"})
            commit("addIconToPlacement", {code: "mail_crm", icon: "pi pi-envelope", color: "purple-300"})
            commit("addIconToPlacement", {code: "landing", icon: "pi pi-desktop", color: "pink-400"})
        },
        addIconsToPrompts({commit}) {
            commit('addIconsToPrompts')
        },
        async fetchPromptList(context, payload) {
            return (new RequestBuilder(AUTH_OBJECT)).fetch('/api/app/prompt/list/', {
              method: 'POST',
              body: JSON.stringify(payload)
            })
        },
        async updatePromptList(context, payload) {
            const response = await context.dispatch('fetchPromptList', payload)
            context.commit('updatePromptList', response)
        },
    },
    getters: {}
}