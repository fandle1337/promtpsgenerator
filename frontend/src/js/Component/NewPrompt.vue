<template>
    <Preloader :isLoading="isLoading"/>
    <div class="container">
        <div class="d-flex">
            <h2 class="mr-auto">Создание нового промпта</h2>
            <a class="d-flex align-content-center justify-content-center align-items-center"
               target="_blank"
               href="https://skyweb24.ru/documentation/copilotprompts/chapter0689/">Документация</a>
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
                    rows="7"
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
                <ScrollPanel style="width: 100%; height: 166px">
                    <div v-for="marker in markerList">
                        <Button
                            :severity="marker.btn"
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
                    :maxSelectedLabels="3"
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
                        :class="{'p-invalid': !fieldValid.icon.value && formSubmitted, 'w-50': true}"
                    />
                    <a class="mt-2 mr-5" href="https://dev.1c-bitrix.ru/upload/api_help/rest/copilot_icon_set.pdf"
                       target="_blank">
                        <i class="pi pi-download ml-2" style="font-size: 1.5rem"
                           v-tooltip="'Ссылка на pdf-файл'"></i>
                    </a>
<!--                    <div v-if="icon">
                        <img :src="'https://skyweb24.ru/bitrix/js/ui/icon-set/main/images/' + icon +'.svg'"
                             alt=""
                             style="width: 50px; height: 50px;">
                    </div>-->
                </div>
            </div>
        </div>
        <Inplace class="mt-4">
            <template #display>
                Посмотреть необязательные параметры
            </template>
            <template #content>
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
                        <label for="section" class="mb-1">
                            Параметр section
                            <i class="pi pi-question-circle ml-2"
                               v-tooltip="'Выберите секцию, в которой хотите разместить ваш промпт. Необязательный параметр.'"></i>
                        </label>
                        <Dropdown
                            class="w-100"
                            id="section"
                            :options="sectionList"
                            option-label="name"
                            :model-value="section"
                            @update:modelValue="changeSection"
                        />
                    </div>
                </div>
                <div class="row mt-4">
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
            </template>
        </Inplace>
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
                    severity="secondary"
                    class="mr-4"
                    label="Отменить"
                    @click="confirmCancel($event)"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import Inplace from "primevue/inplace"
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

const sectionList = computed(() => OptionList.getSectionList())
const getSectionByCode = function (code) {
    return sectionList.value.find(section => section.code === code)
}
const section = ref(getSectionByCode(receivedPrompt.section))
const changeSection = function (event) {
    section.value = event
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

    const nameRuIsValid = validateInput(nameRu.value, 'nameRu')
    const nameEngIsValid = validateInput(nameEng.value, 'nameEng')
    const promptIsValid = validateInput(prompt.value, 'prompt')
    const categoriesIsValid = validateInput(categories.value, 'categories')
    const iconIsValid = validateInput(icon.value, 'icon')

    const formIsValid = function () {
        return (
            nameRuIsValid &&
            nameEngIsValid &&
            promptIsValid &&
            categoriesIsValid &&
            iconIsValid
        )
    }

    if (!formIsValid()) {
        toast.add({
            severity: 'error',
            summary: 'Ошибка!',
            detail: 'Заполните обязательные поля.',
            life: 3000,
            closable: false,
        })
        return
    }

    if (formIsValid()) {
        store.state.prompts.isLoading = true

        return store.dispatch('prompts/addPrompt', {
            categories: formatCategories(categories.value),
            icon: icon.value,
            prompt: prompt.value,
            ru_name: nameRu.value,
            en_name: nameEng.value,
            parent_code: parentCode.value,
            sort: sorting.value,
            section: section.value?.code
        }).then(() => {
            router.push({name: 'main'}).then(() => {
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
            })
        }).catch((error) => {
            toast.add({
                severity: 'error',
                summary: 'Ошибка!',
                detail: error.message,
                life: 3000,
                closable: false,
            })
        }).finally(() => {
            store.state.prompts.isLoading = false
        })
    }
}

const confirmCancel = function (event) {
    confirm.require({
        target: event.currentTarget,
        message: 'Вы уверены, что хотите отменить? Введенные данные не сохранятся.',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
            router.push({name: 'main'})
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