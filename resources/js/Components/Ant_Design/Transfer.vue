<template>
    <div>
        <a-transfer
            v-model:target-keys="targetKeys"
            v-model:selected-keys="selectedKeys"
            :data-source="mockData"
            :titles="['Source', 'Target']"
            :render="item => item.title"
            :disabled="disabled"
            @change="handleChange"
            @selectChange="handleSelectChange"
            @scroll="handleScroll"
        />
        <a-switch
            v-model:checked="disabled"
            un-checked-children="enabled"
            checked-children="disabled"
            style="margin-top: 16px"
        />
    </div>
</template>
<script setup>
import { ref } from 'vue';
const mockData = [];
for (let i = 0; i < 20; i++) {
    mockData.push({
        key: i.toString(),
        title: `content${i + 1}`,
        description: `description of content${i + 1}`,
        disabled: i % 3 < 1,
    });
}
const oriTargetKeys = mockData.filter(item => +item.key % 3 > 1).map(item => item.key);
const disabled = ref(false);
const targetKeys = ref(oriTargetKeys);
const selectedKeys = ref(['1', '4']);
const handleChange = (nextTargetKeys, direction, moveKeys) => {
    console.log('targetKeys: ', nextTargetKeys);
    console.log('direction: ', direction);
    console.log('moveKeys: ', moveKeys);
};
const handleSelectChange = (sourceSelectedKeys, targetSelectedKeys) => {
    console.log('sourceSelectedKeys: ', sourceSelectedKeys);
    console.log('targetSelectedKeys: ', targetSelectedKeys);
};
const handleScroll = (direction, e) => {
    console.log('direction:', direction);
    console.log('target:', e.target);
};
</script>





<template>
    <div>
        <a-transfer
            v-model:target-keys="targetKeys"
            v-model:selected-keys="selectedKeys"
            :data-source="mockData"
            :one-way="true"
            :titles="['Source', 'Target']"
            :render="item => item.title"
            :disabled="disabled"
            @change="handleChange"
            @selectChange="handleSelectChange"
            @scroll="handleScroll"
        />
        <a-switch
            v-model:checked="disabled"
            un-checked-children="enabled"
            checked-children="disabled"
            style="margin-top: 16px"
        />
    </div>
</template>
<script setup>
import { ref } from 'vue';
const mockData = [];
for (let i = 0; i < 20; i++) {
    mockData.push({
        key: i.toString(),
        title: `content${i + 1}`,
        description: `description of content${i + 1}`,
        disabled: i % 3 < 1,
    });
}
const disabled = ref(false);
const targetKeys = ref([]);
const selectedKeys = ref(['1', '4']);
const handleChange = (nextTargetKeys, direction, moveKeys) => {
    console.log('targetKeys: ', nextTargetKeys);
    console.log('direction: ', direction);
    console.log('moveKeys: ', moveKeys);
};
const handleSelectChange = (sourceSelectedKeys, targetSelectedKeys) => {
    console.log('sourceSelectedKeys: ', sourceSelectedKeys);
    console.log('targetSelectedKeys: ', targetSelectedKeys);
};
const handleScroll = (direction, e) => {
    console.log('direction:', direction);
    console.log('target:', e.target);
};
</script>




<template>
    <a-transfer
        v-model:target-keys="targetKeys"
        :data-source="mockData"
        show-search
        :filter-option="filterOption"
        :render="item => item.title"
        @change="handleChange"
        @search="handleSearch"
    />
</template>
<script setup>
import { onMounted, ref } from 'vue';
const mockData = ref([]);
const targetKeys = ref([]);
onMounted(() => {
    getMock();
});
const getMock = () => {
    const keys = [];
    const mData = [];
    for (let i = 0; i < 20; i++) {
        const data = {
            key: i.toString(),
            title: `content${i + 1}`,
            description: `description of content${i + 1}`,
            chosen: Math.random() * 2 > 1,
        };
        if (data.chosen) {
            keys.push(data.key);
        }
        mData.push(data);
    }
    mockData.value = mData;
    targetKeys.value = keys;
};
const filterOption = (inputValue, option) => {
    return option.description.indexOf(inputValue) > -1;
};
const handleChange = (keys, direction, moveKeys) => {
    console.log(keys, direction, moveKeys);
};
const handleSearch = (dir, value) => {
    console.log('search:', dir, value);
};
</script>




