<template>
    <button @click="show=true" class="text-sky-600">Details</button>
    <teleport to="body">
        <Transition
            enter-from-class="opacity-0 scale-125"
            enter-to-class="opacity-100 scale-100"
            enter-active-class="transition duration-300"
            leave-active-class="transition duration-200"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-125"
        >
            <div @click.self="show=false" v-if="show" class="inset-0 fixed bg-black bg-opacity-70 z-[10000] grid place-items-center p-5" >
                <div class="bg-white lg:w-4/6 w-full rounded-xl">
                    <header class="p-3">
                        <div class="flex justify-between">

                            <slot name="header">
                                <div class="font-bold text-sky-600 text-lg">
                                    <h6>{{task.name}}</h6>
                                </div>
                            </slot>
                            <div>
                                <div class="text-end">
                                    <button class="bg-sky-700 rounded-full h-8 w-8 flex place-content-center" type="button" @click="show=false">
                                        <svg class="h-5 self-center fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M312.1 375c9.369 9.369 9.369 24.57 0 33.94s-24.57 9.369-33.94 0L160 289.9l-119 119c-9.369 9.369-24.57 9.369-33.94 0s-9.369-24.57 0-33.94L126.1 256L7.027 136.1c-9.369-9.369-9.369-24.57 0-33.94s24.57-9.369 33.94 0L160 222.1l119-119c9.369-9.369 24.57-9.369 33.94 0s9.369 24.57 0 33.94L193.9 256L312.1 375z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </header>

                    <div class="p-5 ">
                        <p><span class="text-sky-700 font-medium">Description:</span> {{task.description}}</p>
                        <p><span class="text-sky-700 font-medium">Remarks:</span> {{sub_task.remarks}}</p>
                       <div>
                           <p class="inline-block mr-1"><span class="text-sky-700 font-medium">Due date:</span> {{moment(sub_task.due_date).format("ddd MMM DD, YYYY")}}</p>
                           <p class="inline-block mr-1"><span class="text-sky-700 font-medium">Start date & time:</span> {{moment(sub_task.start_time).format("ddd MMM DD, YYYY [at] HH:mm a")}}</p>
                           <p class="inline-block mr-1"><span class="text-sky-700 font-medium">End date & time:</span> <span v-if="sub_task.end_time">{{moment(sub_task.end_time).format("ddd MMM DD, YYYY [at] HH:mm a")}}</span></p>
                       </div>

                    </div>

                </div>
            </div>
        </Transition>
    </teleport>
</template>

<script setup lang="ts">
import moment from "moment";
const emits=defineEmits(['close'])
emits("close")
let props=defineProps({
    show:Boolean,
    task:Object,
    sub_task:Object
})

</script>

<style scoped>

</style>
