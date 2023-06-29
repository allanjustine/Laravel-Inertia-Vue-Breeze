<template>
    <div class="item-card" :class="{ 'item-card--enabled': item.enabled }" @click="openItem">
      <img :src="item.picUrl" alt="Product photo" class="aspect-square w-full object-cover mb-4">

      <h4 class="text-2xl">Item: {{ item?.name }}</h4>
      <div class="text-gray-400">{{ item?.description }}</div>
      <div class="flex justify-between mt-4">
        <div>&nbsp;</div>
        <label :for="'enabled' + '-' + item.id" class="switch">
          <input type="checkbox" :id="'enabled' + '-' + item.id" :checked="item.enabled" @change.prevent="toggleEnabled(item)">
          <span class="slider round"></span>
        </label>
      </div>
    </div>
  </template>

  <style scoped>
  .item-card {
    background-color: white;
    padding: 1.5rem;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
  }

  .item-card:hover {
    background-color: #f7fafc;
  }

  .item-card--enabled {
    background-color: #edf2f7;
  }

  .item-card img {
    width: 100%;
    aspect-ratio: 1/1;
    object-fit: cover;
    margin-bottom: 1rem;
  }

  .item-card h4 {
    font-size: 1.5rem;
  }

  .item-card .text-gray-400 {
    color: #718096;
  }

  .switch {
    position: relative;
    display: inline-block;
    width: 44px;
    height: 24px;
  }

  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .slider {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    border-radius: 34px;
    transition: 0.4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    border-radius: 50%;
    transition: 0.4s;
  }

  input:checked + .slider {
    background-color: #2196f3;
  }

  input:checked + .slider:before {
    transform: translateX(20px);
  }

  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
  </style>

  <script setup>
  import { defineProps } from 'vue';
  import { router } from '@inertiajs/vue3';

  const prop = defineProps({
    item: Object
  });

  function openItem() {
    router.visit('/items/' + prop.item.id);
  }

  function toggleEnabled(item) {
    item.enabled = !item.enabled; // Toggle the enabled state locally
    router.visit('/items/toggle/' + item.id, {
      method: 'post',
      preserveScroll: true
    });
  }
  </script>
