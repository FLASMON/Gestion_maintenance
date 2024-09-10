<template>
    <a-form
        :model="formState"
        name="basic"
        :label-col="{ span: 8 }"
        :wrapper-col="{ span: 16 }"
        autocomplete="off"
        @finish="onFinish"
        @finishFailed="onFinishFailed"
    >
        <a-form-item
            label="Username"
            name="username"
            :rules="[{ required: true, message: 'Please input your username!' }]"
        >
            <a-input v-model:value="formState.username" />
        </a-form-item>

        <a-form-item
            label="Password"
            name="password"
            :rules="[{ required: true, message: 'Please input your password!' }]"
        >
            <a-input-password v-model:value="formState.password" />
        </a-form-item>

        <a-form-item name="remember" :wrapper-col="{ offset: 8, span: 16 }">
            <a-checkbox v-model:checked="formState.remember">Remember me</a-checkbox>
        </a-form-item>

        <a-form-item :wrapper-col="{ offset: 8, span: 16 }">
            <a-button type="primary" html-type="submit">Submit</a-button>
        </a-form-item>
    </a-form>
</template>
<script setup>
import { reactive } from 'vue';
const formState = reactive({
    username: '',
    password: '',
    remember: true,
});
const onFinish = values => {
    console.log('Success:', values);
};
const onFinishFailed = errorInfo => {
    console.log('Failed:', errorInfo);
};
</script>


<template>
    <a-form :model="formState" :label-col="labelCol" :wrapper-col="wrapperCol">
        <a-form-item label="Activity name">
            <a-input v-model:value="formState.name" />
        </a-form-item>
        <a-form-item label="Instant delivery">
            <a-switch v-model:checked="formState.delivery" />
        </a-form-item>
        <a-form-item label="Activity type">
            <a-checkbox-group v-model:value="formState.type">
                <a-checkbox value="1" name="type">Online</a-checkbox>
                <a-checkbox value="2" name="type">Promotion</a-checkbox>
                <a-checkbox value="3" name="type">Offline</a-checkbox>
            </a-checkbox-group>
        </a-form-item>
        <a-form-item label="Resources">
            <a-radio-group v-model:value="formState.resource">
                <a-radio value="1">Sponsor</a-radio>
                <a-radio value="2">Venue</a-radio>
            </a-radio-group>
        </a-form-item>
        <a-form-item label="Activity form">
            <a-textarea v-model:value="formState.desc" />
        </a-form-item>
        <a-form-item :wrapper-col="{ span: 14, offset: 4 }">
            <a-button type="primary" @click="onSubmit">Create</a-button>
            <a-button style="margin-left: 10px">Cancel</a-button>
        </a-form-item>
    </a-form>
</template>
<script setup>
import { reactive, toRaw } from 'vue';
const formState = reactive({
    name: '',
    delivery: false,
    type: [],
    resource: '',
    desc: '',
});
const onSubmit = () => {
    console.log('submit!', toRaw(formState));
};
const labelCol = {
    style: {
        width: '150px',
    },
};
const wrapperCol = {
    span: 14,
};
</script>

<template>
    <a-form
        layout="inline"
        :model="formState"
        @finish="handleFinish"
        @finishFailed="handleFinishFailed"
    >
        <a-form-item>
            <a-input v-model:value="formState.user" placeholder="Username">
                <template #prefix><UserOutlined style="color: rgba(0, 0, 0, 0.25)" /></template>
            </a-input>
        </a-form-item>
        <a-form-item>
            <a-input v-model:value="formState.password" type="password" placeholder="Password">
                <template #prefix><LockOutlined style="color: rgba(0, 0, 0, 0.25)" /></template>
            </a-input>
        </a-form-item>
        <a-form-item>
            <a-button
                type="primary"
                html-type="submit"
                :disabled="formState.user === '' || formState.password === ''"
            >
                Log in
            </a-button>
        </a-form-item>
    </a-form>
</template>
<script setup>
import { reactive } from 'vue';
const formState = reactive({
    user: '',
    password: '',
});
const handleFinish = values => {
    console.log(values, formState);
};
const handleFinishFailed = errors => {
    console.log(errors);
};
</script>


