<template>
      <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Two Factor Authentication
            </h2>
            <breeze-nav-link :href="route('settings')" :active="route().current('settings')">
                Back to Settings
            </breeze-nav-link>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-hite border-b border-gray-200">
                        <p><strong>Two-Fa Status</strong></p>
                            <!-- <Slider v-model:value="twoFa" />
                            <div>{{ twoFa ? 'Enabled!' : 'Disabled!' }}</div> -->
                            <div :class="{'active': toggleActive}" class="toggle_container">
                                <toggle-button @change="triggerToggleEvent" />
                            </div>
                    </div>
                </div>
            </div>
        </div>
      </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
import BreezeNavLink from '@/Components/NavLink'
import ToggleButton from '@/Components/ToggleButton'
// import Slider from '@/Components/Slider'
export default {
    inheritAttrs: false,

    components: {
        BreezeAuthenticatedLayout,
        BreezeNavLink,
        ToggleButton,
        // Slider
    },

    // data() {
    //     return {
    //         twoFa: false
    //     }
    // },

    data() {
        return {
            toggleActive: false
        }
    },

    methods: {
        triggerToggleEvent(value) {
            this.toggleActive = value;
            //call controller to effect status change
        }
    }
}
</script>

