<script setup>
import { computed, onMounted, onBeforeUnmount, ref } from "vue";
import AppButton from "./AppButton.vue";
import { IconBell, IconBellFilled, IconX } from "@tabler/icons-vue";
import moment from "moment";
import { Link } from "@inertiajs/vue3";

const notifications = ref([]);
const showingDropdown = ref(false);
let timer = null;

const hasUnread = computed(() => {
    return notifications.value.some((notification) => !notification.read_at);
});

const bellIcon = computed(() => {
    return hasUnread.value ? IconBellFilled : IconBell;
});

const fetchNotifications = () => {
    axios
        .get(route("api.notification.fetch.unread"))
        .then((response) => {
            notifications.value = response.data.notifications;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            timer = setTimeout(fetchNotifications, 10000);
        });
};

const markAllAsRead = () => {
    axios
        .post(route("api.notification.read.all"))
        .then((response) => {
            notifications.value = response.data.notifications;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            showingDropdown.value = false;
        });
};

const readNotification = (notificationId) => {
    axios
        .post(route("api.notification.read", notificationId))
        .then((response) => {
            notifications.value = response.data.notifications;
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            showingDropdown.value = false;
        });
};

const toggleDropdown = () => {
    showingDropdown.value = !showingDropdown.value;
};

const getTimeAgo = (date) => {
    return moment(date).fromNow();
};

onMounted(() => {
    fetchNotifications();
});

onBeforeUnmount(() => {
    clearTimeout(timer);
});
</script>

<template>
    <div>
        <!-- Full Screen Dropdown Overlay -->
        <div
            v-show="showingDropdown"
            class="fixed inset-0 z-40"
            @click="showingDropdown = false"
        ></div>

        <div class="relative group">
            <AppButton plain square @click="toggleDropdown">
                <component :is="bellIcon" class="size-5" />
            </AppButton>

            <transition
                enter-active-class="transition transform ease-out duration-100"
                enter-from-class="translate-x-full opacity-0"
                enter-to-class="translate-x-0 opacity-100"
                leave-active-class="transition transform ease-in duration-75"
                leave-from-class="translate-x-0 opacity-100"
                leave-to-class="translate-x-full opacity-0"
            >
                <div
                    class="absolute top-2 right-2 size-2.5 rounded-full bg-red-500 border-2 border-zinc-950 group-hover:border-zinc-800"
                    v-show="hasUnread"
                ></div>
            </transition>

            <transition
                enter-active-class="transition transform ease-out duration-300"
                enter-from-class="-translate-y-4 opacity-0"
                enter-to-class="translate-y-0 opacity-100"
                leave-active-class="transition ease-in duration-200"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    class="absolute min-w-64 top-full mt-2 right-0 p-1 bg-zinc-900 rounded-xl ring-1 text-zinc-400 ring-white/20 shadow-xl z-50"
                    v-show="showingDropdown"
                >
                    <div class="flex justify-between items-center pl-2">
                        <p class="text-sm/9 font-semibold text-white">
                            Notifications
                        </p>

                        <AppButton
                            plain
                            square
                            @click="markAllAsRead"
                            v-show="notifications.length"
                        >
                            <IconX class="size-4" />
                        </AppButton>
                    </div>
                    <div class="space-y-1" v-if="notifications.length">
                        <Link
                            v-for="notification in notifications"
                            :key="notification.id"
                            :href="notification.data.link ?? '#!'"
                            class="block relative cursor-pointer px-2 py-1 rounded-lg hover:bg-white/5"
                            @click="readNotification(notification.id)"
                        >
                            <div class="flex items-center space-x-2">
                                <p class="text-sm font-semibold text-white">
                                    {{ notification.data.user }}
                                </p>
                                <p
                                    class="text-xs text-zinc-500 truncate flex-1"
                                >
                                    {{ getTimeAgo(notification.created_at) }}
                                </p>
                                <div
                                    v-if="!notification.read_at"
                                    class="size-2 bg-red-500 rounded-full"
                                ></div>
                            </div>

                            <p class="text-sm">
                                {{ notification.data.message }}
                            </p>
                        </Link>
                    </div>
                    <div v-else>
                        <p class="text-sm text-zinc-500 px-2 pb-2">
                            You don't have new notifications.
                        </p>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>
