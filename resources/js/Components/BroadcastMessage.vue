<template>
    <div v-show="show">
        {{ body }}
    </div>
</template>

<script>
export default {
    name: 'BroadcastMessage',

    data() {
        return {
            body: '',
            show: false,
        }
    },

    // methods: {
    //     Listen() {
    //         Echo.private(`user.${this.$page.props.auth.user.id}`)
    //             .notification((notification) => {
    //                 if (notification.data.message) {
    //                     body = this.notification.data.message,
    //                     show = true
    //                 }   
    //         });
    //     }
    // },
    
    // mounted() {
    //     this.Listen();
    //     console.log(this.Listen);
    // },

    methods: {
        ListenForChanges() {
            Echo.private(`user.${this.$page.props.auth.user.id}`)
                .listen('TradingAccountActivation', (e) => {
                    //console.log(this.e.message)
                    if (e.message) {
                        body = e.message,
                        show = true
                    }    
                });
        }

    },

    created() {
        this.ListenForChanges();
        console.log(this.ListenForChanges);
    }

}
</script>