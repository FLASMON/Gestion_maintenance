<template>
    <a-rate v-model:value="value" />
</template>
<script setup>
import { ref } from 'vue';
const value = ref(2);
</script>

<template>
    <a-rate v-model:value="value" allow-half />
</template>
<script setup>
import { ref } from 'vue';
const value = ref(2.5);
</script>

<template>
  <span>
    <a-rate v-model:value="value" :tooltips="desc" />
    <span class="ant-rate-text">{{ desc[value - 1] }}</span>
  </span>
</template>
<script setup>
import { ref } from 'vue';
const value = ref(3);
const desc = ref(['terrible', 'bad', 'normal', 'good', 'wonderful']);
</script>

<template>
    <a-rate :value="2" disabled />
</template>

<template>
    <div>
        <a-rate v-model:value="value1" />
        <span class="ant-rate-text">allowClear: true</span>
        <br />
        <a-rate v-model:value="value2" :allow-clear="false" />
        <span class="ant-rate-text">allowClear: false</span>
    </div>
</template>
<script setup>
import { ref } from 'vue';
const value1 = ref(3);
const value2 = ref(3);
</script>


<template>
    <div>
        <a-rate v-model:value="value1" allow-half>
            <template #character>
                <heart-outlined />
            </template>
        </a-rate>
        <br />
        <a-rate v-model:value="value2" character="A" allow-half style="font-size: 36px" />
        <br />
        <a-rate v-model:value="value3" character="好" allow-half />
        <br />
    </div>
</template>
<script setup>
import { ref } from 'vue';
const value1 = ref(2);
const value2 = ref(2.5);
const value3 = ref(0.5);
</script>
