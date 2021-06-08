<template>
  <notification-bell v-bind="$attrs" />
</template>

<script>
import { NotificationBell } from 'vue-notification-bell'

export default {
    name: 'DashboardNotificationBell',

    components: { 
        NotificationBell
    }
}
</script>