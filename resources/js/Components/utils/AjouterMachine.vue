<template>
    <div :class="{ 'modal-open': isModalVisible }">
        <a-tooltip title="Ajouter">
            <a-button
                size="small"
                class="flex items-center justify-center !py-3.5 bg-none border-none"
                @click="showModal"
            >
                <font-awesome-icon icon="fa-solid fa-plus" class="!me-0 !size-4"/>
            </a-button>
        </a-tooltip>

        <a-modal v-model:open="open" width="1200px" title="Ajouter une machine" @ok="handleOk">
            <a-form
                :model="formPage"
                name="validate_other"
                layout="vertical"
                autocomplete="off"
                @finish="onFinish"
                @validate="handleValidate"
                @finishFailed="onFinishFailed"
            >
                <div class="px-8 py-6 bg-[#F4FBFE]">

                    <a-row :gutter="[16, 0]">
                        <!-- MACHINES (FAMILLE) -->
                        <a-col :span="24" :sm="12" :md="8" :lg="6">
                            <a-form-item label="MACHINE (FAMILLE)">
                                <a-select
                                    v-model:value="machineFamily"
                                    placeholder="Select a family"
                                    class="w-full sm:w-[300px]"
                                    :options="machineFamilyOptions"
                                    @change="handleMachineFamilyChange"
                                >
                                    <template #dropdownRender="{ menuNode: menu }">
                                        <v-nodes :vnodes="menu" />
                                        <a-divider class="my-4" />
                                        <a-space class="px-2 pb-4">
                                            <a-input
                                                ref="inputRef"
                                                size="large"
                                                v-model:value="name"
                                                placeholder="Enter new family"
                                            >
                                                <template #prefix>
                                                    <font-awesome-icon
                                                        icon="fa-solid fa-plus"
                                                        style="color: rgba(0, 0, 0, 0.5)"
                                                        class="me-4"
                                                    />
                                                </template>
                                            </a-input>
                                            <a-button type="primary" size="large" @click="addMachineFamily">
                                                <font-awesome-icon icon="fa-solid fa-plus" class="!me-0 !size-3.5" />
                                            </a-button>
                                        </a-space>
                                    </template>
                                </a-select>
                            </a-form-item>
                        </a-col>

                        <!-- MARQUE -->
                        <a-col :span="24" :sm="12" :md="8" :lg="6">
                            <a-form-item label="MARQUE">
                                <a-select
                                    v-model:value="brand"
                                    placeholder="Select a brand"
                                    class="w-full sm:w-[300px]"
                                    :options="brandOptions"
                                    @change="handleBrandChange"
                                    :disabled="isBrandDisabled"
                                >
                                    <template #dropdownRender="{ menuNode: menu }">
                                        <v-nodes :vnodes="menu"/>
                                        <a-divider class="my-4"/>
                                        <a-space class="px-2 pb-4">
                                            <a-input ref="inputRef" size="large" v-model:value="name"
                                                     placeholder="Enter new brand">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-plus"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                            <a-button type="primary" size="large" @click="addBrand">
                                                <font-awesome-icon icon="fa-solid fa-plus" class="!me-0 !size-3.5"/>
                                            </a-button>
                                        </a-space>
                                    </template>
                                </a-select>
                            </a-form-item>
                        </a-col>

                        <!-- MODÈLE -->
                        <!-- MODÈLE -->
                        <a-col :span="24" :sm="12" :md="8" :lg="6">
                            <a-form-item label="MODÈLE">
                                <a-select
                                    v-model:value="model"
                                    placeholder="Select a model"
                                    class="w-full sm:w-[300px]"
                                    :options="modelOptions"
                                    @change="handleModelChange"
                                    :disabled="isModelDisabled"
                                >
                                    <template #dropdownRender="{ menuNode: menu }">
                                        <v-nodes :vnodes="menu"/>
                                        <a-divider class="my-4"/>
                                        <a-space class="px-2 pb-4">
                                            <a-input ref="inputRef" size="large" v-model:value="name"
                                                     placeholder="Enter new model">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-plus"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                            <a-button type="primary" size="large" @click="addModel">
                                                <font-awesome-icon icon="fa-solid fa-plus" class="!me-0 !size-3.5"/>
                                            </a-button>
                                        </a-space>
                                    </template>
                                </a-select>
                            </a-form-item>
                        </a-col>

                        <!-- RÉFÉRENCE -->
                        <a-col :span="24" :sm="12" :md="8" :lg="6">
                            <a-form-item label="RÉFÉRENCE">
                                <a-select
                                    v-model:value="reference"
                                    placeholder="Select a reference"
                                    class="w-full sm:w-[300px]"
                                    :options="referenceOptions"
                                    @change="handleReferenceChange"
                                    :disabled="isReferenceDisabled"
                                >
                                    <template #dropdownRender="{ menuNode: menu }">
                                        <v-nodes :vnodes="menu"/>
                                        <a-divider class="my-4"/>
                                        <a-space class="px-2 pb-4">
                                            <a-input ref="inputRef" size="large" v-model:value="name"
                                                     placeholder="Enter new reference">
                                                <template #prefix>
                                                    <font-awesome-icon icon="fa-solid fa-plus"
                                                                       style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                                </template>
                                            </a-input>
                                            <a-button type="primary" size="large" @click="addReference">
                                                <font-awesome-icon icon="fa-solid fa-plus" class="!me-0 !size-3.5"/>
                                            </a-button>
                                        </a-space>
                                    </template>
                                </a-select>
                            </a-form-item>
                        </a-col>

                        <!-- N° SERIE -->
                        <a-col :span="24" :sm="12" :md="8" :lg="12">
                            <a-form-item label="N° SERIE">
                                <a-input v-model:value="serialNumber" autocomplete="off" size="large">
                                    <template #prefix>
                                        <font-awesome-icon icon="fa-solid fa-cable-car"
                                                           style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                    </template>
                                </a-input>
                            </a-form-item>
                        </a-col>

                        <!-- CODE BARRE (Automatique) -->
                        <a-col :span="24" :sm="12" :md="8" :lg="12">
                            <a-form-item label="CODE BARRE (Automatique)">
                                <a-input v-model:value="barcode" autocomplete="off" size="large">
                                    <template #prefix>
                                        <font-awesome-icon icon="fa-solid fa-barcode"
                                                           style="color: rgba(0, 0, 0, 0.5)" class="me-4"/>
                                    </template>
                                </a-input>
                            </a-form-item>
                        </a-col>
                    </a-row>

                </div>
                <div class="px-8 py-4 flex justify-end gap-3 items-center">
                    <a-tooltip title="Supprimer tout">
                        <a-button
                            type="default"
                            size="small"
                            class="flex items-center justify-center !py-4"
                            @click="() => deleteRow(record)"
                        >
                            <font-awesome-icon icon="fa-solid fa-plus" class="!me-0 !size-4"/>
                        </a-button>
                    </a-tooltip>
                    <a-tooltip title="Supprimer tout">
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
                <div class="mx-8 border rounded-md bg-white dark:bg-gray-800">
                    <a-table
                        :row-key="record => record.key"
                        :columns="columns"
                        :data-source="data"
                        :scroll="{ x: 'max-content' }"
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
                                            <font-awesome-icon icon="fa-solid fa-trash" class="!me-0 !size-3.5"/>
                                        </a-button>
                                    </a-tooltip>
                                </div>
                            </template>
                        </template>
                    </a-table>
                </div>

                <div class=" mx-8 my-4 p-4 mb-4 bg-[#F4FBFE] border border-primary rounded-md rounded-b-0 ">
                    <a-row :gutter="[16, 8]">
                        <a-col :span="24" :sm="12" :md="8" :lg="6">
                            <a-form-item label="PRIORITÉ">
                                <a-select v-model:value="statusSel" @change="reloadstatusSel" placeholder="Please select your zone">
                                    <a-select-option value="published">Published</a-select-option>
                                    <a-select-option  value="draft">Draft</a-select-option>
                                    <a-select-option  value="pending">Pending</a-select-option>
                                </a-select>
                            </a-form-item>
                        </a-col>
                        <a-col :span="24" :sm="12" :md="8" :lg="6">
                            <a-form-item label="RÉPARATEUR">
                                <a-select v-model:value="statusSel" @change="reloadstatusSel" placeholder="Please select your zone">
                                    <a-select-option value="published">Published</a-select-option>
                                    <a-select-option  value="draft">Draft</a-select-option>
                                    <a-select-option  value="pending">Pending</a-select-option>
                                </a-select>
                            </a-form-item>
                        </a-col>
                        <a-col :span="24" :sm="12" :md="8" :lg="12">
                            <a-form-item label="REMARQUE">
                                <a-select
                                    v-model:value="value"
                                    mode="tags"
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
import {computed, defineComponent, ref} from 'vue';
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

