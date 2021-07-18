<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Settings
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-if="$page.props.auth.user.role === 'admin'" class="p-6 bg-hite border-b border-gray-200">
                        Admin Settings
                        <div class="p-6 bg-hite border-b border-gray-200">
                            <inertia-link :href="route('two-fa', `${$page.props.auth.user.uuid}`)" class="underline text-sm text-gray-600 hover:text-gray-900">
                                Two Factor Authentication
                            </inertia-link>
                        </div>
                    </div>
                    <div v-else-if="$page.props.auth.user.role === 'manager'" class="p-6 bg-hite border-b border-gray-200">
                        Manager Settings
                        <div class="p-6 bg-hite border-b border-gray-200">
                            <inertia-link :href="route('two-fa', `${$page.props.auth.user.uuid}`)" class="underline text-sm text-gray-600 hover:text-gray-900">
                                Two Factor Authentication
                            </inertia-link>
                        </div>
                    </div>
                    <div v-else class="p-6 bg-hite border-b border-gray-200">
                        User Settings
                        <div class="p-6 bg-hite border-b border-gray-200">
                            <inertia-link :href="route('two-fa', `${$page.props.auth.user.uuid}`)" class="underline text-sm text-gray-600 hover:text-gray-900">
                                Two Factor Authentication
                            </inertia-link>
                        </div>
                        <div class="p-6 bg-hite border-b border-gray-200">
                            <inertia-link :href="route('pde', `${$page.props.auth.user.uuid}`)" class="underline text-sm text-gray-600 hover:text-gray-900">
                                Pesonal Data Export
                            </inertia-link>
                        </div>
                        <div class="p-6 bg-hite border-b border-gray-200">
                            <inertia-link :href="route('close-account', `${$page.props.auth.user.uuid}`)" class="underline text-sm text-gray-600 hover:text-gray-900">
                                Close Account
                            </inertia-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
export default {
    inheritAttrs: false,

    components: {
        BreezeAuthenticatedLayout,
    },


}
</script>


