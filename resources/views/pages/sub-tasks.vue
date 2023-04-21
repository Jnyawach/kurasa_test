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
            <div class="my-5 flex justify-between">
                <h1>Main task: <span class="text-sky-700 text-lg font-bold">{{task.data.name}}</span></h1>
                <Link href="/" class="hover:text-sky-600"><span class="mr-2"><i class="fal fa-arrow-to-left"></i></span>Return to all tasks</Link>
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
                    <button @click="assignModal=true" class="font-bold text-sky-700">
                        <span class="mr-1"><i class="fal fa-plus"></i></span>Assign New Member
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
                        <tbody class="[&>*:nth-child(even)]:bg-gray-100" v-if="sub_tasks.data.length">
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
                                        <button class="flex text-sky-700"><span class="mr-1 self-center"><i class="far fa-ellipsis-v"></i></span><span class="self-center">Action</span></button>
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
