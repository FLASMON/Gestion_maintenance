<template>
    <AuthenticatedLayout title="Blog" sous_title="Posts" selected-menu="post" open-menu="blog">
        <a-row :gutter="[4, 0]" justify="center">
            <a-col :span="24">
                <div class="flex flex-row justify-between items-center bg-white px-8 py-4 sm:rounded-t-lg flex-wrap">
                    <a-space>

                        <a-input-search class=""
                                        v-model:value="value"
                                        placeholder="input search text"
                                        enter-button
                                        @search="onSearch"
                        />

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
                                    <a-input ref="inputRef" v-model:value="name" placeholder="Please enter item"/>
                                    <a-button type="text" @click="addItem" class="flex items-center justify-center">
                                        <template #icon>
                                            <font-awesome-icon icon="fa-solid fa-plus" class="!me-0 pr-2 !size-4"/>
                                        </template>
                                        Add item
                                    </a-button>
                                </a-space>
                            </template>
                        </a-select>

                    </a-space>
                    <a-space>
                        <a-button type="primary" class="flex items-center justify-center !text-sm">
                            <font-awesome-icon icon="fa-solid fa-plus" class="me-4"/>
                            Create
                        </a-button>
                        <!--                        <a-tooltip title="search">-->
                        <!--                            <a-button type="primary" class="flex items-center justify-center" ><font-awesome-icon icon="fa-solid fa-plus" class="!me-0" /></a-button>-->
                        <!--                        </a-tooltip>-->
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
                        :data-source="data"
                        :scroll="{ x: 'max-content' }"
                        class="px-0 py-4 h-full"
                    >
                        <template #bodyCell="{ column, record, text  }">

                            <template v-if="column.key === 'operation'">
                                <div class="flex items-center justify-center gap-2 w-full">
                                    <a-tooltip title="Editer cette ligne">
                                        <a-button
                                            type="default"
                                            size="small"
                                            class="flex items-center justify-center !py-4"
                                            @click="() => editRow(record)"
                                        >
                                            <font-awesome-icon icon="fa-solid fa-edit" class="!me-0 !size-4"/>
                                        </a-button>
                                    </a-tooltip>
                                    <a-tooltip title="Supprimer cette ligne">
                                        <a-button
                                            type="default"
                                            size="small"
                                            class="flex items-center justify-center !py-4"
                                            @click="() => deleteRow(record)"
                                        >
                                            <font-awesome-icon icon="fa-solid fa-trash" class="!me-0 !size-4"/>
                                        </a-button>
                                    </a-tooltip>
                                </div>
                            </template>
                            <template v-if="column.dataIndex === 'name'">
                                <a href="javascript">{{ text }}</a>
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
import {ref, defineComponent} from 'vue';

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

const columns = [
    {
        title: 'ID',
        dataIndex: 'key',
        key: 'key',
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
        dataIndex: 'createdAt',
        sorter: (a, b) => a.createdAt.localeCompare(b.createdAt),
        key: 'createdAt',
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
const data = ref([]);
for (let i = 0; i < 100; i++) {
    data.value.push({
        key: i,
        name: `Edrward ${i}`,
        age: 32,
        template: `Template ${i}`,
        createdAt: `2024-06-${i + 1}`,
        status: i % 2 === 0 ? 'Active' : 'Inactive',
    });
}


const rowSelection = ref({});

const editRow = (record) => {
    console.log('Edit:', record);
};

const deleteRow = (record) => {
    console.log('Delete:', record);
};

</script>
<style>

</style>
