<template>
    <div class="" v-for="prompt in promptList">
        <div class="border mt-3">
            <Card>
                <template #title>
                    {{ prompt.translate.ru }}
                    <div class="d-inline-block" v-for="iconCategory in prompt.iconCategoryList">
                        <div :class="['bg-' + iconCategory.color, 'rounded-full', 'mr-2']">
                            <i :class="[iconCategory.icon]" style="font-size: 1rem; color: white;"></i>
                        </div>
                    </div>
                </template>
                <template #content>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-10 col-lg-9 col-md-8">
                                <p class="m-0">
                                    {{ prompt.prompt }}
                                </p>
                            </div>
                            <div class="flex col-xl-2 col-lg-3 col-md-4 d-flex flex-column align-items-center">
                                <Button
                                    v-if="prompt.isTemplate"
                                    class="mb-2 min-width"
                                    label="Установить"
                                    size="small"
                                />
                                <Button
                                    v-else
                                    class="mb-2 min-width"
                                    label="Удалить"
                                    size="small"
                                    severity="danger"
                                />
                                <Button
                                    class="mb-2 min-width"
                                    label="Создать на основе"
                                    size="small"
                                />
                            </div>
                        </div>
                    </div>
                </template>
            </Card>
        </div>
    </div>
</template>

<script setup>
import Button from "primevue/button";
import Card from "primevue/card";
import Badge from 'primevue/badge';
import {useStore} from "vuex";
import {computed} from "vue";

const store = useStore()

const promptList = computed(() => store.state.prompts.promptsList)

</script>

<style scoped>
.border {
    border: 1px solid #d1d5db;
    border-radius: 6px;
    min-width: 36rem;
}

.min-width {
    width: 7rem;
}

.rounded-full {
    border-radius: 25px;
    padding: 3px 12px 5px !important;
}

</style>