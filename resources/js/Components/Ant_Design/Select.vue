<template>
    <h2>use a-select-option</h2>
    <a-space>
        <a-select
            ref="select"
            v-model:value="value1"
            style="width: 120px"
            @focus="focus"
            @change="handleChange"
        >
            <a-select-option value="jack">Jack</a-select-option>
            <a-select-option value="lucy">Lucy</a-select-option>
            <a-select-option value="disabled" disabled>Disabled</a-select-option>
            <a-select-option value="Yiminghe">yiminghe</a-select-option>
        </a-select>
        <a-select v-model:value="value2" style="width: 120px" disabled>
            <a-select-option value="lucy">Lucy</a-select-option>
        </a-select>
        <a-select v-model:value="value3" style="width: 120px" loading>
            <a-select-option value="lucy">Lucy</a-select-option>
        </a-select>
    </a-space>
    <h2 style="margin-top: 10px">use options (recommend)</h2>
    <a-space>
        <a-select
            ref="select"
            v-model:value="value1"
            style="width: 120px"
            :options="options1"
            @focus="focus"
            @change="handleChange"
        ></a-select>
        <a-select v-model:value="value2" style="width: 120px" disabled :options="options2"></a-select>
        <a-select v-model:value="value3" style="width: 120px" loading :options="options3"></a-select>
    </a-space>
</template>
<script setup>
import { ref } from 'vue';
const value1 = ref('lucy');
const value2 = ref('lucy');
const value3 = ref('lucy');
const options1 = ref([
    {
        value: 'jack',
        label: 'Jack',
    },
    {
        value: 'lucy',
        label: 'Lucy',
    },
    {
        value: 'disabled',
        label: 'Disabled',
        disabled: true,
    },
    {
        value: 'yiminghe',
        label: 'Yiminghe',
    },
]);
const options2 = ref([
    {
        value: 'lucy',
        label: 'Lucy',
    },
]);
const options3 = ref([
    {
        value: 'lucy',
        label: 'Lucy',
    },
]);
const focus = () => {
    console.log('focus');
};
const handleChange = value => {
    console.log(`selected ${value}`);
};
</script>

<template>
    <h2>use a-select-option</h2>
    <a-space>
        <a-select
            ref="select"
            v-model:value="value1"
            style="width: 120px"
            @focus="focus"
            @change="handleChange"
        >
            <a-select-option value="jack">Jack</a-select-option>
            <a-select-option value="lucy">Lucy</a-select-option>
            <a-select-option value="disabled" disabled>Disabled</a-select-option>
            <a-select-option value="Yiminghe">yiminghe</a-select-option>
        </a-select>
        <a-select v-model:value="value2" style="width: 120px" disabled>
            <a-select-option value="lucy">Lucy</a-select-option>
        </a-select>
        <a-select v-model:value="value3" style="width: 120px" loading>
            <a-select-option value="lucy">Lucy</a-select-option>
        </a-select>
    </a-space>
    <h2 style="margin-top: 10px">use options (recommend)</h2>
    <a-space>
        <a-select
            ref="select"
            v-model:value="value1"
            style="width: 120px"
            :options="options1"
            @focus="focus"
            @change="handleChange"
        ></a-select>
        <a-select v-model:value="value2" style="width: 120px" disabled :options="options2"></a-select>
        <a-select v-model:value="value3" style="width: 120px" loading :options="options3"></a-select>
    </a-space>
</template>
<script setup>
import { ref } from 'vue';
const value1 = ref('lucy');
const value2 = ref('lucy');
const value3 = ref('lucy');
const options1 = ref([
    {
        value: 'jack',
        label: 'Jack',
    },
    {
        value: 'lucy',
        label: 'Lucy',
    },
    {
        value: 'disabled',
        label: 'Disabled',
        disabled: true,
    },
    {
        value: 'yiminghe',
        label: 'Yiminghe',
    },
]);
const options2 = ref([
    {
        value: 'lucy',
        label: 'Lucy',
    },
]);
const options3 = ref([
    {
        value: 'lucy',
        label: 'Lucy',
    },
]);
const focus = () => {
    console.log('focus');
};
const handleChange = value => {
    console.log(`selected ${value}`);
};
</script>

<template>
    <a-select
        v-model:value="value"
        mode="tags"
        style="width: 100%"
        placeholder="Tags Mode"
        :options="options"
        @change="handleChange"
    ></a-select>
</template>
<script setup>
import { ref } from 'vue';
const handleChange = value => {
    console.log(`selected ${value}`);
};
const value = ref([]);
const options = [...Array(25)].map((_, i) => ({
    value: (i + 10).toString(36) + (i + 1),
}));
</script>

<template>
    <a-select
        v-model:value="value"
        mode="tags"
        style="width: 100%"
        :token-separators="[',']"
        placeholder="Automatic tokenization"
        :options="options"
        @change="handleChange"
    ></a-select>
</template>
<script setup>
import { ref, watch } from 'vue';
const options = ref([
    {
        value: 'a1',
        label: 'a1',
    },
]);
const value = ref([]);
const handleChange = value => {
    console.log(`selected ${value}`);
};
watch(value, () => {
    console.log('value', value.value);
});
</script>



