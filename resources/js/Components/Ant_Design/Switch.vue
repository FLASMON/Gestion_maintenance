<template>
    <a-switch v-model:checked="checked" />
</template>
<script setup>
import { ref } from 'vue';
const checked = ref(false);
</script>



<template>
    <a-space direction="vertical">
        <a-switch v-model:checked="checked" :disabled="disabled" />
        <a-button type="primary" @click="onToggle">Toggle disabled</a-button>
    </a-space>
</template>
<script setup>
import { ref } from 'vue';
const checked = ref(true);
const disabled = ref(true);
const onToggle = () => {
    disabled.value = !disabled.value;
};
</script>



<template>
    <a-space direction="vertical">
        <a-switch v-model:checked="state.checked1" checked-children="开" un-checked-children="关" />
        <a-switch v-model:checked="state.checked2" checked-children="1" un-checked-children="0" />
        <a-switch v-model:checked="state.checked3">
            <template #checkedChildren><check-outlined /></template>
            <template #unCheckedChildren><close-outlined /></template>
        </a-switch>
    </a-space>
</template>
<script setup>
import { reactive } from 'vue';
const state = reactive({
    checked1: true,
    checked2: false,
    checked3: false,
});
</script>



<template>
    <a-space direction="vertical">
        <a-switch v-model:checked="state.checked1" />
        <a-switch v-model:checked="state.checked2" size="small" />
    </a-space>
</template>
<script setup>
import { reactive } from 'vue';
const state = reactive({
    checked1: true,
    checked2: false,
});
</script>



<template>
    <a-space direction="vertical">
        <a-switch v-model:checked="state.checked1" loading />
        <a-switch v-model:checked="state.checked2" size="small" loading />
    </a-space>
</template>
<script setup>
import { reactive } from 'vue';
const state = reactive({
    checked1: true,
    checked2: false,
});
</script>
