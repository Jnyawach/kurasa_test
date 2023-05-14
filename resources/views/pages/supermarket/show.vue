<template>
<main-layout>
    <template #breadcrumb>
        <ul class="my-2 flex divide-x divide-sky-600">
            <li class="px-2">
                <Link title="home" href="/" class="hover:text-sky-600">Supermarkets</Link>
            </li>
            <li class="px-2">
                <Link title="home" href="#" class="hover:text-sky-600">{{supermarket.data.name}}</Link>
            </li>
            <li class="px-2">
                <Link title="home" href="#" class="hover:text-sky-600">Managers</Link>
            </li>
        </ul>
    </template>
    <div>


        <div class="bg-white shadow rounded-xl">
            <div class="flex justify-between p-3 py-5">
                <div>
                    <h2 class="text-lg font-bold">{{supermarket.data.name}}</h2>
                    <div>
                        <ul class="flex gap-3 my-3 ">
                            <li>
                                <Link :href="'/supermarket/'+supermarket.data.id" class="text-sky-600 hover:text-sky-600">Managers</Link>
                            </li>
                            <li>
                                <Link :href="'/supermarket/suppliers/'+supermarket.data.id"  class="hover:text-sky-600">Suppliers</Link>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex gap-1">
                    <div>
                        <button class="border  p-2 rounded-lg group hover:bg-sky-600" @click="grid=1">
                            <svg class="fill-sky-600 h-4 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z"/></svg>
                        </button>
                    </div>
                    <div>
                        <button class="border p-2 rounded-lg group hover:bg-sky-600" @click="grid=2">

                            <svg class="fill-sky-600 h-4 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M176 0h-128C21.49 0 0 21.49 0 48v128C0 202.5 21.49 224 48 224h128C202.5 224 224 202.5 224 176v-128C224 21.49 202.5 0 176 0zM464 288h-128C309.5 288 288 309.5 288 336v128c0 26.51 21.49 48 48 48h128c26.51 0 48-21.49 48-48v-128C512 309.5 490.5 288 464 288zM464 0h-128C309.5 0 288 21.49 288 48v128C288 202.5 309.5 224 336 224h128C490.5 224 512 202.5 512 176v-128C512 21.49 490.5 0 464 0zM176 288h-128C21.49 288 0 309.5 0 336v128C0 490.5 21.49 512 48 512h128C202.5 512 224 490.5 224 464v-128C224 309.5 202.5 288 176 288z"/></svg>
                        </button>
                    </div>
                    <div>
                        <button @click="newManager=true" class="font-bold bg-sky-600 text-white py-2 px-5 rounded-lg flex items-center gap-1">

                            <svg class="h-4 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256C432 269.3 421.3 280 408 280h-160v160c0 13.25-10.75 24.01-24 24.01S200 453.3 200 440v-160h-160c-13.25 0-24-10.74-24-23.99C16 242.8 26.75 232 40 232h160v-160c0-13.25 10.75-23.99 24-23.99S248 58.75 248 72v160h160C421.3 232 432 242.8 432 256z"/></svg>
                            <span>New Manager</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="divide-y" v-if="grid===1">
                <div class=" p-2 py-5" v-for="manager in supermarket.data.managers" :key="manager.id">
                    <div class="flex gap-5 justify-between">
                        <div>
                            <p class="font-bold text-lg">{{manager.name}}</p>
                            <p><span class="text-sky-700 mr-2 font-medium">Email:</span>{{manager.email}}</p>
                            <div>
                                <p><span class="text-sky-700 mr-2 font-medium">Cellphone:</span>{{manager.phone}}</p>
                                <p><span class="text-sky-700 mr-2 font-medium">Number of Employees:</span>{{manager.employees_count}}</p>
                            </div>
                        </div>
                        <div class="flex gap-2 items-center">
                            <div>
                                <Link :href="'/supermarket/'+supermarket.data.id +'/manager/'+manager.id" class="text-sky-600 m-2 font-medium hover:text-sky-700">
                                    Employees
                                </Link>
                            </div>
                            <div>
                                <edit-manager :manager="manager">
                                    <template #trigger>
                                        <button class="text-sky-600 m-2 font-medium hover:text-sky-700">
                                            Edit
                                        </button>
                                    </template>
                                </edit-manager>

                            </div>
                            <div>
                                <Link method="DELETE" as="button" :href="'/manager/'+manager.id" class="text-red-600 m-2 font-medium hover:text-red-700">
                                    Delete
                                </Link>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 p-3 gap-3" v-if="grid===2">
                <div class="shadow border rounded-lg p-3" v-for="manager in supermarket.data.managers" :key="manager.id">
                    <div class="flex items-center justify-between">
                        <h2 class="font-bold text-lg">{{manager.name}}</h2>

                    </div>

                    <div>
                        <p><span class="text-sky-700 mr-2 font-medium">Email:</span>{{manager.email}}</p>
                        <p><span class="text-sky-700 mr-2 font-medium">Cellphone:</span>{{manager.phone}}</p>
                        <p><span class="text-sky-700 mr-2 font-medium">Number of Employees:</span>{{manager.employees_count}}</p>
                    </div>
                    <div class="flex gap-2 items-center  my-2 rounded">
                        <div>
                            <Link :href="'/supermarket/'+supermarket.data.id +'/manager/'+manager.id" class="text-sky-600 m-2 font-medium hover:text-sky-700">
                               Employees
                            </Link>
                        </div>
                        <div>
                            <edit-manager :manager="manager">
                                <template #trigger>
                                    <button class="text-sky-600 m-2 font-medium hover:text-sky-700">
                                        Edit
                                    </button>
                                </template>
                            </edit-manager>

                        </div>
                        <div>
                            <Link method="DELETE" as="button" :href="'/manager/'+manager.id" class="text-red-600 m-2 font-medium hover:text-red-700">
                                Delete
                            </Link>
                        </div>


                    </div>

                </div>
            </div>
        </div>


    </div>
    <!--new manager modal-->
    <new-manager :show="newManager" @close="newManager=false" :supermarket="supermarket.data"></new-manager>
</main-layout>
</template>

<script setup lang="ts">

import MainLayout from "@/views/layouts/main-layout.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import NewManager from "@/views/components/new-manager.vue";
import EditManager from "@/views/components/edit-manager.vue";
import {useStorage} from "@vueuse/core";
defineProps({
    supermarket:Object
})

const newManager=ref(false)
const grid=ref(useStorage('grid',1))
</script>

<style scoped>

</style>