<template>
    <a-select
        v-model:value="value"
        mode="multiple"
        style="width: 100%"
        placeholder="Please select"
        :options="[...Array(25)].map((_, i) => ({ value: (i + 10).toString(36) + (i + 1) }))"
        @change="handleChange"
    ></a-select>
</template>
<script setup>
import { ref } from 'vue';
const handleChange = value => {
    console.log(`selected ${value}`);
};
const value = ref(['a1', 'b2']);
</script>


<template>
    <a-space>
        <a-select v-model:value="value" style="width: 200px" @change="handleChange">
            <a-select-opt-group>
                <template #label>
          <span>
            <user-outlined />
            Manager
          </span>
                </template>
                <a-select-option value="jack">Jack</a-select-option>
                <a-select-option value="lucy">Lucy</a-select-option>
            </a-select-opt-group>
            <a-select-opt-group label="Engineer">
                <a-select-option value="Yiminghe">yiminghe</a-select-option>
                <a-select-option value="Yiminghe1">yiminghe1</a-select-option>
            </a-select-opt-group>
        </a-select>
        <a-select
            v-model:value="value"
            :options="options"
            style="width: 200px"
            @change="handleChange"
        ></a-select>
    </a-space>
</template>
<script setup>
import { ref } from 'vue';
const handleChange = value => {
    console.log(`selected ${value}`);
};
const options = ref([
    {
        label: 'Manager',
        options: [
            {
                value: 'jack',
                label: 'Jack',
            },
            {
                value: 'lucy',
                label: 'Lucy',
            },
        ],
    },
    {
        label: 'Engineer',
        options: [
            {
                value: 'yiminghe',
                label: 'Yiminghe',
            },
        ],
    },
]);
const value = ref(['lucy']);
</script>




<template>
    <a-select
        v-model:value="value"
        show-search
        placeholder="Select a person"
        style="width: 200px"
        :options="options"
        :filter-option="filterOption"
        @focus="handleFocus"
        @blur="handleBlur"
        @change="handleChange"
    ></a-select>
</template>
<script setup>
import { ref } from 'vue';
const options = ref([
    {
        value: 'jack',
        label: 'Jack',
    },
    {
        value: 'lucy',
        label: 'Lucy',
    },
    {
        value: 'tom',
        label: 'Tom',
    },
]);
const handleChange = value => {
    console.log(`selected ${value}`);
};
const handleBlur = () => {
    console.log('blur');
};
const handleFocus = () => {
    console.log('focus');
};
const filterOption = (input, option) => {
    return option.value.toLowerCase().indexOf(input.toLowerCase()) >= 0;
};
const value = ref(undefined);
</script>




<template>
    <a-space>
        <a-select
            v-model:value="province"
            style="width: 120px"
            :options="provinceData.map(pro => ({ value: pro }))"
        ></a-select>
        <a-select
            v-model:value="secondCity"
            style="width: 120px"
            :options="cities.map(city => ({ value: city }))"
        ></a-select>
    </a-space>
</template>
<script setup>
import { computed, ref, watch } from 'vue';
const provinceData = ['Zhejiang', 'Jiangsu'];
const cityData = {
    Zhejiang: ['Hangzhou', 'Ningbo', 'Wenzhou'],
    Jiangsu: ['Nanjing', 'Suzhou', 'Zhenjiang'],
};
const province = ref(provinceData[0]);
const secondCity = ref(cityData[province.value][0]);
const cities = computed(() => {
    return cityData[province.value];
});
watch(province, val => {
    secondCity.value = cityData[val][0];
});
</script>




<template>
    <a-select
        v-model:value="value"
        placeholder="custom dropdown render"
        style="width: 300px"
        :options="items.map(item => ({ value: item }))"
    >
        <template #dropdownRender="{ menuNode: menu }">
            <v-nodes :vnodes="menu" />
            <a-divider style="margin: 4px 0" />
            <a-space style="padding: 4px 8px">
                <a-input ref="inputRef" v-model:value="name" placeholder="Please enter item" />
                <a-button type="text" @click="addItem">
                    <template #icon>
                        <plus-outlined />
                    </template>
                    Add item
                </a-button>
            </a-space>
        </template>
    </a-select>
</template>
<script setup>
import { defineComponent, ref } from 'vue';
const VNodes = defineComponent({
    props: {
        vnodes: {
            type: Object,
            required: true,
        },
    },
    render() {
        return this.vnodes;
    },
});
let index = 0;
const items = ref(['jack', 'lucy']);
const value = ref();
const inputRef = ref();
const name = ref();
const addItem = e => {
    e.preventDefault();
    console.log('addItem');
    items.value.push(name.value || `New item ${(index += 1)}`);
    name.value = '';
    setTimeout(() => {
        inputRef.value?.focus();
    }, 0);
};
</script>



<template>
    <h2>{{ options.length }} Items</h2>
    <a-select
        v-model:value="value"
        mode="multiple"
        style="width: 100%"
        placeholder="Please select"
        :options="options"
    />
</template>
<script setup>
import { ref } from 'vue';
const options = [];
for (let i = 0; i < 100000; i++) {
    const value = `${i.toString(36)}${i}`;
    options.push({
        value,
        disabled: i === 10,
    });
}
const value = ref(['a10', 'c12']);
</script>



