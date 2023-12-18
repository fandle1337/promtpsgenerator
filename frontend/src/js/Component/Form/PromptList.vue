<template>
    <div class="border card" v-if="promptList.length === 0 && isLoading">
        <Card>
            <template #title>
                Ваши промпты загружаются.
            </template>
            <template #content>
                Подождите, пожалуйста.
            </template>
        </Card>
    </div>
    <div class="border card" v-if="promptList.length === 0 && !isLoading">
        <Card>
            <template #title>
                У вас нет добавленных промптов.
            </template>
            <template #content>
                Добавьте, пожалуйста, новый промпт.
            </template>
        </Card>
    </div>
    <ScrollPanel class="pr-3" v-if="promptList.length !== 0" style="width: 100%; height: 633px">
        <div v-for="(prompt, index) in promptList" :key="index">
            <div :class="{ 'border': true, 'mb-3': index < promptList.length - 1 }">
                <Prompt :prompt="prompt"/>
            </div>
        </div>
    </ScrollPanel>
</template>

<script setup>
import ScrollPanel from 'primevue/scrollpanel';
import Card from "primevue/card";
import {useStore} from "vuex";
import {computed} from "vue";
import Prompt from './Prompt.vue'

const store = useStore()

const isLoading = computed(() => store.state.prompts.isLoading)
const promptList = computed(() => store.state.prompts.promptsList)

</script>

<style scoped>
.border {
    border: 1px solid #d1d5db;
    border-radius: 6px;
    min-width: 36rem;
}
.card {
    max-width: 98.7%;
}
</style>