<template>
    <a-form :layout="formState.layout" :model="formState" v-bind="formItemLayout">
        <a-form-item label="Form Layout">
            <a-radio-group v-model:value="formState.layout">
                <a-radio-button value="horizontal">Horizontal</a-radio-button>
                <a-radio-button value="vertical">Vertical</a-radio-button>
                <a-radio-button value="inline">Inline</a-radio-button>
            </a-radio-group>
        </a-form-item>
        <a-form-item label="Field A">
            <a-input v-model:value="formState.fieldA" placeholder="input placeholder" />
        </a-form-item>
        <a-form-item label="Field B">
            <a-input v-model:value="formState.fieldB" placeholder="input placeholder" />
        </a-form-item>
        <a-form-item :wrapper-col="buttonItemLayout.wrapperCol">
            <a-button type="primary">Submit</a-button>
        </a-form-item>
    </a-form>
</template>
<script setup>
import { computed, reactive } from 'vue';
const formState = reactive({
    layout: 'horizontal',
    fieldA: '',
    fieldB: '',
});
const formItemLayout = computed(() => {
    const { layout } = formState;
    return layout === 'horizontal'
        ? {
            labelCol: {
                span: 4,
            },
            wrapperCol: {
                span: 14,
            },
        }
        : {};
});
const buttonItemLayout = computed(() => {
    const { layout } = formState;
    return layout === 'horizontal'
        ? {
            wrapperCol: {
                span: 14,
                offset: 4,
            },
        }
        : {};
});
</script>


<template>
    <a-checkbox :checked="componentDisabled" @change="e => (componentDisabled = e.target.checked)">
        Form disabled
    </a-checkbox>
    <a-form
        :label-col="labelCol"
        :wrapper-col="wrapperCol"
        layout="horizontal"
        :disabled="componentDisabled"
        style="max-width: 600px"
    >
        <a-form-item label="Checkbox">
            <a-checkbox>checkbox</a-checkbox>
        </a-form-item>
        <a-form-item label="Radio">
            <a-radio-group v-model:value="radioValue">
                <a-radio value="apple">Apple</a-radio>
                <a-radio value="pear">Pear</a-radio>
            </a-radio-group>
        </a-form-item>
        <a-form-item label="Input">
            <a-input />
        </a-form-item>
        <a-form-item label="Select">
            <a-select>
                <a-select-option value="demo">Demo</a-select-option>
            </a-select>
        </a-form-item>
        <a-form-item label="TreeSelect">
            <a-tree-select :tree-data="treeData" />
        </a-form-item>
        <a-form-item label="Cascader">
            <a-cascader :options="options" />
        </a-form-item>
        <a-form-item label="DatePicker">
            <a-date-picker />
        </a-form-item>
        <a-form-item label="RangePicker">
            <a-range-picker />
        </a-form-item>
        <a-form-item label="InputNumber">
            <a-input-number />
        </a-form-item>
        <a-form-item label="TextArea">
            <a-textarea :rows="4" />
        </a-form-item>
        <a-form-item label="Switch">
            <a-switch v-model:checked="checked" />
        </a-form-item>
        <a-form-item label="Upload">
            <a-upload action="/upload.do" list-type="picture-card">
                <div>
                    <PlusOutlined />
                    <div style="margin-top: 8px">Upload</div>
                </div>
            </a-upload>
        </a-form-item>
        <a-form-item label="Button">
            <a-button>Button</a-button>
        </a-form-item>
    </a-form>
</template>
<script setup>
import { ref, reactive } from 'vue';
const componentDisabled = ref(true);
const labelCol = {
    style: {
        width: '150px',
    },
};
const wrapperCol = {
    span: 14,
};
const radioValue = ref('apple');
const treeData = reactive([
    {
        title: 'Light',
        value: 'light',
        children: [
            {
                title: 'Bamboo',
                value: 'bamboo',
            },
        ],
    },
]);
const options = reactive([
    {
        value: 'zhejiang',
        label: 'Zhejiang',
        children: [
            {
                value: 'hangzhou',
                label: 'Hangzhou',
            },
        ],
    },
]);
const checked = ref(false);
</script>

