<template>
   <div class="slider" :class="{'slider--active': value}">
    <input type="checkbox" :checked="value" @click="handleClick" />
   </div>
</template>

<script>
export default {
    name: "Slider",

    props: {
        value: {
            type: Boolean,
            required: true
        }
    },

    methods: {
        handleClick(event) {
            this.$emit("update:value", event.target.checked);
        }
    }
}
</script>
