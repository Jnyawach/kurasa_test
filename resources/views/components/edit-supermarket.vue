<template>
    <div @click="show=true">
        <slot name="trigger">

        </slot>
    </div>
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
                <div class="bg-white lg:w-1/2 w-full rounded-xl">
                    <header class="p-3">
                        <div class="flex justify-between">

                            <slot name="header">
                                <div class="font-bold text-black-100 text-lg">
                                    <h6>Update a Supermarket</h6>
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
                        <form @submit.prevent="submit">
                            <div class="grid my-3">
                                <label class="creative-label" for="task_name">Name:</label>
                                <input type="text" class="creative-input" id="task_name" v-model="form.name" required>
                                <div v-if="form.errors.name" class="creative-error">
                                    <span>{{ form.errors.name}}</span>
                                </div>
                            </div>

                            <div class="grid my-3 grid-cols-2 gap-2">
                                <div >
                                    <label class="creative-label" for="town">Town/city:</label>
                                    <input type="text" class="creative-input" id="town" v-model="form.town" required>
                                    <div v-if="form.errors.town" class="creative-error">
                                        <span>{{ form.errors.town}}</span>
                                    </div>
                                </div>
                                <div >
                                    <label class="creative-label" for="country">Country:</label>
                                    <input type="text" class="creative-input" id="country" v-model="form.country" required>
                                    <div v-if="form.errors.country" class="creative-error">
                                        <span>{{ form.errors.country}}</span>
                                    </div>
                                </div>

                            </div>

                            <div class="my-3 flex justify-end">
                                <button type="submit" class="btn-primary">Save supermarket</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </Transition>
    </teleport>
</template>

<script setup lang="ts">
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
let props=defineProps({
    supermarket:Object
})
const   show=ref(false)
let form=useForm({
    name:props.supermarket.name,
    town:props.supermarket.town,
    country:props.supermarket.country
})

const submit=()=>{
    form.patch('/supermarket/'+props.supermarket.id,{
        onSuccess:()=>{
            show.value=false
            form.reset()
        }
    })
}





</script>

<style scoped>

</style>
