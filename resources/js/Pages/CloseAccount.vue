<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Account Closure
            </h2>
            <breeze-nav-link :href="route('settings')" :active="route().current('settings')">
                Back to Settings
            </breeze-nav-link>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-hite border-b border-gray-200">
                        Delete Account: Please note that while you will no longer have access to your account, 
                        we are required by law to retain your data for 7 years, 
                        only after this will we completely expunge your data from our records.
                    </div>
                </div>
            </div>
        </div>
      </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
import BreezeNavLink from '@/Components/NavLink'
export default {
    inheritAttrs: false,

    components: {
        BreezeAuthenticatedLayout,
        BreezeNavLink,
    },

}
</script>

<style>

</style>