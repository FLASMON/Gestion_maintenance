<template>
    <AuthenticatedLayout title="Bon de reception" selected-menu="newsletter">
        <a-row :gutter="[4, 0]" justify="center">
            <a-col :span="24">
                <div class="flex flex-row justify-between items-center bg-white px-8 py-4 sm:rounded-t-lg flex-wrap">
                    <a-space>
                        <a-select v-model:value="statusSel" @change="reloadstatusSel" placeholder="Please select your zone" class="min-w-52">
                            <a-select-option value="published">Published</a-select-option>
                            <a-select-option  value="draft">Draft</a-select-option>
                            <a-select-option  value="pending">Pending</a-select-option>
                        </a-select>

                        <a-input v-model:value="search" @change="reload" size="large" type="default"
                                 placeholder="Search..." class="min-w-80">
                            <template #suffix>
                                <font-awesome-icon icon="fa-solid fa-search" style="color: rgba(0, 0, 0, 0.45)"
                                                   class="!me-0 !size-4"/>
                            </template>
                        </a-input>
                    </a-space>
                    <a-space>
                        <Link :href="route('newsletter.create')">
                            <a-button type="primary" class="flex items-center justify-center !text-sm">
                                <font-awesome-icon icon="fa-solid fa-plus" class="me-4"/>
                                Create
                            </a-button>
                        </Link>

                        <a-tooltip title="Refresh">
                            <a-button type="default" @click="refresh" class="flex items-center justify-center">
                                <font-awesome-icon icon="fa-solid fa-rotate-right" class="!me-0"/>
                            </a-button>
                        </a-tooltip>
                    </a-space>

                </div>
            </a-col>
            <a-col :span="24" class="h-full">
                <div class="bg-white pb-4 dark:bg-gray-800 overflow-hidden shadow-sm !rounded-none h-full">
                    <a-table
                        :pagination="pagination"
                        @change="handleTableChange"
                        :row-key="record => record.key"
                        :columns="columns"
                        :row-selection="rowSelection"
                        :data-source="pages.data"
                        :scroll="{ x: 'max-content' }"
                        class="px-0 py-0 h-full"
                        :locale="{ emptyText: 'Aucun liste' }"
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
                            <template v-if="column.dataIndex === 'name'">
                                <a-button type="link" size="large" class="!pl-0">{{ text }}</a-button>
                                <!--                                <a href="javascript">{{ text }}</a>-->
                            </template>
                            <template v-if="column.dataIndex === 'status'">
                                <a-tag
                                    :color="record.status === 'published' ? '#00A716' : (record.status === 'pending' ? '#F76707' : '#6C7A91')"
                                    class="flex justify-center capitalize font-medium py-0.5 w-20 text-[14px]">
                                    {{ record.status }}
                                </a-tag>
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
import {ref, defineComponent, h, defineProps, reactive, computed} from 'vue';
import {Link, router, usePage} from "@inertiajs/vue3";
import {message, Modal} from "ant-design-vue";
import {format} from 'date-fns';
import {route} from "ziggy-js";

const props = defineProps({
    pages: {
        type: Object,
        default: {}
    },
    statusSel: {
        type: String,
        default: ''
    },

    search: {
        type: String,
        default: ''
    },
});

const refresh = () => {
    // window.location.reload();
    router.get(route('newsletter.index'));
};

// const formRef = ref();
// const formState = reactive({
//     name: '',
//     region: undefined,
//     date1: undefined,
//     delivery: false,
//     type: [],
//     resource: '',
//     desc: '',
// });

const rowSelection = ref({});

const columns = [
    {
        title: 'N° BON',
        dataIndex: 'id',
        key: 'id',
        fixed: 'left',
    },
    {
        title: 'DATE DU BON',
        dataIndex: 'date_nee',
        key: 'date_nee',
        sorter: (a, b) => a.date_nee.localeCompare(b.date_nee),
    },
    {
        title: 'CLIENT',
        dataIndex: 'profession',
        key: 'profession',
        sorter: (a, b) => a.profession.localeCompare(b.profession),
    },
    {
        title: 'TELEPHONE',
        dataIndex: 'telephone',
        key: 'telephone',
        sorter: (a, b) => a.telephone.localeCompare(b.telephone),
    },
    {
        title: 'AJOUTER PAR',
        dataIndex: 'telephone2',
        key: 'telephone2',
        sorter: (a, b) => a.telephone2.localeCompare(b.telephone2),
    },
    {
        title: 'CREATED AT',
        dataIndex: 'created_at',
        key: 'created_at',
        sorter: (a, b) => a.createdAt.localeCompare(b.createdAt),
    },
    {
        title: 'OPERATIONS',
        key: 'operation',
        fixed: 'right',
        align: 'center',
        width: 80,
    },
];

const editRow = (record) => {
    router.get(route('newsletter.edit', {page: record}, '/edit'));
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
                router.delete(route('page.destroy', {page: record.id}), {
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
const statusSel = ref(null);
const reload = () => {
    router.reload({data: {search: search.value}})
}

const reloadstatusSel = () => {
    router.reload({data: {statusSel: statusSel.value}})
}
const formatDate = (date) => {
    return format(new Date(date), 'dd-MM-yyyy');
}

const pagination = computed(() => {
    return {
        total: props.pages.total,
        current: props.pages.current_page,
        pageSize: props.pages.per_page,
        hideOnSinglePage: true,
        showSizeChanger: false,
        showTotal: (total, range) => `Show from ${range[0]} to ${range[1]} in ${total} records`
    }
});

const handleTableChange = (pag, filters, sorter) => {
    router.get(route('page.index', {page: pag.current}));
};

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

