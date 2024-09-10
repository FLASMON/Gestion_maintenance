<template>
    <a-space direction="vertical" :size="12">
        <a-date-picker v-model:value="value1" />
        <a-date-picker v-model:value="value2" picker="week" />
        <a-date-picker v-model:value="value3" picker="month" />
        <a-date-picker v-model:value="value4" picker="quarter" />
        <a-date-picker v-model:value="value5" picker="year" />
    </a-space>
</template>
<script setup>
import { ref } from 'vue';
const value1 = ref();
const value2 = ref();
const value3 = ref();
const value4 = ref();
const value5 = ref();
</script>

<template>
    <a-space direction="vertical" :size="12">
        <a-range-picker v-model:value="value1" />
        <a-range-picker v-model:value="value2" show-time />
        <a-range-picker v-model:value="value3" picker="week" />
        <a-range-picker v-model:value="value4" picker="month" />
        <a-range-picker v-model:value="value5" picker="year" />
    </a-space>
</template>
<script setup>
import { ref } from 'vue';
const value1 = ref();
const value2 = ref();
const value3 = ref();
const value4 = ref();
const value5 = ref();
</script>


<template>
    <a-space direction="vertical" :size="12">
        <a-date-picker v-model:value="value1" :format="dateFormat" />
        <a-date-picker v-model:value="value2" :format="dateFormatList" />
        <a-date-picker v-model:value="value3" :format="monthFormat" picker="month" />
        <a-range-picker v-model:value="value4" :format="dateFormat" />
        <a-date-picker v-model:value="value5" :format="customFormat" />
        <a-date-picker v-model:value="value6" :format="customWeekStartEndFormat" picker="week" />
    </a-space>
</template>
<script setup>
import dayjs from 'dayjs';
import { ref } from 'vue';
const dateFormat = 'YYYY/MM/DD';
const weekFormat = 'MM/DD';
const monthFormat = 'YYYY/MM';
const dateFormatList = ['DD/MM/YYYY', 'DD/MM/YY'];
const customWeekStartEndFormat = value =>
    `${dayjs(value).startOf('week').format(weekFormat)} ~ ${dayjs(value)
        .endOf('week')
        .format(weekFormat)}`;
const value1 = ref(dayjs('2015/01/01', dateFormat));
const value2 = ref(dayjs('01/01/2015', dateFormatList[0]));
const value3 = ref(dayjs('2015/01', monthFormat));
const value4 = ref([dayjs('2015/01/01', dateFormat), dayjs('2015/01/01', dateFormat)]);
const value5 = ref(dayjs('2015/01/01', dateFormat));
const value6 = ref(dayjs());
const customFormat = value => `custom format: ${value.format(dateFormat)}`;
</script>


<template>
    <a-space direction="vertical" :size="12">
        <a-date-picker show-time placeholder="Select Time" @change="onChange" @ok="onOk" />
        <a-range-picker
            :show-time="{ format: 'HH:mm' }"
            format="YYYY-MM-DD HH:mm"
            :placeholder="['Start Time', 'End Time']"
            @change="onRangeChange"
            @ok="onRangeOk"
        />
    </a-space>
</template>
<script setup>
const onChange = (value, dateString) => {
    console.log('Selected Time: ', value);
    console.log('Formatted Selected Time: ', dateString);
};
const onOk = value => {
    console.log('onOk: ', value);
};
const onRangeChange = (value, dateString) => {
    console.log('Selected Time: ', value);
    console.log('Formatted Selected Time: ', dateString);
};
const onRangeOk = value => {
    console.log('onOk: ', value);
};
export {};
</script>


<template>
    <a-space direction="vertical">
        <a-date-picker>
            <template #renderExtraFooter>extra footer</template>
        </a-date-picker>
        <a-date-picker show-time>
            <template #renderExtraFooter>extra footer</template>
        </a-date-picker>
        <a-range-picker>
            <template #renderExtraFooter>extra footer</template>
        </a-range-picker>
        <a-range-picker show-time>
            <template #renderExtraFooter>extra footer</template>
        </a-range-picker>
        <a-date-picker placeholder="Select month" picker="month">
            <template #renderExtraFooter>extra footer</template>
        </a-date-picker>
    </a-space>
</template>
