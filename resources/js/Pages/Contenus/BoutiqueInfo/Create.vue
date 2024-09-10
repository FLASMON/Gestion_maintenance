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
                    <a-tabs v-model:activeKey="activeKey">
                        <a-tab-pane key="1" tab="Detail" class="-mt-4">
                            <div class="p-4 sm:p-8 mb-6 bg-white shadow-sm sm:rounded-b-md sm:rounded-t-none">
                                <a-row>
                                    <a-col :span="24">
                                        <a-form-item label="Name" required name="name" :rules="rules.name">
                                            <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>

                                        <a-form-item label="Permalink" name="permalink" :rules="rules.permalink">
                                            <a-input v-model:value="formPage.permalink"  autocomplete="off" size="large" @click="fillPermalink">
                                                <template #prefix>
                                                    <span>{{ baseUrl }}</span>
                                                </template>
                                                <template #suffix>
                                                    <a-tooltip title="Generate URL">
                                                        <font-awesome-icon icon="fa-solid fa-link" class="text-gray-500" />
                                                    </a-tooltip>
                                                </template>
                                            </a-input>
                                        </a-form-item>

                                        <a-form-item label="Description" name="description">
                                            <a-textarea v-model:value="formPage.description" autocomplete="off"
                                                        placeholder="Short description" class="!h-32"/>
                                        </a-form-item>

                                        <a-form-item label="Content" required name="content">
                                            <a-flex wrap="wrap" gap="small" class="mb-3">
                                                <a-button type="primary" value="default" class="!text-[14px]" @click="toggleTextEditor">
                                                    <font-awesome-icon :icon="showTextEditor ? 'fa-solid fa-eye' : 'fa-solid fa-code'" class="!me-0 !size-4 pr-2"/>
                                                    {{ showTextEditor ? 'Show Editor' : 'Hide Editor' }}
                                                </a-button>
                                            </a-flex>
                                            <a-textarea v-model:value="formPage.content" autocomplete="off"
                                                        placeholder="Write your content" class="!h-48"
                                                        v-if="!showTextEditor"/>
                                            <TextEditor v-model:value="formPage.content" v-if="showTextEditor"/>
                                        </a-form-item>

<!--                                        <a-form-item label="Content" name="content">-->
<!--                                            <TextEditor v-model:value="formPage.content"/>-->
<!--                                        </a-form-item>-->
                                    </a-col>
                                </a-row>
                            </div>
                        </a-tab-pane>

                        <a-tab-pane key="2" tab="Revision History" force-render
                                    class="p-4 sm:p-8 -mt-4 bg-white shadow-sm sm:rounded-md">
                            Content of Tab Pane 2
                        </a-tab-pane>
                    </a-tabs>
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
                        <a-col :span="24">
                            <div class="px-4 py-3 bg-white shadow-sm sm:rounded-md clearfix">
                                <a-form-item name="image" label="Image">
                                    <a-divider class="!mt-2"/>
                                    <a-upload
                                        v-model:fileList="fileList"
                                        action="https://www.mocky.io/v2/5cc8019d300000980a055e76"
                                        list-type="picture-card"
                                        :before-upload="handleBeforeUpload"
                                        @preview="handlePreview"

                                    >
                                        <div v-if="fileList.length === 0">
                                            <font-awesome-icon icon="fa-solid fa-plus" class="text-gray-500 !size-4 !me-2"/>
                                            <div class="ml-2">Upload</div>
                                        </div>
                                    </a-upload>
                                    <a-modal :open="previewVisible" :title="previewTitle" :footer="null" @cancel="handleCancel">
                                        <img alt="example" :src="previewImage" class="h-64 object-cover w-full" />
                                    </a-modal>
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
import TextEditor from "@/Components/TextEditor.vue";
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

const baseUrl = 'https://artpik.design.com/en/news/';

const onLoadingSave = ref(false);
const onLoadingSaveAndExit = ref(false);

const showTextEditor = ref(true);
const toggleTextEditor = () => {
    showTextEditor.value = !showTextEditor.value;
};

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



const previewVisible = ref(false);
const previewImage = ref('');
const previewTitle = ref('');
const fileList = ref([]);

function getBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

const handleBeforeUpload = (file) => {
    // Limiter à une seule image
    fileList.value = [file];
    return false; // Retourner false pour empêcher l'upload automatique
};

const handleCancel = () => {
    previewVisible.value = false;
    previewTitle.value = '';
};

const handlePreview = async file => {
    if (!file.url && !file.preview) {
        file.preview = await getBase64(file.originFileObj);
    }
    previewImage.value = file.url || file.preview;
    previewVisible.value = true;
    previewTitle.value = file.name || file.url.substring(file.url.lastIndexOf('/') + 1);
};

const fillPermalink = () => {
    if (!formPage.permalink) {
        formPage.permalink = generatePermalink(formPage.name);
    }
};

const generatePermalink = (text) => {
    return text
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
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
