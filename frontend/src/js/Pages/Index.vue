<template>
    <component :is="layout">
        <router-view/>
    </component>
    <Popup
        :module-code="appSettings.moduleCode"
        :domain="appSettings.domain"
        :user-id="+appSettings.userId"
    />
    <Adv/>
</template>

<script setup>
import TabsMenu from "../Component/Form/TabsMenu.vue";
import {Adv} from "skyweb24.vue-adv"
import {computed} from "vue";
import {useStore} from "vuex";
import {Popup} from "skyweb24.vue-review";
import {useRoute} from "vue-router";

const route = useRoute()
const store = useStore()
const appSettings = computed(() => store.state.settings.appSettings)
const layout = computed(() => route.meta.layout)

store.state.prompts.isLoading = true

store.dispatch('prompts/updateFilter').then(() => {
    const payload = {
        showTemplates: store.state.prompts.filter.showTemplates,
        category: store.state.prompts.filter.placement
    }
    store.dispatch('prompts/updatePromptList', payload).then(() => {
        store.dispatch('prompts/addCountForPlacements', store.state.prompts.promptsList)
    })

    store.dispatch('prompts/addIconToPlacement')
})
</script>

<style>
.p-tooltip {
    min-width: 10px;
    max-width: 320px;
    width: auto;
}

.p-listbox-item {
    padding-bottom: 3px;
    padding-top: 3px;
}
.p-inputswitch {
    margin-left: unset !important;
}
.p-button.p-button-outlined {
    border-color: #d1d5db !important;
}
.p-confirm-popup {
    max-width: 300px;
}
.p-inplace-display {
    border: 1px dashed #d1d5db;
    cursor: pointer;
}
</style>