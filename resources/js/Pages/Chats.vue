<template>
<breeze-authenticated-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Chats</div>

                    <div class="panel-body">
                        <chat-messages :chats="chats"></chat-messages>
                    </div>
                    <div class="panel-footer">
                        <chat-form
                            v-on:chatsent="addChat"
                            :user="$page.props.auth.user"
                        ></chat-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
import ChatMessages from '@/Components/ChatMessages'
import ChatForm from '@/Components/ChatForm'
export default {
    inheritAttrs: false,

    components: {
        BreezeAuthenticatedLayout,
        ChatMessages,
        ChatForm
    },

    data () {
        return {
            chats: []
        }
    },

    created() {
        this.fetchChats();
        
        window.EchoService.init().private('chat')
            .listen('ChatSent', (e) => {
                this.chats.push({
                chat: e.chat.chat,
                user: e.user
            });
        });
    },

    methods: {
        fetchChats() {
            axios.get('/chats/fetch').then(response => {
                this.chats = response.data;
            });
        },

        addChat(chat) {
            this.chats.push(chat);

            axios.post('/chats/send', chat).then(response => {
              console.log(response.data);
            });
        }
    }
}
</script>

<style>
.chat {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .chat li {
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
  }

  .chat li .chat-body p {
    margin: 0;
    color: #777777;
  }

  .panel-body {
    overflow-y: scroll;
    height: 350px;
  }

  ::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
  }
</style>