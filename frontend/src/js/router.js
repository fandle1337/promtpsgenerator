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
    route("new-prompt", '/new-prompt/', NewPrompt, ['A']),
    route("settings", '/settings/', Settings, ['A', 'U']),
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const requiredPermissions = to.meta.permissions || []
    const userPermissions = store.state.settings.userPermissionGroup || []

    if (checkUserPermission(requiredPermissions, userPermissions)) {
        next()
    } else {
        next({name: from.name})
    }
})

export default router