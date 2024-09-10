<template>
    <AuthenticatedLayout title="Boutique Informations" :sous_title="BoutiqueInfo?.id ? 'Edit Boutique Informations' : 'Create Boutique Informations'" selected-menu="boutiqueInfo">
        <a-form
            :model="formPage"
            :rules="rules"
            layout="vertical"
            autocomplete="off"
            @finish="onFinish"
            @validate="handleValidate"
            @finishFailed="onFinishFailed"
        >
            <a-row :gutter="[24, 24]" justify="center" class="xl:!mx-0 !mx-2">
                <a-col :span="24">
                    <a-space direction="vertical" :size="[16, 8]"
                             class="flex flex-row flex-wrap overflow-y-hidden justify-between items-center bg-white border-l-4 border-primary shadow-sm px-4 py-4 rounded-sm">
            <span class="text-primary">
              <font-awesome-icon icon="fa-solid fa-plus" class="!me-0 pr-2 !size-4"/> You are editing "English"
            </span>
                    </a-space>
                </a-col>

                <a-col :span="24" :xl="19">
                    <div class="p-4 sm:p-8 mb-6 bg-white shadow-sm sm:rounded-b-md sm:rounded-t-none">
                        <a-row>
                            <a-col :span="24">
                                <div class="mb-4">
                                    <a-typography-text class="uppercase text-base font-medium">Identite</a-typography-text>
                                </div>
                                <a-form-item label="Nom du société" required name="name" :rules="rules.name">
                                    <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                        <template #prefix>
                                            <font-awesome-icon icon="fa-solid fa-pager"
                                                               style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                        </template>
                                    </a-input>
                                </a-form-item>

                                <a-form-item label="Nom du société" required name="name" :rules="rules.name">
                                    <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                        <template #prefix>
                                            <font-awesome-icon icon="fa-solid fa-pager"
                                                               style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                        </template>
                                    </a-input>
                                </a-form-item>

                                <a-form-item label="Numéro d'Identification Fiscal (NIF)" required name="name" :rules="rules.name">
                                    <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                        <template #prefix>
                                            <font-awesome-icon icon="fa-solid fa-pager"
                                                               style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                        </template>
                                    </a-input>
                                </a-form-item>

                                <a-form-item label="Téléphone" required name="name" :rules="rules.name">
                                    <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                        <template #prefix>
                                            <font-awesome-icon icon="fa-solid fa-pager"
                                                               style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                        </template>
                                    </a-input>
                                </a-form-item>

                                <a-form-item label="Adresse" required name="adresse" :rules="rules.name">
                                    <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                        <template #prefix>
                                            <font-awesome-icon icon="fa-solid fa-pager"
                                                               style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                        </template>
                                    </a-input>
                                </a-form-item>

                                <div class="mb-4">
                                    <a-typography-text class="uppercase text-base font-medium">Condition générales</a-typography-text>
                                </div>
                                <a-form-item label="Nom du société" required name="name" :rules="rules.name">
                                    <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                        <template #prefix>
                                            <font-awesome-icon icon="fa-solid fa-pager"
                                                               style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                        </template>
                                    </a-input>
                                </a-form-item>
                                <a-form-item label="Nom du société" required name="name" :rules="rules.name">
                                    <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                        <template #prefix>
                                            <font-awesome-icon icon="fa-solid fa-pager"
                                                               style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                        </template>
                                    </a-input>
                                </a-form-item>
                                <a-form-item label="Nom du société" required name="name" :rules="rules.name">
                                    <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                        <template #prefix>
                                            <font-awesome-icon icon="fa-solid fa-pager"
                                                               style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                        </template>
                                    </a-input>
                                </a-form-item>
                            </a-col>
                        </a-row>
                    </div>
                </a-col>

                <a-col :span="24" :xl="5">
                    <a-row :gutter="[24, 24]">
                        <a-col :span="24" class="max-lg:order-last xl:order-first">
                            <div class="px-4 pt-3 bg-white shadow-sm sm:rounded-md">
                                <a-typography-title :level="5">Publish</a-typography-title>
                                <a-divider class="!my-4"/>
                                <a-flex gap="small" class="flex flex-wrap">
                                    <a-form-item>
                                        <a-button @click="e => onSubmit(e, false, 'save')" type="primary"
                                                  :loading="onLoadingSave"
                                                  class="flex items-center justify-center !text-sm">
                                            <font-awesome-icon icon="fa-solid fa-save" class="me-3"/>
                                            Save
                                        </a-button>
                                    </a-form-item>
                                    <a-form-item>
                                        <a-button @click="e => onSubmit(e, true, 'saveAndExit')" type="default"
                                                  :loading="onLoadingSaveAndExit"
                                                  class="flex items-center justify-center !text-sm">
                                            <font-awesome-icon icon="fa-solid fa-save" class="me-3"/>
                                            Save & Exit
                                        </a-button>
                                    </a-form-item>
                                </a-flex>
                            </div>
                        </a-col>

                        <a-col :span="24">
                            <div class="px-4 py-3 bg-white shadow-sm sm:rounded-md">
                                <a-form-item name="status" label="Status" :rules="rules.status" class="font-medium">
                                    <a-divider class="!mt-2"/>
                                    <a-select v-model:value="formPage.status" placeholder="Please select your status">
                                        <a-select-option value="published">Published</a-select-option>
                                        <a-select-option value="draft">Draft</a-select-option>
                                        <a-select-option value="pending">Pending</a-select-option>
                                    </a-select>
                                </a-form-item>
                            </div>
                        </a-col>

                        <a-col :span="24">
                            <div class="px-4 py-3 bg-white shadow-sm sm:rounded-md">
                                <a-form-item name="template" label="Template" :rules="rules.template"
                                             class="font-medium">
                                    <a-divider class="!mt-2"/>
                                    <a-select v-model:value="formPage.template"
                                              placeholder="Please select your template">
                                        <a-select-option value="default">Default</a-select-option>
                                    </a-select>
                                </a-form-item>
                            </div>
                        </a-col>
                    </a-row>
                </a-col>
            </a-row>
        </a-form>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {h, ref, watch } from 'vue';
