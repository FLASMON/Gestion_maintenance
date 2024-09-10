<template>
    <AuthenticatedLayout title="Client" :sous_title="pages?.id ? 'Edit Page' : 'Create Client'" selected-menu="page">
        <a-form
            :model="formPage"
            :rules="rules"
            layout="vertical"
            autocomplete="off"
            @finish="onFinish"
            v-bind="formItemLayout"
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
                        <a-tab-pane key="1" tab="Information Rapide" class="-mt-4">
                            <div class="p-4 sm:p-8 mb-6 bg-white shadow-sm sm:rounded-b-md sm:rounded-t-none">
                                <a-row :gutter="[16, 0]">
                                    <a-col :span="24">
                                        <a-form-item label="Client" required name="client" :rules="rules.name">
                                            <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>

                                    <a-col :span="24" :md="12">
                                        <a-form-item label="Nom" required name="nom" :rules="rules.name">
                                            <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>

                                    <a-col :span="24" :md="12">
                                        <a-form-item label="Prénom" required name="prenom" :rules="rules.name">
                                            <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>

                                    <a-col :span="24" :md="12">
                                        <a-form-item label="Ville" required name="ville" :rules="rules.name">
                                            <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>

                                    <a-col :span="24" :md="12">
                                        <a-form-item label="Région" required name="region" :rules="rules.name">
                                            <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>

                                    <a-col :span="24">
                                        <a-form-item label="Adresse" name="permalink" :rules="rules.permalink">
                                            <a-input v-model:value="formPage.permalink" autocomplete="off" size="large"
                                                     @click="fillPermalink">
                                                <template #prefix>
                                                    <span>{{ baseUrl }}</span>
                                                </template>
                                                <template #suffix>
                                                    <a-tooltip title="Generate URL">
                                                        <font-awesome-icon icon="fa-solid fa-link"
                                                                           class="text-gray-500"/>
                                                    </a-tooltip>
                                                </template>
                                            </a-input>
                                        </a-form-item>

                                        <a-form-item label="Description" name="description">
                                            <a-textarea v-model:value="formPage.description" autocomplete="off"
                                                        placeholder="Short description" class="!h-32"/>
                                        </a-form-item>
                                    </a-col>
                                </a-row>
                            </div>
                        </a-tab-pane>

                        <a-tab-pane key="2" tab="Information Avancée" force-render class="p-0 -mt-4 sm:rounded-md">
                            <div class="p-4 sm:p-8 mb-6 bg-white shadow-sm sm:rounded-b-md sm:rounded-t-none">
                                <a-row :gutter="[16, 0]">
                                    <a-col :span="24">
                                        <a-form-item label="N° Carte d'Itentité National" required name="num_cin"
                                                     :rules="rules.name">
                                            <a-input v-model:value="formPage.num_cin" autocomplete="off" size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>

                                    <a-col :span="24" :md="12">
                                        <a-form-item name="date-picker" label="Date de naissance" v-bind="config">
                                            <a-date-picker v-model:value="formPage['date-picker']"
                                                           value-format="YYYY-MM-DD" size="large" class="w-full"/>
                                        </a-form-item>
                                    </a-col>

                                    <a-col :span="24" :md="12">
                                        <a-form-item label="Lieu de naissance" name="lieu_nee" :rules="rules.lieu_nee">
                                            <a-input v-model:value="formPage.lieu_nee" autocomplete="off" size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>

                                    <a-col :span="24" :md="12">
                                        <a-form-item label="Profession" name="profession" :rules="rules.profession">
                                            <a-input v-model:value="formPage.profession" autocomplete="off"
                                                     size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>

                                    <a-col :span="24" :md="12">
                                        <a-form-item label="Téléphone" name="telephone" :rules="rules.telephone">
                                            <a-input v-model:value="formPage.telephone" autocomplete="off" size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>
                                    <a-col :span="24" :md="12">
                                        <a-form-item label="Téléphone 2" name="telephone2" :rules="rules.telephone2">
                                            <a-input v-model:value="formPage.telephone2" autocomplete="off"
                                                     size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>

                                    <a-col :span="24" :md="12">
                                        <a-form-item label="Téléphone 3" name="telephone3" :rules="rules.telephone3">
                                            <a-input v-model:value="formPage.telephone3" autocomplete="off"
                                                     size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>

                                    <a-col :span="24">

                                        <a-form-item label="Description" name="telephone3">
                                            <a-textarea v-model:value="formPage.description" autocomplete="off"
                                                        placeholder="Short telephone 3" class="!h-32"/>
                                        </a-form-item>

                                        <a-form-item label="Solde Initial" name="telephone3">
                                            <a-input v-model:value="formPage.telephone3" autocomplete="off"
                                                     size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>

                                        <a-space direction="vertical">
                                            <a-switch v-if="formPage.status !== 'societe'"
                                                      v-model:checked="showFormPassport"
                                                      checked-children="Afficher Passeport"
                                                      un-checked-children="Masquer Passeport"
                                                      @change="toggleTextEditor" size="large"
                                                     />

                                        </a-space>
                                    </a-col>
                                </a-row>
                            </div>

                            <div v-if="showFormPassport"
                                 class="p-4 sm:p-8 mb-6 bg-white shadow-sm sm:rounded-b-md sm:rounded-t-none">
                                <a-typography-title :level="5" class="pb-4">Passport / Registre commerce
                                </a-typography-title>
                                <a-row :gutter="[16, 0]">
                                    <a-col :span="24">
                                        <a-form-item label="Client" required name="client" :rules="rules.name">
                                            <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>

                                    <a-col :span="24" :md="12">
                                        <a-form-item label="Nom" required name="nom" :rules="rules.name">
                                            <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>
                                    <a-col :span="24" :md="12">
                                        <a-form-item label="Prénom" required name="prenom" :rules="rules.name">
                                            <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>
                                    <a-col :span="24" :md="12">
                                        <a-form-item label="Ville" required name="ville" :rules="rules.name">
                                            <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>
                                    <a-col :span="24" :md="12">
                                        <a-form-item label="Région" required name="region" :rules="rules.name">
                                            <a-input v-model:value="formPage.name" autocomplete="off" size="large">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-pager"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                        </a-form-item>
                                    </a-col>

                                    <a-col :span="24">
                                        <a-form-item label="Client" required name="client" :rules="rules.name">
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
                        </a-tab-pane>
                    </a-tabs>
                </a-col>

                <a-col :span="24" :xl="5">
                    <a-row :gutter="[24, 24]">
                        <a-col :span="24" class="max-lg:order-last xl:order-first">
                            <div class="px-4 pt-3 lg:mt-12 bg-white shadow-sm sm:rounded-md">
                                <a-typography-title :level="5">Publish</a-typography-title>
                                <a-divider class="!my-3"/>
                                <a-flex gap="small" class="flex items-center flex-wrap pt-4 pb-6">
                                    <a-button @click="e => onSubmit(e, false, 'save')" type="primary"
                                              :loading="onLoadingSave"
                                              class="flex items-center justify-center !text-sm">
                                        <font-awesome-icon icon="fa-solid fa-save" class="!me-2"/>
                                        Save
                                    </a-button>
                                    <a-button @click="e => onSubmit(e, true, 'saveAndExit')" type="default"
                                              :loading="onLoadingSaveAndExit"
                                              class="flex items-center justify-center !text-sm">
                                        <font-awesome-icon icon="fa-solid fa-save" class="!me-2"/>
                                        Save & Exit
                                    </a-button>

                                </a-flex>
                            </div>
                        </a-col>

                        <a-col :span="24">
                            <div class="px-4 py-3 bg-white shadow-sm sm:rounded-md">
                                <a-form-item name="status" label="Type de client" :rules="rules.status"
                                             class="font-medium">
                                    <a-divider class="!mt-2"/>
                                    <a-select v-model:value="formPage.status" placeholder="Please select your status">
                                        <a-select-option value="societe">Société</a-select-option>
                                        <a-select-option value="draft">Draft</a-select-option>
                                        <a-select-option value="pending">Pending</a-select-option>
                                    </a-select>
                                </a-form-item>
                            </div>
                        </a-col>

                        <!--                        <a-col :span="24">-->
                        <!--                            <div class="px-4 py-3 bg-white shadow-sm sm:rounded-md">-->
                        <!--                                <a-form-item name="status" label="Type de client" :rules="rules.status" class="font-medium">-->
                        <!--                                    <a-divider class="!mt-2"/>-->
                        <!--                                    <a-select v-model:value="formPage.status" placeholder="Please select your status">-->
                        <!--                                        <a-select-option value="societe">Société</a-select-option>-->
                        <!--                                        <a-select-option value="draft">Draft</a-select-option>-->
                        <!--                                        <a-select-option value="pending">Pending</a-select-option>-->
                        <!--                                    </a-select>-->
                        <!--                                </a-form-item>-->
                        <!--                            </div>-->
                        <!--                        </a-col>-->

                        <a-col :span="24">
                            <div class="px-4 py-3 bg-white shadow-sm sm:rounded-md">
                                <a-form-item name="sexe" label="Sexe" required
                                             class="font-medium">
                                    <a-divider class="!mt-2"/>
                                    <a-radio-group v-model:value="value" name="radioGroup">
                                        <a-radio value="homme" class="uppercase">Homme</a-radio>
                                        <a-radio value="femme" class="uppercase">Femme</a-radio>
                                    </a-radio-group>
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
import {h, ref, watch} from 'vue';
import {router, useForm} from '@inertiajs/vue3';
import {notification} from "ant-design-vue";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {defineProps} from 'vue'
import {route} from "ziggy-js";

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
const showFormPassport = ref(false);
const onLoadingSave = ref(false);
const onLoadingSaveAndExit = ref(false);

// Watch for changes in formPage.status
watch(() => formPage.status, (newStatus) => {
    showFormPassport.value = newStatus !== 'societe';
});

const toggleTextEditor = (checked) => {
    showFormPassport.value = checked;
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
    height: 8rem;
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
