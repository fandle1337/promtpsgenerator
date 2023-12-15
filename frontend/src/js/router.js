import {createRouter, createWebHistory} from "vue-router";

import PromptList from './Component/Main.vue';
import NewPrompt from './Component/NewPrompt.vue';

const route = function (name, path, component) {
    return {
        name: name,
        path: process.env.WORK_DIRECTORY + path,
        component: component,
    }
}

const routes = [
    route("list", '/:pathMatch(.*)*', PromptList),
    route("new", '/new-prompt/', NewPrompt),
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;