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
                                    <h6>Assign employees to {{manager.name}}</h6>
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
                        <form @submit.prevent="saveEmployees">
                            <div class="grid my-5">
                                <h6 class="font-medium">Upload CSV file <a :href="'/templates/employee-template.xlsx'" class="text-sky-600" download>Download template</a> </h6>
                                <div class="flex gap-2 my-2">
                                    <div>
                                        <input type="file" required class="border rounded" @input="upload.employees=$event.target.files[0]">
                                    </div>
                                    <button type="submit" class="text-white bg-sky-600 py-1 px-3 font-medium rounded-lg">Upload</button>
                                </div>
                                <div v-if="upload.errors.employees" class="creative-error">
                                    <span>{{ upload.errors.employees}}</span>
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
                                    <label class="creative-label" for="gender" >Gender:</label>
                                    <select class="creative-input" id="gender" v-model="form.gender">
                                        <option :value="null">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <div v-if="form.errors.gender" class="creative-error">
                                        <span>{{ form.errors.gender}}</span>
                                    </div>
                                </div>


                            </div>

                            <div class="grid my-3 grid-cols-2 gap-2">
                                <div >
                                    <label class="creative-label" for="type">Employee Type:</label>
                                    <select class="creative-input" id="type" v-model="form.type">
                                        <option :value="null">Select Type</option>
                                        <option value="Back Office">Back Office</option>
                                        <option value="Cashier">Cashier</option>
                                    </select>
                                    <div v-if="form.errors.type" class="creative-error">
                                        <span>{{ form.errors.type}}</span>
                                    </div>
                                </div>



                            </div>

                            <div class="my-3 flex justify-end">
                                <button type="submit" class="btn-primary">Save employee</button>
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
    manager:Object
})

let form=useForm({
    name:'',
    type:null,
    gender:null,
    manager_id:props.manager.id
})

let upload=useForm({
    manager_id:props.manager.id,
    employees:''
})

const submit=()=>{
    form.post('/employee',{
        onSuccess:()=>{
            emits('close')
            form.reset()
        }
    })
}

const saveEmployees=()=>{
    upload.post('/employee/save',{
        onSuccess:()=>{
            emits('close')
            form.reset()
        }
    })
}





</script>

<style scoped>

</style>
