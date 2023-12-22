<template>
    <Preloader :isLoading="isLoading"/>
    Раздел находится в процессе разработки.
    <Banner
        :module-code="moduleCode"
        :domain="domain"
    />
</template>

<script setup>
import Preloader from "./UI/Preloader.vue";
import {Banner} from "skyweb24.vue-review"
import {useStore} from "vuex"
import {computed} from "vue"


const store = useStore()
const isLoading = computed(() => store.state.prompts.isLoading)
const moduleCode = computed(() => store.state.settings.moduleCode)
const domain = computed(() => store.state.settings.domain)
</script>

<style scoped>

</style>