const open = ref(false);
const name = ref('');
const machineFamily = ref(null);
const brand = ref(null);
const model = ref(null);
const reference = ref(null);
const serialNumber = ref('');
const barcode = ref('');

const machineFamilyOptions = computed(() => [
    { value: 'family1', label: 'Family 1' },
    { value: 'family2', label: 'Family 2' },
]);

const brandOptions = computed(() => [
    { value: 'brand1', label: 'Brand 1' },
    { value: 'brand2', label: 'Brand 2' },
]);

const modelOptions = computed(() => [
    { value: 'model1', label: 'Model 1' },
    { value: 'model2', label: 'Model 2' },
]);

const referenceOptions = computed(() => [
    { value: 'reference1', label: 'Reference 1' },
    { value: 'reference2', label: 'Reference 2' },
]);

const isBrandDisabled = computed(() => !machineFamily.value);
const isModelDisabled = computed(() => !brand.value);
const isReferenceDisabled = computed(() => !model.value);

// const formPage = useForm({
//     machineFamily: null,
//     brand: null,
//     model: null,
//     reference: null,
//     serialNumber: '',
//     barcode: '',
// });


const handleMachineFamilyChange = (value) => {
    brand.value = null;
    model.value = null;
    reference.value = null;
};

const handleBrandChange = (value) => {
    model.value = null;
    reference.value = null;
};

