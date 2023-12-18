<template>
    <Preloader :isLoading="isLoading"/>
    <div class="container">
        <div class="mt-2">
            <h1>Создание нового промпта</h1>
        </div>
        <div class="row mt-4">
            <div class="col-6 d-flex flex-column">
                <label for="nameRu" class="mb-1">
                    <Tag
                        value="RU"
                    />
                    Название*
                    <i class="pi pi-question-circle ml-1"
                       v-tooltip.right="'Название на русском'"></i>
                </label>
                <InputText
                    id="nameRu"
                    type="text"
                    :modelValue="nameRu"
                    @update:modelValue="changeNameRu"
                    :class="{'p-invalid': !fieldValid.nameRu.value && formSubmitted}"
                />
            </div>
            <div class="col-6 d-flex flex-column">
                <label for="nameEng" class="mb-1">
                    <Tag
                        value="EN"
                    />
                    Название*
                    <i class="pi pi-question-circle ml-1"
                       v-tooltip.right="'Название на английском'"></i>
                </label>
                <InputText
                    id="nameEng"
                    type="text"
                    :modelValue="nameEng"
                    @update:modelValue="changeNameEng"
                    :class="{'p-invalid': !fieldValid.nameEng.value && formSubmitted}"
                />
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-8 d-flex flex-column">
                <label for="prompt" class="mb-1">
                    Промпт*
                    <i class="pi pi-question-circle ml-1"
                       v-tooltip.right="'Введите ваш промпт для AI'"></i>
                </label>
                <Textarea
                    class="w-100"
                    id="prompt"
                    rows="8"
                    :model-value="prompt"
                    @update:modelValue="changePrompt"
                    :class="{'p-invalid': !fieldValid.prompt.value && formSubmitted}"
                />
            </div>
            <div class="col-4 d-flex flex-column">
                <label for="markers" class="mb-1">
                    Маркеры
                    <i class="pi pi-question-circle ml-1"
                       v-tooltip.right="'Вы можете использовать это'"></i>
                </label>

                <ScrollPanel style="width: 100%; height: 186px">
                    <div v-for="marker in markerList">
                        <Button
                            class="mb-1"
                            size="small"
                            :label="marker.code"
                            @click="chooseMarker"
                            v-tooltip.right="marker.name"
                        />
                    </div>
                </ScrollPanel>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6 d-flex flex-column">
                <label for="categories" class="mb-1">
                    Инструменты Б24*
                    <i class="pi pi-question-circle ml-1"
                       v-tooltip.right="'Выберите инструменты Б24, где будет использоваться этот промпт.'"></i>
                </label>
                <MultiSelect
                    :model-value="categories"
                    :class="{'w-100': true, 'p-invalid': !fieldValid.categories.value && formSubmitted}"
                    id="categories"
                    display="chip"
                    optionLabel="name"
                    :options="categoryList"
                    placeholder="Выберите инструменты Б24"
                    @update:modelValue="changeSelectedCategories"

                />
            </div>
            <div class="col-6 d-flex flex-column">
                <label for="icon" class="mb-1">
                    Код иконки*
                    <i class="pi pi-question-circle ml-2"
                       v-tooltip.right="'Введите код иконки, который можно узнать в pdf-файле.'"></i>
                </label>
                <div class="d-flex">
                    <InputText
                        id="icon"
                        type="text"
                        :modelValue="icon"
                        @update:modelValue="changeIcon"
                        :class="{'p-invalid': !fieldValid.icon.value && formSubmitted, 'w-100': true}"
                    />
                    <a class="mt-2" href="https://dev.1c-bitrix.ru/upload/api_help/rest/copilot_icon_set.pdf"
                       target="_blank">
                        <i class="pi pi-download ml-2" style="font-size: 1.5rem"
                           v-tooltip="'Ссылка на pdf-файл'"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6 d-flex flex-column">
                <label for="parentCode" class="mb-1">
                    Параметр parent_code
                    <i class="pi pi-question-circle ml-2"
                       v-tooltip="'Введите код родительской секции, к которой вы ходите привязать данный промпт. Необязательный параметр.'"></i>
                </label>
                <InputText
                    class="w-100"
                    id="parentCode"
                    type="text"
                    :modelValue="parentCode"
                    @update:modelValue="changeParentCode"
                />
            </div>
            <div class="col-6 d-flex flex-column">
                <label for="sorting" class="mb-1">
                    Параметр sort
                    <i class="pi pi-question-circle ml-2"
                       v-tooltip="'Введите число для сортировки пунктов между собой. Необязательный параметр.'"></i>
                </label>
                <InputNumber
                    class="w-100"
                    id="sorting"
                    :modelValue="sorting"
                    @update:modelValue="changeSorting"
                />
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6 d-flex flex-row-reverse">
                <Button
                    label="Сохранить"
                    @click="submit"
                />
            </div>
            <div class="col-6">
                <Toast/>
                <ConfirmPopup/>
                <Button
                    severity="danger"
                    class="mr-4"
                    label="Отменить"
                    @click="confirmCancel($event)"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import MultiSelect from "primevue/multiselect"
