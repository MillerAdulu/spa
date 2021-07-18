<template>
<breeze-authenticated-layout>
<breeze-validation-errors class="mb-4" />
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Profile
        </h2>
    </template>
    <div v-for="userprofile in userprofile" :key="userprofile.id" class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <form @submit.prevent="update" enctype="multipart/form-data">
            <div>
                <breeze-input id="user_id" type="hidden" :value="$page.props.auth.user.id" class="mt-1 block w-full" name="form.user_id" autofocus autocomplete="user_id" />
            </div>

            <div>
                <breeze-input id="uuid" type="hidden" :value="$page.props.auth.user.uuid" class="mt-1 block w-full" name="form.uuid" autofocus autocomplete="uuid" />
            </div>

            <div>
                <breeze-label for="first_name" value="First Name" />
                <breeze-input id="first_name" type="text" :value="$page.props.auth.user.first_name" class="mt-1 block w-full" disabled="true" name="form.first_name" required autofocus autocomplete="first_name" />
            </div>

            <div>
                <breeze-label for="last_name" value="Last Name" />
                <breeze-input id="last_name" type="text" :value="$page.props.auth.user.last_name" class="mt-1 block w-full" disabled="true" name="form.last_name" required autofocus autocomplete="last_name" />
            </div>

             <div>
                <breeze-label for="mobile_phone_number" value="Phone Number" />
                <breeze-input id="mobile_phone_number" type="text" :value="$page.props.auth.user.mobile_phone_number" class="mt-1 block w-full" name="form.mobile_phone_number" @change="selectPhone" autofocus autocomplete="mobile_phone_number" />
            </div>

            <div>
                <breeze-label for="address" value="Address" />
                <breeze-input id="address" type="text" :value="userprofile.address" class="mt-1 block w-full" name="form.address" @change="selectAddress" autocomplete="address" />
            </div>

            <div class="mt-4">
                <breeze-label for="city" value="City" />
                <breeze-input id="city" type="text" :value="userprofile.city" class="mt-1 block w-full" name="form.city" @change="selectCity" autocomplete="city" />
            </div>

            <div class="mt-4">
                <breeze-label for="state" value="State" />
                <breeze-input id="state" type="text" :value="userprofile.state" class="mt-1 block w-full" name="form.state" @change="selectState" autocomplete="state" />
            </div>

            <div class="mt-4">
                <breeze-label for="country" value="Country" />
                <breeze-input id="country" type="text" :value="userprofile.country" class="mt-1 block w-full" name="form.country" @change="selectCountry" autocomplete="country" />
            </div>

            <div class="mt-4">
                <breeze-label for="signature" value="Upload Signature" />
                <breeze-input id="signature" type="file" accept="image/*,.pdf" class="mt-1 block w-full" name="form.signature" @change="selectSignature" />
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
            </div> 
            
            <div class="mt-4">
                <breeze-label for="photograph" value="Upload Photograph" />
                <breeze-input id="photograph" type="file" accept="image/*,.pdf" class="mt-1 block w-full" name="form.photograph" @change="selectPhotograph" />
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
            </div> 
            
            <div class="mt-4">
                <breeze-label for="means_of_identification" value="Upload Means Of Identification" />
                <breeze-input id="means_of_identification" type="file" accept="image/*,.pdf" class="mt-1 block w-full" name="form.means_of_identification" @change="selectId" />
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
            </div> 
            
            <div class="mt-4">
                <breeze-label for="public_utility_bill" value="Upload Public Utility Bill" />
                <breeze-input id="public_utility_bill" type="file" accept="image/*,.pdf" class="mt-1 block w-full" name="form.public_utility_bill" @change="selectUtilitybill" />
                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                    {{ form.progress.percentage }}%
                </progress>
            </div>

            <div class="flex items-center justify-end mt-4">
                <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Update Profile
                </breeze-button>
            </div>
        </form>
    </div>
</breeze-authenticated-layout>
</template>

<script>
import BreezeButton from '@/Components/Button'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
import BreezeInput from '@/Components/Input'
import BreezeLabel from '@/Components/Label'
import BreezeValidationErrors from '@/Components/ValidationErrors'
export default {
    inheritAttrs: false,

    props: {
        userprofile: Array,
    },

    components: {
        BreezeAuthenticatedLayout,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
    },

    data() {
        return {
            form: this.$inertia.form({
                _method: 'put',
                user_id: '',
                uuid: '',
                first_name: '',
                last_name: '',
                mobile_phone_number: '',
                address: '',
                city: '',
                state: '',
                country: '',
                signature: '',
                photograph: '',
                means_of_identification: '',
                public_utility_bill: '',
            })
        }
    },

    mounted() {
        this.form.user_id = document.getElementById("user_id").value,
        this.form.uuid = document.getElementById("uuid").value,
        this.form.first_name = document.getElementById("first_name").value
        this.form.last_name = document.getElementById("last_name").value
        this.form.mobile_phone_number = document.getElementById("mobile_phone_number").value
        this.form.address = document.getElementById("address").value
        this.form.city = document.getElementById("city").value
        this.form.state = document.getElementById("state").value
        this.form.country = document.getElementById("country").value
    },

    methods: {
        selectPhone(event) {
            this.form.mobile_phone_number = event.target.value
        },

        selectAddress(event) {
            this.form.address = event.target.value
        },

        selectCity(event) {
            this.form.city = event.target.value
        },

         selectState(event) {
            this.form.state = event.target.value
        },

         selectCountry(event) {
            this.form.country = event.target.value
        },

        selectSignature(event) {
            this.form.signature = event.target.files[0]
            //  if(event.target.files[0].size > 512) {
            //     alert('File size must be less than 0.5Mb')
            // }
        },

        selectPhotograph(event) {
            this.form.photograph = event.target.files[0]
            //  if(event.target.files[0].size > 512) {
            //     alert('File size must be less than 0.5Mb')
            // }
        },

        selectId(event) {
            this.form.means_of_identification = event.target.files[0]
            //  if(event.target.files[0].size > 512) {
            //     alert('File size must be less than 0.5Mb')
            // }
        },

        selectUtilitybill(event) {
            this.form.public_utility_bill = event.target.files[0]
            //  if(event.target.files[0].size > 512) {
            //     alert('File size must be less than 0.5Mb')
            // }
        },

        update() {
            this.form.post(this.route('profile.update', `${this.$page.props.auth.user.uuid}`), {
                // onFinish: () => this.form.reset(),
            })
        }
    }
}
</script>