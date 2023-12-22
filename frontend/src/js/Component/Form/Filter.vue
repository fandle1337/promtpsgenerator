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
                    <div class="name">
                        {{ slotProps.option.name }}
                    </div>
                </div>
                <div class="ml-2">
                    <b>{{ slotProps.option.count }}</b>
                </div>
            </div>
        </template>
        <template #footer>
            <div class="mb-3 d-flex justify-content-center">
                <Button
                    outlined
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
import OptionList from "../../class/OptionList";
import expand from "../../class/expandedCateogryIcon";

const store = useStore()

const expandPlacements = function (placements) {
    return placements.map(placement => {
        return {
            ...placement,
            ...expand(placement.code),
        }
    })
}

const placements = computed(() => {
    return expandPlacements(store.state.prompts.options.placements)
})

const selectedPlacement = computed(() => {
    return placements.value.find(p => p.code === store.state.prompts.filter.placement)
})

const choosePlacements = function (event) {
    store.state.prompts.filter.placement = event.code
    store.state.prompts.isLoading = true
    store.dispatch('prompts/updatePromptList').then(() => {
        store.dispatch('prompts/addCountForPlacements', store.state.prompts.promptsList) //TODO возможно убрать
    }).then(() => {
        store.state.prompts.isLoading = false
    })
}
const clearFilter = function () {
    store.state.prompts.filter.placement = null
    store.state.prompts.isLoading = true
    store.dispatch('prompts/updatePromptList').then(() => {
        store.dispatch('prompts/addCountForPlacements', store.state.prompts.promptsList) //TODO возможно убрать
    }).then(() => {
        store.state.prompts.isLoading = false
    })
}
</script>

<style scoped>
.d-flex.justify-content-center b {
    text-align: center;
    font-size: 20px;
}

.rounded-full {
    border-radius: 25px;
    padding: 10px 12px 9px;
}

.name {
    font-size: 15px;
}

.p-listbox.p-focus {
    outline: none;
    border-color: #d1d5db;
    box-shadow: none;
}
</style>