<template>
    <a-radio-group v-model:value="placement" style="margin-right: 8px">
        <a-radio value="top">top</a-radio>
        <a-radio value="right">right</a-radio>
        <a-radio value="bottom">bottom</a-radio>
        <a-radio value="left">left</a-radio>
    </a-radio-group>
    <a-button type="primary" @click="showDrawer">Open</a-button>
    <a-drawer
        title="Basic Drawer"
        :placement="placement"
        :closable="false"
        :open="open"
        @close="onClose"
    >
        <p>Some contents...</p>
        <p>Some contents...</p>
        <p>Some contents...</p>
    </a-drawer>
</template>
<script setup>
import { ref } from 'vue';
const placement = ref('left');
const open = ref(false);
const showDrawer = () => {
    open.value = true;
};
const onClose = () => {
    open.value = false;
};
</script>





<template>
    <a-button type="primary" @click="showDrawer">
        <template #icon><PlusOutlined /></template>
        New account
    </a-button>
    <a-drawer
        title="Create a new account"
        :width="720"
        :open="open"
        :body-style="{ paddingBottom: '80px' }"
        :footer-style="{ textAlign: 'right' }"
        @close="onClose"
    >
        <a-form :model="form" :rules="rules" layout="vertical">
            <a-row :gutter="16">
                <a-col :span="12">
                    <a-form-item label="Name" name="name">
                        <a-input v-model:value="form.name" placeholder="Please enter user name" />
                    </a-form-item>
                </a-col>
                <a-col :span="12">
                    <a-form-item label="Url" name="url">
                        <a-input
                            v-model:value="form.url"
                            style="width: 100%"
                            addon-before="http://"
                            addon-after=".com"
                            placeholder="please enter url"
                        />
                    </a-form-item>
                </a-col>
            </a-row>
            <a-row :gutter="16">
                <a-col :span="12">
                    <a-form-item label="Owner" name="owner">
                        <a-select v-model:value="form.owner" placeholder="Please a-s an owner">
                            <a-select-option value="xiao">Xiaoxiao Fu</a-select-option>
                            <a-select-option value="mao">Maomao Zhou</a-select-option>
                        </a-select>
                    </a-form-item>
                </a-col>
                <a-col :span="12">
                    <a-form-item label="Type" name="type">
                        <a-select v-model:value="form.type" placeholder="Please choose the type">
                            <a-select-option value="private">Private</a-select-option>
                            <a-select-option value="public">Public</a-select-option>
                        </a-select>
                    </a-form-item>
                </a-col>
            </a-row>
            <a-row :gutter="16">
                <a-col :span="12">
                    <a-form-item label="Approver" name="approver">
                        <a-select v-model:value="form.approver" placeholder="Please choose the approver">
                            <a-select-option value="jack">Jack Ma</a-select-option>
                            <a-select-option value="tom">Tom Liu</a-select-option>
                        </a-select>
                    </a-form-item>
                </a-col>
                <a-col :span="12">
                    <a-form-item label="DateTime" name="dateTime">
                        <a-date-picker
                            v-model:value="form.dateTime"
                            style="width: 100%"
                            :get-popup-container="trigger => trigger.parentElement"
                        />
                    </a-form-item>
                </a-col>
            </a-row>
            <a-row :gutter="16">
                <a-col :span="24">
                    <a-form-item label="Description" name="description">
                        <a-textarea
                            v-model:value="form.description"
                            :rows="4"
                            placeholder="please enter url description"
                        />
                    </a-form-item>
                </a-col>
            </a-row>
        </a-form>
        <template #extra>
            <a-space>
                <a-button @click="onClose">Cancel</a-button>
                <a-button type="primary" @click="onClose">Submit</a-button>
            </a-space>
        </template>
    </a-drawer>
</template>
<script setup>
import { reactive, ref } from 'vue';
const form = reactive({
    name: '',
    url: '',
    owner: '',
    type: '',
    approver: '',
    dateTime: null,
    description: '',
});
const rules = {
    name: [
        {
            required: true,
            message: 'Please enter user name',
        },
    ],
    url: [
        {
            required: true,
            message: 'please enter url',
        },
    ],
    owner: [
        {
            required: true,
            message: 'Please select an owner',
        },
    ],
    type: [
        {
            required: true,
            message: 'Please choose the type',
        },
    ],
    approver: [
        {
            required: true,
            message: 'Please choose the approver',
        },
    ],
    dateTime: [
        {
            required: true,
            message: 'Please choose the dateTime',
            type: 'object',
        },
    ],
    description: [
        {
            required: true,
            message: 'Please enter url description',
        },
    ],
};
const open = ref(false);
const showDrawer = () => {
    open.value = true;
};
const onClose = () => {
    open.value = false;
};
</script>





<template>
    <a-button type="primary" @click="showDrawer">Open</a-button>
    <a-drawer
        v-model:open="open"
        title="Multi-level drawer"
        width="520"
        :closable="false"
        :footer-style="{ textAlign: 'right' }"
        @close="onClose"
    >
        <a-button type="primary" @click="showChildrenDrawer">Two-level drawer</a-button>
        <a-drawer v-model:open="childrenDrawer" title="Two-level Drawer" width="320" :closable="false">
            <a-button type="primary" @click="showChildrenDrawer">This is two-level drawer</a-button>
        </a-drawer>

        <template #footer>
            <a-button style="margin-right: 8px" @click="onClose">Cancel</a-button>
            <a-button type="primary" @click="onClose">Submit</a-button>
        </template>
    </a-drawer>
</template>
<script setup>
import { ref } from 'vue';
const open = ref(false);
const childrenDrawer = ref(false);
const showDrawer = () => {
    open.value = true;
};
const onClose = () => {
    open.value = false;
};
const showChildrenDrawer = () => {
    childrenDrawer.value = true;
};
</script>




