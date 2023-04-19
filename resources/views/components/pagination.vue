<template>
<div class="flex justify-between">
    <div>
        <h6 class="font-medium">Showing <span class="text-sky-700">{{ data.meta.current_page }}</span> of <span
            class="text-sky-700">{{ data.meta.last_page }}</span> Page(s)</h6>
    </div>
    <div class="flex gap-2">
        <div v-if="data.links.prev">
            <Link  :href="data.links.prev" class="border rounded-lg bg-white text-sky-700 text-xs py-2 px-5 h-8 font-medium hover:text-white hover:bg-sky-700"><span class="mr-1"><i class="far fa-angle-left"></i></span> PREV</Link>
        </div>
        <div v-if="data.links.next">
            <Link :href="data.links.next" class="border rounded-lg bg-white text-sky-700 text-xs py-2 px-5 h-8 font-medium hover:text-white hover:bg-sky-700">NEXT <span class="ml-1"><i class="far fa-angle-right"></i></span></Link>
        </div>
    </div>
</div>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
defineProps({
    data:Object
})
</script>

<style scoped>

</style>
