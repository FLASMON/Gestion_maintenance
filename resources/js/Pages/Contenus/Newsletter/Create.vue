<template>
    <AuthenticatedLayout title="Bon de reception" :sous_title="testimonials?.id ? 'Edit Bon de reception' : 'Create Bon de reception'"
                         selected-menu="newsletter">
        <a-form
            :model="formPage"
            name="validate_other"
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
                                <a-space direction="horizontal" class="mb-4">
                                    <a-avatar class="flex items-center justify-center bg-white border-2 border-gray-200" :size="{xs: 24, sm: 32, md: 35, lg: 40, xl: 50, xxl: 50}">
                                        <template #icon>
                                            <span class="text-gray-800">1</span>
                                        </template>
                                    </a-avatar>
                                    <a-typography-text class="text-base font-medium capitalize">Client</a-typography-text>
                                </a-space>

                                <div class="flex items-center justify-between flex-wrap mb-4 border border-primary rounded-md p-6">
                                    <div class="flex items-center gap-6">
                                        <a-avatar class="flex items-center justify-center bg-white border-2 border-gray-200" :size="{ xs: 24, sm: 32, md: 40, lg: 64, xl: 80, xxl: 100 }">
                                            <template #icon>
                                                <font-awesome-icon v-if="sexe" icon="fa-solid fa-user" class="!size-12 !me-0 text-gray-200"/>
                                                <font-awesome-icon v-else icon="fa-solid fa-question" class="!size-12 !me-0 text-gray-800"/>
                                            </template>
                                        </a-avatar>

                                        <div class="flex flex-col">
                                            <a-button type="primary" class="mb-4 !text-sm">Selectionnez un client</a-button>
                                            <a-typography-title :level="2">FLASMON Jamé</a-typography-title>
                                        </div>
                                    </div>

                                    <div class="">
                                        <a-space direction="vertical" class="!w-full">
                                            <a-typography-text class="text-base font-medium capitalize">ville : <span class="font-normal">toamasina</span></a-typography-text>
                                            <a-typography-text class="text-base font-medium capitalize">région : <span class="font-normal">toamasina</span></a-typography-text>
                                            <a-typography-text class="text-base font-medium capitalize">tél : <span class="font-normal">+261 64 565 21</span></a-typography-text>
                                        </a-space>
                                    </div>
                                </div>
                            </a-col>
                            <a-col :span="24">
                                <a-space direction="horizontal" class="mb-4">
                                    <a-avatar class="flex items-center justify-center bg-white border-2 border-gray-200" :size="{ xs: 24, sm: 32, md: 35, lg: 40, xl: 50, xxl: 50 }">
                                        <template #icon>
                                            <span class="text-gray-800">2</span>
                                        </template>
                                    </a-avatar>
                                    <a-typography-text class="text-base font-medium capitalize">Details</a-typography-text>
                                </a-space>
                                <div class="mb-4 border border-primary rounded-t-md rounded-b-0 px-0 py-2">
                                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm !rounded-none h-full">
                                        <div class="flex items-center justify-between px-4 py-2 gap-4">
                                            <div class="flex items-center space-x-2 w-full"> <!-- Container for the button and input -->
                                                <AjouterMachine></AjouterMachine>
                                                <a-tooltip title="Recherche">
                                                    <a-button
                                                        v-if="!showInput"
                                                        @click="toggleInput"
                                                        size="small"
                                                        class="flex items-center justify-center !py-3.5 bg-none border-none"
                                                    >
                                                        <font-awesome-icon icon="fa-solid fa-magnifying-glass" class="!me-0 !size-4"/>
                                                    </a-button>
                                                </a-tooltip>
                                                <transition name="slide-fade" @before-enter="beforeEnter" @enter="enter" @leave="leave">
                                                    <a-input
                                                        v-if="showInput"
                                                        v-model:value="value1"
                                                        placeholder="input with clear icon"
                                                        allow-clear
                                                        @blur="handleBlur"
                                                        @change="handleChange"
                                                        class="w-full rounded-3xl"
                                                        size="large"
                                                    >
                                                        <template #prefix>
                                                            <font-awesome-icon icon="fa-solid fa-magnifying-glass"
                                                                               style="color: rgba(0, 0, 0, 0.3)" class="!me-2 !size-4"/>
                                                        </template>

                                                    </a-input>

                                                </transition>
                                            </div>
                                            <a-typography-text class="text-base font-medium capitalize text-nowrap text-right"> <!-- Move text to the right -->
                                                3 : <span class="font-normal">Machine</span>
                                            </a-typography-text>
                                        </div>
                                        <a-table
                                            :row-key="record => record.key"
                                            :columns="columns"
                                            :row-selection="rowSelection"
                                            :data-source="data"
                                            :scroll="{ x: 'max-content' }"
                                            class="px-0 py-4 h-full"
                                        >
                                            <template #bodyCell="{ column, record, text  }">

                                                <template v-if="column.key === 'operation'">
                                                    <div class="flex items-center justify-center gap-2 w-full">
                                                        <a-tooltip title="Edit">
                                                            <a-button
                                                                type="primary"
                                                                size="small"
                                                                class="flex items-center justify-center !py-3.5"
                                                                @click="editRow(record)"
                                                            >
                                                                <font-awesome-icon icon="fa-solid fa-edit" class="!me-0 !size-3.5"/>
                                                            </a-button>
                                                        </a-tooltip>

                                                        <a-tooltip title="Delete">
                                                            <a-button
                                                                type="primary" danger
                                                                size="small"
                                                                class="flex items-center justify-center !py-3.5"
                                                                @click="deleteRow(record)"
                                                            >
                                                                <font-awesome-icon icon="fa-solid fa-trash" class="!me-0 !size-3.5"/>
                                                            </a-button>
                                                        </a-tooltip>
                                                    </div>
                                                </template>
                                            </template>
                                        </a-table>
                                    </div>
                                </div>
                            </a-col>

