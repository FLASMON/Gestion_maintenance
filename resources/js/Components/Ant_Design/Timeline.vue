<template>
    <a-timeline>
        <a-timeline-item>Create a services site 2015-09-01</a-timeline-item>
        <a-timeline-item>Solve initial network problems 2015-09-01</a-timeline-item>
        <a-timeline-item>Technical testing 2015-09-01</a-timeline-item>
        <a-timeline-item>Network problems being solved 2015-09-01</a-timeline-item>
    </a-timeline>
</template>




<template>
    <a-timeline>
        <a-timeline-item color="green">Create a services site 2015-09-01</a-timeline-item>
        <a-timeline-item color="green">Create a services site 2015-09-01</a-timeline-item>
        <a-timeline-item color="red">
            <p>Solve initial network problems 1</p>
            <p>Solve initial network problems 2</p>
            <p>Solve initial network problems 3 2015-09-01</p>
        </a-timeline-item>
        <a-timeline-item>
            <p>Technical testing 1</p>
            <p>Technical testing 2</p>
            <p>Technical testing 3 2015-09-01</p>
        </a-timeline-item>
        <a-timeline-item color="gray">
            <p>Technical testing 1</p>
            <p>Technical testing 2</p>
            <p>Technical testing 3 2015-09-01</p>
        </a-timeline-item>
        <a-timeline-item color="gray">
            <p>Technical testing 1</p>
            <p>Technical testing 2</p>
            <p>Technical testing 3 2015-09-01</p>
        </a-timeline-item>
        <a-timeline-item color="#00CCFF">
            <template #dot>
                <SmileOutlined />
            </template>
            <p>Custom color testing</p>
        </a-timeline-item>
    </a-timeline>
</template>
<script setup>
export {};
</script>




<template>
    <div>
        <a-timeline pending="Recording..." :reverse="reverse">
            <a-timeline-item>Create a services site 2015-09-01</a-timeline-item>
            <a-timeline-item>Solve initial network problems 2015-09-01</a-timeline-item>
            <a-timeline-item>Technical testing 2015-09-01</a-timeline-item>
        </a-timeline>
        <a-button type="primary" style="margin-top: 16px" @click="handleClick">Toggle Reverse</a-button>
    </div>
</template>
<script setup>
import { ref } from 'vue';
const reverse = ref(false);
const handleClick = () => {
    reverse.value = !reverse.value;
};
</script>




<template>
    <a-timeline>
        <a-timeline-item>Create a services site 2015-09-01</a-timeline-item>
        <a-timeline-item>Solve initial network problems 2015-09-01</a-timeline-item>
        <a-timeline-item color="red">
            <template #dot><clock-circle-outlined style="font-size: 16px" /></template>
            Technical testing 2015-09-01
        </a-timeline-item>
        <a-timeline-item>Network problems being solved 2015-09-01</a-timeline-item>
    </a-timeline>
</template>
<script setup>
export {};
</script>






