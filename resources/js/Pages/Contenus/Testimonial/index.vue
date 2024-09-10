<template>
    <AuthenticatedLayout title="Testimonial" selected-menu="testimonial">
        <a-row :gutter="[4, 0]" justify="center">
            <a-col :span="24">
                <div class="flex flex-row justify-between items-center bg-white px-8 py-4 sm:rounded-t-lg flex-wrap">
                    <a-space>
                        <a-select
                            v-model:value="value"
                            placeholder="Select filter"
                            style="width: 250px"
                            :options="items.map(item => ({ value: item }))"
                            class=""
                        >
                            <template #dropdownRender="{ menuNode: menu }">
                                <v-nodes :vnodes="menu"/>
                                <a-divider style="margin: 4px 0"/>
                                <a-space style="padding: 4px 8px">
                                    <a-input ref="inputRef" v-model:value="name" placeholder="Please enter item">
                                        <template #prefix>
                                            <font-awesome-icon icon="fa-solid fa-plus"
                                                               style="color: rgba(0, 0, 0, 0.5)" class="me-0 !size-3"/>
                                        </template>
                                    </a-input>
                                    <a-button type="text" @click="addItem" class="flex items-center justify-center">
                                        <template #icon>
                                            <font-awesome-icon icon="fa-solid fa-plus" class="!me-0 pr-2 !size-4"/>
                                        </template>
                                        Add item
                                    </a-button>
                                </a-space>
                            </template>
                        </a-select>
                        <a-input v-model:value="search" @change="reload" size="large" type="default"
                                 placeholder="Search...">
                            <template #suffix>
                                <font-awesome-icon icon="fa-solid fa-search" style="color: rgba(0, 0, 0, 0.45)"
                                                   class="!me-0 !size-4"/>
                            </template>
                        </a-input>
                    </a-space>
                    <a-space>
                        <Link :href="route('testimonial.create')">
                            <a-button type="primary" class="flex items-center justify-center !text-sm">
                                <font-awesome-icon icon="fa-solid fa-plus" class="me-4"/>
                                Create
                            </a-button>
                        </Link>

                        <a-tooltip title="Refrech">
                            <a-button type="primary" class="flex items-center justify-center">
                                <font-awesome-icon icon="fa-solid fa-rotate-right" class="!me-0"/>
                            </a-button>
                        </a-tooltip>
                    </a-space>

                </div>
            </a-col>
            <a-col :span="24" class="h-full">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg h-full">
                    <a-table
                        :row-key="record => record.key"
                        :columns="columns"
                        :row-selection="rowSelection"
                        :data-source="testimonials.data"
                        :scroll="{ x: 'max-content' }"
                        class="px-0 py-0 min-h-full"
                        :locale="{ emptyText: 'No data testimonial to display' }"
                    >
                        <template #bodyCell="{ column, record, text  }">

                            <template v-if="column.key === 'image'">
                                <div class="flex rounded-md overflow-hidden">
                                    <a-avatar :size="54" class="flex items-center justify-center">
                                        <template #icon>
                                            <a-image
                                                class="!object-cover"
                                                :width="50"
                                                :height="50"
                                                src="/img/avatar.jpg"
                                                fallback="data:image/png;base64,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"
                                            >
                                                <template #previewMask>
                                                    <font-awesome-icon icon="fa-solid fa-eye" class="!me-0 !size-6"/>
                                                </template>
                                            </a-image>
                                        </template>
                                    </a-avatar>
                                </div>
                            </template>

                            <template v-if="column.key === 'operation'">
                                <div class="flex items-center justify-center gap-2 w-full">
                                    <a-tooltip title="Edit">
                                        <a-button
                                            type="primary"
                                            size="small"
                                            class="flex items-center justify-center !py-4"
                                            @click="editRow(record)"
                                        >
                                            <font-awesome-icon icon="fa-solid fa-edit" class="!me-0 !size-4"/>
                                        </a-button>
                                    </a-tooltip>

                                    <a-tooltip title="Delete">
                                        <a-button
                                            type="primary" danger
                                            size="small"
                                            class="flex items-center justify-center !py-4"
                                            @click="deleteRow(record)"
                                        >
                                            <font-awesome-icon icon="fa-solid fa-trash" class="!me-0 !size-4"/>
                                        </a-button>
                                    </a-tooltip>
                                </div>
                            </template>
                            <template v-if="column.dataIndex === 'status'">
                                <a-tag
                                    :color="record.status === 'published' ? '#00A716' : (record.status === 'pending' ? '#F76707' : '#6C7A91')"
                                    class="flex justify-center capitalize font-medium py-1 w-20 text-[14px]">
                                    {{ record.status }}
                                </a-tag>
                            </template>
                            <template v-if="column.dataIndex === 'name'">
                                <a  @click="editRow(record)">{{ text }}</a>
                            </template>
                            <template v-if="column.dataIndex === 'created_at'">
                                {{ formatDate(record.created_at) }}
                            </template>
                        </template>
                    </a-table>
                </div>
            </a-col>
        </a-row>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ref, defineComponent, defineProps, h} from 'vue'
