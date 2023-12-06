<template>
    <div class="mt-2">
        <h1>Создание нового промпта</h1>
    </div>
    <div class="row mt-4">
        <div class="col-3">
            Название
            <i class="pi pi-question-circle ml-2"
               v-tooltip="'Введите названия вашего нового промпта на русском и английском языках.'"></i>
        </div>
        <div class="col-4">
            <span class="d-flex flex-column">
                <InputText
                    aria-describedby="nameRu"
                    type="text"
                    :modelValue="nameRu"
                    @update:modelValue="changeNameRu"
                />
                <small id="nameRu">На русском языке</small>
            </span>
        </div>
        <div class="col-4">
            <span class="d-flex flex-column">
                <InputText
                    aria-describedby="nameEng"
                    type="text"
                    :modelValue="nameEng"
                    @update:modelValue="changeNameEng"
                />
                <small id="nameEng">На английском языке</small>
            </span>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
            Промпт
            <i class="pi pi-question-circle ml-2"
               v-tooltip="'Введите ваш запрос для AI, можете воспользоваться подготовленными для вас свойствами.'"></i>
        </div>
        <div class="col-6">
            <Textarea
                autoResize
                rows="8"
                cols="39"
                :model-value="prompt"
                @update:modelValue="changePrompt"
            />
        </div>
        <div class="col-2">
            подсказки по свойствам
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
            Инструмент Б24
            <i class="pi pi-question-circle ml-2"
               v-tooltip="'Выберите, в каких инструментах Б24 будет встроен ваш промпт.'"></i>
        </div>
        <div class="col-5">
            <div v-for="category of categories" :key="category.code" class="mt-1">
                <Checkbox
                    class="mr-1"
                    :model-value="selectedCategories"
                    :input-id="category.code"
                    name="category"
                    :value="category.code"
                    @update:modelValue="changeSelectedCategories"
                />
                <label class="mr-5" :for="category.code">{{ category.name }}</label>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
            Параметр code
            <i class="pi pi-question-circle ml-2"
               v-tooltip="'Введите код вашего промпта, например rest_joke или rest_approve.'"></i>
        </div>
        <div class="col-4">
            <span class="d-flex flex-column">
                <InputText
                    aria-describedby="code"
                    type="text"
                    :modelValue="code"
                    @update:modelValue="changeCode"
                />
                <small id="code">На английском языке</small>
            </span>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
            Параметр parent_code
            <i class="pi pi-question-circle ml-2"
               v-tooltip="'Введите код родительской секции, к которой вы ходите привязать данный промпт. Необязательный параметр.'"></i>
        </div>
        <div class="col-4">
            <span class="d-flex flex-column">
                <InputText
                    aria-describedby="parentCode"
                    type="text"
                    :modelValue="parentCode"
                    @update:modelValue="changeParentCode"
                />
                <small id="parentCode">На английском языке</small>
            </span>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
            Параметр sort
            <i class="pi pi-question-circle ml-2"
               v-tooltip="'Введите число для сортировки пунктов между собой. Необязательный параметр.'"></i>
        </div>
        <div class="col-4">
            <span class="d-flex flex-column">
                <InputText
                    aria-describedby="sorting"
                    type="text"
                    :modelValue="sorting"
                    @update:modelValue="changeSorting"
                />
                <small id="sorting">Число</small>
            </span>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
            Код иконки
            <i class="pi pi-question-circle ml-2"
               v-tooltip="'Введите код иконки, который можно узнать в pdf-файле.'"></i>
        </div>
        <div class="col-4">
            <span class="d-flex flex-column">
                <InputText
                    aria-describedby="icon"
                    type="text"
                    :modelValue="icon"
                    @update:modelValue="changeIcon"
                />
                <small id="icon">Код иконки</small>
            </span>
        </div>
        <div class="col-4">
            pdf-файл с иконками
        </div>
    </div>
    <div class="row mt-2 col-12">
        <Button
            class="mr-4"
            label="Сохранить"
        />
        <Button
            severity="danger"
            class="mr-4"
            label="Отменить"
        />
    </div>
</template>

<script setup>
import Button from 'primevue/button';
import Checkbox from 'primevue/checkbox';
import Card from "primevue/card";
import Textarea from 'primevue/textarea';
import InputText from "primevue/inputtext";
import {ref, computed} from "vue";

const nameRu = ref('')
const changeNameRu = function (event) {
    nameRu.value = event
}
const nameEng = ref('')
const changeNameEng = function (event) {
    nameEng.value = event
}

const prompt = ref('')
const changePrompt = function (event) {
    prompt.value = event
}

const selectedCategories = ref([])
const categories = computed(() => {
    return [
        {name: 'Пост ленты новостей', code: 'livefeed'},
        {name: 'Комментарий ленты новостей', code: 'livefeed_comments'},
        {name: 'Текст задачи', code: 'tasks'},
        {name: 'Комментарии задачи', code: 'tasks_comments'},
        {name: 'Чат', code: 'chat'},
        {name: 'Почта', code: 'mail'},
        {name: 'Почта CRM', code: 'mail_crm'},
        {name: 'Сайты', code: 'landing'}
    ]
})
const changeSelectedCategories = function (event) {
    selectedCategories.value = event
}

const code = ref('rest_')
const changeCode = function (event) {
    code.value = event
}

const parentCode = ref('')
const changeParentCode = function (event) {
    parentCode.value = event
}

const sorting = ref('')
const changeSorting = function (event) {
    sorting.value = event
}

const icon = ref('')
const changeIcon = function (event) {
    icon.value = event
}


</script>

<style scoped>

</style>