<template>
    <a-form
        :model="formState"
        name="horizontal_login"
        layout="inline"
        autocomplete="off"
        @finish="onFinish"
        @finishFailed="onFinishFailed"
    >
        <a-form-item
            label="Username"
            name="username"
            :rules="[{ required: true, message: 'Please input your username!' }]"
        >
            <a-input v-model:value="formState.username">
                <template #prefix>
                    <UserOutlined class="site-form-item-icon" />
                </template>
            </a-input>
        </a-form-item>

        <a-form-item
            label="Password"
            name="password"
            :rules="[{ required: true, message: 'Please input your password!' }]"
        >
            <a-input-password v-model:value="formState.password">
                <template #prefix>
                    <LockOutlined class="site-form-item-icon" />
                </template>
            </a-input-password>
        </a-form-item>

        <a-form-item>
            <a-button :disabled="disabled" type="primary" html-type="submit">Log in</a-button>
        </a-form-item>
    </a-form>
</template>
<script setup>
import { reactive, computed } from 'vue';
const formState = reactive({
    username: '',
    password: '',
});
const onFinish = values => {
    console.log('Success:', values);
};
const onFinishFailed = errorInfo => {
    console.log('Failed:', errorInfo);
};
const disabled = computed(() => {
    return !(formState.username && formState.password);
});
</script>


<template>
    <a-form
        ref="formRef"
        :model="formState"
        :rules="rules"
        :label-col="labelCol"
        :wrapper-col="wrapperCol"
    >
        <a-form-item ref="name" label="Activity name" name="name">
            <a-input v-model:value="formState.name" />
        </a-form-item>
        <a-form-item label="Activity zone" name="region">
            <a-select v-model:value="formState.region" placeholder="please select your zone">
                <a-select-option value="shanghai">Zone one</a-select-option>
                <a-select-option value="beijing">Zone two</a-select-option>
            </a-select>
        </a-form-item>
        <a-form-item label="Activity time" required name="date1">
            <a-date-picker
                v-model:value="formState.date1"
                show-time
                type="date"
                placeholder="Pick a date"
                style="width: 100%"
            />
        </a-form-item>
        <a-form-item label="Instant delivery" name="delivery">
            <a-switch v-model:checked="formState.delivery" />
        </a-form-item>
        <a-form-item label="Activity type" name="type">
            <a-checkbox-group v-model:value="formState.type">
                <a-checkbox value="1" name="type">Online</a-checkbox>
                <a-checkbox value="2" name="type">Promotion</a-checkbox>
                <a-checkbox value="3" name="type">Offline</a-checkbox>
            </a-checkbox-group>
        </a-form-item>
        <a-form-item label="Resources" name="resource">
            <a-radio-group v-model:value="formState.resource">
                <a-radio value="1">Sponsor</a-radio>
                <a-radio value="2">Venue</a-radio>
            </a-radio-group>
        </a-form-item>
        <a-form-item label="Activity form" name="desc">
            <a-textarea v-model:value="formState.desc" />
        </a-form-item>
        <a-form-item :wrapper-col="{ span: 14, offset: 4 }">
            <a-button type="primary" @click="onSubmit">Create</a-button>
            <a-button style="margin-left: 10px" @click="resetForm">Reset</a-button>
        </a-form-item>
    </a-form>
</template>
<script setup>
import { reactive, ref, toRaw } from 'vue';
const formRef = ref();
const labelCol = {
    span: 5,
};
const wrapperCol = {
    span: 13,
};
const formState = reactive({
    name: '',
    region: undefined,
    date1: undefined,
    delivery: false,
    type: [],
    resource: '',
    desc: '',
});
const rules = {
    name: [
        {
            required: true,
            message: 'Please input Activity name',
            trigger: 'change',
        },
        {
            min: 3,
            max: 5,
            message: 'Length should be 3 to 5',
            trigger: 'blur',
        },
    ],
    region: [
        {
            required: true,
            message: 'Please select Activity zone',
            trigger: 'change',
        },
    ],
    date1: [
        {
            required: true,
            message: 'Please pick a date',
            trigger: 'change',
            type: 'object',
        },
    ],
    type: [
        {
            type: 'array',
            required: true,
            message: 'Please select at least one activity type',
            trigger: 'change',
        },
    ],
    resource: [
        {
            required: true,
            message: 'Please select activity resource',
            trigger: 'change',
        },
    ],
    desc: [
        {
            required: true,
            message: 'Please input activity form',
            trigger: 'blur',
        },
    ],
};
const onSubmit = () => {
    formRef.value
        .validate()
        .then(() => {
            console.log('values', formState, toRaw(formState));
        })
        .catch(error => {
            console.log('error', error);
        });
};
const resetForm = () => {
    formRef.value.resetFields();
};
</script>



