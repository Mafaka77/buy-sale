<template>

        <q-scroll-area class="fit" :horizontal-thumb-style="{ opacity: 0 }">
            <q-list padding>
                <q-item clickable v-ripple @click="e=>router.get(route('dashboard'))">
                    <q-item-section avatar>
                        <q-icon name="inbox" />
                    </q-item-section>

                    <q-item-section>
                        Dashboard
                    </q-item-section>
                </q-item>
                <q-expansion-item
                    icon="perm_identity"
                    label="Manage"
                >
                    <q-item  clickable v-ripple @click="e=>router.get(route('category.index'))">
<!--                        <q-item-section avatar>-->
<!--                            <q-icon name="star" />-->
<!--                        </q-item-section>-->

                        <q-item-section>
                            Manage Category
                        </q-item-section>
                    </q-item>
                    <q-item clickable v-ripple @click="e=>router.get(route('house-type.index'))">
<!--                        <q-item-section avatar>-->
<!--                            <q-icon name="send" />-->
<!--                        </q-item-section>-->

                        <q-item-section>
                            Manage House Type
                        </q-item-section>
                    </q-item>
                    <q-item clickable v-ripple @click="e=>router.get(route('furnish-type.index'))">
                        <!--                        <q-item-section avatar>-->
                        <!--                            <q-icon name="send" />-->
                        <!--                        </q-item-section>-->

                        <q-item-section>
                            Manage Furnish Type
                        </q-item-section>
                    </q-item>
                    <q-item clickable v-ripple @click="e=>router.get(route('furnishing.index'))">
                        <!--                        <q-item-section avatar>-->
                        <!--                            <q-icon name="send" />-->
                        <!--                        </q-item-section>-->

                        <q-item-section>
                            Manage Furnishing
                        </q-item-section>
                    </q-item>
                    <q-item clickable v-ripple @click="e=>router.get(route('amenities.index'))">
                        <!--                        <q-item-section avatar>-->
                        <!--                            <q-icon name="send" />-->
                        <!--                        </q-item-section>-->

                        <q-item-section>
                            Manage Amenities
                        </q-item-section>
                    </q-item>
                    <q-item clickable v-ripple @click="e=>router.get(route('brands.index'))">
                        <!--                        <q-item-section avatar>-->
                        <!--                            <q-icon name="send" />-->
                        <!--                        </q-item-section>-->

                        <q-item-section>
                            Manage Brands
                        </q-item-section>
                    </q-item>
                    <q-item clickable v-ripple @click="e=>router.get(route('sub-category.index'))">
                        <!--                        <q-item-section avatar>-->
                        <!--                            <q-icon name="send" />-->
                        <!--                        </q-item-section>-->

                        <q-item-section>
                            Manage Sub-Category
                        </q-item-section>
                    </q-item>
                    <q-separator />
                </q-expansion-item>




                <q-item clickable v-ripple>
                    <q-item-section avatar>
                        <q-icon name="drafts" />
                    </q-item-section>

                    <q-item-section>
                        Drafts
                    </q-item-section>
                </q-item>
            </q-list>
        </q-scroll-area>
</template>

<script setup>

import {router} from "@inertiajs/vue3";
</script>

<style scoped>

</style>
