<template>
    <div>
        <div :style="{ marginBottom: '16px' }">
            <a-button @click="add">ADD</a-button>
        </div>
        <a-tabs v-model:activeKey="activeKey" hide-add type="editable-card" @edit="onEdit">
            <a-tab-pane v-for="pane in panes" :key="pane.key" :tab="pane.title" :closable="pane.closable">
                {{ pane.content }}
            </a-tab-pane>
        </a-tabs>
    </div>
</template>
<script setup>
import { ref } from 'vue';
const panes = ref(
    new Array(2).fill(null).map((_, index) => {
        const id = String(index + 1);
        return {
            title: `Tab ${id}`,
            content: `Content of Tab Pane ${id}`,
            key: id,
        };
    }),
);
const activeKey = ref(panes.value[0].key);
const newTabIndex = ref(0);
const add = () => {
    activeKey.value = `newTab${newTabIndex.value++}`;
    panes.value.push({
        title: `New Tab ${activeKey.value}`,
        content: `Content of new Tab ${activeKey.value}`,
        key: activeKey.value,
    });
};
const remove = targetKey => {
    let lastIndex = 0;
    panes.value.forEach((pane, i) => {
        if (pane.key === targetKey) {
            lastIndex = i - 1;
        }
    });
    panes.value = panes.value.filter(pane => pane.key !== targetKey);
    if (panes.value.length && activeKey.value === targetKey) {
        if (lastIndex >= 0) {
            activeKey.value = panes.value[lastIndex].key;
        } else {
            activeKey.value = panes.value[0].key;
        }
    }
};
const onEdit = targetKey => {
    remove(targetKey);
};
</script>





<template>
    <h4 style="margin-bottom: 16px">Presets:</h4>
    <div>
        <a-tag color="pink">pink</a-tag>
        <a-tag color="red">red</a-tag>
        <a-tag color="orange">orange</a-tag>
        <a-tag color="green">green</a-tag>
        <a-tag color="cyan">cyan</a-tag>
        <a-tag color="blue">blue</a-tag>
        <a-tag color="purple">purple</a-tag>
    </div>
    <h4 style="margin: 16px 0">Custom:</h4>
    <div>
        <a-tag color="#f50">#f50</a-tag>
        <a-tag color="#2db7f5">#2db7f5</a-tag>
        <a-tag color="#87d068">#87d068</a-tag>
        <a-tag color="#108ee9">#108ee9</a-tag>
    </div>
</template>



<template>
    <h4 style="margin-bottom: 16px">Presets:</h4>
    <div>
        <a-tag color="pink">pink</a-tag>
        <a-tag color="red">red</a-tag>
        <a-tag color="orange">orange</a-tag>
        <a-tag color="green">green</a-tag>
        <a-tag color="cyan">cyan</a-tag>
        <a-tag color="blue">blue</a-tag>
        <a-tag color="purple">purple</a-tag>
    </div>
    <h4 style="margin: 16px 0">Custom:</h4>
    <div>
        <a-tag color="#f50">#f50</a-tag>
        <a-tag color="#2db7f5">#2db7f5</a-tag>
        <a-tag color="#87d068">#87d068</a-tag>
        <a-tag color="#108ee9">#108ee9</a-tag>
    </div>
</template>






<template>
    <a-divider orientation="left">Without icon</a-divider>
    <div>
        <a-tag color="success">success</a-tag>
        <a-tag color="processing">processing</a-tag>
        <a-tag color="error">error</a-tag>
        <a-tag color="warning">warning</a-tag>
        <a-tag color="default">default</a-tag>
    </div>
    <a-divider orientation="left">With icon</a-divider>
    <div>
        <a-tag color="success">
            <template #icon>
                <check-circle-outlined />
            </template>
            success
        </a-tag>
        <a-tag color="processing">
            <template #icon>
                <sync-outlined :spin="true" />
            </template>
            processing
        </a-tag>
        <a-tag color="error">
            <template #icon>
                <close-circle-outlined />
            </template>
            error
        </a-tag>
        <a-tag color="warning">
            <template #icon>
                <exclamation-circle-outlined />
            </template>
            warning
        </a-tag>
        <a-tag color="default">
            <template #icon>
                <clock-circle-outlined />
            </template>
            waiting
        </a-tag>
        <a-tag color="default">
            <template #icon>
                <minus-circle-outlined />
            </template>
            stop
        </a-tag>
    </div>
</template>
<script setup>
export {};
</script>
