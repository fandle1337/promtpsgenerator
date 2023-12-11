<template>
    <div class="d-flex justify-content-between align-items-center">
        <span class="p-input-icon-left">
          <i class="pi pi-search"/>
          <InputText
              v-model="search"
              placeholder="Поиск"
              size="normal"
          />
        </span>
        <div class="d-flex">
            <div class="min-width-5">
                <Tag
                    class="min-width-5"
                    value="Мои"
                />
            </div>
            <InputSwitch
                class="ml-3 mr-3"
                :modelValue="displayTemplates"
                @update:modelValue="changeTemplates"
            />
            <div>
                <Tag
                    class="min-width-5"
                    value="Все промпты"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import Tag from 'primevue/tag';
import InputSwitch from 'primevue/inputswitch';
import InputText from "primevue/inputtext";
import {computed, ref} from "vue";
import {useStore} from "vuex";

const store = useStore()
const search = ref()
const displayTemplates = computed(() => store.state.prompts.options.showTemplates)
const changeTemplates = function (event) {
    store.state.prompts.options.showTemplates = event
    store.state.prompts.filter.showTemplates = event
    store.dispatch('prompts/updatePromptList').then(() => {
        store.dispatch('prompts/addCountForPlacements', store.state.prompts.promptsList)
    })
}
</script>

<style scoped>
.min-width-5 {
    min-width: 5rem;
}
</style>
