<script setup>

</script>

<template>
    <q-layout view="hHh lpR fff">
        <q-header class="bg-white text-black" bordered  style="border-bottom-color: green">
            <q-toolbar>
                <div class="col q-pl-lg q-mb-sm" >
                    <q-toolbar-title>
                        <div class="row justify-center q-pt-md">
                            <div class="col-xs-12 col-md-5 text-center links">
                            </div>
                            <div class="col-xs-12 col-md-5 text-center links">

                            </div>

                        </div>

                    </q-toolbar-title>

                </div>
            </q-toolbar>
        </q-header>
        <q-page-container>
            <q-page style="width: 100%">
                <slot/>
            </q-page>
        </q-page-container>
    </q-layout>
</template>
