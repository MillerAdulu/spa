<template>
    <div v-show="show">
        {{ body }}
    </div>
</template>

<script>
export default {
    name: 'BroadcastMessage',

    //props: ['message'],

    data() {
        return {
            body: '',
            show: false,
        }
    },

    // mounted() {
    //     window.Echo.private(`user.${this.$page.props.auth.user.id}`)
    //             .notification((notification) => {
    //                 this.body = notification.message,
    //                 this.show = true
    //                 console.log(this.notification.message)
    //                 });
    // },

    // methods: {
    //     Test() {
    //         this.body = 'Test',
    //         this.show = true
    //         console.log(this.body)
    //     }
    // },

    // created() {
    //     this.Test();
    // },

    methods: {
        Listen() {
            Echo.private(`user.${this.$page.props.auth.user.id}`)
                .notification((notification) => {
                    if (notification) {
                        this.body = notification.message,
                        this.show = true
                        console.log(this.notification.message)
                    }

                    console.log('No message')
            });
        }
    },
    
    created() {
        this.Listen();
    }
}
</script>