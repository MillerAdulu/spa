<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-if="$page.props.auth.user.role === 'admin'" class="p-6 bg-hite border-b border-gray-200">
                        Admin: Welcome {{ $page.props.auth.user.first_name }}!
                    </div>
                    <div v-else-if="$page.props.auth.user.role === 'manager'" class="p-6 bg-hite border-b border-gray-200">
                        Manager: Welcome {{ $page.props.auth.user.first_name }}!
                    </div>
                    <div v-else class="p-6 bg-hite border-b border-gray-200">
                        User: Welcome {{ $page.props.auth.user.first_name }}!
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

    mounted() {
        window.EchoService.init().private(`user.${this.$page.props.auth.user.id}`)
            // .notification((notification) => {
            //     console.log(notification)
            // });
    },

    destroyed() {
        window.EchoService.init().leave(`user.${this.$page.props.auth.user.id}`);
    },

    // methods: {
    //     Listen() {
    //         window.EchoService.init().private(`user.${this.$page.props.auth.user.id}`)
    //             .listen('.TradingAccountActivation', (e) => {
    //                 // this.body = e.id,
    //                 // this.show = true,
    //                 console.log(e.id)
    //             })
    //             .notification((notification) => {
    //                 // this.body = notification.data.message,
    //                 // this.show = true,
    //                 console.log(notification.type)   
    //             });
    //     }
    // },
    
    // created() {
    //     this.Listen();
    // },

    // destroyed() {
    //     this.Listen();
    // },
}
</script>