const handleModelChange = (value) => {
    reference.value = null;
};

const handleReferenceChange = () => {};

const showModal = () => {
    open.value = true;
};

const collapsed = ref(false);

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
const addItem = e => {
    e.preventDefault();
    console.log('addItem');
    items.value.push(name.value || `New item ${(index += 1)}`);
    name.value = '';
    setTimeout(() => {
        inputRef.value?.focus();
    }, 0);
};


const handleChange = value => {
    console.log(`selected ${value}`);
};


const columns = [
    {
        title: 'PANNE DECLARE',
        dataIndex: 'machine',
        key: 'machine',
        align: 'center',
    },

    {
        title: 'OPERATIONS',
        key: 'operation',
        fixed: 'right',
        align: 'center',
        width: 150,
    },
];
const data = ref([]);
for (let i = 0; i < 2; i++) {
    data.value.push({
        machine: `ASUS ${i}`,

    });
}


</script>

<style>


.ant-modal .ant-modal-content {
    @apply !p-0
}

.ant-modal .ant-modal-footer {
    @apply px-8 pb-4
}

.ant-modal .ant-modal-header {
    @apply px-8 py-4 !mb-0
}

.modal-open {
    filter: blur(5px) !important;
    transition: filter 0.3s ease-in-out;
}

.ant-modal .ant-modal-footer {
    @apply !pt-4
}

</style>
