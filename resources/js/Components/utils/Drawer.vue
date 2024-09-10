<template>

    <a-drawer
        v-model:open="open"
        class="custom-class"
        root-class-name="root-class-name"
        :root-style="{ color: 'blue' }"
        style="color: red"
        title="Basic Drawer"
        placement="right"
        @after-open-change="afterOpenChange"
    >
        <a-tabs v-model:activeKey="activeKey">
            <a-tab-pane key="1">
                <template #tab>
        <span>
         <font-awesome-icon icon="fa-solid fa-pager"
                            style="color: rgba(0, 0, 0, 0.5)" class=""/>
          Tab 1
        </span>
                </template>
                Tab 1
            </a-tab-pane>
            <a-tab-pane key="2">
                <template #tab>
        <span>
          <font-awesome-icon icon="fa-solid fa-pager"
                             style="color: rgba(0, 0, 0, 0.5)" class=""/>
          Tab 2
        </span>
                </template>
                Tab 2
            </a-tab-pane>
        </a-tabs>
<!--        <a-list-->
<!--            class="demo-loadmore-list"-->
<!--            :loading="initLoading"-->
<!--            item-layout="horizontal"-->
<!--            :data-source="list"-->
<!--        >-->
<!--            <template #loadMore>-->
<!--                <div-->
<!--                    v-if="!initLoading && !loading"-->
<!--                    :style="{ textAlign: 'center', marginTop: '12px', height: '32px', lineHeight: '32px' }"-->
<!--                >-->
<!--                    <a-button @click="onLoadMore">loading more</a-button>-->
<!--                </div>-->
<!--            </template>-->
<!--            <template #renderItem="{ item }">-->
<!--                <a-list-item>-->
<!--                    <template #actions>-->
<!--                        <a key="list-loadmore-edit">edit</a>-->
<!--                        <a key="list-loadmore-more">more</a>-->
<!--                    </template>-->
<!--                    <a-skeleton avatar :title="false" :loading="!!item.loading" active>-->
<!--                        <a-list-item-meta-->
<!--                            description="Ant Design, a design language for background applications, is refined by Ant UED Team"-->
<!--                        >-->
<!--                            <template #title>-->
<!--                                <a href="https://www.antdv.com/">{{ item.name.last }}</a>-->
<!--                            </template>-->
<!--                            <template #avatar>-->
<!--                                <a-avatar :src="item.picture.large" />-->
<!--                            </template>-->
<!--                        </a-list-item-meta>-->
<!--                    </a-skeleton>-->
<!--                </a-list-item>-->
<!--            </template>-->
<!--        </a-list>-->
    </a-drawer>
</template>
<script setup>
import {onMounted, ref, nextTick, defineModel} from 'vue';
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

const activeKey = ref('1');
const open = defineModel('open');
const afterOpenChange = bool => {
    console.log('open', bool);
};
const showDrawer = () => {
    open.value = true;
};

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

<style>

</style>
