<template>
    <Head title="Items" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2>Items</h2>
                <div style="position: relative">
                    <input
                        type="text"
                        @keydown.enter="search($event)"
                        class="border border-gray-400 rounded-full w=[300px]"
                    />
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="#888888"
                        width="20px"
                        height="20px"
                        viewBox="0 0 16 16"
                        style="position: absolute; right: 10px; top: 10px"
                    >
                        <path
                            d="M12.027 9.92L16 13.95 14 16l-4.075-3.976A6.465 6.465 0 0 1 6.5 13C2.91 13 0 10.083 0 6.5 0 2.91 2.917 0 6.5 0 10.09 0 13 2.917 13 6.5a6.463 6.463 0 0 1-.973 3.42zM1.997 6.452c0 2.48 2.014 4.5 4.5 4.5 2.48 0 4.5-2.015 4.5-4.5 0-2.48-2.015-4.5-4.5-4.5-2.48 0-4.5 2.014-4.5 4.5z"
                            fill-rule="evenodd"
                        />
                    </svg>
                </div>
                <div>
                    <Link
                        href="/items/create"
                        class="px-4 py-2 bg-gray-100 shadow border-gray-300 border hover:bg-white rounded"
                    >
                        Create Item
                    </Link>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden shadow-sm grid grid-cols-3 grid-flow-row gap-4 sm:rounded-lg"
                >
                    <ItemComponent
                        v-for="item in items"
                        :key="item.id"
                        :item="item"
                    />
                </div>

                <span class="ms-auto" v-if="items.length === 0"
                    >No items found.</span
                >
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ItemComponent from "@/Components/ItemComponent.vue";
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import { reactive } from "vue";

const prop = defineProps({
    items: Array,
});

function search(ev) {
    router.visit("/items/search/" + ev.target.value);
}
</script>
