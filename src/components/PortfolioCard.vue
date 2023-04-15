<script setup>
defineProps({
  image: {
    type: String,
    required: true
  },
  title: {
    type: String,
    required: true
  },
  text: {
    type: String,
    required: true
  },
  data: {
    required: true
  },
})
</script>

<template>
  <div class="relative p-3">
    <div class="rounded-lg p-4" :style="`background: linear-gradient(rgba(0, 0, 0, .6), rgba(0, 0, 0, .6)), url(${image}); background-position: center top; background-size: auto 100%;`">
      <h3 class="text-xl">
        {{ title }}
      </h3>
      <p class="mb-3">
        {{ text }}
      </p>
      <div class="text-center flex">
        <button class="border flex-grow rounded-md px-2 py-1 hover:text-black hover:bg-white uppercase" @click="$emit('openDetails', data)">Details</button>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
