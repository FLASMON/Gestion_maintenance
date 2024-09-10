<template>
    <a-list
        class="demo-loadmore-list"
        :loading="initLoading"
        item-layout="horizontal"
        :data-source="list"
    >
        <template #loadMore>
            <div
                v-if="!initLoading && !loading"
                :style="{ textAlign: 'center', marginTop: '12px', height: '32px', lineHeight: '32px' }"
            >
                <a-button @click="onLoadMore">loading more</a-button>
            </div>
        </template>
        <template #renderItem="{ item }">
            <a-list-item>
                <template #actions>
                    <a key="list-loadmore-edit">edit</a>
                    <a key="list-loadmore-more">more</a>
                </template>
                <a-skeleton avatar :title="false" :loading="!!item.loading" active>
                    <a-list-item-meta
                        description="Ant Design, a design language for background applications, is refined by Ant UED Team"
                    >
                        <template #title>
                            <a href="https://www.antdv.com/">{{ item.name.last }}</a>
                        </template>
                        <template #avatar>
                            <a-avatar :src="item.picture.large"/>
                        </template>
                    </a-list-item-meta>
                    <div>content</div>
                </a-skeleton>
            </a-list-item>
        </template>
    </a-list>
</template>
<script setup>
import {onMounted, ref, nextTick} from 'vue';

const count = 3;
const fakeDataUrl = `https://randomuser.me/api/?results=${count}&inc=name,gender,email,nat,picture&noinfo`;
const initLoading = ref(true);
const loading = ref(false);
const data = ref([]);
const list = ref([]);
onMounted(() => {
    fetch(fakeDataUrl)
        .then(res => res.json())
        .then(res => {
            initLoading.value = false;
            data.value = res.results;
            list.value = res.results;
        });
});
const onLoadMore = () => {
    loading.value = true;
    list.value = data.value.concat(
        [...new Array(count)].map(() => ({
            loading: true,
            name: {},
            picture: {},
        })),
    );
    fetch(fakeDataUrl)
        .then(res => res.json())
        .then(res => {
            const newData = data.value.concat(res.results);
            loading.value = false;
            data.value = newData;
            list.value = newData;
            nextTick(() => {
                // Resetting window's offsetTop so as to display react-virtualized demo underfloor.
                // In real scene, you can using public method of react-virtualized:
                // https://stackoverflow.com/questions/46700726/how-to-use-public-method-updateposition-of-react-virtualized
                window.dispatchEvent(new Event('resize'));
            });
        });
};
</script>
<style scoped>
.demo-loadmore-list {
    min-height: 350px;
}
</style>


<template>
    <a-list item-layout="vertical" size="large" :pagination="pagination" :data-source="listData">
        <template #footer>
            <div>
                <b>ant design vue</b>
                footer part
            </div>
        </template>
        <template #renderItem="{ item }">
            <a-list-item key="item.title">
                <template #actions>
          <span v-for="{ icon, text } in actions" :key="icon">
            <component :is="icon" style="margin-right: 8px"/>
            {{ text }}
          </span>
                </template>
                <template #extra>
                    <img
                        width="272"
                        alt="logo"
                        src="https://gw.alipayobjects.com/zos/rmsportal/mqaQswcyDLcXyDKnZfES.png"
                    />
                </template>
                <a-list-item-meta :description="item.description">
                    <template #title>
                        <a :href="item.href">{{ item.title }}</a>
                    </template>
                    <template #avatar>
                        <a-avatar :src="item.avatar"/>
                    </template>
                </a-list-item-meta>
                {{ item.content }}
            </a-list-item>
        </template>
    </a-list>
</template>
<script setup>
import {StarOutlined, LikeOutlined, MessageOutlined} from '@ant-design/icons-vue';

const listData = [];
for (let i = 0; i < 23; i++) {
    listData.push({
        href: 'https://www.antdv.com/',
        title: `ant design vue part ${i}`,
        avatar: 'https://joeschmoe.io/api/v1/random',
        description:
            'Ant Design, a design language for background applications, is refined by Ant UED Team.',
        content:
            'We supply a series of design principles, practical patterns and high quality design resources (Sketch and Axure), to help people create their product prototypes beautifully and efficiently.',
    });
}
const pagination = {
    onChange: page => {
        console.log(page);
    },
    pageSize: 3,
};
const actions = [
    {
        icon: StarOutlined,
        text: '156',
    },
    {
        icon: LikeOutlined,
        text: '156',
    },
    {
        icon: MessageOutlined,
        text: '2',
    },
];
</script>


<template>
    <h3 :style="{ margin: '16px 0' }">Small Size</h3>
    <a-list size="small" bordered :data-source="data">
        <template #renderItem="{ item }">
            <a-list-item>{{ item }}</a-list-item>
        </template>
        <template #header>
            <div>Header</div>
        </template>
        <template #footer>
            <div>Footer</div>
        </template>
    </a-list>
    <h3 :style="{ marginBottom: '16px' }">Default Size</h3>
    <a-list bordered :data-source="data">
        <template #renderItem="{ item }">
            <a-list-item>{{ item }}</a-list-item>
        </template>
        <template #header>
            <div>Header</div>
        </template>
        <template #footer>
            <div>Footer</div>
        </template>
    </a-list>
    <h3 :style="{ margin: '16px 0' }">Large Size</h3>
    <a-list size="large" bordered :data-source="data">
        <template #renderItem="{ item }">
            <a-list-item>{{ item }}</a-list-item>
        </template>
        <template #header>
            <div>Header</div>
        </template>
        <template #footer>
            <div>Footer</div>
        </template>
    </a-list>
</template>
<script setup>
const data = [
    'Racing car sprays burning fuel into crowd.',
    'Japanese princess to wed commoner.',
    'Australian walks 100km after outback crash.',
    'Man charged over missing wedding girl.',
    'Los Angeles battles huge wildfires.',
];
</script>



