<script setup>
import NavLink from "@/Components/NavLink.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const loggedIn = computed(() => usePage().props.auth.user !== null);
const user = computed(() => usePage().props.auth.user);
</script>

<template>
    <NavLink
        :active="route().current('build.index')"
        :href="route('build.index')"
    >
        Guides</NavLink
    >
    <NavLink
        v-if="loggedIn"
        :active="route().current('build.own.index')"
        :href="route('build.own.index')"
    >
        My Guides</NavLink
    >
    <NavLink
        v-if="loggedIn"
        :href="route('settings.profile')"
        :active="route().current('settings.*')"
    >
        Settings
    </NavLink>
    <NavLink
        v-if="user?.role === 'DEVELOPER' || user?.role === 'ADMIN'"
        :href="route('build.wfa')"
        :active="route().current('build.wfa')"
    >
        Waiting for Approval
    </NavLink>
    <NavLink
        v-if="loggedIn && user.role === 'DEVELOPER'"
        :active="route().current('item.*')"
        :href="route('item.index')"
    >
        Items</NavLink
    >
</template>
