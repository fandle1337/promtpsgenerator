<template>
    <router-view/>
    <!--        <Popup
                :module-code="appSettings.moduleCode"
                :domain="appSettings.domain"
                :user-id="+appSettings.userId"
            />-->
</template>

<script setup>
import {computed} from "vue";
import {useRoute} from "vue-router";
import {useStore} from "vuex";
// import {Popup} from "skyweb24.vue-review";

const route = useRoute()
const store = useStore()
const appSettings = computed(() => store.state.settings.appSettings)

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

<style scoped>

</style>