<template>
    <div class="q-pl-xl q-pr-xl">
        <div class="row">
        </div>

        <q-table
            flat bordered
            title="Brands"
            :rows="brandList"
            :columns="columns"
            row-key="name"
            :pagination="initialPagination"
        >
            <template v-slot:top-right>
                <q-btn
                    @click="openAddModal"
                    outline
                    rounded
                    label="Add Brands"
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
                    <q-toolbar-title><span class="text-weight-bold"> Brands</span></q-toolbar-title>
                    <q-btn flat round dense icon="close" v-close-popup/>
                </q-toolbar>
                <q-card-section>
                    <form @submit.prevent="submit" method="POST">
                        <div class="q-pa-md">
                            <div class="q-gutter-x-md column" style="width: 400px">
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
                                <q-input
                                    outlined
                                    v-model="form.brand_name"
                                    :error="!form.errors.brand_name===false"
                                    :error-message="form.errors.brand_name"
                                    dense
                                    placeholder="Brand  Name *">
                                    <template v-slot:prepend>
                                        <q-icon name="add" />
                                    </template>
                                </q-input>
                                <q-file
                                    v-model="form.brand_logo"
                                    :display-value="form.brand_logo"
                                    :error="!form.errors.brand_logo===false"
                                    :error-message="form.errors.brand_logo"
                                    label="Upload  Logo (Below <3Mb)"
                                    color="green"
                                    dense
                                    counter
                                    outlined
                                    max-file-size="3145728"
                                    @update:model-value="uploadIcon"
                                    @rejected="onFileRejected"
                                >
                                    <template v-slot:prepend>
                                        <q-icon name="attach_file" />
                                    </template>
                                </q-file>
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
    brand_name:'',
    brand_logo:'',
    category_id:0
});
const props=defineProps({
    'brands':[],
    'category':[],
});
const brandList=ref(props.brands);
const columns = [
    {name: 'id', align: 'left', label: 'ID', field: 'id'},
    {name: 'name', align: 'left', label: ' Name', field: 'brand_name'},
    {name: 'category', align: 'left', label: 'Category ', field:e=>e.category.category_name},
    {name: 'actions', align: 'right', label: 'Actions', field: 'id'}
]
const openAddModal=()=>{
    modal.value=true;
    isEdit.value=false;
}
const uploadIcon=()=>{
    const formData = new FormData()
    formData.append('logo',form.brand_logo);
    q.loading.show({
        message:'File uploading......'
    });
    axios.post(route('upload-brand-logo'), formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }).then((response) => {
        q.loading.hide();
        form.brand_logo=response.data.data;
        q.notify({
            type: 'positive',
            message: `File Uploaded Successfully`
        })
    }).catch((ex)=>{

        q.loading.hide();
        q.notify({
            type: 'negative',
            message: ex
        })
    })
}
const submit=()=>{
    form.post(route('brands.store'),{
        onStart:()=>q.loading.show(),
        onSuccess:()=>{
            q.loading.hide();
            q.notify({
                message:'Brand created',
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
