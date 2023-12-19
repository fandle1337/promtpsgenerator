<template>
    <Toast/>
    <Preloader :isLoading="isLoading"/>
    <div class="mt-3 row d-flex align-items-center">
        <div class="col-2 col-md-3 col-xl-3">
            <Button
                severity="success"
                icon="pi pi-plus"
                label="Создать промпт"
                @click="addPrompt"
            />
        </div>
        <div class="col-9 col-md-9 col-xl-9 d-flex justify-content-end align-items-center">
            <Search/>
        </div>
    </div>

    <div>
        <div class="row mt-3">
            <div class="col-3 col-md-3 col-xl-3 mt-1 pr-2">
                <Filter/>
            </div>
            <div class="col-9 col-md-9 col-xl-9 mt-1">
                <PromptList/>
            </div>
        </div>
    </div>

</template>

<script setup>
import Toast from 'primevue/toast';
import Button from "primevue/button"
import Filter from "./Form/Filter.vue"
import Search from "./Form/Search.vue"
import PromptList from "./Form/PromptList.vue"
import {useStore} from "vuex"
import {useRouter} from "vue-router";
import Preloader from "./UI/Preloader.vue";
import {computed} from "vue";

const store = useStore()
const router = useRouter()

const isLoading = computed(() => store.state.prompts.isLoading)

const addPrompt = function () {
    router.push({name: 'new-prompt'})
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