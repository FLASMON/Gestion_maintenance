<template>
    <div :class="{ 'modal-open': isModalVisible }">
        <a-tooltip title="Ajouter">
            <a-button
                type="primary"
                size="small"
                class="flex items-center justify-center !py-3.5"
                @click="showModal"
            >
                <font-awesome-icon icon="fa-solid fa-plus" class="!me-0 !size-3.5"/>
            </a-button>
        </a-tooltip>
        <a-modal v-model:open="open" width="1200px" title="LAPTOP ASUS-555XL" @ok="handleOk">
            <a-form
                :model="formPage"
                name="validate_other"
                layout="vertical"
                autocomplete="off"
                @finish="onFinish"
                @validate="handleValidate"
                @finishFailed="onFinishFailed"
            >
                <div class="px-8 py-6">
                    <a-row :gutter="[16, 8]">
                        <a-col :span="24" :sm="12" :md="8" :lg="16">
                            <div class="px-4 py-4  bg-[#F6F8FB] border border-gray-200 rounded-md">
                                <a-space direction="vertical" :size="[16, 2]">
                                    <a-typography-title :level="5"><span class="font-normal">FAMILLE : </span>FAMILLE
                                    </a-typography-title>
                                    <a-typography-title :level="5"><span class="font-normal">MACHINE : </span>MACHINE
                                    </a-typography-title>
                                    <a-typography-title :level="5"><span class="font-normal">N° SERIE : </span>N° SERIE
                                    </a-typography-title>
                                    <a-typography-title :level="5"><span class="font-normal">REMARQUES : </span>REMARQUES
                                    </a-typography-title>
                                    <a-typography-title :level="5"><span class="font-normal">PRIORITE : </span>PRIORITE
                                    </a-typography-title>
                                </a-space>
                            </div>
                        </a-col>

                        <a-col :span="24" :sm="12" :md="8" :lg="8">
                            <div class="flex flex-col px-4 py-4 bg-[#F6F8FB] border border-gray-200 rounded-md">
                                <a-space direction="vertical" :size="[16, 2]">
                                    <a-typography-title :level="5"><span class="font-normal">N° BON : </span>N° BON
                                    </a-typography-title>
                                    <a-typography-title :level="5"><span class="font-normal">DATE DU BON : </span>DATE
                                        DU BON
                                    </a-typography-title>
                                </a-space>
                                <a-space direction="vertical" :size="[16, 0]" class="mt-5">
                                    <a-typography-title :level="5" class="!mb-1"><span
                                        class="font-normal">CLIENT : </span>CLIENT
                                    </a-typography-title>
                                    <a-typography-title :level="5" class="!mb-1"><span
                                        class="font-normal">VILLE : </span>VILLE
                                    </a-typography-title>
                                    <a-typography-title :level="5" class="!mb-1"><span
                                        class="font-normal">TELEPHONE : </span>TELEPHONE
                                    </a-typography-title>
                                </a-space>
                            </div>
                        </a-col>
                    </a-row>
                </div>
                <div class="card-container">
                    <a-tabs v-model:activeKey="activeKey" type="card" class="px-8">

                        <a-tab-pane key="1" tab="PANNES DECLARE" class="p-4 bg-[#F6F8FB] -mt-4">
                            <p class="uppercase">Content of Tab Pane 1</p>
                        </a-tab-pane>
                        <a-tab-pane key="2" tab="TRAVAUX EFFECTUE">
                            <a-table
                                :row-key="record => record.key"
                                :columns="columns"
                                :data-source="dataSource"
                                :scroll="{ x: 'max-content' }"
                                :pagination="false"
                                class="h-full"
                            >
                                <template #bodyCell="{ column, text, record }">
                                    <template v-if="['frais', 'amount'].includes(column.dataIndex)">
                                        <div>
                                            <a-input
                                                v-if="editableData[record.key]"
                                                v-model:value="editableData[record.key][column.dataIndex]"
                                                style="margin: -5px 0"
                                            >
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-dollar-sign"
                                                                       style="color: rgba(0, 0, 0, 0.5)"
                                                                       class="!me-4 !size-4"/>
                                                </template>
                                            </a-input>
                                            <template v-else>
                                                {{ text }}
                                            </template>
                                        </div>
                                    </template>
                                    <template v-else-if="column.dataIndex === 'operation'">
                                        <div class="flex items-center justify-center gap-2 w-full">
                                            <a-space v-if="editableData[record.key]">
                                                <a-tooltip title="Save">
                                                    <a-button
                                                        size="small"
                                                        class="flex items-center justify-center !py-3.5 !border-success bg-success hover:!bg-emerald-600 text-white hover:!text-white"
                                                        @click="save(record.key)"
                                                    >
                                                        <font-awesome-icon icon="fa-solid fa-save"
                                                                           class="!me-0 !size-3.5"/>
                                                    </a-button>
                                                </a-tooltip>

                                                <a-popconfirm title="Sure to cancel?" @confirm="cancel(record.key)">
                                                    <a-tooltip title="Cancel">
                                                        <a-button
                                                            type="primary" danger
                                                            size="small"
                                                            class="flex items-center justify-center !py-3.5"
                                                        >
                                                            <font-awesome-icon icon="fa-solid fa-ban"
                                                                               class="!me-0 !size-3.5"/>
                                                        </a-button>
                                                    </a-tooltip>

                                                </a-popconfirm>
                                            </a-space>

                                            <a-tooltip title="Edit" v-else>
                                                <a-button
                                                    type="primary"
                                                    size="small"
                                                    class="flex items-center justify-center !py-3.5"
                                                    @click="editRow(record.key)"
                                                >
                                                    <font-awesome-icon icon="fa-solid fa-edit" class="!me-0 !size-3.5"/>
                                                </a-button>
                                            </a-tooltip>
                                        </div>
                                    </template>
                                </template>

                                <template #summary>
                                    <a-table-summary-row class="bg-gray-50">
                                        <a-table-summary-cell :col-span="4"></a-table-summary-cell>
                                        <a-table-summary-cell
                                            class="bg-[#FFFFDF] border border-gray-400 mb-2 text-center text-base font-semibold">
                                            {{ totalFees }}
                                        </a-table-summary-cell>
                                        <a-table-summary-cell :col-span="1"></a-table-summary-cell>
                                        <a-table-summary-cell
                                            class="bg-[#FBDCA0] border border-gray-400 mb-2 text-center text-base font-bold">
                                            {{ totalAmount }} Ar
                                        </a-table-summary-cell>
                                    </a-table-summary-row>
                                </template>
                            </a-table>
                        </a-tab-pane>

                        <a-tab-pane key="3" tab="HISTORIQUES DES ETATS">
                            <a-table
                                :row-key="record => record.key"
                                :columns="tableHistorique"
                                :row-selection="rowSelection"
                                :data-source="dataHistorique"
                                :scroll="{ x: 'max-content' }"
                                :pagination="false"
                                bordered
                                class="h-full"
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
                                                    <font-awesome-icon icon="fa-solid fa-trash"
                                                                       class="!me-0 !size-3.5"/>
                                                </a-button>
                                            </a-tooltip>
                                        </div>
                                    </template>
                                </template>
                            </a-table>
                        </a-tab-pane>

                    </a-tabs>
                </div>

                <div class=" mx-8 my-4 p-4 mb-4 border border-primary bg-[#F1FAFE] rounded-md rounded-b-0 ">
                    <a-row :gutter="[16, 8]">
                        <a-col :span="24" :sm="12" :md="8" :lg="6">
                            <a-form-item label="ETAT">
                                <a-select
                                    v-model="selectedValue"
                                    placeholder="Sélectionnez une option"
                                >
                                    <a-select-option
                                        v-for="option in options"
                                        :key="option.value"
                                        :value="option.value"
                                        :class="['flex items-center justify-center', option.color]"
                                    >
                                        <font-awesome-icon :icon="option.icon"
                                                           :class="[option.color, '!me-2', '!size-4']"/>
                                        {{ option.label }}
                                    </a-select-option>
                                </a-select>
                            </a-form-item>
                        </a-col>
                        <a-col :span="24" :sm="12" :md="8" :lg="6">
                            <a-form-item label="RÉPARATEUR">
                                <a-select v-model:value="statusSel" @change="reloadstatusSel"
                                          placeholder="Please select your zone">
                                    <a-select-option value="published">Published</a-select-option>
                                    <a-select-option value="draft">Draft</a-select-option>
                                    <a-select-option value="pending">Pending</a-select-option>
                                </a-select>
                            </a-form-item>
                        </a-col>
                        <a-col :span="24" :sm="12" :md="8" :lg="12">
                            <a-form-item label="REMARQUE">
                                <a-select
                                    v-model:value="value"
                                    mode="multiple"
                                    style="width: 100%"
                                    placeholder="Please select"
                                    :options="[...Array(25)].map((_, i) => ({ value: (i + 10).toString(36) + (i + 1) }))"
                                    @change="handleChange"
                                ></a-select>
                            </a-form-item>
                        </a-col>
                    </a-row>
                </div>
            </a-form>
            <template #footer class="!pt-40">
                <a-button key="cancel" @click="open = false">Cancel</a-button>
                <a-button key="submit" type="primary" @click="handleOk">Ajouter à la liste</a-button>
            </template>
        </a-modal>
    </div>