<template>
    <a-transfer
        v-model:target-keys="targetKeys"
        :data-source="mockData"
        show-search
        :list-style="{
      width: '250px',
      height: '300px',
    }"
        :operations="['to right', 'to left']"
        :render="item => `${item.title}-${item.description}`"
        @change="handleChange"
    >
        <template #footer="{ direction }">
            <a-button
                v-if="direction === 'left'"
                size="small"
                style="float: left; margin: 5px"
                @click="getMock"
            >
                left reload
            </a-button>
            <a-button
                v-else-if="direction === 'right'"
                size="small"
                style="float: right; margin: 5px"
                @click="getMock"
            >
                right reload
            </a-button>
        </template>
        <template #notFoundContent>
            <span>没数据</span>
        </template>
    </a-transfer>
</template>
<script setup>
import { ref, onMounted } from 'vue';
const mockData = ref([]);
const targetKeys = ref([]);
onMounted(() => {
    getMock();
});
const getMock = () => {
    const keys = [];
    const mData = [];
    for (let i = 0; i < 20; i++) {
        const data = {
            key: i.toString(),
            title: `content${i + 1}`,
            description: `description of content${i + 1}`,
            chosen: Math.random() * 2 > 1,
        };
        if (data.chosen) {
            keys.push(data.key);
        }
        mData.push(data);
    }
    mockData.value = mData;
    targetKeys.value = keys;
};
const handleChange = (keys, direction, moveKeys) => {
    console.log(keys, direction, moveKeys);
};
</script>



<template>
    <div>
        <a-transfer
            v-model:target-keys="targetKeys"
            :data-source="mockData"
            :render="item => item.title"
            :disabled="disabled"
            pagination
            @change="handleChange"
        />
        <a-switch
            v-model:checked="disabled"
            un-checked-children="enabled"
            checked-children="disabled"
            style="margin-top: 16px"
        />
    </div>
</template>
<script setup>
import { ref } from 'vue';
const mockData = [];
for (let i = 0; i < 200; i++) {
    mockData.push({
        key: i.toString(),
        title: `content${i + 1}`,
        description: `description of content${i + 1}`,
    });
}
const oriTargetKeys = mockData.filter(item => +item.key % 3 > 1).map(item => item.key);
const disabled = ref(false);
const targetKeys = ref(oriTargetKeys);
const handleChange = (nextTargetKeys, direction, moveKeys) => {
    console.log('targetKeys: ', nextTargetKeys);
    console.log('direction: ', direction);
    console.log('moveKeys: ', moveKeys);
};
</script>




<template>
    <div>
        <a-transfer
            v-model:target-keys="targetKeys"
            :data-source="mockData"
            :disabled="disabled"
            :show-search="showSearch"
            :filter-option="(inputValue, item) => item.title.indexOf(inputValue) !== -1"
            :show-select-all="false"
            @change="onChange"
        >
            <template
                #children="{
          direction,
          filteredItems,
          selectedKeys,
          disabled: listDisabled,
          onItemSelectAll,
          onItemSelect,
        }"
            >
                <a-table
                    :row-selection="
            getRowSelection({
              disabled: listDisabled,
              selectedKeys,
              onItemSelectAll,
              onItemSelect,
            })
          "
                    :columns="direction === 'left' ? leftColumns : rightColumns"
                    :data-source="filteredItems"
                    size="small"
                    :style="{ pointerEvents: listDisabled ? 'none' : null }"
                    :custom-row="
            ({ key, disabled: itemDisabled }) => ({
              onClick: () => {
                if (itemDisabled || listDisabled) return;
                onItemSelect(key, !selectedKeys.includes(key));
              },
            })
          "
                />
            </template>
        </a-transfer>
        <a-switch
            v-model:checked="disabled"
            un-checked-children="disabled"
            checked-children="disabled"
            style="margin-top: 16px"
        />
        <a-switch
            v-model:checked="showSearch"
            un-checked-children="showSearch"
            checked-children="showSearch"
            style="margin-top: 16px"
        />
    </div>
