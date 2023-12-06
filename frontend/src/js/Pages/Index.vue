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
</script>

<style scoped>

</style>