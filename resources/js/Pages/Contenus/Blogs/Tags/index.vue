<template>
    <AuthenticatedLayout title="Blog" sous_title="Tags" selected-menu="tags" open-menu="blog">
        <a-row :gutter="[4, 0]" justify="center">
            <a-col :span="24">
                <div class="flex flex-row justify-between items-center bg-white px-8 py-4 sm:rounded-t-lg flex-wrap">
                    <a-space>
                        <a-select
                            v-model:value="value"
                            placeholder="Select filter"
                            style="width: 250px"
                            :options="options.map(item => ({ value: item }))"
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
                        <a-input v-model:value="search" @change="reload" size="large" type="default" placeholder="Search...">
                            <template #suffix>
                                <font-awesome-icon icon="fa-solid fa-search" style="color: rgba(0, 0, 0, 0.45)"
                                                   class="!me-0"/>
                            </template>
                        </a-input>
                    </a-space>
                    <a-space>
                        <Link :href="route('tags.create')">
                            <a-button type="primary" class="flex items-center justify-center !text-sm">
                                <font-awesome-icon icon="fa-solid fa-plus" class="me-4"/>
                                Create
                            </a-button>
                        </Link>

                        <a-tooltip title="Reload">
                            <a-button type="default" class="flex items-center justify-center">
                                <font-awesome-icon icon="fa-solid fa-rotate-right" class="!me-0"/>
                            </a-button>
                        </a-tooltip>
                    </a-space>

                </div>
            </a-col>
            <a-col :span="24" class="h-full">
                <div class="bg-white pb-4 dark:bg-gray-800 overflow-hidden shadow-sm !rounded-none h-full">
                    <a-table
                        :row-key="record => record.key"
                        :columns="columns"
                        :row-selection="rowSelection"
                        :data-source="tags.data"
                        :scroll="{ x: 'max-content' }"
                        class="px-0 py-0 h-full"
                        :locale="{ emptyText: 'No data to display' }"
                    >
                        <template #bodyCell="{ column, record, text  }">
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
                            <template v-if="column.dataIndex === 'name'">
                                <a-button type="link" size="large" class="!pl-0">{{ text }}</a-button>
                                <!--                                <a href="javascript">{{ text }}</a>-->
                            </template>
                            <template v-if="column.dataIndex === 'status'">
                                <a-tag :color="record.status === 'published' ? '#00A716' : (record.status === 'pending' ? '#F76707' : '#6C7A91')" class="flex justify-center capitalize font-medium py-1 w-20 text-[14px]">{{ record.status }}</a-tag>
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
import {ref, defineComponent, h, defineProps} from 'vue';
import {Link, router, usePage} from "@inertiajs/vue3";
import {message, Modal} from "ant-design-vue";
import {route} from "ziggy-js";
import { format } from 'date-fns';

const props = defineProps({
    tags: {
        type: Object,
        default: {}
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
const options = ref(['jack', 'lucy']);
const value = ref();
const inputRef = ref();
const name = ref();
const addItem = e => {
    e.preventDefault();
    console.log('addItem');
    options.value.push(name.value || `New item ${(index += 1)}`);
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
        key: 'id',
        fixed: 'left',
    },
    {
        title: 'NAME',
        dataIndex: 'name',
        key: 'name',
        sorter: (a, b) => a.name.localeCompare(b.name),
        fixed: 'left',
    },
    {
        title: 'TEMPLATE',
        dataIndex: 'template',
        sorter: (a, b) => a.template.localeCompare(b.template),
        key: 'template',
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
    router.get(route('tags.edit', {tag: record},'/edit'));
}

const deleteRow = (record) => {
    Modal.confirm({
        title: 'Êtes-vous sûr de vouloir supprimer ce page ?',
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
                router.delete(route('tags.destroy', {tag: record.id}), {
                    preserveScroll: true,
                    onSuccess: page => {
                        resolve()
                        message.success(usePage().props.message)

                        const index = selectedRowKeys.value.indexOf(record.id)
                        if(index !== -1)
                            selectedRowKeys.value.splice(index, 1)
                    }
                })
            });
        }
    });
}

const search = ref('');
const reload = () => {
    router.reload({ data: { search: search.value } })
}

const formatDate = (date) => {
    return format(new Date(date), 'dd-MM-yyyy');
}

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
</style>
