<template>
    <a-space direction="vertical">
        <a-time-picker v-model:value="value" />
        <a-time-picker v-model:value="strValue" value-format="HH:mm:ss" />
    </a-space>
</template>
<script setup>
import dayjs from 'dayjs';
import { ref, watch } from 'vue';
const value = ref(dayjs('08:00:00', 'HH:mm:ss'));
const strValue = ref('09:00:00');
watch(value, () => {
    console.log(value.value);
});
watch(strValue, () => {
    console.log(strValue.value);
});
</script>



<template>
    <a-space direction="vertical">
        <a-time-picker :bordered="false" />
        <a-time-range-picker :bordered="false" />
    </a-space>
</template>



<template>
    <a-time-range-picker />
</template>


<template>
    <a-space direction="vertical">
        <a-time-picker v-model:value="value" use12-hours />
        <a-time-picker v-model:value="value" use12-hours format="h:mm:ss A" style="width: 140px" />
        <a-time-picker v-model:value="value" use12-hours format="h:mm a" />
    </a-space>
</template>
<script setup>
import { ref } from 'vue';
const value = ref();
</script>


<template>
    <a-space direction="vertical">
        <a-time-picker v-model:value="value" v-model:open="open" @openChange="handleOpenChange">
            <template #renderExtraFooter="{ prefixCls }">
                <a-button size="small" type="primary" @click="handleClose">OK {{ prefixCls }}</a-button>
            </template>
        </a-time-picker>
        <a-time-picker v-model:value="value" v-model:open="open2">
            <template #renderExtraFooter>
                <a-button size="small" type="primary" @click="handleClose">OK</a-button>
            </template>
        </a-time-picker>
    </a-space>
</template>
<script setup>
import { ref } from 'vue';
const open = ref(false);
const open2 = ref(false);
const value = ref();
const handleOpenChange = openStatus => {
    console.log('open', openStatus);
    open.value = openStatus;
};
const handleClose = () => {
    open.value = false;
    open2.value = false;
};
</script>


<template>
    <a-time-picker v-model:value="value" :minute-step="15" :second-step="10" />
</template>
<script setup>
import { ref } from 'vue';
const value = ref();
</script>




