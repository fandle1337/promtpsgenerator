<template>
    <Preloader :isLoading="isLoading"/>
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
                    :class="{'p-invalid': !errors.nameRu.value && formSubmitted}"
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
                    :class="{'p-invalid': !errors.nameEng.value && formSubmitted}"
                />
                <small id="nameEng">На английском языке</small>
            </span>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3 col-lg-3">
            Промпт
            <i class="pi pi-question-circle ml-2"
               v-tooltip="'Введите ваш запрос для AI, можете воспользоваться подготовленными для вас маркерами.'"></i>
        </div>
        <div class="col-4 col-lg-5">
            <Textarea
                autoResize
                rows="8"
                cols="40"
                :model-value="prompt"
                @update:modelValue="changePrompt"
                :class="{'p-invalid': !errors.prompt.value && formSubmitted}"
            />
        </div>
        <div class="col-3 col-lg-4">
            <Dropdown
                placeholder="Выберете маркер"
                :options="markerList"
                option-label="name"
                @update:modelValue="chooseMarker"
            />
            <i class="pi pi-question-circle ml-2"
               v-tooltip="'Пояснение как работает'"></i>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3">
            Инструмент Б24
            <i class="pi pi-question-circle ml-2"
               v-tooltip="'Выберите, в каких инструментах Б24 будет встроен ваш промпт.'"></i>
        </div>
        <div class="col-5">
            <div v-for="category of categoryList" :key="category.code" class="mt-1">
                <Checkbox
                    class="mr-1"
                    :model-value="categories"
                    :input-id="category.code"
                    name="category"
                    :value="category.code"
                    @update:modelValue="changeSelectedCategories"
                    :class="{'p-invalid': !errors.categories.value && formSubmitted}"
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
                    :class="{'p-invalid': !errors.code.value && formSubmitted}"
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
                <InputNumber
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
                    :class="{'p-invalid': !errors.icon.value && formSubmitted}"
                />
                <small id="icon">Код иконки</small>
            </span>
        </div>
        <div class="col-4 mt-2">
            <a href="https://dev.1c-bitrix.ru/upload/api_help/rest/copilot_icon_set.pdf" target="_blank">
                <i class="pi pi-download ml-2" style="font-size: 1.5rem"
                   v-tooltip="'Ссылка на pdf-файл'"></i>
            </a>
        </div>
    </div>
    <div class="row mt-2 col-12">
        <Button
            class="mr-4"
            label="Сохранить"
            @click="submit"
        />
        <Toast/>
        <ConfirmPopup/>
        <Button
            severity="danger"
            class="mr-4"
            label="Отменить"
            @click="confirmCancel($event)"
        />
    </div>
</template>

<script setup>
import Toast from 'primevue/toast'
import Dropdown from "primevue/dropdown"
import Button from 'primevue/button'
import InputNumber from 'primevue/inputnumber'
import Checkbox from 'primevue/checkbox'
import Textarea from 'primevue/textarea'
import InputText from "primevue/inputtext"
import {computed, ref} from "vue"
import OptionList from "../class/OptionList"
import {useRoute, useRouter} from "vue-router"
import {useStore} from "vuex"
import {useToast} from "primevue/usetoast"
import Preloader from "./UI/Preloader.vue";
import ConfirmPopup from "primevue/confirmpopup";
import {useConfirm} from "primevue/useconfirm";

const store = useStore()
const router = useRouter()
const route = useRoute()
const toast = useToast()
const confirm = useConfirm()

const receivedPrompt = router.currentRoute.value.query

const isLoading = computed(() => store.state.prompts.isLoading)

const nameRu = ref(receivedPrompt.ruName)
const changeNameRu = function (event) {
    nameRu.value = event
}
const nameEng = ref(receivedPrompt.enName)
const changeNameEng = function (event) {
    nameEng.value = event
}

const prompt = ref(receivedPrompt.prompt)
const changePrompt = function (event) {
    prompt.value = event
}

