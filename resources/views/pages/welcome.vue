<template>
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
        <div class="rounded-xl bg-gray-100 flex justify-between py-3 px-3">
           <div class="flex gap-2">
               <span><i class="far fa-search"></i></span>
               <input type="search" placeholder="Search task by name..." class="bg-transparent text-gray-700
               self-center placeholder-gray-500 w-96 focus:border-0 focus:outline-0 focus:ring-0 self-center">
           </div>

            <div class="flex gap-2">
                <button class="text-sky-700 font-bold">
                    Filter<span class="ml-2"><i class="fal fa-sliders-h"></i></span>
                </button>
            </div>
        </div>
        <div class="my-8 flex justify-between px-3">
            <div class="flex gap-3">
                <label>
                    <input type="checkbox" class="hidden">
                    <span class="text-sky-700 text-lg"><i class="fas fa-check-circle"></i></span>
                    <span class="text-lg"><i class="far fa-circle"></i></span>
                </label>
                <p class="self-center"><span class="font-bold text-gray-900">14 tasks</span> (of 103)</p>
                <select class="text-sky-700 bg-transparent focus:border-0 focus:ring-0 focus:outline-0">
                    <option>Showing 10</option>
                    <option>Showing 50</option>
                    <option>Showing 100</option>
                </select>
            </div>
            <div class="flex gap-3 text-sm">
                <button class="font-bold">
                    <span class="mr-1"><i class="far fa-check-circle"></i></span>Mark complete
                </button>
                <button class="font-bold">
                    <span class="mr-1"><i class="far fa-trash-restore"></i></span>Move to trash
                </button>
                <button class="font-bold text-red-700">
                    <span class="mr-1"><i class="far fa-trash-alt"></i></span>Delete
                </button>
                <button @click="newTaskModal=true" class="font-bold text-sky-700">
                    <span class="mr-1"><i class="fal fa-plus"></i></span>New task
                </button>
            </div>
        </div>

        <!--tasks table-->

        <div class="bg-white shadow-lg  rounded-xl overflow-hidden my-5">

            <div class="relative overflow-x-auto sm:rounded-lg ">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-sky-700 uppercase bg-gray-100 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Task Name
                        </th>
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
                            Start Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            End Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <label>
                                <input type="checkbox" class="hidden">
                                <span class="text-sky-700"><i class="fas fa-check-circle"></i></span>
                                <span class=""><i class="far fa-circle"></i></span>
                            </label>
                            Complete Authentication
                        </th>
                        <td class="px-6 py-2">
                           Joshua
                        </td>
                        <td class="px-6 py-2">
                            Progress
                        </td>
                        <td class="px-6 py-2">
                           Jun 3, 2023
                        </td>
                        <td class="px-6 py-2">
                            Jun 3, 2023
                        </td>
                        <td class="px-6 py-2">
                            Jun 3, 2023
                        </td>
                        <td class="px-6 py-2">
                            <button class="flex text-sky-700"><span class="mr-1 self-center"><i class="far fa-ellipsis-v"></i></span><span class="self-center">Action</span></button>
                        </td>
                    </tr>
                    <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Complete Authentication
                        </th>
                        <td class="px-6 py-2">
                            Joshua
                        </td>
                        <td class="px-6 py-2">
                            Progress
                        </td>
                        <td class="px-6 py-2">
                            Jun 3, 2023
                        </td>
                        <td class="px-6 py-2">
                            Jun 3, 2023
                        </td>
                        <td class="px-6 py-2">
                            Jun 3, 2023
                        </td>
                        <td class="px-6 py-2">
                            <button class="flex text-sky-700"><span class="mr-1 self-center"><i class="far fa-ellipsis-v"></i></span><span class="self-center">Action</span></button>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>

        <!--pagination-->
        <div class="py-5">
            <pagination></pagination>
        </div>

        <!--create and update modals-->
        <!-- create new task-->
        <create-task :show="newTaskModal" @close="newTaskModal=false"></create-task>


    </div>
</main>
</template>

<script setup lang="ts">
import {Link, usePage} from "@inertiajs/vue3";
import Pagination from "@/views/components/pagination.vue";
import {computed, ref} from "vue";
import CreateTask from "@/views/components/create-task.vue";

const user = computed(() => usePage().props.auth)

const newTaskModal=ref(false)
</script>

<style scoped>

</style>
