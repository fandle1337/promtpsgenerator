<template>
    <div class="mt-2">
        <h1>CoPilot: Управление промптами</h1>
    </div>
    <Button
        label="Создать новый промпт"
        @click="addPrompt"
    />
    <div class="content">
        <div class="row mt-3">
            <div class="col-3 col-md-4 col-xl-3 mt-1 pr-2">
                <Filter/>
            </div>
            <div class="col-7 col-md-8 col-xl-8 mt-1">
                <Search/>
                <Prompt/>
            </div>
        </div>
    </div>

</template>

<script setup>
import Button from "primevue/button"
import Filter from "./Form/Filter.vue"
import Search from "./Form/Search.vue"
import Prompt from "./Form/Prompt.vue"
import {useStore} from "vuex"
import {useRouter} from "vue-router";

const store = useStore()
const router = useRouter()

store.dispatch('prompts/addIconToPlacement')
store.dispatch('prompts/addIconsToPrompts')

const addPrompt = function () {
    router.push('./new-prompt/')
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