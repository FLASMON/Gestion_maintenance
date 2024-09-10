<template>
    <a-dropdown :trigger="['click']">

        <a-avatar :style="{'background-color': $page.props.auth.user.color }" :size="28"
                  class="!flex !items-center cursor-pointer hover:ring-4 ring-gray-200 pb-1 mb-1">
            {{ $page.props.auth.user.name.substring(0, 1) }}
        </a-avatar>

        <template #overlay>
            <a-menu class="w-[210px] !text-gray-800">
                <div class="flex flex-col px-2 py-2 text-sm justify-center">
                    <a-avatar :style="{'background-color': $page.props.auth.user.color }" :size="70" class="mx-auto mt-3">
                        <span class="text-3xl relative top-1">{{ $page.props.auth.user.name.substring(0, 1) }}</span>
                    </a-avatar>
                    <div class="font-medium text-center text-lg mt-3">{{ $page.props.auth.user.name }}</div>
                    <div class="truncate text-xs text-center">{{ $page.props.auth.user.email }}</div>
                </div>
                <a-menu-divider/>
                <a-menu-item key="0" class="text-sm !text-gray-800">
                    <Link :href="route('profile.edit')">
                        <font-awesome-icon class="me-1" icon="fa-solid fa-circle-user" />
                        Profile
                    </Link>
                </a-menu-item>
                <a-menu-item key="1" class="text-sm !text-gray-800">
                    <Link :href="route('logout')" method="post" as="fetch">
                        <font-awesome-icon class="me-1" icon="fa-solid fa-right-from-bracket" />
                        Déconnexion
                    </Link>
                </a-menu-item>
            </a-menu>
        </template>
    </a-dropdown>
</template>

<script setup>
import {Link} from '@inertiajs/vue3';</script>

<style scoped>

</style>
