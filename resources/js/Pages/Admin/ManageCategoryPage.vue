<template>
    <div class="q-pl-xl q-pr-xl">
        <div class="row">
        </div>

        <q-table
            flat bordered
            title="Category"
            :rows="categoryList"
            :columns="columns"
            row-key="name"
            :pagination="initialPagination"
        >
            <template v-slot:top-right>
                <q-btn
                    @click="openAddModal"
                    outline
                    rounded
                    label="Add Category"
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
                    <q-toolbar-title><span class="text-weight-bold"> Categories</span></q-toolbar-title>
                    <q-btn flat round dense icon="close" v-close-popup/>
                </q-toolbar>
                <q-card-section>
                    <form @submit.prevent="submit" method="POST">
                        <div class="q-pa-md">
                            <div class="q-gutter-x-md column" style="width: 400px">
                                <q-input
                                    name="sub_division_name"
                                    outlined
                                    v-model="form.category_name"
                                    :error="!form.errors.category_name===false"
                                    :error-message="form.errors.category_name"
                                    dense
                                    placeholder="Category Name *">
                                    <template v-slot:prepend>
                                        <q-icon name="add" />
                                    </template>
                                </q-input>
                                <q-file
                                    v-model="form.category_icon"
                                    :display-value="form.category_icon"
                                    :error="!form.errors.category_icon===false"
                                    :error-message="form.errors.category_icon"
                                    label="Upload Category Icon (Below <3Mb)"
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
    category_name:'',
    category_icon:''
});
const props=defineProps({
    'category':[],
});
const categoryList=ref(props.category);
const columns = [
    {name: 'id', align: 'left', label: 'ID', field: 'id'},
    {name: 'category_name', align: 'left', label: 'Category Name', field: 'category_name'},
    {name: 'category_icon', align: 'left', label: 'Icon ', field:'category_icon'},
    {name: 'actions', align: 'right', label: 'Actions', field: 'id'}
]
const openAddModal=()=>{
    modal.value=true;
    isEdit.value=false;
}
const uploadIcon=()=>{
    const formData = new FormData()
    formData.append('category_icon',form.category_icon);
    q.loading.show({
        message:'File uploading......'
    });
    axios.post(route('upload-category-icon'), formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }).then((response) => {
        q.loading.hide();
        form.category_icon=response.data.data;
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
    form.post(route('category.store'),{
        onStart:()=>q.loading.show(),
        onSuccess:()=>{
            q.loading.hide();
            q.notify({
                message:'Category created',
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
