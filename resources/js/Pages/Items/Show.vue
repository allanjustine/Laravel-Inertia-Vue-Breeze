<template>
    <Head :title="'View Item | ' + item.name"></Head>

    <AuthenticatedLayout>
      <template #header>
        <div class="flex justify-between">
          <h2>View Item | {{ item.name }}</h2>
          <div>
            <Link
              href="/items"
              class="px-4 py-2 bg-gray-100 shadow border-gray-300 border hover:bg-white rounded"
            >
              Back
            </Link>
          </div>
        </div>
      </template>

      <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow rounded py-6 flex">
          <img :src="item.picUrl" alt="Product photo" class="aspect-square w-[40%] object-cover">
          <div class="pl-6 w-full flex flex-col">
            <h4 class="text-3xl mb-6">{{ item.name }}</h4>
            <div class="p-4 bg-gray-100 flex-1">
              {{ item.description }}
            </div>
            <div class="flex justify-end mt-4">
              <Link
                :href="'/items/' + item.id"
                method="delete"
                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
              >
                Delete
              </Link>
            </div>
            <div class="flex justify-between items-center mt-4">
              <div>
                {{ item.qty }} items available.
              </div>
              <h4 class="text-4xl text-blue-700">
                PhP {{ item.price }}
              </h4>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>

  <script setup>
  import { Link, Head } from '@inertiajs/vue3'
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'


  const prop = defineProps({
    item: Object
  })
  </script>