<template>
    <a-form
        ref="formRef"
        name="custom-validation"
        :model="formState"
        :rules="rules"
        v-bind="layout"
        @finish="handleFinish"
        @validate="handleValidate"
        @finishFailed="handleFinishFailed"
    >
        <a-form-item has-feedback label="Password" name="pass">
            <a-input v-model:value="formState.pass" type="password" autocomplete="off" />
        </a-form-item>
        <a-form-item has-feedback label="Confirm" name="checkPass">
            <a-input v-model:value="formState.checkPass" type="password" autocomplete="off" />
        </a-form-item>
        <a-form-item has-feedback label="Age" name="age">
            <a-input-number v-model:value="formState.age" />
        </a-form-item>
        <a-form-item :wrapper-col="{ span: 14, offset: 4 }">
            <a-button type="primary" html-type="submit">Submit</a-button>
            <a-button style="margin-left: 10px" @click="resetForm">Reset</a-button>
        </a-form-item>
    </a-form>
</template>
<script setup>
import { reactive, ref } from 'vue';
const formRef = ref();
const formState = reactive({
    pass: '',
    checkPass: '',
    age: undefined,
});
const checkAge = async (_rule, value) => {
    if (!value) {
        return Promise.reject('Please input the age');
    }
    if (!Number.isInteger(value)) {
        return Promise.reject('Please input digits');
    } else {
        if (value < 18) {
            return Promise.reject('Age must be greater than 18');
        } else {
            return Promise.resolve();
        }
    }
};
const validatePass = async (_rule, value) => {
    if (value === '') {
        return Promise.reject('Please input the password');
    } else {
        if (formState.checkPass !== '') {
            formRef.value.validateFields('checkPass');
        }
        return Promise.resolve();
    }
};
const validatePass2 = async (_rule, value) => {
    if (value === '') {
        return Promise.reject('Please input the password again');
    } else if (value !== formState.pass) {
        return Promise.reject("Two inputs don't match!");
    } else {
        return Promise.resolve();
    }
};
const rules = {
    pass: [
        {
            required: true,
            validator: validatePass,
            trigger: 'change',
        },
    ],
    checkPass: [
        {
            validator: validatePass2,
            trigger: 'change',
        },
    ],
    age: [
        {
            validator: checkAge,
            trigger: 'change',
        },
    ],
};
const layout = {
    labelCol: {
        span: 4,
    },
    wrapperCol: {
        span: 14,
    },
};
const handleFinish = values => {
    console.log(values, formState);
};
const handleFinishFailed = errors => {
    console.log(errors);
};
const resetForm = () => {
    formRef.value.resetFields();
};
const handleValidate = (...args) => {
    console.log(args);
};
</script>


<template>
    <a-form
        :model="formState"
        v-bind="layout"
        name="nest-messages"
        :validate-messages="validateMessages"
        @finish="onFinish"
    >
        <a-form-item :name="['user', 'name']" label="Name" :rules="[{ required: true }]">
            <a-input v-model:value="formState.user.name" />
        </a-form-item>
        <a-form-item :name="['user', 'email']" label="Email" :rules="[{ type: 'email' }]">
            <a-input v-model:value="formState.user.email" />
        </a-form-item>
        <a-form-item :name="['user', 'age']" label="Age" :rules="[{ type: 'number', min: 0, max: 99 }]">
            <a-input-number v-model:value="formState.user.age" />
        </a-form-item>
        <a-form-item :name="['user', 'website']" label="Website">
            <a-input v-model:value="formState.user.website" />
        </a-form-item>
        <a-form-item :name="['user', 'introduction']" label="Introduction">
            <a-textarea v-model:value="formState.user.introduction" />
        </a-form-item>
        <a-form-item :wrapper-col="{ ...layout.wrapperCol, offset: 8 }">
            <a-button type="primary" html-type="submit">Submit</a-button>
        </a-form-item>
    </a-form>
