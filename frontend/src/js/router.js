import {createRouter, createWebHistory} from "vue-router"
import store from "./store"
import {checkUserPermission} from "./class/UserPermissions"
import Main from './Component/Main.vue'
import NewPrompt from './Component/NewPrompt.vue'
import Settings from "./Component/Settings.vue"
import TabsMenu from "./Component/Form/TabsMenu.vue";

const route = function (name, path, component, permissions, layout = TabsMenu) {
    return {
        name: name,
        path: process.env.WORK_DIRECTORY + path,
        component: component,
        meta: {
            permissions: permissions,
            layout: layout
        },
    }
}

const routes = [
    route("main", '/:pathMatch(.*)*', Main, ['A', 'U']),
    route("new-prompt", '/new-prompt/', NewPrompt, ['A', 'U']),
    route("settings", '/settings/', Settings, ['A', 'U']),
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

/*router.beforeEach(async (to, from, next) => {
    const checkPermissions = () => {
        return checkUserPermission(to.meta.permissions, store.state.settings.appSettings.user_permission_group)
    }

    if (to.name !== "main" && !checkPermissions()) {
        next({name: "main"})
    } else {
        next()
    }
})*/

export default router