<template>
  <avatar v-bind="$attrs" />
</template>

<script>
import { Avatar } from 'vue-avatar'

export default {

    name: 'DashboardAvatar',

    components: {
        Avatar
    }
}
</script>