</template>
<script setup>
import { reactive } from 'vue';
const layout = {
    labelCol: {
        span: 8,
    },
    wrapperCol: {
        span: 16,
    },
};
const validateMessages = {
    required: '${label} is required!',
    types: {
        email: '${label} is not a valid email!',
        number: '${label} is not a valid number!',
    },
    number: {
        range: '${label} must be between ${min} and ${max}',
    },
};
const formState = reactive({
    user: {
        name: '',
        age: undefined,
        email: '',
        website: '',
        introduction: '',
    },
});
const onFinish = values => {
    console.log('Success:', values);
};
</script>



<template>
    <div>
        <a-form
            ref="formRef"
            name="advanced_search"
            class="ant-advanced-search-form"
            :model="formState"
            @finish="onFinish"
        >
            <a-row :gutter="24">
                <template v-for="i in 10" :key="i">
                    <a-col v-show="expand || i <= 6" :span="8">
                        <a-form-item
                            :name="`field-${i}`"
                            :label="`field-${i}`"
                            :rules="[{ required: true, message: 'input something' }]"
                        >
                            <a-input v-model:value="formState[`field-${i}`]" placeholder="placeholder"></a-input>
                        </a-form-item>
                    </a-col>
                </template>
            </a-row>
            <a-row>
                <a-col :span="24" style="text-align: right">
                    <a-button type="primary" html-type="submit">Search</a-button>
                    <a-button style="margin: 0 8px" @click="() => formRef.resetFields()">Clear</a-button>
                    <a style="font-size: 12px" @click="expand = !expand">
                        <template v-if="expand">
                            <UpOutlined />
                        </template>
                        <template v-else>
                            <DownOutlined />
                        </template>
                        Collapse
                    </a>
                </a-col>
            </a-row>
        </a-form>
        <div class="search-result-list">Search Result List</div>
    </div>
</template>
<script setup>
import { reactive, ref } from 'vue';
const expand = ref(false);
const formRef = ref();
const formState = reactive({});
const onFinish = values => {
    console.log('Received values of form: ', values);
    console.log('formState: ', formState);
};
</script>
<style scoped>
#components-form-demo-advanced-search .ant-form {
    max-width: none;
}
#components-form-demo-advanced-search .search-result-list {
    margin-top: 16px;
    border: 1px dashed #e9e9e9;
    border-radius: 2px;
    background-color: #fafafa;
    min-height: 200px;
    text-align: center;
    padding-top: 80px;
}
[data-theme='dark'] .ant-advanced-search-form {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid #434343;
    padding: 24px;
    border-radius: 2px;
}
[data-theme='dark'] #components-form-demo-advanced-search .search-result-list {
    border: 1px dashed #434343;
    background: rgba(255, 255, 255, 0.04);
}
</style>


<template>
    <a-form
        ref="formRef"
        name="dynamic_form_nest_item"
        :model="dynamicValidateForm"
        @finish="onFinish"
    >
        <a-space
            v-for="(user, index) in dynamicValidateForm.users"
            :key="user.id"
            style="display: flex; margin-bottom: 8px"
            align="baseline"
        >
            <a-form-item
                :name="['users', index, 'first']"
                :rules="{
          required: true,
          message: 'Missing first name',
        }"
            >
                <a-input v-model:value="user.first" placeholder="First Name" />
            </a-form-item>
            <a-form-item
                :name="['users', index, 'last']"
                :rules="{
          required: true,
          message: 'Missing last name',
        }"
            >
                <a-input v-model:value="user.last" placeholder="Last Name" />
            </a-form-item>
            <MinusCircleOutlined @click="removeUser(user)" />
        </a-space>
        <a-form-item>
            <a-button type="dashed" block @click="addUser">
                <PlusOutlined />
                Add user
            </a-button>
        </a-form-item>
        <a-form-item>
            <a-button type="primary" html-type="submit">Submit</a-button>
        </a-form-item>
    </a-form>
</template>
<script setup>
import { reactive, ref } from 'vue';
const formRef = ref();
const dynamicValidateForm = reactive({
    users: [],
});
const removeUser = item => {
    const index = dynamicValidateForm.users.indexOf(item);
    if (index !== -1) {
        dynamicValidateForm.users.splice(index, 1);
    }
};
const addUser = () => {
    dynamicValidateForm.users.push({
        first: '',
        last: '',
        id: Date.now(),
    });
};
const onFinish = values => {
    console.log('Received values of form:', values);
    console.log('dynamicValidateForm.users:', dynamicValidateForm.users);
};
</script>


