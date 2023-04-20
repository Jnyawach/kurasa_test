<template>
    <toast></toast>
<main>
    <div class="py-5 text-white" style="background-image: url('/images/bg-desktop-dark.jpg');">
       <div class="flex justify-between p-10 max-w-[1200px] mx-auto">
           <div class="flex gap-1">

               <h1 class="text self-center capitalize"><span class="mr-2"><i class="fal fa-user"></i></span>{{user.name}}</h1>
           </div>
           <div>
               <Link class="" as="button" method="post" href="/user/logout">
                   <span class="mr-1"><i class="fal fa-lock"></i></span>Logout
               </Link>
           </div>
       </div>
    </div>

    <div class="my-10 px-10">
        <div class="rounded-xl bg-gray-100 py-3 px-3">
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
                <button @click="newTaskModal=true" class="font-bold text-sky-700">
                    <span class="mr-1"><i class="fal fa-plus"></i></span>New task
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
                    <tbody class="[&>*:nth-child(even)]:bg-gray-100">
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
                                    <button class="flex text-sky-700"><span class="mr-1 self-center"><i class="far fa-ellipsis-v"></i></span><span class="self-center">Action</span></button>
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
