<script setup>
import AppButton from "@/Components/AppButton.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { inject } from "vue";

const emitter = inject("emitter");
</script>

<template>
    <div class="flex items-center gap-3">
        <AppButton color="blue" @click="emitter.emit('open-new-guide-modal')">
            New Guide</AppButton
        >

        <!-- Settings Dropdown -->
        <Dropdown>
            <template #trigger>
                <div
                    class="flex cursor-pointer justify-center items-center p-1.5 rounded-lg hover:bg-white/10"
                >
                    <img
                        :src="$page.props.auth.user.profile_photo_url"
                        alt=""
                        class="size-6 rounded-md"
                    />
                </div>
            </template>

            <template #content>
                <DropdownLink :href="route('profile.edit')">
                    Profile
                </DropdownLink>
                <DropdownLink :href="route('build.own.index')">
                    My Guides
                </DropdownLink>
                <DropdownLink
                    :href="route('build.wfa')"
                    v-if="
                        $page.props.auth.user.role === 'DEVELOPER' ||
                        $page.props.auth.user.role === 'ADMIN'
                    "
                >
                    Waiting for Approval
                </DropdownLink>
                <DropdownLink :href="route('logout')" method="post" as="button">
                    Log Out
                </DropdownLink>
            </template>
        </Dropdown>
    </div>
</template>