import {Link, router, usePage} from "@inertiajs/vue3";
import {message, Modal} from "ant-design-vue";
import {format} from "date-fns";

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

const VNodes = defineComponent({
    props: {
        vnodes: {
            type: Object,
            required: true,
        },
    },
    render() {
        return this.vnodes;
    },
});
let index = 0;
const items = ref(['jack', 'lucy']);
const value = ref();
const inputRef = ref();
const name = ref();
const addItem = e => {
    e.preventDefault();
    console.log('addItem');
    items.value.push(name.value || `New item ${(index += 1)}`);
    name.value = '';
    setTimeout(() => {
        inputRef.value?.focus();
    }, 0);
};

const rowSelection = ref({});
const columns = [
    {
        title: 'ID',
        dataIndex: 'id',
        key: 'key',
        fixed: 'left',
    },
    {
        title: 'IMAGE',
        dataIndex: 'image',
        key: 'image',
        fixed: 'left',
        width: '150px',
    },
    {
        title: 'NAME',
        dataIndex: 'name',
        key: 'name',
        sorter: (a, b) => a.name.localeCompare(b.name),

    },
    {
        title: 'COMPANY',
        dataIndex: 'company',
        key: 'company',
        sorter: (a, b) => a.name.localeCompare(b.name),

    },
    {
        title: 'CREATED AT',
        dataIndex: 'created_at',
        sorter: (a, b) => a.createdAt.localeCompare(b.createdAt),
        key: 'created_at',
    },
    {
        title: 'STATUS',
        dataIndex: 'status',
        sorter: (a, b) => a.status.localeCompare(b.status),
        key: 'status',
    },
    {
        title: 'OPERATIONS',
        key: 'operation',
        fixed: 'right',
        align: 'center',
    },
];

const editRow = (record) => {
    console.log("record",record)
    router.get(route('testimonial.edit', {testimonial: record}, '/edit'));
}

const deleteRow = (record) => {
    Modal.confirm({
        title: 'Are you sure you want to delete this testimonial ?',
        content: h('div', {}, [
            h('h4', {class: 'font-medium'}, [record.name]),
        ]),
        okText: 'SUPPRIMER',
        cancelText: 'ANNULER',
        okType: 'primary',
        okButtonProps: {class: '!bg-red-500'},
        class: 'main-modal-wrap',
        icon: null,
        onOk() {
            return new Promise((resolve, reject) => {
                router.delete(route('testimonial.destroy', {testimonial: record.id}), {
                    preserveScroll: true,
                    onSuccess: page => {
                        resolve()
                        message.success(usePage().props.message)

                        const index = selectedRowKeys.value.indexOf(record.id)
                        if (index !== -1)
                            selectedRowKeys.value.splice(index, 1)
                    }
                })
            });
        }
    });
}

const search = ref('');
const reload = () => {
    router.reload({data: {search: search.value}})
}

const formatDate = (date) => {
    return format(new Date(date), 'dd-MM-yyyy');
}
</script>
<style>

</style>