<template>
    <a-form ref="formRef" :model="formState" name="form_context" v-bind="layout" @finish="onFinish">
        <a-form-item
            name="group"
            label="Group Name"
            :rules="[{ required: true, message: 'Please input group name!' }]"
        >
            <a-input v-model:value="formState.group" />
        </a-form-item>

        <a-form-item label="User List">
            <template v-if="formState.users.length">
                <ul>
                    <template v-for="user in formState.users" :key="user.key">
                        <li class="user">
                            <a-avatar>
                                <template #icon><UserOutlined /></template>
                            </a-avatar>
                            {{ user.name }} - {{ user.age }}
                        </li>
                    </template>
                </ul>
            </template>
            <template v-else>
                <a-typography-text class="ant-form-text" type="secondary">
                    (
                    <SmileOutlined />
                    No user yet. )
                </a-typography-text>
            </template>
        </a-form-item>

        <a-form-item v-bind="tailLayout">
            <a-button html-type="submit" type="primary">Submit</a-button>
            <a-button html-type="button" style="margin: 0 8px" @click="visible = true">Add User</a-button>
        </a-form-item>
    </a-form>
    <a-modal v-model:open="visible" title="Basic Drawer" @ok="onOk">
        <a-form ref="modalFormRef" :model="modalFormState" layout="vertical" name="userForm">
            <a-form-item name="name" label="User Name" :rules="[{ required: true }]">
                <a-input v-model:value="modalFormState.name" />
            </a-form-item>
            <a-form-item name="age" label="User Age" :rules="[{ required: true }]">
                <a-input-number v-model:value="modalFormState.age" />
            </a-form-item>
        </a-form>
    </a-modal>
</template>
<script setup>
import { reactive, ref, watch, toRaw } from 'vue';
const formRef = ref();
const modalFormRef = ref();
const visible = ref(false);
const formState = reactive({
    group: '',
    users: [],
});
const modalFormState = ref({});
watch(
    visible,
    () => {
        modalFormState.value = {};
    },
    {
        flush: 'post',
    },
);
const onOk = () => {
    modalFormRef.value.validateFields().then(() => {
        formState.users.push({
            ...modalFormState.value,
            key: Date.now(),
        });
        visible.value = false;
    });
};
const onFinish = () => {
    console.log('Finish:', toRaw(formState));
};
const layout = {
    labelCol: {
        span: 8,
    },
    wrapperCol: {
        span: 16,
    },
};
const tailLayout = {
    wrapperCol: {
        offset: 8,
        span: 16,
    },
};
</script>
<style scoped>
#components-form-demo-form-context .user {
    margin-bottom: 8px;
}

#components-form-demo-form-context .user .ant-avatar {
    margin-right: 8px;
}

.ant-row-rtl #components-form-demo-form-context .user .ant-avatar {
    margin-right: 0;
    margin-left: 8px;
}
</style>



<template>
    <div>
        <a-button type="primary" @click="visible = true">New Collection</a-button>
        <a-modal
            v-model:open="visible"
            title="Create a new collection"
            ok-text="Create"
            cancel-text="Cancel"
            @ok="onOk"
        >
            <a-form ref="formRef" :model="formState" layout="vertical" name="form_in_modal">
                <a-form-item
                    name="title"
                    label="Title"
                    :rules="[{ required: true, message: 'Please input the title of collection!' }]"
                >
                    <a-input v-model:value="formState.title" />
                </a-form-item>
                <a-form-item name="description" label="Description">
                    <a-textarea v-model:value="formState.description" />
                </a-form-item>
                <a-form-item name="modifier" class="collection-create-form_last-form-item">
                    <a-radio-group v-model:value="formState.modifier">
                        <a-radio value="public">Public</a-radio>
                        <a-radio value="private">Private</a-radio>
                    </a-radio-group>
                </a-form-item>
            </a-form>
        </a-modal>
    </div>
