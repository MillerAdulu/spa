<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Users
            </h2>
        </template>
         <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-if="$page.props.auth.user.role === 'admin'" class="p-6 bg-hite border-b border-gray-200">
                        Admin: Users List
                        <div class="bg-white rounded-md shadow overflow-x-auto">
                            <table class="w-full whitespace-nowrap">
                                <tr class="text-left font-bold">
                                  <th class="px-6 pt-6 pb-4">First Name</th>
                                  <th class="px-6 pt-6 pb-4">Last Name</th>
                                </tr>
                                <tr v-for="user in users" :key="user.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <td class="border-t">
                                        {{ user.first_name }}
                                    </td>
                                    <td class="border-t">
                                        {{ user.last_name }}
                                    </td>
                                    <inertia-link :href="route('impersonate', `${user.id}`)" class="underline text-sm text-gray-600 hover:text-gray-900">
                                        Impersonate User
                                    </inertia-link>
                                </tr>
                                <!-- <tr v-if="users.length === 0">
                                    <td class="border-t px-6 py-4" colspan="4">No user found.</td
                                </tr> -->
                            </table>
                        </div>  
                    </div>
                    <div v-else class="p-6 bg-hite border-b border-gray-200">
                        Manager: Users List
                         <div class="bg-white rounded-md shadow overflow-x-auto">
                            <table class="w-full whitespace-nowrap">
                                <tr class="text-left font-bold">
                                  <th class="px-6 pt-6 pb-4">First Name</th>
                                  <th class="px-6 pt-6 pb-4">Last Name</th>
                                </tr>
                                <tr v-for="user in users" :key="user.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <td class="border-t">
                                        {{ user.first_name }}
                                    </td>
                                    <td class="border-t">
                                        {{ user.last_name }}
                                    </td>
                                    <inertia-link :href="route('impersonate', `${user.id}`)" class="underline text-sm text-gray-600 hover:text-gray-900">
                                        Impersonate User
                                    </inertia-link>
                                </tr>
                                <!-- <tr v-if="users.length === 0">
                                    <td class="border-t px-6 py-4" colspan="4">No user found.</td
                                </tr> -->
                            </table>
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

    props: {
        users: Array
    },

    components: {
        BreezeAuthenticatedLayout,
    },

}
</script>

