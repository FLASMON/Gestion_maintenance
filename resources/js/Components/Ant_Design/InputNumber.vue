<template>
    <a-space>
        <a-input-number v-model:value="value1" size="large" :min="1" :max="100000" />
        <a-input-number v-model:value="value2" :min="1" :max="100000" />
        <a-input-number v-model:value="value3" size="small" :min="1" :max="100000" />
    </a-space>
</template>
<script setup>
import { ref } from 'vue';
const value1 = ref(3);
const value2 = ref(3);
const value3 = ref(3);
</script>


<template>
    <a-space direction="vertical">
        <a-input-number v-model:value="value1" addon-before="+" addon-after="$"></a-input-number>
        <a-input-number v-model:value="value2">
            <template #addonBefore>
                <a-select v-model:value="addonBeforeValue" style="width: 60px">
                    <a-select-option value="add">+</a-select-option>
                    <a-select-option value="minus">-</a-select-option>
                </a-select>
            </template>
            <template #addonAfter>
                <a-select v-model:value="addonAfterValue" style="width: 60px">
                    <a-select-option value="USD">$</a-select-option>
                    <a-select-option value="EUR">€</a-select-option>
                    <a-select-option value="GBP">£</a-select-option>
                    <a-select-option value="CNY">¥</a-select-option>
                </a-select>
            </template>
        </a-input-number>
        <a-input-number v-model:value="value3">
            <template #addonAfter><SettingOutlined /></template>
        </a-input-number>
        <a-input-number v-model:value="value4">
            <template #addonAfter>
                <a-cascader placeholder="cascader" style="width: 150px" />
            </template>
        </a-input-number>
    </a-space>
</template>
<script setup>
import { ref } from 'vue';
const value1 = ref(100);
const value2 = ref(100);
const value3 = ref(100);
const value4 = ref(100);
const addonBeforeValue = ref('add');
const addonAfterValue = ref('USD');
</script>


<template>
    <a-input-number
        v-model:value="value"
        style="width: 200px"
        :min="0"
        :max="10"
        :step="0.00000000000001"
        string-mode
    />
</template>
<script setup>
import { ref } from 'vue';
const value = ref('1');
</script>


<template>
    <a-space>
        <a-input-number
            v-model:value="value1"
            :formatter="value => `$ ${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
            :parser="value => value.replace(/\$\s?|(,*)/g, '')"
        />
        <a-input-number
            v-model:value="value2"
            :min="0"
            :max="100"
            :formatter="value => `${value}%`"
            :parser="value => value.replace('%', '')"
        />
    </a-space>
</template>
<script setup>
import { ref } from 'vue';
const value1 = ref(1000);
const value2 = ref(100);
</script>