</template>
<script setup>
import { reactive, ref, toRaw } from 'vue';
const formRef = ref();
const visible = ref(false);
const formState = reactive({
    title: '',
    description: '',
    modifier: 'public',
});
const onOk = () => {
    formRef.value
        .validateFields()
        .then(values => {
            console.log('Received values of form: ', values);
            console.log('formState: ', toRaw(formState));
            visible.value = false;
            formRef.value.resetFields();
            console.log('reset formState: ', toRaw(formState));
        })
        .catch(info => {
            console.log('Validate Failed:', info);
        });
};
</script>
<style scoped>
.collection-create-form_last-form-item {
    margin-bottom: 0;
}
</style>


<template>
    <a-form
        :model="formState"
        name="time_related_controls"
        v-bind="formItemLayout"
        @finish="onFinish"
        @finishFailed="onFinishFailed"
    >
        <a-form-item name="date-picker" label="DatePicker" v-bind="config">
            <a-date-picker v-model:value="formState['date-picker']" value-format="YYYY-MM-DD" />
        </a-form-item>
        <a-form-item name="date-time-picker" label="DatePicker[showTime]" v-bind="config">
            <a-date-picker
                v-model:value="formState['date-time-picker']"
                show-time
                format="YYYY-MM-DD HH:mm:ss"
                value-format="YYYY-MM-DD HH:mm:ss"
            />
        </a-form-item>
        <a-form-item name="month-picker" label="MonthPicker" v-bind="config">
            <a-date-picker
                v-model:value="formState['month-picker']"
                value-format="YYYY-MM"
                picker="month"
            />
        </a-form-item>
        <a-form-item name="range-picker" label="RangePicker" v-bind="rangeConfig">
            <a-range-picker v-model:value="formState['range-picker']" value-format="YYYY-MM-DD" />
        </a-form-item>
        <a-form-item name="range-time-picker" label="RangePicker[showTime]" v-bind="rangeConfig">
            <a-range-picker
                v-model:value="formState['range-time-picker']"
                show-time
                format="YYYY-MM-DD HH:mm:ss"
                value-format="YYYY-MM-DD HH:mm:ss"
            />
        </a-form-item>
        <a-form-item name="time-picker" label="TimePicker" v-bind="config">
            <a-time-picker
                v-model:value="formState['time-picker']"
                format="HH:mm:ss"
                value-format="HH:mm:ss"
            />
        </a-form-item>
        <a-form-item
            :wrapper-col="{
        xs: { span: 24, offset: 0 },
        sm: { span: 16, offset: 8 },
      }"
        >
            <a-button type="primary" html-type="submit">Submit</a-button>
        </a-form-item>
    </a-form>
</template>
<script setup>
import { reactive } from 'vue';
const formItemLayout = {
    labelCol: {
        xs: {
            span: 24,
        },
        sm: {
            span: 8,
        },
    },
    wrapperCol: {
        xs: {
            span: 24,
        },
        sm: {
            span: 16,
        },
    },
};
const config = {
    rules: [
        {
            type: 'string',
            required: true,
            message: 'Please select time!',
        },
    ],
};
const rangeConfig = {
    rules: [
        {
            type: 'array',
            required: true,
            message: 'Please select time!',
        },
    ],
};
const formState = reactive({});
const onFinish = values => {
    console.log('Success:', values, formState);
};
const onFinishFailed = errorInfo => {
    console.log('Failed:', errorInfo);
};
</script>


