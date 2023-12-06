<template>
    <Listbox
        :modelValue="selectedPlacement"
        :options="placements"
        optionLabel="name"
        @update:model-value="choosePlacements">
        <template #header>
            <div class="d-flex justify-content-center mt-2">
                <b>
                    Инструменты B24
                </b>
            </div>
        </template>
        <template #option="slotProps">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div :class="['bg-' + slotProps.option.color, 'rounded-full', 'mr-2']">
                        <i :class="[slotProps.option.icon]" style="font-size: 1rem; color: white;"></i>
                    </div>
                    {{ slotProps.option.name }}
                </div>
                <div><b>{{ slotProps.option.count }}</b></div>
            </div>
        </template>
        <template #footer>
            <div class="mb-3 d-flex justify-content-center">
                <Button
                    label="Показать все"
                    @click="clearFilter"
                />
            </div>
        </template>
    </Listbox>
</template>

<script setup>
import Button from "primevue/button";
import Card from "primevue/card";
import Checkbox from "primevue/checkbox";
import Listbox from "primevue/listbox";
import {computed, ref} from "vue";
import {useStore} from "vuex";

const store = useStore()
const placements = computed(() => {
    return store.state.prompts.options.placements
})

const selectedPlacement = computed(() => {
    return placements.value.find(p => p.code === store.state.prompts.filter.placement)
})

const choosePlacements = function (event) {
    store.state.prompts.filter.placement = event.code
}
const clearFilter = function () {
    store.state.prompts.filter.placement = null
}
</script>

<style scoped>
.d-flex.justify-content-center b {
    text-align: center;
    font-size: 25px;
}
.rounded-full {
    border-radius: 25px;
    padding: 10px 12px 9px;
}
</style>