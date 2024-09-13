<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import AppButton from "@/Components/AppButton.vue";
import GuestLayoutNew from "@/Layouts/GuestLayoutNew.vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayoutNew>
        <Head title="Login" />

        <div class="text-center mb-6">
            <p class="text-3xl font-bold text-white mb-2">Login</p>
            <p class="text-sm">
                Enter your email below to login to your account
            </p>
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block text-sm w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <div class="flex items-center justify-between">
                    <InputLabel for="password" value="Password" />
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="underline text-xs text-zinc-500 hover:text-zinc-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Forgot your password?
                    </Link>
                </div>

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block text-sm w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-zinc-500">Remember me</span>
                </label>
            </div>

            <div class="mt-4 space-y-3">
                <AppButton
                    color="blue"
                    class="w-full"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    type="submit"
                >
                    Log in
                </AppButton>
                <AppButton
                    plain
                    color="white"
                    class="w-full"
                    :href="route('register')"
                >
                    Register
                </AppButton>
            </div>
        </form>
    </GuestLayoutNew>
</template>
