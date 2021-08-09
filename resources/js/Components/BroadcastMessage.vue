<template>
    <div v-show="show">
        {{ body }}
    </div>
</template>

<script>
export default {
    name: 'BroadcastMessage',

    props: ['message'],

    data() {
        return {
            body: '',
            show: false,
        }
    },

    // mounted() {
    //     window.EchoService.init().private(`user.${this.$page.props.auth.user.id}`)
    //             // .listen('TradingAccountActivation', (e) => {
    //             .listen('.my-event', (e) => {
    //                 this.body = e.id,
    //                 this.show = true,
    //                 console.log(e.id)
    //             })
    //             .notification((notification) => {
    //                 console.log(notification)
    //             });
    // },

    // destroyed() {
    //     window.EchoService.init().leave(`user.${this.$page.props.auth.user.id}`);
    // },

    // mounted() {
    //      window.Echo.private(`user.${this.$page.props.auth.user.id}`)
    //               .listen('TradingAccountActivation', (e) => {
    //                  this.body = e.id,
    //                  this.show = true,
    //                  console.log(e.id)
    //               });
    // },

    // methods: {
    //     Listen() {
    //         window.Echo.private(`user.${this.$page.props.auth.user.id}`)
    //             .listen('.TradingAccountActivation', (e) => {
    //                 this.body = e.id,
    //                 this.show = true,
    //                 console.log(e.id)
    //             })
    //             .notification((notification) => {
    //                 this.body = notification.data.message,
    //                 this.show = true,
    //                 console.log(notification.type)   
    //             });
    //     }
    // },
    
    // created() {
    //     this.Listen();
    // }
}
</script>