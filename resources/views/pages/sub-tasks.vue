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
            <div class="my-5 flex justify-between">
                <h1>Main task: <span class="text-sky-700 text-lg font-bold">{{task.data.name}}</span></h1>
                <Link href="/" class="hover:text-sky-600 group flex items-center gap-2">

                    <svg class="h-5 fill-inherit group-hover:fill-sky-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M48.03 424V88c0-13.25-10.76-24-24.02-24S0 74.75 0 88v336C0 437.3 10.76 448 24.02 448S48.03 437.3 48.03 424zM272.3 366.5L180.3 280h243.6C437.2 280 448 269.3 448 256s-10.76-23.1-24.02-23.1H180.3l91.98-86.53c5.035-4.719 7.568-11.09 7.568-17.47c0-5.906-2.158-11.81-6.536-16.44c-9.069-9.656-24.27-10.12-33.93-1.031l-136.1 128c-9.694 9.062-9.694 25.87 0 34.94l136.1 128c9.663 9.094 24.86 8.625 33.93-1.031C282.5 390.8 282 375.6 272.3 366.5z"/></svg>
                    <span >Return to all tasks</span>

                </Link>
            </div>

            <div class="my-8 flex justify-between px-3">
                <div class="flex gap-3">
                    <!--top filter-->
                    <p class="self-center"><span class="font-bold text-gray-900">{{sub_tasks.data.length}} Sub Task(s)</span> (of {{sub_tasks.meta.total}})</p>
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
                    <button @click="assignModal=true" class="font-bold text-sky-700 flex items-center gap-2">
                        <svg class="h-4 fill-sky-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.0.0-alpha3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M432 256C432 269.3 421.3 280 408 280h-160v160c0 13.25-10.75 24.01-24 24.01S200 453.3 200 440v-160h-160c-13.25 0-24-10.74-24-23.99C16 242.8 26.75 232 40 232h160v-160c0-13.25 10.75-23.99 24-23.99S248 58.75 248 72v160h160C421.3 232 432 242.8 432 256z"/></svg>
                        <span>Assign New Member</span>

                    </button>
                </div>
            </div>

            <!--sub_tasks table-->

            <div class="bg-white shadow-lg  rounded-xl my-5">

                <div class="relative  sm:rounded-lg ">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-sky-700 uppercase bg-gray-100 ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Owner
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Due Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Start Time
                            </th>
                            <th scope="col" class="px-6 py-3">
                                End Time
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Details
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody class="[&>*:nth-child(even)]:bg-gray-100 text-[12px]" v-if="sub_tasks.data.length">
                        <tr :key="activity.id" v-for="activity in sub_tasks.data" class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{activity.user.name}}
                            </th>

                            <td class="px-6 py-2">
                                <span v-if="activity.status.name==='Cancelled'" class="text-red-900">{{activity.status.name}}</span>
                                <span v-if="activity.status.name==='Pending'" class="text-yellow-600">{{activity.status.name}}</span>
                                <span v-if="activity.status.name==='Progress'" class="text-lime-500">{{activity.status.name}}</span>
                                <span v-if="activity.status.name==='Complete'" class="text-green-600">{{activity.status.name}}</span>
                            </td>
                            <td class="px-6 py-2">
                                {{new Date(activity.due_date).toDateString()}}
                            </td>
                            <td class="px-6 py-2">
                                <span v-if="activity.start_time">{{moment(activity.start_time).format("ddd MMM DD, YYYY [at] HH:mm a")}}</span>
                                <span v-else>-</span>
                            </td>
                            <td class="px-6 py-2">
                                <span v-if="activity.end_time">{{moment(activity.end_time).format("ddd MMM DD, YYYY [at] HH:mm a")}}</span>
                                <span v-else>-</span>
                            </td>
                            <td class="px-6 py-2">
                               <task-details :sub_task="activity" :task="task.data" ></task-details>
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

                                            <li class="py-3 px-2" v-if="activity.status.name!=='Complete'">
                                                <sub-task-complete :sub_task="activity"></sub-task-complete>
                                            </li>
                                            <li class="py-3 px-2" v-if="activity.status.name!=='Cancelled' && activity.status.name!=='Complete'">
                                                <Link as="button" method="patch" :href="'/sub_tasks/cancel/'+activity.id" class="hover:text-sky-700">Cancel task</Link>
                                            </li>
                                            <li class="py-3 px-2">
                                                <Link as="button" method="patch" :href="'/sub_tasks/trash/'+activity.id" class="hover:text-sky-700">Move to Trash</Link>
                                            </li>
                                            <li class="py-3 px-2">
                                                <Link :href="'/sub_tasks/'+activity.id" as="button" method="delete" class="hover:text-sky-700">Delete</Link>
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
                <pagination :data="sub_tasks"></pagination>
            </div>

            <!--create and update modals-->
            <!-- Assign new member modal-->
            <assign-member :show="assignModal" @close="assignModal=false" :task="task.data"></assign-member>



        </div>
    </main>
</template>

<script setup lang="ts">
import {Link, router, usePage} from "@inertiajs/vue3";
import Pagination from "@/views/components/pagination.vue";
import {computed, ref, watch} from "vue";
import Dropdown from "@/views/components/dropdown.vue";
import Toast from "@/views/components/toast.vue";
import {debounce} from 'lodash';
import moment from "moment";
import AssignMember from "@/views/components/assign-member.vue";
import TaskDetails from "@/views/components/task-details.vue";
import SubTaskComplete from "@/views/components/sub-task-complete.vue";


let props=defineProps({
    sub_tasks:Object,
    filters:Object,
    statuses:Object,
    task:Object
})

const user = computed(() => usePage().props.auth)
const assignModal=ref(false)
const showing=ref<Number>(props.filters.showing?props.filters.showing:10)
const status=ref(props.filters.status?props.filters.status:null)



watch([ showing, status], debounce(function (value:any) {
    router.get('/tasks/'+props.task.data.id,{
        showing:showing.value,
        status:status.value
    }, {preserveState:true, replace:true});
}, 300))


</script>

<style scoped>

</style>