</template>

<script setup>
import {cloneDeep} from 'lodash-es';
import {computed, defineComponent, reactive, ref} from 'vue';
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

const open = ref(false);

const collapsed = ref(false);
const showModal = () => {
    open.value = true;
};
const handleOk = e => {
    console.log(e);
    open.value = false;
};


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


const selectedValue = ref(null);
const options = ref([
    {value: 'enattente', label: 'EN ATTENTE', icon: 'fa-clock', color: '!text-gray-500'},
    {value: 'encours', label: 'EN COURS', icon: 'fa-arrows-rotate', color: '!text-yellow-500'},
    {value: 'repare', label: 'REPARE', icon: 'fa-thumbs-up', color: '!text-green-500'},
    {value: 'nom-repare', label: 'NOM REPARE', icon: 'fa-exclamation-circle', color: '!text-blue-500'},
    {value: 'endomage', label: 'ENDOMMAGE', icon: 'fa-times-circle', color: '!text-orange-500'},
    {value: 'annuler', label: 'ANNULER', icon: 'fa-ban', color: '!text-red-500'},
]);

const handleChange = value => {
    console.log(`selected ${value}`);
};
const handleBlur = () => {
    console.log('blur');
};
const handleFocus = () => {
    console.log('focus');
};
const filterOption = (input, option) => {
    return option.value.toLowerCase().indexOf(input.toLowerCase()) >= 0;
};

