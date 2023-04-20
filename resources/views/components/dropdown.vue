<template>
<div class="relative" v-on-click-outside="closeDrop">
    <div @click="show=!show">
        <slot name="header" >
            <button>Action</button>
        </slot>
    </div>
    <div v-show="show" class="absolute bg-white rounded-lg w-44 right-0 shadow-lg border z-[100000]">
        <slot/>
    </div>
</div>
</template>

<script setup lang="ts">
import { vOnClickOutside } from '@vueuse/components'
import {ref} from "vue";

const show=ref(false)
const closeDrop = () => {
  show.value=false
}
</script>

<style scoped>

</style>
