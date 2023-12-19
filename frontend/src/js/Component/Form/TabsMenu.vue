<template>
    <div class="layout">
        <div class="navigation d-flex flex-column">
            <template v-for="page of pages">
                <router-link
                    :to="{name: page.name}"
                    :class="['navigation__item p-3', {'_active': isInnerPage(page.to)}]"
                    v-tooltip="page.label">
                    <i :class="['navigation__icon pi', page.icon]"></i>
                </router-link>
            </template>
        </div>
        <div class="content p-2">

                <slot/>

        </div>
    </div>
    <Adv/>
</template>
<script setup>
import TabMenu from 'primevue/tabmenu'
import {ref} from "vue"
import {useRoute, useRouter} from "vue-router";
import {Adv} from "skyweb24.vue-adv"

const route = useRoute()
const router = useRouter()

const pages = ref([
    {
        label: 'Список промптов',
        name: 'main',
        icon: 'pi pi-list',
        command: () => {
            router.push({name: 'main'})
        },
        to: process.env.WORK_DIRECTORY + "/",
    },
    {
        label: 'Новый промпт',
        name: 'new-prompt',
        icon: 'pi pi-plus-circle',
        command: () => {
            router.push({name: 'new-prompt'})
        },
        to: process.env.WORK_DIRECTORY + "/new-prompt/",
    },
    {
        label: 'Настройки',
        name: 'settings',
        icon: 'pi pi-cog',
        command: () => {
            router.push({name: 'settings'})
        },
        to: process.env.WORK_DIRECTORY + "/settings/",
    }
])

function isInnerPage(to) {
    let toArray = to.split('/')
    let pathArray = route.path.split('/')
    return toArray[2] === pathArray[2] || (toArray[2] === '' && !pathArray[2]) || (toArray[2] === '' && pathArray[2] === 'index.php');
}

</script>
<style>
.layout {
    min-height: 100vh;
}

.navigation {
    position: fixed;
    width: 60px;
    height: 100vh;
    border-right: 1px solid var(--surface-300);
}

.navigation__item {
    display: block;
    width: 60px;
    height: 60px;
    border-bottom: 1px solid var(--surface-300);
}

.navigation__item:first-child {
    border-top: 1px solid var(--surface-300);
}

.navigation__icon {
    color: var(--surface-600);
    font-size: calc(60px - 2rem);
}

.navigation__item:hover .navigation__icon {
    color: var(--surface-400);
}

.navigation__item._disabled .navigation__icon,
.navigation__item._disabled:hover .navigation__icon {
    color: var(--surface-300);
}

.navigation__item._active {
    background: var(--primary-400);
}

.navigation__item._active .navigation__icon {
    color: #fff;
}

.content {
    width: calc(100% - 62px);
    margin-left: 62px;
}
</style>