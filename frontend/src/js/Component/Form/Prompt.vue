<template>
    <Toast/>
    <Panel toggleable :collapsed="promptsCollapsed">
        <template #header>
            <div class="d-flex align-items-center justify-content-center align-content-center">
                <div v-tooltip.left="'Название промпта'" class="mr-2">
                    {{ prompt.translate.ru }}
                </div>
                <div class="d-inline-block" v-for="category in expandedCategories">
                    <div :class="['bg-' + category.color, 'rounded-full', 'mr-2']"
                         v-tooltip.top="category.name">
                        <i :class="[category.icon]" style="font-size: 1rem; color: white;"></i>
                    </div>
                </div>
            </div>
        </template>
        <template #footer v-if="!prompt.isTemplate">
            <div class="d-flex justify-content-between">
                <div v-tooltip.left="'Код промпта'">
                    {{ prompt.code }}
                </div>
                <div v-tooltip.left="'Дата установки'">
                    {{formatDate(prompt.dateCreated)}}
                </div>
            </div>
        </template>
        <template #icons>
            <button
                class="p-panel-header-icon p-link mr-2"
                @click="toggle"
                aria-haspopup="true"
                aria-controls="config_menu">
                <span class="pi pi-cog"></span>
            </button>
            <Menu ref="menuVisible" id="config_menu" :model="itemsMenu" popup/>
        </template>
        <div v-tooltip.left="'Текст промпта'" style="white-space: pre-line">
            {{ prompt.prompt }}
        </div>
    </Panel>
</template>

<script setup>

import Toast from "primevue/toast";
import Menu from 'primevue/menu';
import Panel from 'primevue/panel';
import ConfirmPopup from 'primevue/confirmpopup';
import Button from "primevue/button";
import {useStore} from "vuex";
import {computed, ref} from "vue";
import {useRouter} from "vue-router";
import {useToast} from "primevue/usetoast";
import expand from "../../class/expandedCateogryIcon";

const store = useStore()
const toast = useToast()
const router = useRouter()

const props = defineProps({
    prompt: {
        type: Object,
    }
})

const promptsCollapsed = computed(() => store.state.prompts.options.promptsCollapsed)

const isAdmin = computed(() => {
    return store.state.settings.userPermissionGroup === 'A'
})

const expandedCategories = computed(() => {
    return props.prompt.categories.map(category => expand(category))
})

const deletePrompt = async function (promptId) {
    if (!isAdmin.value) {
        toast.add({
            severity: 'error',
            summary: 'Внимание!',
            detail: 'Это действие доступно только администраторам портала.',
            life: 3000,
            closable: false,
        })
        return
    }
    if (confirm('Вы уверены, что хотите удалить этот промпт?')) {
        store.state.prompts.isLoading = true
        await store.dispatch('prompts/deletePrompt', {id: promptId})
        await store.dispatch('prompts/updatePromptList')
        await store.dispatch('prompts/addCountForPlacements', store.state.prompts.promptsList)
        store.state.prompts.isLoading = false
    }
}
const copyTemplate = async function (templateId) {
    if (!isAdmin.value) {
        toast.add({
            severity: 'error',
            summary: 'Внимание!',
            detail: 'Это действие доступно только администраторам портала.',
            life: 3000,
            closable: false,
        })
        return
    }
    store.state.prompts.isLoading = true
    await store.dispatch('prompts/copyTemplate', {id: templateId})
    await store.dispatch('prompts/updatePromptList')
    await store.dispatch('prompts/addCountForPlacements', store.state.prompts.promptsList)
    store.state.prompts.isLoading = false
}
const addBasedOn = function (prompt) {
    if (!isAdmin.value) {
        toast.add({
            severity: 'error',
            summary: 'Внимание!',
            detail: 'Это действие доступно только администраторам портала.',
            life: 3000,
            closable: false,
        })
        return
    }
    router.push({
        name: 'new-prompt',
        query: {
            ruName: prompt.translate.ru,
            enName: prompt.translate.en,
            prompt: prompt.prompt,
            categories: prompt.categories,
            icon: prompt.icon,
            parentCode: prompt.parentCode,
            section: prompt.section,
            sort: prompt.sort,
        }
    })
}

const menuVisible = ref()
const toggle = (event) => {
    menuVisible.value.toggle(event)
}

const itemsMenu = computed(() => {
    const list = [
        {
            label: 'Создать на основе',
            icon: 'pi pi-plus-circle',
            command: () => addBasedOn(props.prompt)
        }
    ]
    const btnDelete = {
        label: 'Удалить',
        icon: 'pi pi-times',
        command: () => deletePrompt(props.prompt.id)
    }

    const btnInstallTemplate = {
        label: 'Установить',
        icon: 'pi pi-check',
        command: () => copyTemplate(props.prompt.id)
    }

    if (props.prompt.isTemplate) {
        list.unshift(btnInstallTemplate)
    } else {
        list.unshift(btnDelete)
    }

    return list
})

const formatDate = function (date) {
    const dateObject = new Date(date)
    const day = dateObject.getDate()
    const month = dateObject.getMonth() + 1
    const year = dateObject.getFullYear()

    return `${day < 10 ? '0' : ''}${day}.${month < 10 ? '0' : ''}${month}.${year}`
}

</script>

<style scoped>

.rounded-full {
    border-radius: 30px;
    padding: 8px 9px 5px !important;
}

</style>