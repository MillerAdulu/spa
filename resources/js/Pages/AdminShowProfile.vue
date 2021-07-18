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
                            <td class="border-t">
                                <a :href="route('download', `${userprofile.signature}`)" target="_blank">
                                Download User Signature: <img class="block w-5 h-5 rounded-full mr-2 -my-2" :src="route('display-image', `${userprofile.signature}`)" />
                                </a>
                            </td> 
                        </tr>
                        <tr class="text-left font-bold">
                            <td class="border-t">
                                <a :href="route('download', `${userprofile.photograph}`)" target="_blank">
                                Download User Photograph: <img class="block w-5 h-5 rounded-full mr-2 -my-2" :src="route('display-image', `${userprofile.photograph}`)" />
                                </a>
                            </td> 
                        </tr>
                        <tr class="text-left font-bold">
                             <td class="border-t">
                                <a :href="route('download', `${userprofile.means_of_identification}`)" target="_blank">
                                Download User ID: <img class="block w-5 h-5 rounded-full mr-2 -my-2" :src="route('display-image', `${userprofile.means_of_identification}`)" />
                                </a>
                            </td> 
                        </tr>
                        <tr class="text-left font-bold">
                            <td class="border-t">
                                <a :href="route('download', `${userprofile.public_utility_bill}`)" target="_blank">
                                Download User Utility Bill: <img class="block w-5 h-5 rounded-full mr-2 -my-2" :src="route('display-image', `${userprofile.public_utility_bill}`)" />
                                </a>
                            </td> 
                        </tr>
                    </table>
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