import ScrollPanel from "primevue/scrollpanel";
import Tag from 'primevue/tag'
import Toast from 'primevue/toast'
import Dropdown from "primevue/dropdown"
import Button from 'primevue/button'
import InputNumber from 'primevue/inputnumber'
import Checkbox from 'primevue/checkbox'
import Textarea from 'primevue/textarea'
import InputText from "primevue/inputtext"
import ConfirmPopup from "primevue/confirmpopup";
import {computed, ref} from "vue"
import OptionList from "../class/OptionList"
import {useRouter} from "vue-router"
import {useStore} from "vuex"
import {useToast} from "primevue/usetoast"
import Preloader from "./UI/Preloader.vue";
import {useConfirm} from "primevue/useconfirm";

const store = useStore()
const router = useRouter()
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

const prompt = ref(receivedPrompt.prompt ?? '')
const changePrompt = function (event) {
    prompt.value = event
}

const formatForCategories = function (categories) {
    if (categories) {
        const categoryOptionList = OptionList.getCategoryList()
        return categoryOptionList.filter(category => categories.includes(category.code))
    }
}

const categories = ref(formatForCategories(receivedPrompt.categories))
const categoryList = computed(() => {
    return OptionList.getCategoryList()
})
const changeSelectedCategories = function (event) {
    categories.value = event
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
    if (event.currentTarget.innerText === 'role') {
        prompt.value += '{' + event.currentTarget.innerText + '}' + '{/' + event.currentTarget.innerText + '}'
        return
    }
    prompt.value += '{' + event.currentTarget.innerText + '}'
}

const fieldValid = {
    nameRu: ref(false),
    nameEng: ref(false),
    prompt: ref(false),
    categories: ref(false),
    icon: ref(false)
}

const validateInput = (value, refName) => {
    if (refName === 'categories') {
        if (value === undefined) {
            return false
        }
        if (value.length > 0) {
            fieldValid[refName].value = true
            return true
        }
        fieldValid[refName].value = false
        return false
    }
    if (!!value) {
        fieldValid[refName].value = true
        return true
    }
    fieldValid[refName].value = false
    return false
}

const formSubmitted = ref(false)
const formatCategories = function (categories) {
    const result = []
    categories.forEach(category => {
        result.push(category.code)
    })
    return result
}

const submit = async function () {
    formSubmitted.value = true

    const isNameRuValid = validateInput(nameRu.value, 'nameRu')
    const isNameEngValid = validateInput(nameEng.value, 'nameEng')
    const isPromptValid = validateInput(prompt.value, 'prompt')
    const isCategoriesValid = validateInput(categories.value, 'categories')
    const isIconValid = validateInput(icon.value, 'icon')

    if (
        isNameRuValid &&
        isNameEngValid &&
        isPromptValid &&
        isCategoriesValid &&
        isIconValid
    ) {
        store.state.prompts.isLoading = true

        return new Promise((resolve, reject) => {
            store.dispatch('prompts/addPrompt', {
                categories: formatCategories(categories.value),
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
.p-tooltip {
    width: 1000px;
}
</style>