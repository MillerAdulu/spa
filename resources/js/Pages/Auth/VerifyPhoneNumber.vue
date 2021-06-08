<template>
    <breeze-validation-errors class="mb-4" />
    <div class="mb-4 text-sm text-gray-600">
        Thanks for signing up. Please verify your phone number:{{ phone }} by filling in the code we just texted you.
    </div>
    <form @submit.prevent="submit">
        <div class="mt-4">
            <breeze-label for="code" value="Phone Verification Code" />
            <breeze-input id="mobile_phone_number" type="hidden" :value="phone" class="mt-1 block w-full" name="form.mobile_phone_number" required autofocus autocomplete="mobile_phone_number" />
            <breeze-input id="verification_code" type="text" class="mt-1 block w-full" v-model="form.verification_code" required autofocus autocomplete="verification_code" />
        </div>
        <div class="mt-4 flex items-center justify-between">
            <breeze-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Verify Phone Number
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
        phone: String
    },

    data() {
        return {
            form: this.$inertia.form({
                verification_code: '',
                mobile_phone_number: '',
            })
        }
    },

    mounted() {
            
        this.form.mobile_phone_number = document.getElementById("mobile_phone_number").value

    },

    methods: {
        submit() {
            this.form.post(this.route('phoneverification.verify'), {
                onFinish: () => this.form.reset('code'),
            })
        },
    }
}
</script>
