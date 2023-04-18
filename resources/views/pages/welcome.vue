<template>
<main>
    <div class="py-5 text-white" style="background-image: url('/images/bg-desktop-dark.jpg');">
       <div class="flex justify-between p-10 max-w-[1200px] mx-auto">
           <div class="flex gap-1">

               <h1 class="text self-center"><span class="mr-2"><i class="fal fa-user"></i></span>Joshua</h1>
           </div>
           <div>
               <Link class="" as="button">
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
        <div class="py-5 flex justify-between px-3">
            <div class="flex gap-3">
                <input type="checkbox" class="h-4 w-4 border-2 rounded-full rounded-lg bg-sky-700 self-center">
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
                    <span class="mr-1"><i class="far fa-trash-restore"></i></span>Trash
                </button>
                <button class="font-bold text-red-700">
                    <span class="mr-1"><i class="far fa-trash-alt"></i></span>Delete
                </button>
            </div>
        </div>

        <!--tasks table-->

        <div class="bg-white shadow-lg border rounded-xl overflow-hidden my-5">

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Color
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Apple MacBook Pro 17"
                        </th>
                        <td class="px-6 py-4">
                            Silver
                        </td>
                        <td class="px-6 py-4">
                            Laptop
                        </td>
                        <td class="px-6 py-4">
                            $2999
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Microsoft Surface Pro
                        </th>
                        <td class="px-6 py-4">
                            White
                        </td>
                        <td class="px-6 py-4">
                            Laptop PC
                        </td>
                        <td class="px-6 py-4">
                            $1999
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Magic Mouse 2
                        </th>
                        <td class="px-6 py-4">
                            Black
                        </td>
                        <td class="px-6 py-4">
                            Accessories
                        </td>
                        <td class="px-6 py-4">
                            $99
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Google Pixel Phone
                        </th>
                        <td class="px-6 py-4">
                            Gray
                        </td>
                        <td class="px-6 py-4">
                            Phone
                        </td>
                        <td class="px-6 py-4">
                            $799
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Apple Watch 5
                        </th>
                        <td class="px-6 py-4">
                            Red
                        </td>
                        <td class="px-6 py-4">
                            Wearables
                        </td>
                        <td class="px-6 py-4">
                            $999
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>


    </div>
</main>
</template>

<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
</script>

<style scoped>

</style>
