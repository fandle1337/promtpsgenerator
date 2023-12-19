<template>
    Раздел находится в процессе разработки.
    <Banner
        :module-code="appSettings.moduleCode"
        :domain="appSettings.domain"
    />
</template>

<script setup>
import {Banner} from "skyweb24.vue-review"
import {useStore} from "vuex"
import {computed} from "vue"


const store = useStore()
const appSettings = computed(() => store.state.settings.appSettings)
</script>

<style scoped>

</style>