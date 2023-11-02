<template>
    <div class="q-pl-xl q-pr-xl">
        <div class="row">
        </div>

        <q-table
            flat bordered
            title="Furnishing"
            :rows="furnishingList"
            :columns="columns"
            row-key="name"
            :pagination="initialPagination"
        >
            <template v-slot:top-right>
                <q-btn
                    @click="openAddModal"
                    outline
                    rounded
                    label="Add Furnishing"
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
                    <q-toolbar-title><span class="text-weight-bold"> House Type</span></q-toolbar-title>
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
                                    placeholder="Furnishing Name *">
                                    <template v-slot:prepend>
                                        <q-icon name="add" />
                                    </template>
                                </q-input>
                                                                <q-file
                                                                    v-model="form.icon"
                                                                    :display-value="form.icon"
                                                                    :error="!form.errors.icon===false"
                                                                    :error-message="form.errors.icon"
                                                                    label="Upload  Icon (Below <3Mb)"
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
    name:'',
    icon:''
});
const props=defineProps({
    'furnishing':[],
});
const furnishingList=ref(props.furnishing);
const columns = [
    {name: 'id', align: 'left', label: 'ID', field: 'id'},
    {name: 'name', align: 'left', label: ' Name', field: 'name'},
    {name: 'icon', align: 'left', label: ' Icon', field: 'icon'},
    {name: 'actions', align: 'right', label: 'Actions', field: 'id'}
]
const openAddModal=()=>{
    modal.value=true;
    isEdit.value=false;
}
const uploadIcon=()=>{
    const formData = new FormData()
    formData.append('icon',form.icon);
    q.loading.show({
        message:'File uploading......'
    });
    axios.post(route('upload-furnishing-icon'), formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }).then((response) => {
        q.loading.hide();
        form.icon=response.data.data;
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
    form.post(route('furnishing.store'),{
        onStart:()=>q.loading.show(),
        onSuccess:()=>{
            q.loading.hide();
            q.notify({
                message:'Furnish Type created',
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
