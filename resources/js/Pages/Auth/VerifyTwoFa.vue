<template>
    <breeze-validation-errors class="mb-4" />
    <div class="mb-4 text-sm text-gray-600">
        Thanks for activating a second level Verification. Please authenticate by filling in the token we just texted to you.
    </div>
    <form @submit.prevent="submit">
        <div class="mt-4">
            <breeze-label for="token" value="Two-Fa Token" />
            <breeze-input id="mobile_phone_number" type="hidden" :value="phone" class="mt-1 block w-full" name="form.mobile_phone_number" autofocus autocomplete="mobile_phone_number" />
            <breeze-input id="two_fa_token" type="text" class="mt-1 block w-full" v-model="form.two_fa_token" required autofocus autocomplete="two_fa_token" />
        </div>
        <div class="mt-4 flex items-center justify-between">
            <breeze-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Verify Two-Fa Token
            </breeze-button>

            <inertia-link :href="route('logout')" method="post" as="button" class="underline text-sm text-gray-600 hover:text-gray-900">Log Out</inertia-link>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/Button'
import BreezeGuestLayout from '@/Layouts/Guest'
import BreezeInput from '@/Components/Input'
import BreezeLabel from '@/Components/Label'
import BreezeValidationErrors from '@/Components/ValidationErrors'
export default {
    inheritAttrs: false,
        
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors
    },

    props: {
        phone: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                two_fa_token: '',
                mobile_phone_number: '',
            })
        }
    },

    mounted() {
            
        this.form.mobile_phone_number = document.getElementById("mobile_phone_number").value
    },

    methods: {
        submit() {
            this.form.post(this.route('two-fa.verify'), {
                onFinish: () => this.form.reset('token'),
            })
        },
    }
}
</script>
