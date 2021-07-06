<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Personal Data Export
            </h2>
            <breeze-nav-link :href="route('settings')" :active="route().current('settings')">
                Back to Settings
            </breeze-nav-link>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-hite border-b border-gray-200">
                        Request Personal Data
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