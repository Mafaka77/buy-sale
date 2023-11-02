<template>
    <q-layout view="hHh lpR fFf">

        <q-header elevated class="bg-primary text-white">
            <q-toolbar>
                <q-btn flat @click="drawer = !drawer" round dense icon="menu" />

                <q-toolbar-title>
                    <q-avatar>
                        <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
                    </q-avatar>
                    Title
                </q-toolbar-title>
            </q-toolbar>
        </q-header>

        <q-drawer
            v-model="drawer"
            show-if-above

            :mini="miniState"
            @mouseover="miniState = false"
            @mouseout="miniState = true"

            :width="200"
            :breakpoint="500"
            bordered
            :class="$q.dark.isActive ? 'bg-grey-9' : 'bg-grey-3'"
        >
        <DrawerComponent/>
        </q-drawer>

        <q-page-container>
            <div class="q-pa-xl">
                <slot/>
            </div>

        </q-page-container>

    </q-layout>
</template>

<script setup>
import { ref } from 'vue'
import DrawerComponent from "@/Components/DrawerComponent.vue";
const drawer=ref(false);
const  miniState= ref(true);
const leftDrawerOpen = ref(false)
const toggleLeftDrawer =()=> {
    leftDrawerOpen.value = !leftDrawerOpen.value
}

</script>