import {router, useForm} from '@inertiajs/vue3';
import {notification} from "ant-design-vue";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import { defineProps, defineEmits } from 'vue'
import {route} from "ziggy-js";
import * as BoutiqueInfo from "date-fns/locale";

const activeKey = ref('1');
const props = defineProps({
    pages: {
        type: Object,
        default: () => ({})
    },
    recherche: {
        type: String,
        default: ''
    },
});

let formPage = useForm({
    id: props.pages?.id,
    name: props.pages?.name,
    content: props.pages?.content || '',
    description: props.pages?.description,
    status: props.pages?.status || 'published',
    template: props.pages?.template || 'default',
});

const onLoadingSave = ref(false);
const onLoadingSaveAndExit = ref(false);

const openNotification = placement => {
    notification.open({
        message: `Notification ${placement}`,
        description: `Page has been ${props.pages?.id ? 'updated' : 'created'} successfully.`,
        placement,
        icon: h(FontAwesomeIcon, {icon: ["fas", "circle-check"], style: {color: '#ffffff'}}),
    });
};

const retourPage = () => {
    router.get(route('page.index'));
};

const onSubmit = (e, redirect = false, action = '') => {
    formPage.clearErrors();

    if (action === 'save') {
        onLoadingSave.value = true;
    } else if (action === 'saveAndExit') {
        onLoadingSaveAndExit.value = true;
    }

    const options = {
        preserveScroll: true,
        onSuccess: () => {
            openNotification('bottomRight');
            if (redirect) {
                retourPage();
            }
            onLoadingSave.value = false;
            onLoadingSaveAndExit.value = false;
        },
        onError: () => {
            onLoadingSave.value = false;
            onLoadingSaveAndExit.value = false;
        }
    };

    if (props.pages?.id) {
        formPage.put(route('page.update', {page: props.pages.id}), options);
    } else {
        formPage.post(route('page.store'), options);
    }
};

const onFinish = () => {
    onSubmit(null, false, 'save');
};

const handleValidate = () => {
    console.log('Validation successful');
};

const onFinishFailed = (errorInfo) => {
    console.error('Failed:', errorInfo);
};

const rules = {
    name: [
        {required: true, message: 'Please input the page name!', trigger: 'change'},
        {min: 4, max: 120, message: 'Name should be between 4 to 120 characters', trigger: 'blur'},
    ],
    permalink: [
        {required: true, message: 'Please input the permalink!', trigger: 'change'},
    ],
    status: [
        {required: true, message: 'Please select the status!', trigger: 'change'},
    ],
    template: [
        {required: true, message: 'Please select the template!', trigger: 'change'},
    ],
};

</script>

<style>
/* Add your custom styles here */
.ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item::before {
    position: absolute;
    z-index: 1;
    width: 8rem;
    height: 8rem;
    background-color: rgba(0, 0, 0, 0.45);
    opacity: 0;
    transition: all 0.3s;
    content: " ";
}
.ant-upload-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item {
    position: relative;
    height:  8rem;
    padding: 0;
    border: 1px solid #d9d9d9;
    border-radius: 8px;
}
.ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload.ant-upload-select {
    width: 8rem;
    height: 8rem;
}
.ant-upload-wrapper.ant-upload-picture-card-wrapper .ant-upload-list.ant-upload-list-picture-card .ant-upload-list-item-container {
    display: inline-block;
    width: 8rem;
    height: 8rem;
}
</style>
