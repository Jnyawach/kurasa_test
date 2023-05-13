<template>
    <toast></toast>
    <main>
        <!--header-->
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


            <div class="flex gap-2">
                <div class="w-56">
                    <ul class="sticky top-0 space-y-5">
                        <li>
                            <Link href="/" title="supermarkets">Supermarkets</Link>
                        </li>
                        <li>
                            <Link href="#" title="supermarkets">Managers</Link>
                        </li>
                        <li>
                            <Link href="#" title="supermarkets">Employees</Link>
                        </li>
                        <li>
                            <Link href="#" title="supermarkets">Suppliers</Link>
                        </li>
                    </ul>
                </div>
                <div class=" w-full">
                    <slot/>
                </div>

            </div>






        </div>
    </main>
</template>

<script setup lang="ts">
import {Link, usePage} from "@inertiajs/vue3";
import {computed, ref, watch} from "vue";
import Toast from "@/views/components/toast.vue";
const user = computed(() => usePage().props.auth)
</script>

<style scoped>

</style>
