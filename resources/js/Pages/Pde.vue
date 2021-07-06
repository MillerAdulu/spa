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