<template>
    <div class="q-pl-xl q-pr-xl">
        <div class="row">
        </div>

        <q-table
            flat bordered
            title="Sub Category"
            :rows="subCategoryList"
            :columns="columns"
            row-key="name"
            :pagination="initialPagination"
        >
            <template v-slot:top-right>
                <q-btn
                    @click="openAddModal"
                    outline
                    rounded
                    label="Add Sub Category"
                    dense
                    flat
                    class="text-white q-px-lg q-mx-lg"
                    style="background-color:#2e6525 "
                />
            </template>
            <template v-slot:body-cell-actions="props">
                <q-td :props="props">
                    <q-btn
                        dense
                        round
                        flat
                        @click="openEditModal(props.row)"
                        icon="edit"
                        style="color: #2e6525"
                    ></q-btn>

                    <q-btn
                        dense
                        round
                        flat
                        color="red"
                        @click="deleteDistrict(props.row.id)"
                        icon="delete"
                    ></q-btn>
                </q-td>
            </template>
        </q-table>
        <q-dialog v-model="modal">
            <q-card>
                <q-toolbar>
                    <q-toolbar-title><span class="text-weight-bold"> Sub Category</span></q-toolbar-title>
                    <q-btn flat round dense icon="close" v-close-popup/>
                </q-toolbar>
                <q-card-section>
                    <form @submit.prevent="submit" method="POST">
                        <div class="q-pa-md">
                            <div class="q-gutter-x-md column" style="width: 400px">
                                <q-input
                                    outlined
                                    v-model="form.name"
                                    :error="!form.errors.name===false"
                                    :error-message="form.errors.name"
                                    dense
                                    placeholder="Sub Category Name *">
                                    <template v-slot:prepend>
                                        <q-icon name="add" />
                                    </template>
                                </q-input>
                                <q-input
                                    outlined
                                    v-model="form.tags"
                                    :error="!form.errors.tags===false"
                                    :error-message="form.errors.tags"
                                    dense
                                    placeholder="Tag Name *">
                                    <template v-slot:prepend>
                                        <q-icon name="add" />
                                    </template>
                                </q-input>
                                <q-select v-model="form.category_id" :error="!form.errors.category_id === false"
                                          :error-message="form.errors.category_id" :options="category" dense emit-value
                                          fill-input filled hide-selected map-options option-label="category_name" option-value="id"
                                          placeholder="Select Category *" standout use-input>
                                    <template v-slot:prepend>
                                        <q-icon name="book" />
                                    </template>
                                    <template v-slot:no-option>
                                        <q-item>
                                            <q-item-section class="text-gresy">
                                                No results
                                            </q-item-section>
                                        </q-item>
                                    </template>
                                </q-select>
                                <q-btn label="Submit" dense color="black" type="submit"
                                       :disable="form.processing"/>
                            </div>
                        </div>
                    </form>
                </q-card-section>
            </q-card>

        </q-dialog>
    </div>
</template>

<script setup>
import {ref} from 'vue';
import {useQuasar} from "quasar";
import {router, useForm} from "@inertiajs/vue3";

const q=useQuasar();
const modal=ref(false);
const isEdit=ref(false);
const form=useForm({
    id:0,
    name:'',
    tags:'',
    category_id:''
});
const props=defineProps({
    'subCategory':[],
    'category':[],
});
const subCategoryList=ref(props.subCategory);
const columns = [
    {name: 'id', align: 'left', label: 'ID', field: 'id'},
    {name: 'name', align: 'left', label: ' Name', field: 'name'},
    {name: 'category', align: 'left', label: 'Category ', field:e=>e.category.category_name},
    {name: 'actions', align: 'right', label: 'Actions', field: 'id'}
]
const openAddModal=()=>{
    modal.value=true;
    isEdit.value=false;
}
const submit=()=>{
    console.log(form);
    form.post(route('sub-category.store'),{
        onStart:()=>q.loading.show(),
        onSuccess:()=>{
            q.loading.hide();
            q.notify({
                message:'House Type created',
                icon:'check',
                iconColor:'blue'
            });
        },
        onError:()=>{
            q.loading.hide();
            q.notify({
                message:'Error Occured',
                icon:'warning',
                iconColor:'red'
            });
        },
        preserveState:false,

    })
}
const onFileRejected=(message)=>{
    q.notify({
        type: 'negative',
        message: `${message.length} file(s) did not pass validation constraints`
    })
}
</script>

<style scoped>

</style>