<template>
    <a-form
        :model="formState"
        name="validate_other"
        v-bind="formItemLayout"
        @finishFailed="onFinishFailed"
        @finish="onFinish"
    >
        <a-form-item label="Plain Text">
            <span class="ant-form-text">China</span>
        </a-form-item>
        <a-form-item
            name="select"
            label="Select"
            has-feedback
            :rules="[{ required: true, message: 'Please select your country!' }]"
        >
            <a-select v-model:value="formState.select" placeholder="Please select a country">
                <a-select-option value="china">China</a-select-option>
                <a-select-option value="usa">U.S.A</a-select-option>
            </a-select>
        </a-form-item>

        <a-form-item
            name="select-multiple"
            label="Select[multiple]"
            :rules="[{ required: true, message: 'Please select your favourite colors!', type: 'array' }]"
        >
            <a-select
                v-model:value="formState['select-multiple']"
                mode="multiple"
                placeholder="Please select favourite colors"
            >
                <a-select-option value="red">Red</a-select-option>
                <a-select-option value="green">Green</a-select-option>
                <a-select-option value="blue">Blue</a-select-option>
            </a-select>
        </a-form-item>

        <a-form-item label="InputNumber">
            <a-form-item name="input-number" no-style>
                <a-input-number v-model:value="formState['input-number']" :min="1" :max="10" />
            </a-form-item>
            <span class="ant-form-text">machines</span>
        </a-form-item>

        <a-form-item name="switch" label="Switch">
            <a-switch v-model:checked="formState.switch" />
        </a-form-item>

        <a-form-item name="slider" label="Slider">
            <a-slider
                v-model:value="formState.slider"
                :marks="{
          0: 'A',
          20: 'B',
          40: 'C',
          60: 'D',
          80: 'E',
          100: 'F',
        }"
            />
        </a-form-item>

        <a-form-item name="radio-group" label="Radio.Group">
            <a-radio-group v-model:value="formState['radio-group']">
                <a-radio value="a">item 1</a-radio>
                <a-radio value="b">item 2</a-radio>
                <a-radio value="c">item 3</a-radio>
            </a-radio-group>
        </a-form-item>

        <a-form-item
            name="radio-button"
            label="Radio.Button"
            :rules="[{ required: true, message: 'Please pick an item!' }]"
        >
            <a-radio-group v-model:value="formState['radio-button']">
                <a-radio-button value="a">item 1</a-radio-button>
                <a-radio-button value="b">item 2</a-radio-button>
                <a-radio-button value="c">item 3</a-radio-button>
            </a-radio-group>
        </a-form-item>

        <a-form-item name="checkbox-group" label="Checkbox.Group">
            <a-checkbox-group v-model:value="formState['checkbox-group']">
                <a-row>
                    <a-col :span="8">
                        <a-checkbox value="A" style="line-height: 32px">A</a-checkbox>
                    </a-col>
                    <a-col :span="8">
                        <a-checkbox value="B" style="line-height: 32px" disabled>B</a-checkbox>
                    </a-col>
                    <a-col :span="8">
                        <a-checkbox value="C" style="line-height: 32px">C</a-checkbox>
                    </a-col>
                    <a-col :span="8">
                        <a-checkbox value="D" style="line-height: 32px">D</a-checkbox>
                    </a-col>
                    <a-col :span="8">
                        <a-checkbox value="E" style="line-height: 32px">E</a-checkbox>
                    </a-col>
                    <a-col :span="8">
                        <a-checkbox value="F" style="line-height: 32px">F</a-checkbox>
                    </a-col>
                </a-row>
            </a-checkbox-group>
        </a-form-item>

        <a-form-item name="rate" label="Rate">
            <a-rate v-model:value="formState.rate" allow-half />
        </a-form-item>

        <a-form-item name="upload" label="Upload" extra="longgggggggggggggggggggggggggggggggggg">
            <a-upload
                v-model:fileList="formState.upload"
                name="logo"
                action="/upload.do"
                list-type="picture"
            >
                <a-button>
                    <template #icon><UploadOutlined /></template>
                    Click to upload
                </a-button>
            </a-upload>
        </a-form-item>

        <a-form-item label="Dragger">
            <a-form-item name="dragger" no-style>
                <a-upload-dragger v-model:fileList="formState.dragger" name="files" action="/upload.do">
                    <p class="ant-upload-drag-icon">
                        <InboxOutlined />
                    </p>
                    <p class="ant-upload-text">Click or drag file to this area to upload</p>
                    <p class="ant-upload-hint">Support for a single or bulk upload.</p>
                </a-upload-dragger>
            </a-form-item>
        </a-form-item>

        <a-form-item :wrapper-col="{ span: 12, offset: 6 }">
            <a-button type="primary" html-type="submit">Submit</a-button>
        </a-form-item>
    </a-form>
</template>
<script setup>
import { reactive } from 'vue';
const formItemLayout = {
    labelCol: {
        span: 6,
    },
    wrapperCol: {
        span: 14,
    },
};
const formState = reactive({
    'input-number': 3,
    'checkbox-group': ['A', 'B'],
    rate: 3.5,
});
const onFinish = values => {
    console.log('Success:', values);
};
const onFinishFailed = errorInfo => {
    console.log('Failed:', errorInfo);
};
</script>
