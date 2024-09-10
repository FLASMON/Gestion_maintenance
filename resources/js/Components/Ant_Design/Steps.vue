<template>
    <a-steps
        :current="1"
        :items="[
      {
        title: 'Finished',
        description,
      },
      {
        title: 'In Progress',
        description,
        subTitle: 'Left 00:00:08',
      },
      {
        title: 'Waiting',
        description,
      },
    ]"
    ></a-steps>
</template>
<script setup>
const description = 'This is a description.';
</script>

<template>
    <a-steps
        :current="1"
        size="small"
        :items="[
      {
        title: 'Finished',
      },
      {
        title: 'In Progress',
      },
      {
        title: 'Waiting',
      },
    ]"
    ></a-steps>
</template>

<template>
    <a-steps :items="items"></a-steps>
</template>
<script setup>
import { h } from 'vue';
import {
    UserOutlined,
    SolutionOutlined,
    LoadingOutlined,
    SmileOutlined,
} from '@ant-design/icons-vue';
const items = [
    {
        title: 'Login',
        status: 'finish',
        icon: h(UserOutlined),
    },
    {
        title: 'Verification',
        status: 'finish',
        icon: h(SolutionOutlined),
    },
    {
        title: 'Pay',
        status: 'process',
        icon: h(LoadingOutlined),
    },
    {
        title: 'Done',
        status: 'wait',
        icon: h(SmileOutlined),
    },
];
</script>


<template>
    <div>
        <a-steps :current="current" :items="items"></a-steps>
        <div class="steps-content">
            {{ steps[current].content }}
        </div>
        <div class="steps-action">
            <a-button v-if="current < steps.length - 1" type="primary" @click="next">Next</a-button>
            <a-button
                v-if="current == steps.length - 1"
                type="primary"
                @click="message.success('Processing complete!')"
            >
                Done
            </a-button>
            <a-button v-if="current > 0" style="margin-left: 8px" @click="prev">Previous</a-button>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
const current = ref(0);
const next = () => {
    current.value++;
};
const prev = () => {
    current.value--;
};
const steps = [
    {
        title: 'First',
        content: 'First-content',
    },
    {
        title: 'Second',
        content: 'Second-content',
    },
    {
        title: 'Last',
        content: 'Last-content',
    },
];
const items = steps.map(item => ({
    key: item.title,
    title: item.title,
}));
</script>
<style scoped>
.steps-content {
    margin-top: 16px;
    border: 1px dashed #e9e9e9;
    border-radius: 6px;
    background-color: #fafafa;
    min-height: 200px;
    text-align: center;
    padding-top: 80px;
}

.steps-action {
    margin-top: 24px;
}

[data-theme='dark'] .steps-content {
    background-color: #2f2f2f;
    border: 1px dashed #404040;
}
</style>


<template>
    <a-steps
        direction="vertical"
        :current="1"
        :items="[
      {
        title: 'Finished',
        description,
      },
      {
        title: 'In Progress',
        description,
      },
      {
        title: 'Waiting',
        description,
      },
    ]"
    ></a-steps>
</template>
<script setup>
const description = 'This is a description.';
</script>


<template>
    <a-steps
        direction="vertical"
        size="small"
        :current="1"
        :items="[
      { title: 'Finished', description },
      {
        title: 'In Progress',
        description,
      },
      {
        title: 'Waiting',
        description,
      },
    ]"
    ></a-steps>
</template>
<script setup>
const description = 'This is a description.';
</script>


<template>
    <div>
        <a-steps
            progress-dot
            :current="1"
            :items="[
        {
          title: 'Finished',
          description: 'This is a description.',
        },
        {
          title: 'In Progress',
          description: 'This is a description.',
        },
        {
          title: 'Waiting',
          description: 'This is a description.',
        },
      ]"
        ></a-steps>
        <a-divider />
        <a-steps
            progress-dot
            :current="1"
            direction="vertical"
            :items="[
        {
          title: 'Finished',
          description: 'This is a description. This is a description.',
        },
        {
          title: 'Finished',
          description: 'This is a description. This is a description.',
        },
        {
          title: 'In Progress',
          description: 'This is a description. This is a description.',
        },
        {
          title: 'Waiting',
          description: 'This is a description.',
        },
        {
          title: 'Waiting',
          description: 'This is a description.',
        },
      ]"
        ></a-steps>
    </div>
</template>
