<template>
    <a-layout-sider
        id="side-bar"
        v-model:collapsed="collapsed"
        theme="light"
        :width="260"
        breakpoint="lg"
        :collapsed-width="0"
        :trigger="null"
        :zero-width-trigger-style="{ display: 'none' }"
        class="p-0 !fixed h-full !overflow-y-auto z-40 main-scrool"
    >
        <div
            class="bg-[#1D2226] h-full shadow-md shadow-gray-400 p-0 overflow-y-hidden"
        >
            <div class="flex items-center left bg-white shadow-md h-16 px-8">
                <AppLogo class="h-12"/>
                <a-button
                    @click="siderCollapsed"
                    class="!p-1 ml-5 lg:hidden rounded-lg border-none"
                >
                    <font-awesome-icon
                        icon="bars-staggered"
                        class="fa-2x text-gray-800 dark:text-white"
                    />
                </a-button>
            </div>

            <div
                style="height: inherit"
                class="main-scrool !overflow-y-auto pb-20"
            >
                <a-menu
                    :selectedKeys="selectedKeys"
                    class="!border-0 bg-transparent"
                    theme="dark"
                    mode="inline"
                    :openKeys="openKeys"
                    @openChange="handleOpenChange"
                >
                    <a-menu-item key="dashboard" class="menu-item">
                        <Link :href="route('dashboard')">
                            <font-awesome-icon icon="fa-solid fa-house"/>
                            <span class="">Statistiques</span>
                        </Link>
                    </a-menu-item>

                    <a-menu-divider></a-menu-divider>
                    <a-menu-item key="page" class="menu-item">
                        <Link :href="route('page.index')">
                            <font-awesome-icon icon="fa-solid fa-pager"/>
                            <span class="capitalize">Clients</span>
                        </Link>
                    </a-menu-item>

                    <a-menu-divider></a-menu-divider>

                    <a-menu-item key="newsletter" class="menu-item">
                        <Link :href="route('newsletter.index')">
                            <font-awesome-icon icon="fa-solid fa-newspaper"/>
                            <span class="">Bons de reception</span>
                        </Link>
                    </a-menu-item>

                    <a-menu-divider></a-menu-divider>

                    <a-menu-item key="testimonial" class="menu-item">
                        <Link :href="route('testimonial.index')">
                            <font-awesome-icon icon="fa-solid fa-comment-dots"/>
                            <span class="">Bons de sortie</span>
                        </Link>
                    </a-menu-item>

                    <a-menu-divider></a-menu-divider>

                    <a-menu-item key="media" class="menu-item">
                        <Link :href="route('media.index')">
                            <font-awesome-icon icon="fa-solid fa-folder"/>
                            <span class="capitalize">Ateliers</span>
                        </Link>
                    </a-menu-item>

                    <a-menu-divider></a-menu-divider>

                    <a-menu-item key="contact" class="menu-item">
                        <Link :href="route('contact.index')">
                            <font-awesome-icon icon="fa-solid fa-envelope"/>
                            <span class="capitalize">Contact</span>
                        </Link>
                    </a-menu-item>

                    <a-menu-divider></a-menu-divider>

                    <a-menu-item key="profile" class="menu-item">
                        <Link :href="route('profile.edit')">
                            <font-awesome-icon icon="fa-solid fa-cog"/>
                            <span class="capitalize">Paramètres</span>
                        </Link>
                    </a-menu-item>

                    <a-menu-divider></a-menu-divider>

                    <a-sub-menu v-for="(menu, index) in EXTRA_MENU"
                                :key="menu.key ? menu.key : 'E-' + index">

                        <template #title>
                            <font-awesome-icon :icon="menu.icon"/>
                            <span class="capitalize">{{ menu.title.toLowerCase() }}</span>
                        </template>

                        <a-menu-item v-for="sous in menu.sous_menu" :key="sous.key">
                            <Link :href="sous.route">
                                <font-awesome-icon :icon="sous.icon" class="!size-3"/>
                                <span class="capitalize">{{ sous.title }}</span>
                            </Link>
                        </a-menu-item>
                    </a-sub-menu>

                    <a-menu-divider></a-menu-divider>
                </a-menu>
            </div>
        </div>
    </a-layout-sider>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import {defineProps, ref} from "vue";
