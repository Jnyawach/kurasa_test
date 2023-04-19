<template>
    <Head>
        <title>Login</title>

    </Head>
    <div class="h-screen flex justify-center items-center">
        <div class="my-auto self-center bg-white rounded-3xl shadow overflow-hidden w-96">
            <div class=" py-5 px-5 ">
                <h1 class="font-semibold text-xl text-center mt-5 text-sky-700">Login</h1>
            </div>
            <div class="py-5 px-5">
                <form @submit.prevent="form.post('authenticate')">
                    <div class="mt-3">
                        <label for="form-input" class="creative-label"><span class="mr-2 text-sky-700"><i class="fal fa-envelope"></i></span>Email:</label>
                        <input type="email" class="creative-input" id="form-input" placeholder="Enter your email" required v-model="form.email"/>
                        <div v-if="form.errors.email" class="creative-error">
                            <span>{{ form.errors.email }}</span>
                        </div>
                    </div>
                    <div class="mt-7">
                        <label for="password" class="creative-label"><span class="mr-2 text-sky-700"><i class="fal fa-lock"></i></span>Password:</label>
                        <input type="password" class="creative-input" id="password" placeholder="Enter your password" required v-model="form.password"/>
                        <div v-if="form.errors.password" class="creative-error">
                            <span>{{ form.errors.password}}</span>
                        </div>
                    </div>
                    <div class="flex mt-4 place-content-end">
                        <button type="submit" class="btn-primary  m-1">Login</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</template>

<script setup lang="ts">
import {Head, useForm, Link} from "@inertiajs/vue3";

let form=useForm({
    email: '',
    password: '',

})


</script>

<style scoped>

</style>