</template>
<script setup>
import { ref } from 'vue';
const mockData = [];
for (let i = 0; i < 10; i++) {
    mockData.push({
        key: i.toString(),
        title: `content${i + 1}`,
        description: `description of content${i + 1}`,
        disabled: i % 4 === 0,
    });
}
const originTargetKeys = mockData.filter(item => +item.key % 3 > 1).map(item => item.key);
const leftTableColumns = [
    {
        dataIndex: 'title',
        title: 'Name',
    },
    {
        dataIndex: 'description',
        title: 'Description',
    },
];
const rightTableColumns = [
    {
        dataIndex: 'title',
        title: 'Name',
    },
];
const targetKeys = ref(originTargetKeys);
const disabled = ref(false);
const showSearch = ref(false);
const leftColumns = ref(leftTableColumns);
const rightColumns = ref(rightTableColumns);
const onChange = nextTargetKeys => {
    console.log('nextTargetKeys', nextTargetKeys);
};
const getRowSelection = ({ disabled, selectedKeys, onItemSelectAll, onItemSelect }) => {
    return {
        getCheckboxProps: item => ({
            disabled: disabled || item.disabled,
        }),
        onSelectAll(selected, selectedRows) {
            const treeSelectedKeys = selectedRows.filter(item => !item.disabled).map(({ key }) => key);
            onItemSelectAll(treeSelectedKeys, selected);
        },
        onSelect({ key }, selected) {
            onItemSelect(key, selected);
        },
        selectedRowKeys: selectedKeys,
    };
};
</script>




<template>
    <div>
        <a-transfer
            v-model:target-keys="targetKeys"
            class="tree-transfer"
            :data-source="dataSource"
            :render="item => item.title"
            :show-select-all="false"
        >
            <template #children="{ direction, selectedKeys, onItemSelect }">
                <a-tree
                    v-if="direction === 'left'"
                    block-node
                    checkable
                    check-strictly
                    default-expand-all
                    :checked-keys="[...selectedKeys, ...targetKeys]"
                    :tree-data="treeData"
                    @check="
            (_, props) => {
              onChecked(props, [...selectedKeys, ...targetKeys], onItemSelect);
            }
          "
                    @select="
            (_, props) => {
              onChecked(props, [...selectedKeys, ...targetKeys], onItemSelect);
            }
          "
                />
            </template>
        </a-transfer>
    </div>
</template>
<script setup>
import { computed, ref } from 'vue';
const tData = [
    {
        key: '0-0',
        title: '0-0',
    },
    {
        key: '0-1',
        title: '0-1',
        children: [
            {
                key: '0-1-0',
                title: '0-1-0',
            },
            {
                key: '0-1-1',
                title: '0-1-1',
            },
        ],
    },
    {
        key: '0-2',
        title: '0-3',
    },
];
const transferDataSource = [];
function flatten(list = []) {
    list.forEach(item => {
        transferDataSource.push(item);
        flatten(item.children);
    });
}
flatten(JSON.parse(JSON.stringify(tData)));
function isChecked(selectedKeys, eventKey) {
    return selectedKeys.indexOf(eventKey) !== -1;
}
function handleTreeData(treeNodes, targetKeys = []) {
    return treeNodes.map(({ children, ...props }) => ({
        ...props,
        disabled: targetKeys.includes(props.key),
        children: handleTreeData(children ?? [], targetKeys),
    }));
}
const targetKeys = ref([]);
const dataSource = ref(transferDataSource);
const treeData = computed(() => {
    return handleTreeData(tData, targetKeys.value);
});
const onChecked = (e, checkedKeys, onItemSelect) => {
    const { eventKey } = e.node;
    onItemSelect(eventKey, !isChecked(checkedKeys, eventKey));
};
</script>
<style scoped>
.tree-transfer .ant-transfer-list:first-child {
    width: 50%;
    flex: none;
}
</style>





