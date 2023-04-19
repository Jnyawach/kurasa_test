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
                <div class="bg-white lg:w-4/6 w-full rounded-xl">
                    <header class="p-3">
                        <div class="flex justify-between">

                            <slot name="header">
                                <div class="text-lg">
                                    <h6 class="text-sky-600 font-bold my-3">{{ task.name }}</h6>
                                    <p>Add new team member</p>
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
                        <form @submit.prevent="submit">
                            <div class="grid my-3 grid-cols-6 gap-2">

                                <div class="col-span-2">
                                    <label class="creative-label" for="due_date">Due date:</label>
                                    <input type="date" class="creative-input" id="due_date" v-model="form.due_date">
                                    <div v-if="form.errors.due_date" class="creative-error">
                                        <span>{{ form.errors.due_date}}</span>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label class="creative-label" for="due_date">Start date & time:</label>
                                    <input type="datetime-local" class="creative-input" id="due_date"
                                           v-model="form.start_time">
                                    <div v-if="form.errors.start_time" class="creative-error">
                                        <span>{{ form.errors.start_time}}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="grid grid-cols-2 my-3">
                                <div>
                                    <label class="creative-label" for="team_member">Select team member:</label>
                                    <select id="team_member" class="creative-input" v-model="form.team_member">
                                        <option :value="null">Team members</option>
                                        <option :value="member.id" :key="member.id" v-for="member in members" class="capitalize">{{member.name}} <span class="text-sky-700" v-if="member.id===$page.props.auth.id">(me)</span></option>
                                    </select>
                                    <div v-if="form.errors.team_member" class="creative-error">
                                        <span>{{ form.errors.team_member}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="my-3 flex justify-end">
                                <button type="submit" class="btn-primary">Add member</button>
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
    task:Object
})

let form=useForm({
    due_date:'',
    start_time:'',
    team_member:null,
    task_id:props.task.id


})

//Get team members
const members=ref()

onMounted(()=>{
    axios
        .get('api/get/members')
        .then((response: { data: never[]; }) => {
            members.value = response.data;
        })
        .catch((error: any) => console.log(error))
})

//submit task
const submit=()=>{
    form.post('/sub_tasks',{
        onSuccess:()=>{
            form.reset()
            emits('close')
        }
    })
}
</script>

<style scoped>

</style>
