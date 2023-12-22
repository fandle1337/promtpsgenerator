<template>
    <div class="d-flex justify-content-between align-items-center">
        <!--        <span class="p-input-icon-left">
                  <i class="pi pi-search"/>
                  <InputText
                      v-model="search"
                      placeholder="Поиск"
                      size="normal"
                  />
                </span>-->
        <div class="d-flex justify-content-center align-content-center align-items-center pr-3">
            <div>
                <Button
                    outlined
                    class="mr-5"
                    :label="getCollapseLabel"
                    @click="toggleCollapse"
                />
            </div>
            <div class="border d-flex justify-content-center align-content-center align-items-center">
                <div class="pl-2 mr-3">
                    Мои промпты
                </div>
                <InputSwitch
                    class="mr-3"
                    :modelValue="displayTemplates"
                    @update:modelValue="changeTemplates"
                />
                <div class="pr-2">
                    Библиотека промптов
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Button from "primevue/button";
import Tag from 'primevue/tag';
import InputSwitch from 'primevue/inputswitch';
import InputText from "primevue/inputtext";
import {computed, ref} from "vue";
import {useStore} from "vuex";

const store = useStore()
const displayTemplates = computed(() => store.state.prompts.filter.showTemplates)
const changeTemplates = function (event) {
    store.state.prompts.filter.showTemplates = event
    store.state.prompts.isLoading = true
    store.dispatch('prompts/updatePromptList').then(() => {
        store.dispatch('prompts/addCountForPlacements', store.state.prompts.promptsList)
    })
    store.state.prompts.isLoading = false
}

const promptsCollapsed = computed(() => store.state.prompts.options.promptsCollapsed)
const toggleCollapse = function () {
    store.commit('prompts/togglePromptsCollapsed')
}
const getCollapseLabel = computed(() => {
    if (promptsCollapsed.value) {
        return 'Развернуть все'
    }
    return 'Свернуть все'
})

</script>

<style scoped>
.border {
    padding: 8px;
    border: 1px solid #d1d5db;
    border-radius: 23px;
}
</style>
