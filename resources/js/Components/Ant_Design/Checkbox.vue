<template>
    <a-checkbox v-model:checked="checked">Checkbox</a-checkbox>
</template>
<script setup>
import { ref } from 'vue';
const checked = ref(false);
</script>

<template>
    <div>
        <a-checkbox
            v-model:checked="state.checkAll"
            :indeterminate="state.indeterminate"
            @change="onCheckAllChange"
        >
            Check all
        </a-checkbox>
    </div>
    <a-divider />
    <a-checkbox-group v-model:value="state.checkedList" :options="plainOptions" />
</template>
<script setup>
import { reactive, watch } from 'vue';
const plainOptions = ['Apple', 'Pear', 'Orange'];
const state = reactive({
    indeterminate: true,
    checkAll: false,
    checkedList: ['Apple', 'Orange'],
});
const onCheckAllChange = e => {
    Object.assign(state, {
        checkedList: e.target.checked ? plainOptions : [],
        indeterminate: false,
    });
};
watch(
    () => state.checkedList,
    val => {
        state.indeterminate = !!val.length && val.length < plainOptions.length;
        state.checkAll = val.length === plainOptions.length;
    },
);
</script>


<template>
    <a-checkbox-group v-model:value="state.value1" name="checkboxgroup" :options="plainOptions" />
    <br />
    <br />
    <a-checkbox-group v-model:value="state.value2" :options="plainOptions" />
    <br />
    <br />
    <a-checkbox-group v-model:value="state.value3" :options="options" />
    <br />
    <br />
    <a-checkbox-group v-model:value="state.value4" :options="optionsWithDisabled" disabled>
        <template #label="{ label }">
            <span style="color: red">{{ label }}</span>
        </template>
    </a-checkbox-group>
</template>
<script setup>
import { reactive } from 'vue';
const plainOptions = ['Apple', 'Pear', 'Orange'];
const options = [
    {
        label: 'Apple',
        value: 'Apple',
    },
    {
        label: 'Pear',
        value: 'Pear',
    },
    {
        label: 'Orange',
        value: 'Orange',
    },
];
const optionsWithDisabled = [
    {
        label: 'Apple',
        value: 'Apple',
    },
    {
        label: 'Pear',
        value: 'Pear',
    },
    {
        label: 'Orange',
        value: 'Orange',
        disabled: false,
    },
];
const state = reactive({
    value1: [],
    value2: ['Apple'],
    value3: ['Pear'],
    value4: ['Apple'],
});
</script>


<template>
    <a-checkbox-group v-model:value="value" style="width: 100%">
        <a-row>
            <a-col :span="8">
                <a-checkbox value="A">A</a-checkbox>
            </a-col>
            <a-col :span="8">
                <a-checkbox value="B">B</a-checkbox>
            </a-col>
            <a-col :span="8">
                <a-checkbox value="C">C</a-checkbox>
            </a-col>
            <a-col :span="8">
                <a-checkbox value="D">D</a-checkbox>
            </a-col>
            <a-col :span="8">
                <a-checkbox value="E">E</a-checkbox>
            </a-col>
        </a-row>
    </a-checkbox-group>
</template>
<script setup>
import { ref } from 'vue';
const value = ref([]);
</script>
