<template>
    <Head :title="title"/>
    <a-layout
        id="content"
        :has-sider="hasSider"
        class="min-h-screen !bg-[#f6f8fb] bg-fixed"
    >
        <side-bar
            v-if="hasSider"
            v-model:collapsed="siderCollapsed"
            :selected-keys="[selectedMenu]"
            :open-keys="[openMenu]"
        />

        <a-layout-content
            class="flex p-0 bg-[#f6f8fb]"
            :class="{ 'lg:ml-[260px]': hasSider && !siderCollapsed }"
        >
            <div class="mx-auto w-full w-screen-xl pt-0 pb-6 sm:pt-6">
                <a-affix :offset-top="0" @change="affixed = $event">
                    <div
                        class="flex gap-2 items-center sm:px-8"
                        :class="{ affixed: affixed }"
                    >
                        <div v-if="hasSider">
                            <Link
                                type="button"
                                :href="backTo"
                                v-if="backTo"
                                class="inline-flex items-center text-xl p-1 text-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-200"
                            >
                                <font-awesome-icon icon="fa-solid fa-bars"/>
                            </Link>
                            <button
                                type="button"
                                @click="siderCollapsed = !siderCollapsed"
                                v-else
                                class="inline-flex items-center text-xl p-1 mr-4 text-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-200"
                            >
                                <font-awesome-icon icon="fa-solid fa-bars" class="!me-0"/>
                            </button>
                        </div>
                        <h1 class="lg:text-lg xl:text-xl font-semibold">
                            <a-breadcrumb>
                                <a-breadcrumb-item>
                                    <font-awesome-icon icon="fa-solid fa-house" class="!size-4"/>
                                    <span>{{ title }}</span>
                                </a-breadcrumb-item>
                                <a-breadcrumb-item v-if="sous_title">{{ sous_title }}</a-breadcrumb-item>
                            </a-breadcrumb>
                        </h1>

                        <div
                            class="flex items-center gap-6 text-gray-500 ms-auto"
                        >

                            <a-badge :count="9" @click="openDrawer=true" class="cursor-pointer">
                                <font-awesome-icon icon="fa-solid fa-bell" class="!me-0"/>
                            </a-badge>

                            <Link
                                title="Paramètres" :href="route('profile.edit')"
                                class="inline-flex items-center text-sm rounded-lg focus:outline-none focus:ring focus:ring-gray-200"
                            >
                                <font-awesome-icon icon="fa-solid fa-cog" class="!me-0 pb-1"/>
                            </Link>
                            <main-avatar/>
                        </div>
                    </div>
                </a-affix>
                <Drawer v-model:open="openDrawer"></Drawer>
                <div class="pt-8 sm:px-8">
                    <transition name="slide-fade" appear>
                        <div>
                            <slot></slot>
                        </div>
                    </transition>
                </div>
            </div>
        </a-layout-content>
    </a-layout>
</template>

<script setup>
import {defineProps, ref, watch} from "vue";
import {Head, Link, usePage} from "@inertiajs/vue3";
import SideBar from "./Partials/SideBar.vue";
import MainAvatar from "./Partials/MainAvatar.vue";
import {message} from "ant-design-vue";
import Drawer from "@/Components/utils/Drawer.vue";

const affixed = ref(false);
const siderCollapsed = ref(false);

const openDrawer = ref(false)

const props = defineProps({
    title: String,
    sous_title: String,
    fullContent: {
        default: false,
    },
    selectedMenu: {
        type: String,
        default: "Dashboard",
    },
    openMenu: {
        type: String,
        default: "",
    },
    hasSider: {
        type: Boolean,
        default: true,
    },
    backTo: String,
    search: {
        type: Boolean,
        default: false,
    },
});

const page = usePage();
watch(
    () => page.props.messages,
    (data) => {
        console.log("CHANGE MESSAGES");
        if (data.info) {
            message.success(data.info);
        }
        if (data.error) {
            message.error(data.error);
        }
    }
);

</script>

<style scoped>
.affixed {
    @apply motion-safe:bg-white motion-safe:shadow-md motion-safe:py-[16px] motion-safe:px-4 motion-safe:rounded-none transition-all duration-300;
}

.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 600ms ease-out;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    opacity: 0;
    transform: translateY(-100px);
}

.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 600ms ease-in;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    opacity: 0;
    transform: translateY(100px);
}

.ant-badge .ant-badge-count {
    position: absolute;
    top: 0;
    inset-inline-end: 0;
    transform: translate(10%, -50%) !important;
    transform-origin: 100% 0%;
}
</style>
