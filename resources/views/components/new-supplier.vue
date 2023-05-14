<template>
    <teleport to="body">
        <Transition
            enter-from-class="opacity-0 scale-125"
            enter-to-class="opacity-100 scale-100"
            enter-active-class="transition duration-300"
            leave-active-class="transition duration-200"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-125"
        >
            <div @click.self="$emit('close')" v-if="show" class="inset-0 fixed bg-black bg-opacity-70 z-[10000] grid place-items-center p-5" >
                <div class="bg-white lg:w-1/2 w-full rounded-xl">
                    <header class="p-3">
                        <div class="flex justify-between">

                            <slot name="header">
                                <div class="font-bold text-black-100 text-lg">
                                    <h6>Add a new Supplier to {{supermarket.name}}</h6>
                                </div>
                            </slot>
                            <div>
                                <div class="text-end">
                                    <button class="bg-sky-700 rounded-full h-8 w-8 flex place-content-center" type="button" @click="$emit('close')">

                                        <svg class="h-5 self-center fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M312.1 375c9.369 9.369 9.369 24.57 0 33.94s-24.57 9.369-33.94 0L160 289.9l-119 119c-9.369 9.369-24.57 9.369-33.94 0s-9.369-24.57 0-33.94L126.1 256L7.027 136.1c-9.369-9.369-9.369-24.57 0-33.94s24.57-9.369 33.94 0L160 222.1l119-119c9.369-9.369 24.57-9.369 33.94 0s9.369 24.57 0 33.94L193.9 256L312.1 375z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </header>

                    <div class="p-5 ">
                        <form @submit.prevent="saveSuppliers">
                            <div class="grid my-5">
                                <h6 class="font-medium">Upload CSV file <a :href="'/templates/supplier-template.xlsx'" class="text-sky-600" download>Download template</a> </h6>
                                <div class="flex gap-2 my-2">
                                    <div>
                                        <input type="file" required class="border rounded" @input="upload.suppliers=$event.target.files[0]">
                                    </div>
                                    <button type="submit" class="text-white bg-sky-600 py-1 px-3 font-medium rounded-lg">Upload</button>
                                </div>
                                <div v-if="upload.errors.suppliers" class="creative-error">
                                    <span>{{ upload.errors.suppliers}}</span>
                                </div>
                            </div>
                        </form>
                        <form @submit.prevent="submit">

                            <div class="grid my-3 grid-cols-2 gap-2">
                                <div >
                                    <label class="creative-label" for="task_name">Name:</label>
                                    <input type="text" class="creative-input" id="task_name" v-model="form.name" required>
                                    <div v-if="form.errors.name" class="creative-error">
                                        <span>{{ form.errors.name}}</span>
                                    </div>
                                </div>
                                <div >
                                    <label class="creative-label" for="town">Cellphone:</label>
                                    <input type="text" class="creative-input" id="town" v-model="form.phone" required>
                                    <div v-if="form.errors.phone" class="creative-error">
                                        <span>{{ form.errors.phone}}</span>
                                    </div>
                                </div>


                            </div>

                            <div class="grid my-3 grid-cols-2 gap-2">
                                <div >
                                    <label class="creative-label" for="task_name">Town:</label>
                                    <input type="text" class="creative-input" id="task_name" v-model="form.town" required>
                                    <div v-if="form.errors.town" class="creative-error">
                                        <span>{{ form.errors.town}}</span>
                                    </div>
                                </div>
                                <div >
                                    <label class="creative-label" for="town">Country:</label>
                                    <input type="text" class="creative-input" id="town" v-model="form.country" required>
                                    <div v-if="form.errors.country" class="creative-error">
                                        <span>{{ form.errors.country}}</span>
                                    </div>
                                </div>


                            </div>

                            <div class="my-3 flex justify-end">
                                <button type="submit" class="btn-primary">Save supplier</button>
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
import {onMounted, ref} from "vue";
import axios from "axios";
const emits=defineEmits(['close'])
emits("close")
let props=defineProps({
    show:Boolean,
    supermarket:Object
})

let form=useForm({
    name:'',
    phone:'',
    country:'',
    town:'',
    supermarket_id:props.supermarket.id
})

let upload=useForm({
    supermarket_id:props.supermarket.id,
    suppliers:''
})

const submit=()=>{
    form.post('/supplier',{
        onSuccess:()=>{
            emits('close')
            form.reset()
        }
    })
}

const saveSuppliers=()=>{
    upload.post('/supplier/save',{
        onSuccess:()=>{
            emits('close')
            form.reset()
        }
    })
}





</script>

<style scoped>

</style>