const formatForCategories = function (categories) {
    if (typeof categories === "string") {
        return [categories]
    }
    return categories
}

const categories = ref(formatForCategories(receivedPrompt.categories))
const categoryList = computed(() => {
    return OptionList.getCategoryList()
})
const changeSelectedCategories = function (event) {
    categories.value = event
}

const code = ref(receivedPrompt.code ?? 'rest_')
const changeCode = function (event) {
    code.value = event
}

const parentCode = ref(receivedPrompt.parentCode)
const changeParentCode = function (event) {
    parentCode.value = event
}

const sorting = ref(receivedPrompt.sort)
const changeSorting = function (event) {
    sorting.value = event
}

const icon = ref(receivedPrompt.icon)
const changeIcon = function (event) {
    icon.value = event
}

const markerList = computed(() => {
    return OptionList.getMarkerList()
})
const chooseMarker = function (event) {
    if (event.code === 'role') {
        prompt.value += '{' + event.code + '}' + '{/' + event.code + '}'
        return
    }
    prompt.value += '{' + event.code + '}'
}

const errors = {
    nameRu: ref(false),
    nameEng: ref(false),
    prompt: ref(false),
    categories: ref(false),
    code: ref(false),
    icon: ref(false)
}

const validateInput = (value, refName) => {
    if (refName === 'code') {
        return value !== 'rest_'
    }
    if (refName === 'categories') {
        return value.length > 0
    }
    if (!!value) {
        errors[refName].value = true
        return true
    }
    return false
}

const formSubmitted = ref(false)

const submit = async function () {
    formSubmitted.value = true

    const isNameRuValid = validateInput(nameRu.value, 'nameRu')
    const isNameEngValid = validateInput(nameEng.value, 'nameEng')
    const isPromptValid = validateInput(prompt.value, 'prompt')
    let isCategoriesValid = validateInput(categories.value, 'categories')
    const isCodeValid = validateInput(code.value, 'code')
    const isIconValid = validateInput(icon.value, 'icon')

    if (
        isNameRuValid &&
        isNameEngValid &&
        isPromptValid &&
        isCategoriesValid &&
        isCodeValid &&
        isIconValid
    ) {
        store.state.prompts.isLoading = true

        return new Promise((resolve, reject) => {
            store.dispatch('prompts/addPrompt', {
                categories: categories.value,
                code: code.value,
                icon: icon.value,
                prompt: prompt.value,
                ru_name: nameRu.value,
                en_name: nameEng.value,
                parent_code: parentCode.value,
                sort: sorting.value,
            }).then(() => {
                router.push('/b24/').then(() => {
                    toast.add({
                        severity: 'success',
                        summary: 'Ваш промпт добавлен!',
                        detail: 'Можете проверить его на своем портале.',
                        life: 3000,
                        closable: false,
                    })
                    store.dispatch('prompts/updatePromptList').then(() => {
                        store.dispatch('prompts/addCountForPlacements', store.state.prompts.promptsList)
                    })
                    resolve()
                })
            }).catch((error) => {
                toast.add({
                    severity: 'error',
                    summary: 'Ошибка!',
                    detail: error.message,
                    life: 3000,
                    closable: false,
                })
                errors.code.value = false
                reject(error)
            })
                .finally(() => {
                    store.state.prompts.isLoading = false
                })
        })
    } else {
        toast.add({
            severity: 'error',
            summary: 'Ошибка!',
            detail: 'Заполните обязательные поля.',
            life: 3000,
            closable: false,
        })

        // return Promise.reject(new Error('Ошибка валидации'))
    }
}

const confirmCancel = function (event) {
    confirm.require({
        target: event.currentTarget,
        message: 'Вы уверены, что хотите отменить? Введенные данные не сохранятся.',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.push('/b24/')
        },
        reject: () => {
        },
        acceptLabel: 'Да',
        rejectLabel: 'Нет',
        acceptClass: 'p-button-success p-button-sm',
        rejectClass: 'p-button-danger p-button-sm',
    })
}
</script>

<style scoped>

</style>