import AppLogo from "@/Components/AppLogo.vue";

const collapsed = defineModel("collapsed");

const siderCollapsed = () => {
    collapsed.value = !collapsed.value;
};

const props = defineProps({
    selectedKeys: {
        type: Array,
        default: [],
    },

    openKeys: {
        type: String,
        default: "",
    },
});

const EXTRA_MENU = [
    {
        title: "Paramètres",
        key: "blog",
        icon: ['fas', 'pen-to-square'],
        sous_menu: [
            {title: "Général", key: "post", route: route('tags.index'), icon: ['fas', 'fa-genderless']},
            {title: "Boutique Informations", key: "boutiqueInfo", route: route('BoutiqueInfo.index'), icon: ['fas', 'fa-genderless']},
            {title: "Utilisateur / Reparateur", key: "tags", route: route('tags.index'), icon: ['fas', 'fa-genderless']},
            {title: "Machines", key: "categorie", route: route('tags.index'), icon: ['fas', 'fa-genderless']},
            // {title: "Travaux & Pannes", key: "Travaux", route: route('Travaux.index'), icon: ['fas', 'fa-genderless']},
            {title: "Rapports", key: "categorie", route: route('tags.index'), icon: ['fas', 'fa-genderless']},
            {
                title: "Travaux & Pannes",
                key: "Travaux",
                icon: ['fas', 'fa-tools'],
                sous_menu: [
                    {title: "Travaux", key: "travaux", route: route('Travaux.index'), icon: ['fas', 'fa-wrench']},
                    {title: "Pannes", key: "pannes", route: route('Travaux.index'), icon: ['fas', 'fa-tools']}
                ]
            },
        ],
    },


];

</script>

<style>

#side-bar::-webkit-scrollbar {
    @apply !w-[3px];
}

#side-bar .ant-menu-item {
    @apply relative px-3 py-6 m-0 mb-2 w-full rounded-none flex items-center leading-6 text-sm hover:bg-primary hover:rounded-none hover:shadow transition-all duration-300;
}

#side-bar .ant-menu-dark .ant-menu-item-selected {
    @apply !bg-primary
}

#side-bar .ant-menu-dark .menu-item.ant-menu-item-selected::before,
#side-bar .ant-menu-dark .ant-menu-submenu-selected > .ant-menu-submenu-title::before{
    content: '';
    position: absolute;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    border-width: 10px;
    border-style: solid;
    border-color: transparent #f6f8fb transparent transparent;
}

#side-bar .ant-menu-item a {
    @apply flex items-center rounded-none;
}

#side-bar .ant-menu-item svg,
.svg-inline--fa {
    @apply w-5 h-5 me-3;
}

#side-bar .ant-menu-dark {
    @apply !rounded-none
}

#side-bar .ant-menu-inline .ant-menu-submenu {
    @apply hover:bg-primary rounded-none
}

#side-bar .ant-menu-dark.ant-menu-submenu > .ant-menu {
    @apply !bg-[#1178a3]
}

#side-bar .ant-menu-dark.ant-menu-inline .ant-menu-sub.ant-menu-inline {
    @apply bg-[#2C3338]
}

#side-bar .ant-menu-dark .ant-menu-submenu-selected > .ant-menu-submenu-title {
    @apply !bg-primary hover:bg-primary px-0 py-6 m-0 mx-0 w-full rounded-none
}

#side-bar .ant-menu-dark.ant-menu-inline .ant-menu-sub.ant-menu-inline .ant-menu-item {
    @apply hover:text-white hover:bg-transparent transition-all duration-300
}

#side-bar .ant-menu-dark.ant-menu-inline .ant-menu-sub.ant-menu-inline .ant-menu-item.ant-menu-item-selected {
    @apply !bg-transparent
}
</style>
