<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Profile
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white rounded-md shadow overflow-x-auto">
                    <table v-for="userprofile in userprofile" :key="userprofile.id" class="w-full whitespace-nowrap">
                        <tr class="text-left font-bold">
                            <td class="border-t">
                                First Name: {{ userprofile.first_name }}
                            </td>
                        </tr>
                        <tr class="text-left font-bold">
                            <td class="border-t">
                                Last Name: {{ userprofile.last_name }}
                            </td>
                        </tr>
                        <tr class="text-left font-bold">
                            <td class="border-t">
                                Phone Number: {{ userprofile.mobile_phone_number }}
                            </td>
                        </tr>
                        <tr class="text-left font-bold">
                            <td class="border-t">
                                Address: {{ userprofile.address }}
                            </td>
                        </tr>
                        <tr class="text-left font-bold">
                            <td class="border-t">
                                City: {{ userprofile.city }}
                            </td>
                        </tr> 
                        <tr class="text-left font-bold">
                            <td class="border-t">
                                State: {{ userprofile.state }}
                            </td>
                        </tr>
                        <tr class="text-left font-bold">
                            <td class="border-t">
                                Country: {{ userprofile.country }}
                            </td>
                        </tr>
                        <tr class="text-left font-bold">
                            <td value="Signature" class="border-t">
                                Signature: <img class="block w-5 h-5 rounded-full mr-2 -my-2" :src="route('display-image', `${userprofile.signature}`)" />
                            </td>
                        </tr>
                        <tr class="text-left font-bold">
                            <td class="border-t">
                                Photograph: <img class="block w-5 h-5 rounded-full mr-2 -my-2" :src="route('display-image', `${userprofile.photograph}`)" />
                            </td>
                        </tr>
                        <tr class="text-left font-bold">
                            <td class="border-t">
                                Means Of Identification: <img class="block w-5 h-5 rounded-full mr-2 -my-2" :src="route('display-image', `${userprofile.means_of_identification}`)" />
                            </td>
                        </tr>
                        <tr class="text-left font-bold">
                            <td class="border-t">
                                Public Utility Bill: <img class="block w-5 h-5 rounded-full mr-2 -my-2" :src="route('display-image', `${userprofile.public_utility_bill}`)" />
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="bg-white rounded-md shadow">
                    <inertia-link :href="route('profile.edit', `${$page.props.auth.user.uuid}`)" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Edit Profile
                    </inertia-link>    
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

    props: {
        userprofile: Array
    },

    components: {
        BreezeAuthenticatedLayout,
        BreezeNavLink,
    },

}
</script>