const columns = [
    {
        title: 'OPERATIONS',
        dataIndex: 'operation',
        fixed: 'right',
        align: 'center',
        width: '5%'
    },
    {
        title: 'AJOUTER',
        dataIndex: 'added',
        key: 'added',
        align: 'center',
        width: '20%',
    },

    {
        title: 'HEURE',
        dataIndex: 'hour',
        key: 'hour',
        align: 'center',
    },

    {
        title: 'TRAVAIL/SERVICE',
        dataIndex: 'machine',
        key: 'machine',
        align: 'center',
    },
    {
        title: 'FRAIS',
        dataIndex: 'frais',
        key: 'frais',
        align: 'center',
    },
    {
        title: 'DETAILS',
        dataIndex: 'details',
        key: 'details',
        align: 'center',
        width: '5%'
    },
    {
        title: 'MONTANT A PAYER',
        dataIndex: 'amount',
        key: 'amount',
        align: 'center',
    }
];
const data = ref([
    {key: 1, machine: 'Machine 1', added: '2023-09-01', hour: '12:00', modified: '2023-09-02', frais: 100, details: '...', amount: 500},
    {key: 2, machine: 'Machine 2', added: '2023-09-03', hour: '14:00', modified: '2023-09-04', frais: 200, details: '...', amount: 300},
]);

const dataSource = ref(data);
const editableData = reactive({});
const editRow = key => {
    editableData[key] = cloneDeep(dataSource.value.filter(item => key === item.key)[0]);
};
const save = key => {
    Object.assign(dataSource.value.filter(item => key === item.key)[0], editableData[key]);
    delete editableData[key];
};
const cancel = key => {
    delete editableData[key];
};

// Gestion de la sélection de lignes
const rowSelection = {
    onChange: (selectedRowKeys, selectedRows) => {
        console.log(`Selected row keys: ${selectedRowKeys}`, 'Selected rows: ', selectedRows);
    },
};
// Calcul des totaux pour le footer
const totalFees = computed(() => data.value.reduce((sum, record) => sum + (record.frais || 0), 0));
const totalAmount = computed(() => data.value.reduce((sum, record) => sum + (record.amount || 0), 0));

const tableHistorique = [
    {
        title: 'ETAT DE LA MACHINE',
        dataIndex: 'machine',
        key: 'machine',
        sorter: (a, b) => a.name.localeCompare(b.name),
        align: 'center',
    },
    {
        title: 'AJOUTE',
        dataIndex: 'machine',
        key: 'machine',
        sorter: (a, b) => a.name.localeCompare(b.name),
        align: 'center',
    },
    {
        title: 'HEURE',
        dataIndex: 'hour',
        key: 'hour',
        sorter: (a, b) => a.hour.localeCompare(b.hour),
        align: 'center',
        width: 80,
    },
    {
        title: 'MODIFIER',
        dataIndex: 'modified',
        key: 'modified',
        sorter: (a, b) => a.modified.localeCompare(b.modified),
        align: 'center',
    }
];


</script>

<style>
.ant-modal .ant-modal-content {
    @apply !p-0
}

.ant-modal .ant-modal-footer {
    @apply px-8 pb-4
}

.ant-modal .ant-modal-header {
    @apply px-8 py-4
}

.modal-open {
    filter: blur(5px);
    transition: filter 0.3s ease-in-out;
}

.ant-modal .ant-modal-footer {
    @apply !pt-4
}
</style>
