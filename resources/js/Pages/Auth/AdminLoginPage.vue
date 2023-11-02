<template>
    <div class="container">
        <div class="row justify-center items-center ">
            <div class="col-xs-12 col-md-4  absolute-center text-center ">
                <q-card flat bordered class="q-pa-xl">
                    <h5 class="text-h5 text-red  q-my-md">ADMIN LOGIN</h5>
                    <form method="post" @submit.prevent="$el=>submit()">
                        <div class="q-col-gutter-lg">
                            <q-input

                                outlined
                                color="teal"
                                v-model="form.email"
                                label="Email"
                                type="email">
                                <template v-slot:prepend>
                                    <q-icon name="email" />
                                </template>
                            </q-input>
                            <q-input
                                color="teal"
                                outlined
                                v-model="form.password"
                                label="Password"
                                type="password">
                                <template v-slot:prepend>
                                    <q-icon name="password" />
                                </template>
                            </q-input>
                            <div>
                                <q-btn
                                    class="full-width text-white"
                                    label="Login"
                                    flat
                                    outline
                                    style="background-color: green"
                                    type="submit"/>
                            </div>

                        </div>
                    </form>

                </q-card>
            </div>
        </div>
    </div>
</template>

<script setup>
import {useQuasar} from "quasar";
import {ref} from 'vue';
import {useForm} from "@inertiajs/vue3";
const q=useQuasar();
const form=useForm({
    email:'',
    password:'',
})

const submit=()=>{
    form.post(route('admin-login',form),{
        onStart:()=>q.loading.show(),
        onError:(error)=>{
            q.notify({
                message:error.error,
                closeBtn:true,
                icon:'warning',
                iconColor:'red'
            })
        },
        onFinish:()=>q.loading.hide()
    })
}
</script>

<style scoped>

</style>
