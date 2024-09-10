<template>
    <a-tabs v-model:activeKey="activeKey">
        <a-tab-pane key="1" tab="Tab 1">Content of Tab Pane 1</a-tab-pane>
        <a-tab-pane key="2" tab="Tab 2" force-render>Content of Tab Pane 2</a-tab-pane>
        <a-tab-pane key="3" tab="Tab 3">Content of Tab Pane 3</a-tab-pane>
    </a-tabs>
</template>
<script setup>
import { ref } from 'vue';
const activeKey = ref('1');
</script>




<template>
    <a-tabs v-model:activeKey="activeKey">
        <a-tab-pane key="1" tab="Tab 1">Tab 1</a-tab-pane>
        <a-tab-pane key="2" tab="Tab 2" disabled>Tab 2</a-tab-pane>
        <a-tab-pane key="3" tab="Tab 3">Tab 3</a-tab-pane>
    </a-tabs>
</template>
<script setup>
import { ref } from 'vue';
const activeKey = ref('1');
</script>



<template>
    <a-tabs v-model:activeKey="activeKey" centered>
        <a-tab-pane key="1" tab="Tab 1">Content of Tab Pane 1</a-tab-pane>
        <a-tab-pane key="2" tab="Tab 2" force-render>Content of Tab Pane 2</a-tab-pane>
        <a-tab-pane key="3" tab="Tab 3">Content of Tab Pane 3</a-tab-pane>
    </a-tabs>
</template>
<script setup>
import { ref } from 'vue';
const activeKey = ref('1');
</script>


<template>
    <a-tabs v-model:activeKey="activeKey">
        <a-tab-pane key="1">
            <template #tab>
        <span>
          <apple-outlined />
          Tab 1
        </span>
            </template>
            Tab 1
        </a-tab-pane>
        <a-tab-pane key="2">
            <template #tab>
        <span>
          <android-outlined />
          Tab 2
        </span>
            </template>
            Tab 2
        </a-tab-pane>
    </a-tabs>
</template>
<script setup>
import { ref } from 'vue';
const activeKey = ref('1');
</script>


<template>
    <div>
        <a-radio-group v-model:value="mode" :style="{ marginBottom: '8px' }">
            <a-radio-button value="top">Horizontal</a-radio-button>
            <a-radio-button value="left">Vertical</a-radio-button>
        </a-radio-group>
        <a-tabs
            v-model:activeKey="activeKey"
            :tab-position="mode"
            :style="{ height: '200px' }"
            @tabScroll="callback"
        >
            <a-tab-pane v-for="i in 30" :key="i" :tab="`Tab-${i}`">Content of tab {{ i }}</a-tab-pane>
        </a-tabs>
    </div>
</template>
<script setup>
import { ref } from 'vue';
const mode = ref('top');
const activeKey = ref(1);
const callback = val => {
    console.log(val);
};
</script>


<template>
    <a-tabs v-model:activeKey="activeKey">
        <a-tab-pane key="1" tab="Tab 1">Content of tab 1</a-tab-pane>
        <a-tab-pane key="2" tab="Tab 2">Content of tab 2</a-tab-pane>
        <a-tab-pane key="3" tab="Tab 3">Content of tab 3</a-tab-pane>
        <template #leftExtra>
            <a-button class="tabs-extra-demo-button">Left Extra Action</a-button>
        </template>
        <template #rightExtra>
            <a-button>Right Extra Action</a-button>
        </template>
    </a-tabs>
</template>
<script setup>
import { ref } from 'vue';
const activeKey = ref('1');
</script>
<style scoped>
.tabs-extra-demo-button {
    margin-right: 16px;
}

.ant-row-rtl .tabs-extra-demo-button {
    margin-right: 0;
    margin-left: 16px;
}
</style>


<template>
    <a-tabs v-model:activeKey="activeKey" type="editable-card" @edit="onEdit">
        <a-tab-pane v-for="pane in panes" :key="pane.key" :tab="pane.title" :closable="pane.closable">
            {{ pane.content }}
        </a-tab-pane>
    </a-tabs>
</template>
<script setup>
import { ref } from 'vue';
const panes = ref([
    {
        title: 'Tab 1',
        content: 'Content of Tab 1',
        key: '1',
    },
    {
        title: 'Tab 2',
        content: 'Content of Tab 2',
        key: '2',
    },
    {
        title: 'Tab 3',
        content: 'Content of Tab 3',
        key: '3',
        closable: false,
    },
]);
const activeKey = ref(panes.value[0].key);
const newTabIndex = ref(0);
const add = () => {
    activeKey.value = `newTab${++newTabIndex.value}`;
    panes.value.push({
        title: 'New Tab',
        content: 'Content of new Tab',
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
const onEdit = (targetKey, action) => {
    if (action === 'add') {
        add();
    } else {
        remove(targetKey);
    }
};
</script>




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
