<template>
    <a-collapse v-model:activeKey="activeKey">
        <a-collapse-panel key="1" header="This is panel header 1">
            <p>{{ text }}</p>
        </a-collapse-panel>
        <a-collapse-panel key="2" header="This is panel header 2">
            <p>{{ text }}</p>
        </a-collapse-panel>
        <a-collapse-panel key="3" header="This is panel header 3" collapsible="disabled">
            <p>{{ text }}</p>
        </a-collapse-panel>
    </a-collapse>
</template>
<script setup>
import { ref, watch } from 'vue';
const text = `A dog is a type of domesticated animal.Known for its loyalty and faithfulness,it can be found as a welcome guest in many households across the world.`;
const activeKey = ref(['1']);
watch(activeKey, val => {
    console.log(val);
});
</script>




<template>
    <a-collapse v-model:activeKey="activeKey" accordion>
        <a-collapse-panel key="1" header="This is panel header 1">
            <p>{{ text }}</p>
        </a-collapse-panel>
        <a-collapse-panel key="2" header="This is panel header 2">
            <p>{{ text }}</p>
        </a-collapse-panel>
        <a-collapse-panel key="3" header="This is panel header 3">
            <p>{{ text }}</p>
        </a-collapse-panel>
    </a-collapse>
</template>
<script setup>
import { ref } from 'vue';
const activeKey = ref([]);
const text = `A dog is a type of domesticated animal.Known for its loyalty and faithfulness,it can be found as a welcome guest in many households across the world.`;
</script>




<template>
    <a-collapse v-model:activeKey="activeKey" @change="changeActivekey">
        <a-collapse-panel key="1" header="This is panel header 1">
            <a-collapse default-active-key="4">
                <a-collapse-panel key="4" header="This is panel nest panel">
                    <p>{{ text }}</p>
                </a-collapse-panel>
            </a-collapse>
        </a-collapse-panel>
        <a-collapse-panel key="2" header="This is panel header 2">
            <p>{{ text }}</p>
        </a-collapse-panel>
        <a-collapse-panel key="3" header="This is panel header 3">
            <p>{{ text }}</p>
        </a-collapse-panel>
    </a-collapse>
</template>
<script setup>
import { ref } from 'vue';
const activeKey = ref([]);
const text = `A dog is a type of domesticated animal.Known for its loyalty and faithfulness,it can be found as a welcome guest in many households across the world.`;
const changeActivekey = key => {
    console.log(key);
};
</script>



<template>
    <a-collapse v-model:activeKey="activeKey" :bordered="false">
        <a-collapse-panel key="1" header="This is panel header 1">
            <p>{{ text }}</p>
        </a-collapse-panel>
        <a-collapse-panel key="2" header="This is panel header 2">
            <p>{{ text }}</p>
        </a-collapse-panel>
        <a-collapse-panel key="3" header="This is panel header 3">
            <p>{{ text }}</p>
        </a-collapse-panel>
    </a-collapse>
</template>
<script setup>
import { ref } from 'vue';
const activeKey = ref(['1']);
const text = `A dog is a type of domesticated animal. Known for its loyalty and faithfulness, it can be found as a welcome guest in many households across the world.`;
</script>




<template>
    <a-collapse
        v-model:activeKey="activeKey"
        :bordered="false"
        style="background: rgb(255, 255, 255)"
    >
        <template #expandIcon="{ isActive }">
            <caret-right-outlined :rotate="isActive ? 90 : 0" />
        </template>
        <a-collapse-panel key="1" header="This is panel header 1" :style="customStyle">
            <p>{{ text }}</p>
        </a-collapse-panel>
        <a-collapse-panel key="2" header="This is panel header 2" :style="customStyle">
            <p>{{ text }}</p>
        </a-collapse-panel>
        <a-collapse-panel key="3" header="This is panel header 3" :style="customStyle">
            <p>{{ text }}</p>
        </a-collapse-panel>
    </a-collapse>
</template>
<script setup>
import { ref } from 'vue';
const activeKey = ref(['1']);
const text = `A dog is a type of domesticated animal.Known for its loyalty and faithfulness,it can be found as a welcome guest in many households across the world.`;
const customStyle =
    'background: #f7f7f7;border-radius: 4px;margin-bottom: 24px;border: 0;overflow: hidden';
</script>




<template>
    <a-collapse v-model:activeKey="activeKey" :expand-icon-position="expandIconPosition">
        <a-collapse-panel key="1" header="This is panel header 1">
            <p>{{ text }}</p>
            <template #extra><setting-outlined @click="handleClick" /></template>
        </a-collapse-panel>
        <a-collapse-panel key="2" header="This is panel header 2">
            <p>{{ text }}</p>
            <template #extra><setting-outlined @click="handleClick" /></template>
        </a-collapse-panel>
        <a-collapse-panel key="3" header="This is panel header 3" collapsible="disabled">
            <p>{{ text }}</p>
            <template #extra><setting-outlined @click="handleClick" /></template>
        </a-collapse-panel>
    </a-collapse>
    <br />
    <span>Expand Icon Position:</span>
    <a-select v-model:value="expandIconPosition">
        <a-select-option value="start">start</a-select-option>
        <a-select-option value="end">end</a-select-option>
    </a-select>
</template>
<script setup>
import { ref, watch } from 'vue';
const text = `A dog is a type of domesticated animal.Known for its loyalty and faithfulness,it can be found as a welcome guest in many households across the world.`;
const activeKey = ref(['1']);
const expandIconPosition = ref('start');
const handleClick = event => {
    // If you don't want click extra trigger collapse, you can prevent this:
    event.stopPropagation();
};
watch(activeKey, val => {
    console.log(val);
});
</script>






<template>
    <a-collapse v-model:activeKey="activeKey" ghost>
        <a-collapse-panel key="1" header="This is panel header 1">
            <p>{{ text }}</p>
        </a-collapse-panel>
        <a-collapse-panel key="2" header="This is panel header 2">
            <p>{{ text }}</p>
        </a-collapse-panel>
        <a-collapse-panel key="3" header="This is panel header 3" collapsible="disabled">
            <p>{{ text }}</p>
        </a-collapse-panel>
    </a-collapse>
</template>
<script setup>
import { ref, watch } from 'vue';
const text = `A dog is a type of domesticated animal.Known for its loyalty and faithfulness,it can be found as a welcome guest in many households across the world.`;
const activeKey = ref(['1']);
watch(activeKey, val => {
    console.log(val);
});
</script>




<template>
    <a-space direction="vertical">
        <a-collapse v-model:activeKey="activeKey" collapsible="header">
            <a-collapse-panel key="1" header="This panel can only be collapsed by clicking text">
                <p>{{ text }}</p>
            </a-collapse-panel>
        </a-collapse>
        <a-collapse v-model:activeKey="activeKey" collapsible="icon">
            <a-collapse-panel key="1" header="This panel can only be collapsed by clicking icon">
                <p>{{ text }}</p>
            </a-collapse-panel>
        </a-collapse>
        <a-collapse collapsible="disabled">
            <a-collapse-panel key="1" header="This panel can't be collapsed">
                <p>{{ text }}</p>
            </a-collapse-panel>
        </a-collapse>
    </a-space>
</template>
<script setup>
import { ref } from 'vue';
const activeKey = ref(['1']);
const text = `A dog is a type of domesticated animal. Known for its loyalty and faithfulness, it can be found as a welcome guest in many households across the world.`;
</script>
<style scoped>
.ant-space {
    width: 100%;
}
</style>






