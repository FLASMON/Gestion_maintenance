<template>
    <a-radio v-model:checked="checked">Radio</a-radio>
</template>
<script setup>
import { ref } from 'vue';
const checked = ref(false);
</script>

<template>
    <div>
        <a-radio v-model:checked="checked1" :disabled="disabled">Disabled</a-radio>
        <a-radio v-model:checked="checked2" :disabled="disabled">Disabled</a-radio>
        <br />
        <div style="margin-top: 16px">
            <a-button type="primary" @click="toggleDisabled">Toggle disabled</a-button>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
const disabled = ref(true);
const checked1 = ref(true);
const checked2 = ref(false);
const toggleDisabled = () => {
    disabled.value = !disabled.value;
};
</script>

<template>
    <div>
        <div>
            <a-radio-group v-model:value="value1">
                <a-radio-button value="a">Hangzhou</a-radio-button>
                <a-radio-button value="b">Shanghai</a-radio-button>
                <a-radio-button value="c">Beijing</a-radio-button>
                <a-radio-button value="d">Chengdu</a-radio-button>
            </a-radio-group>
        </div>
        <div :style="{ marginTop: '16px' }">
            <a-radio-group v-model:value="value2">
                <a-radio-button value="a">Hangzhou</a-radio-button>
                <a-radio-button value="b" disabled>Shanghai</a-radio-button>
                <a-radio-button value="c">Beijing</a-radio-button>
                <a-radio-button value="d">Chengdu</a-radio-button>
            </a-radio-group>
        </div>
        <div :style="{ marginTop: '16px' }">
            <a-radio-group v-model:value="value3" disabled>
                <a-radio-button value="a">Hangzhou</a-radio-button>
                <a-radio-button value="b">Shanghai</a-radio-button>
                <a-radio-button value="c">Beijing</a-radio-button>
                <a-radio-button value="d">Chengdu</a-radio-button>
            </a-radio-group>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
const value1 = ref('a');
const value2 = ref('a');
const value3 = ref('a');
</script>



<template>
    <a-radio-group v-model:value="value">
        <a-radio :style="radioStyle" :value="1">Option A</a-radio>
        <a-radio :style="radioStyle" :value="2">Option B</a-radio>
        <a-radio :style="radioStyle" :value="3">Option C</a-radio>
        <a-radio :style="radioStyle" :value="4">
            More...
            <a-input v-if="value === 4" style="width: 100px; margin-left: 10px" />
        </a-radio>
    </a-radio-group>
</template>
<script setup>
import { reactive, ref } from 'vue';
const value = ref(1);
const radioStyle = reactive({
    display: 'flex',
    height: '30px',
    lineHeight: '30px',
});
</script>


<template>
    <a-space direction="vertical">
        <a-radio-group v-model:value="value1" :options="plainOptions" />
        <a-radio-group v-model:value="value2" :options="optionsWithDisabled" />
        <a-radio-group v-model:value="value3" :options="plainOptions" disabled />
        <a-radio-group v-model:value="value1" option-type="button" :options="plainOptions" />
        <a-radio-group v-model:value="value2" option-type="button" :options="optionsWithDisabled" />
        <a-radio-group v-model:value="value3" option-type="button" :options="plainOptions" disabled />
    </a-space>
</template>
<script setup>
import { ref } from 'vue';
const plainOptions = ['Apple', 'Pear', 'Orange'];
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
        disabled: true,
    },
];
const value1 = ref('Apple');
const value2 = ref('Apple');
const value3 = ref('Apple');
</script>


<template>
    <div>
        <a-radio-group v-model:value="value">
            <a-radio :value="1">A</a-radio>
            <a-radio :value="2">B</a-radio>
            <a-radio :value="3">C</a-radio>
            <a-radio :value="4">D</a-radio>
        </a-radio-group>
    </div>
</template>
<script setup>
import { ref } from 'vue';
const value = ref(1);
</script>
