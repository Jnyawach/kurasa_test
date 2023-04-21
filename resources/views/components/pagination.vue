<template>
<div class="flex justify-between">
    <div>
        <h6 class="font-medium">Showing <span class="text-sky-700">{{ data.meta.current_page }}</span> of <span
            class="text-sky-700">{{ data.meta.last_page }}</span> Page(s)</h6>
    </div>
    <div class="flex gap-2">
        <div v-if="data.links.prev">
            <Link  :href="data.links.prev" class="border rounded-lg bg-white text-sky-700 text-xs py-2 px-5 h-8 font-medium hover:text-white hover:bg-sky-700 flex items-center gap-1 group">

                <svg class="h-4 fill-sky-700 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><!--! Font Awesome Pro 6.0.0-alpha3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M166.5 424.5l-143.1-152c-4.375-4.625-6.562-10.56-6.562-16.5c0-5.938 2.188-11.88 6.562-16.5l143.1-152c9.125-9.625 24.31-10.03 33.93-.9375c9.688 9.125 10.03 24.38 .9375 33.94l-128.4 135.5l128.4 135.5c9.094 9.562 8.75 24.75-.9375 33.94C190.9 434.5 175.7 434.1 166.5 424.5z"/></svg>
                <span>PREV</span>
            </Link>
        </div>
        <div v-if="data.links.next">
            <Link :href="data.links.next" class="border rounded-lg bg-white text-sky-700 text-xs py-2 px-5 h-8 font-medium hover:text-white hover:bg-sky-700 flex items-center gap-1 group">
                 <span class="ml-1">NEXT</span>
                <svg class="h-4 fill-sky-700 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M89.45 87.5l143.1 152c4.375 4.625 6.562 10.56 6.562 16.5c0 5.937-2.188 11.87-6.562 16.5l-143.1 152C80.33 434.1 65.14 434.5 55.52 425.4c-9.688-9.125-10.03-24.38-.9375-33.94l128.4-135.5l-128.4-135.5C45.49 110.9 45.83 95.75 55.52 86.56C65.14 77.47 80.33 77.87 89.45 87.5z"/></svg>
            </Link>
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
