<template>
    <Toast/>
    <Preloader :isLoading="isLoading"/>
    <div class="mt-2">
        <h1>CoPilot: Управление промптами</h1>
    </div>
    <div class="row">
        <div class="col-2 col-md-3 col-xl-3">
            <Button
                severity="success"
                icon="pi pi-plus"
                label="Создать промпт"
                @click="addPrompt"
            />
        </div>
        <div class="mt-3 col-7 col-md-8 col-xl-8 d-flex justify-content-end">
            <Search/>
        </div>
    </div>

    <div class="content">
        <div class="row mt-3">
            <div class="col-2 col-md-3 col-xl-3 mt-1 pr-2">
                <Filter/>
            </div>
            <div class="col-7 col-md-8 col-xl-8 mt-1">
                <Prompt/>
            </div>
        </div>
    </div>

</template>

<script setup>
import Toast from 'primevue/toast';
import Button from "primevue/button"
import Filter from "./Form/Filter.vue"
import Search from "./Form/Search.vue"
import Prompt from "./Form/Prompt.vue"
import {useStore} from "vuex"
import {useRouter} from "vue-router";
import Preloader from "./UI/Preloader.vue";
import {computed} from "vue";

const store = useStore()
const router = useRouter()

const isLoading = computed(() => store.state.prompts.isLoading)

const addPrompt = function () {
    router.push('/b24/new-prompt/')
}

</script>

<style scoped>
h1 {
    font-size: 30px;
}

.row {
    align-items: flex-start;
}
</style>