<!--                            <a-col :span="24">-->
<!--                                <a-form-item label="Name" name="name" has-feedback-->
<!--                                             :rules="[{ required: true, message: 'Please select your country!' }]">-->
<!--                                    <a-input v-model:value="formPage.name" autocomplete="off" size="large">-->
<!--                                        <template #prefix>-->
<!--                                            <font-awesome-icon icon="fa-solid fa-pager"-->
<!--                                                               style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>-->
<!--                                        </template>-->
<!--                                    </a-input>-->
<!--                                </a-form-item>-->

<!--                                <a-form-item label="Position/Company" required name="company">-->
<!--                                    <a-input v-model:value="formPage.company" autocomplete="off" size="large">-->
<!--                                        <template #prefix>-->
<!--                                            <font-awesome-icon icon="fa-solid fa-plus"-->
<!--                                                               style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>-->
<!--                                        </template>-->
<!--                                    </a-input>-->
<!--                                </a-form-item>-->

<!--                                <a-form-item label="Content" required name="content">-->
<!--                                    <a-flex wrap="wrap" gap="small" class="mb-3">-->
<!--                                        <a-button type="primary" value="default" class="!text-[14px]"-->
<!--                                                  @click="toggleTextEditor">-->
<!--                                            <font-awesome-icon-->
<!--                                                :icon="showTextEditor ? 'fa-solid fa-eye' : 'fa-solid fa-code'"-->
<!--                                                class="!me-0 !size-4 pr-2"/>-->
<!--                                            {{ showTextEditor ? 'Show Editor' : 'Hide Editor' }}-->
<!--                                        </a-button>-->
<!--                                    </a-flex>-->
<!--                                    <a-textarea v-model:value="formPage.content" autocomplete="off"-->
<!--                                                placeholder="Write your content" class="!h-48"-->
<!--                                                v-if="!showTextEditor"/>-->
<!--                                </a-form-item>-->
<!--                            </a-col>-->
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
                                                  class=" flex items-center justify-center !text-sm">
                                            <font-awesome-icon icon="fa-solid fa-circle-check" class="me-3"/>
                                            Save & Exit
                                        </a-button>
                                    </a-form-item>
                                </a-flex>
                            </div>
                        </a-col>

                        <a-col :span="24">
                            <div class="px-4 py-3 bg-white shadow-sm sm:rounded-md ">
                                <a-form-item name="status" has-feedback label="BON"
                                             :rules="[{ required: true, message: 'Please select your country!' }]">
                                    <a-divider class="!mt-2"/>
                                    <a-typography-title :level="2">0001C</a-typography-title>
                                    <a-form-item name="date-picker" v-bind="config">
                                        <a-date-picker v-model:value="formPage['date-picker']" value-format="YYYY-MM-DD" size="large"  class="w-full" />
                                    </a-form-item>
<!--                                    <a-select v-model:value="formPage.status" placeholder="Please select your status">-->
<!--                                        <a-select-option value="published">Published</a-select-option>-->
<!--                                        <a-select-option value="draft">Draft</a-select-option>-->
<!--                                        <a-select-option value="pending">Pending</a-select-option>-->
<!--                                    </a-select>-->
                                </a-form-item>
                            </div>
                        </a-col>

                        <a-col :span="24">
                            <div class="px-4 py-3 bg-white shadow-sm sm:rounded-md">
                                <a-form-item name="image" label="Format Imprimer" class="font-medium">
                                    <a-divider class="!mt-2"/>

                                    <a-space direction="vertical" class="font-normal">
                                        <a-checkbox value="A">Imprimer Format A4</a-checkbox>
                                        <a-checkbox value="B">Imprimer Format A6</a-checkbox>
                                        <a-checkbox value="C">Imprimer les étiquettes</a-checkbox>
                                        <a-checkbox value="D">Aperçu</a-checkbox>
                                        <a-checkbox value="E">Paramètre Imprimate</a-checkbox>
                                    </a-space>

