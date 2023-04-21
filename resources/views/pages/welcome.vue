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
            <input v-model="search" type="search" placeholder="Search task by name..." class="bg-transparent text-gray-700
               self-center placeholder-gray-500 w-full focus:border-0 focus:outline-0 focus:ring-0 self-center">

        </div>
        <div class="my-8 flex justify-between px-3">
            <div class="flex gap-3">
                <!--top filter-->
                <p class="self-center"><span class="font-bold text-gray-900">{{tasks.data.length}} tasks</span> (of {{tasks.meta.total}})</p>
                <select v-model="showing" class="text-sky-700 bg-transparent focus:border-0 focus:ring-0 focus:outline-0">
                    <option value="10">Showing 10</option>
                    <option value="50">Showing 50</option>
                    <option value="100">Showing 100</option>
                </select>
                <label class="font-bold text-gray-900" for="filter_status">Filter by status:</label>
                <select id="filter_status" v-model="status" class="capitalize text-sky-700 bg-transparent focus:border-0 focus:ring-0 focus:outline-0">
                    <option :value="null">All</option>
                    <option :key="status.id" :value="status.id" v-for="status in statuses">{{status.name}}</option>

                </select>
            </div>
            <div class="flex gap-3 text-sm">
                <button @click="newTaskModal=true" class="font-bold text-sky-600 flex items-center gap-1">

                    <svg class="h-4 fill-sky-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.0.0-alpha3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M432 256C432 269.3 421.3 280 408 280h-160v160c0 13.25-10.75 24.01-24 24.01S200 453.3 200 440v-160h-160c-13.25 0-24-10.74-24-23.99C16 242.8 26.75 232 40 232h160v-160c0-13.25 10.75-23.99 24-23.99S248 58.75 248 72v160h160C421.3 232 432 242.8 432 256z"/></svg>
                    <span>New task</span>
                </button>
            </div>
        </div>

        <!--tasks table-->

        <div class="bg-white shadow-lg  rounded-xl my-5">

            <div class="relative  sm:rounded-lg ">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-sky-700 uppercase bg-gray-100 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Task Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Due Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User Tasks
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Details
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="[&>*:nth-child(even)]:bg-gray-100 text-[12px]">
                    <tr :key="task.id" v-for="task in tasks.data" class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                            {{task.name}}
                        </th>

                        <td class="px-6 py-2">
                            <span v-if="task.status.name==='Cancelled'" class="text-red-900">{{task.status.name}}</span>
                            <span v-if="task.status.name==='Pending'" class="text-yellow-600">{{task.status.name}}</span>
                            <span v-if="task.status.name==='Progress'" class="text-lime-500">{{task.status.name}}</span>
                            <span v-if="task.status.name==='Complete'" class="text-green-600">{{task.status.name}}</span>
                        </td>
                        <td class="px-6 py-2">
                           {{new Date(task.due_date).toDateString()}}
                        </td>
                        <td class="px-6 py-2">
                            {{task.sub_task}}
                        </td>
                        <td class="px-6 py-2">
                            <Link  title="Sub tasks" :href="'/tasks/'+task.id" class="text-sky-600">
                                View details
                            </Link>
                        </td>

                        <td class="px-6 py-2">
                            <dropdown>
                                <template #header>
                                    <button class="flex text-sky-600 items-center gap-1">
                                        <svg class="h-3 fill-sky-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512"><path d="M64 112c26.5 0 48-21.5 48-48S90.5 16 64 16S16 37.5 16 64S37.5 112 64 112zM64 400c-26.5 0-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48S90.5 400 64 400zM64 208C37.5 208 16 229.5 16 256S37.5 304 64 304s48-21.5 48-48S90.5 208 64 208z"/></svg>
                                        <span class="self-center">Action</span></button>
                                </template>
                                <div>
                                    <ul class="divide-y bg-sky-50">
                                        <li class="py-3 px-2">
                                            <Link title="Sub tasks" :href="'tasks/'+task.id" class="hover:text-sky-700">
                                                View user tasks
                                            </Link>
                                        </li>
                                        <li class="py-3 px-2" v-if="task.status.name!=='Complete'">
                                            <Link as="button" method="patch" :href="'tasks/complete/'+task.id" class="hover:text-sky-700">Mark as Complete</Link>
                                        </li>
                                        <li class="py-3 px-2" v-if="task.status.name!=='Cancelled'">
                                            <Link as="button" method="patch" :href="'tasks/cancel/'+task.id" class="hover:text-sky-700">Cancel task</Link>
                                        </li>
                                        <li class="py-3 px-2">
                                            <Link as="button" method="patch" :href="'tasks/trash/'+task.id" class="hover:text-sky-700">Move to Trash</Link>
                                        </li>
                                        <li class="py-3 px-2">
                                            <Link :href="'/tasks/'+task.id" as="button" method="delete" class="hover:text-sky-700">Delete</Link>
                                        </li>


                                    </ul>
                                </div>
                            </dropdown>

                        </td>
                    </tr>


                    </tbody>
                </table>
            </div>

        </div>

        <!--pagination-->
        <div class="py-5">
            <pagination :data="tasks"></pagination>
        </div>

        <!--create and update modals-->
        <!-- create new task-->
        <create-task :show="newTaskModal" @close="newTaskModal=false"></create-task>


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
    tasks:Object,
    filters:Object,
    statuses:Object
})

const user = computed(() => usePage().props.auth)
const newTaskModal=ref(false)
const showing=ref<Number>(props.filters.showing?props.filters.showing:10)
const search=ref(props.filters.search?props.filters.search:'')
const status=ref(props.filters.status?props.filters.status:null)



watch([search, showing, status], debounce(function (value:any) {
    router.get('/',{
        search:search.value,
        showing:showing.value,
        status:status.value
    }, {preserveState:true, replace:true});
}, 300))


</script>

<style scoped>

</style>
