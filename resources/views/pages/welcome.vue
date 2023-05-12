<template>
    <toast></toast>
<main>
    <div class="py-5 text-white" style="background-image: url('/images/bg-desktop-dark.jpg');">
       <div class="flex justify-between p-10 max-w-[1200px] mx-auto">
           <div class="flex gap-1  items-center ">
               <svg class="h-4  fill-white self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
               <span class="self-center capitalize ">{{user.name}}</span>
           </div>
           <div>
               <Link class="flex gap-1  items-center" as="button" method="post" href="/user/logout">

                   <svg class="h-4  fill-white self-center" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.0.0-alpha3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M384 192h-32V127.1c0-70.58-57.42-127.1-128-127.1s-128 57.42-128 127.1V192H64C28.65 192 0 220.7 0 256v191.1c0 35.35 28.65 64 64 64h320c35.35 0 64-28.65 64-64V256C448 220.7 419.3 192 384 192zM144 128c0-44.11 35.89-80 80-80s80 35.89 80 80v64h-160V128zM400 448c0 8.822-7.178 16-16 16H64c-8.822 0-16-7.178-16-16V256c0-8.822 7.178-16 16-16h320c8.822 0 16 7.178 16 16V448z"/></svg>
                   <span >Logout</span>
               </Link>
           </div>
       </div>
    </div>

    <div class="my-10 px-10">
        <div class="rounded-xl bg-gray-100 py-3 px-3 flex items-center gap-2">

            <svg class="h-4 fill-sky-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M504.1 471l-134-134C399.1 301.5 415.1 256.8 415.1 208c0-114.9-93.13-208-208-208S-.0002 93.13-.0002 208S93.12 416 207.1 416c48.79 0 93.55-16.91 129-45.04l134 134C475.7 509.7 481.9 512 488 512s12.28-2.344 16.97-7.031C514.3 495.6 514.3 480.4 504.1 471zM48 208c0-88.22 71.78-160 160-160s160 71.78 160 160s-71.78 160-160 160S48 296.2 48 208z"/></svg>
            <input v-model="search" type="search" placeholder="Search supermarket by name..." class="bg-transparent text-gray-700
               self-center placeholder-gray-500 w-full focus:border-0 focus:outline-0 focus:ring-0 self-center">

        </div>
        <div class="my-8 flex justify-between px-3">
            <div class="flex gap-3 text-sm">
                <button @click="newSupermarket=true" class="font-bold text-sky-600 flex items-center gap-1">

                    <svg class="h-4 fill-sky-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M432 256C432 269.3 421.3 280 408 280h-160v160c0 13.25-10.75 24.01-24 24.01S200 453.3 200 440v-160h-160c-13.25 0-24-10.74-24-23.99C16 242.8 26.75 232 40 232h160v-160c0-13.25 10.75-23.99 24-23.99S248 58.75 248 72v160h160C421.3 232 432 242.8 432 256z"/></svg>
                    <span>Create new supermarket</span>
                </button>
            </div>
        </div>

        <!--tasks table-->

        <div class="bg-white shadow-lg  rounded-xl my-5">
         <table class="w-full">
             <thead class="text-sky-600">
             <tr class="text-start border-b">
                 <th class="text-start p-3">Supermarket</th>
                 <th class="text-start p-3">Location</th>
                 <th class="text-start p-3">Managers</th>
                 <th class="text-start p-3">Suppliers</th>
                 <th class="text-start p-3">Action</th>
             </tr>
             </thead>
             <tbody>
             <tr v-for="supermarket in supermarkets.data" :key="supermarket.id">
                 <th>{{supermarket.name}}</th>
             </tr>
             </tbody>
         </table>
        </div>

        <!--create and update modals-->
        <!-- create new task-->
        <create-task :show="newSupermarket" @close="newSupermarket=false"></create-task>


    </div>
</main>
</template>

<script setup lang="ts">
import {Link, router, usePage} from "@inertiajs/vue3";
import Pagination from "@/views/components/pagination.vue";
import {computed, ref, watch} from "vue";
import CreateTask from "@/views/components/create-task.vue";
import Dropdown from "@/views/components/dropdown.vue";
import Toast from "@/views/components/toast.vue";
import {debounce} from 'lodash';


let props=defineProps({
    supermarkets:Object,
    filters:Object,
    statuses:Object
})

const user = computed(() => usePage().props.auth)
const newSupermarket=ref(false)

const search=ref(props.filters?props.filters:'')

watch([search, ], debounce(function (value:any) {
    router.get('/',{
        search:value,
    }, {preserveState:true, replace:true});
}, 300))


</script>

<style scoped>

</style>
