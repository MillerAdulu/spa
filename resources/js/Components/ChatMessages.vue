<template>
      <ul class="chat">
        <li class="left clearfix" v-for="chat in chats" :key="chat.id">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                        {{ chat.user.first_name }}
                    </strong>
                </div>
                <p>
                    {{ chat.chat }}
                </p>
            </div>
        </li>
    </ul>
</template>

<script>
export default {
    props: ['chats']
}
</script>

<style>

</style>