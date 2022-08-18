<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Masuk" />
        <h1 class="text-center text-xl mt-2 mb-5">Masuk</h1>

        <BreezeValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="float-right decoration-none text-sm text-gray-600 hover:text-gray-900">
                    Lupa Password?
                </Link>
                <label class="flex items-center">
                    <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">

                <BreezeButton class="ml-4 ml-4 bg-teal-700 hover:bg-teal-900" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Masuk
                </BreezeButton>
            </div>
            <div class="mx-auto text-center mt-2">
                <Link :href="route('register')" class="decoration-none text-sm text-gray-600 hover:text-gray-900">
                    Belum Punya Akun?
                </Link>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
