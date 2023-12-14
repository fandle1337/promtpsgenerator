<template>
    <div class="border mb-3" v-if="promptList.length === 0 && isLoading">
        <Card>
            <template #title>
                Ваши промпты загружаются.
            </template>
            <template #content>
                Подождите, пожалуйста.
            </template>
        </Card>
    </div>
    <div class="border mb-3" v-if="promptList.length === 0 && !isLoading">
        <Card>
            <template #title>
                У вас нет добавленных промптов.
            </template>
            <template #content>
                Добавьте, пожалуйста, новый промпт.
            </template>
        </Card>
    </div>
    <ScrollPanel style="width: 100%; height: 633px">
        <div v-for="(prompt, index) in promptList" :key="index">
            <div :class="{ 'border': true, 'mb-3': index < promptList.length - 1 }">
                <Card>
                    <template #title>
                        {{ prompt.translate.ru }}
                        <div class="d-inline-block" v-for="iconCategory in prompt.iconCategoryList">
                            <div :class="['bg-' + iconCategory.color, 'rounded-full', 'mr-2']"
                                 v-tooltip.top="'12321'">
                                <i :class="[iconCategory.icon]" style="font-size: 1rem; color: white;"></i>
                            </div>
                        </div>
                    </template>
                    <template #content>
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-10 col-lg-9 col-md-8">
                                    <p class="m-0">
                                        {{ prompt.prompt }}
                                    </p>
                                </div>
                                <div class="flex col-xl-2 col-lg-3 col-md-4 d-flex flex-column align-items-center">
                                    <ConfirmPopup/>
                                    <Button
                                        v-if="prompt.isTemplate"
                                        class="mb-2 min-width"
                                        label="Установить"
                                        size="small"
                                        severity="success"
                                        @click="copyTemplate(prompt.id)"
                                    />
                                    <Button
                                        v-else
                                        class="mb-2 min-width"
                                        label="Удалить"
                                        size="small"
                                        severity="danger"
                                        @click="confirmDelete($event, prompt.id)"
                                    />
                                    <Button
                                        class="mb-2 min-width"
                                        label="Создать на основе"
                                        size="small"
                                        @click="addBasedOn(prompt)"
                                    />
                                </div>
                            </div>
                        </div>
                    </template>
                </Card>
            </div>
        </div>
    </ScrollPanel>
</template>

<script setup>
import ScrollPanel from 'primevue/scrollpanel';
import ConfirmPopup from 'primevue/confirmpopup';
import {useConfirm} from "primevue/useconfirm";
import Button from "primevue/button";
import Card from "primevue/card";
import {useStore} from "vuex";
import {computed} from "vue";
import {useRouter} from "vue-router";

const store = useStore()
const confirm = useConfirm()
const router = useRouter()

const isLoading = computed(() => store.state.prompts.isLoading)
const promptList = computed(() => store.state.prompts.promptsList)
const deletePrompt = async function (promptId) {
    store.state.prompts.isLoading = true
    await store.dispatch('prompts/deletePrompt', {id: promptId})
    await store.dispatch('prompts/updatePromptList')
    await store.dispatch('prompts/addCountForPlacements', store.state.prompts.promptsList)
}
const confirmDelete = function (event, id) {
    confirm.require({
        target: event.currentTarget,
        message: 'Вы уверены, что хотите удалить этот промпт?',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            deletePrompt(id)
        },
        reject: () => {
        },
        acceptLabel: 'Да',
        rejectLabel: 'Нет',
        acceptClass: 'p-button-success p-button-sm',
        rejectClass: 'p-button-danger p-button-sm',
    })
}

const copyTemplate = async function (templateId) {
    store.state.prompts.isLoading = true
    await store.dispatch('prompts/copyTemplate', {id: templateId})
    await store.dispatch('prompts/updatePromptList')
    await store.dispatch('prompts/addCountForPlacements', store.state.prompts.promptsList)
}

const addBasedOn = function (prompt) {
    router.push({
        path: '/b24/new-prompt/',
        query: {
            ruName: prompt.translate.ru,
            enName: prompt.translate.en,
            prompt: prompt.prompt,
            categories: prompt.categories,
            code: prompt.code,
            parentCode: prompt.parentCode,
            sort: prompt.sort,
            icon: prompt.icon,
        }
    })
}

</script>

<style scoped>
.border {
    border: 1px solid #d1d5db;
    border-radius: 6px;
    min-width: 36rem;
}

.min-width {
    width: 7rem;
}

.rounded-full {
    border-radius: 25px;
    padding: 3px 12px 5px !important;
}

</style>