<!--                                    <a-select v-model:value="formPage.image"-->
<!--                                              placeholder="Please select your template">-->
<!--                                        <a-select-option value="default">image</a-select-option>-->
<!--                                    </a-select>-->
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
import AjouterMachine from "@/Components/utils/AjouterMachine.vue";
import DetailMachine from "@/Components/utils/DetailMachine.vue";
import {defineProps, defineEmits} from 'vue';
import {route} from "ziggy-js";


const activeKey = ref('1');
const props = defineProps({
    testimonials: {
        type: Array,
        filters: Object,
        links: Array,
        default: () => ({})
    },
    search: {
        type: String,
        default: ''
    },
});

let formPage = useForm({
    id: props.testimonials?.id,
    name: props.testimonials?.name,
    content: props.testimonials?.content,
    image: props.testimonials?.image,
    company: props.testimonials?.company,
    status: props.testimonials?.status || 'published',
});

const onLoadingSave = ref(false);
const onLoadingSaveAndExit = ref(false);

const showTextEditor = ref(true);
const toggleTextEditor = () => {
    showTextEditor.value = !showTextEditor.value;
};

const openNotification = placement => {
    notification.open({
        message: `Notification ${placement}`,
        description: `Testimonial has been ${props.testimonials?.id ? 'updated' : 'created'} successfully.`,
        placement,
        icon: h(FontAwesomeIcon, {icon: ["fas", "circle-check"], style: {color: '#ffffff'}}),
    });
};

const retourPage = () => {
    router.get(route('testimonial.index'));
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
            openNotification('success');
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

    if (props.testimonials?.id) {
        formPage.put(route('testimonial.update', {testimonial: props.testimonials.id}), options);
    } else {
        formPage.post(route('testimonial.store'), options);
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

const columns = [
    {
        title: 'CM',
        dataIndex: 'key',
        key: 'key',
        fixed: 'left',
        width: 80,
    },
    {
        title: 'Machine (Famille)',
        dataIndex: 'machine',
        key: 'machine',
        sorter: (a, b) => a.name.localeCompare(b.name),
        fixed: 'left',
        width: 200,
    },
    {
        title: 'Désignation',
        dataIndex: 'designation',
        key: 'designation',
        sorter: (a, b) => a.name.localeCompare(b.name),
        fixed: 'left',
    },
    {
        title: 'N° Série',
        dataIndex: 'num_serie',
        key: 'num_serie',
        sorter: (a, b) => a.name.localeCompare(b.name),
        fixed: 'left',
    },
    {
        title: 'Remarque',
        dataIndex: 'remarque',
        key: 'remarque',
    },
    {
        title: 'OPERATIONS',
        key: 'operation',
        fixed: 'right',
        align: 'center',
        width: 50,
    },
];
const data = ref([]);
for (let i = 0; i < 2; i++) {
    data.value.push({
        key: i,
        machine: `ASUS ${i}`,
        designation: `Panne carte graphic`,
        num_serie: 25487562,
        remarque: `remarque`,
    });
}

const rowSelection = ref({});
const editRow = (record) => {
    console.log('Edit:', record);
};

const deleteRow = (record) => {
    console.log('Delete:', record);
};

const showInput = ref(false);
const value1 = ref('');

const toggleInput = () => {
    showInput.value = !showInput.value;
};

const handleChange = () => {
    if (!value1.value) {
        showInput.value = false;
    }
};

// Watch for value1 changes and handle input visibility
watch(value1, (newValue) => {
    if (!newValue && showInput.value) {
        showInput.value = false;
    }
});

</script>

<style>

.ant-notification-notice {
    @apply bg-[#00A716]
}

.ant-notification-notice .ant-notification-notice-icon {
    @apply absolute !top-[40px];

}

.ant-notification-notice .ant-notification-notice-with-icon .ant-notification-notice-message,
.ant-notification-notice .ant-notification-notice-with-icon .ant-notification-notice-description,
.ant-notification-notice .ant-notification-close-icon {
    @apply text-[#ffffff]
}


.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 600ms ease-out;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    opacity: 0;
    transform: translateX(-100px);
}

.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 600ms ease-in;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    opacity: 0;
    transform: translateX(100px);
}

</style>
