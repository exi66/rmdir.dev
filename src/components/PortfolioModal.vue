
<script setup>
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Pagination } from 'vue3-carousel'
</script>

<script>
export default {
  components: {
    Carousel,
    Slide,
    Pagination,
  },
  props: {
    open: {
      type: Boolean,
      required: true
    },
    data: {
      type: Object,
      required: true
    },
  },
  computed: {
    isOpen() {
      return this.open
    }
  },
}
</script>

<template>
  <div class="modal fixed top-0 left-0 w-screen h-screen z-30 flex" tabindex="-1" v-if="isOpen">
    <div class="modal-backdrop" @click="$emit('closeModal')"></div>
    <button class="absolute top-0 right-0 p-1" @click="$emit('closeModal')">
      <i class="bi bi-x-lg text-2xl mx-0.5"></i>
    </button>
    <div class="modal-content relative m-8 bg-[--dark] rounded-lg flex-grow overflow-auto">
      <div class="modal-body p-3 flex flex-col-reverse lg:flex-row">
        <div class="flex-1">
          <div class="p-3 m-2 bg-[--semi-dark] rounded-lg">
            <Carousel :autoplay="0" :itemsToShow="1.3" :wrapAround="true" :transition="500">
              <Slide v-for="slide in data.slide" :key="slide">
                <img :src="slide" class="carousel__item rounded-lg">
              </Slide>
              <template #addons>
                <Pagination />
              </template>
            </Carousel>
          </div>
        </div>
        <div class="flex-1 flex flex-col">
          <div class="p-3 m-2 bg-[--semi-dark] rounded-lg">
            <h1 class="text-2xl uppercase text-center mb-3">
              <a v-if="data.url" :href="data.url" class="truncate">
                {{ data.name }}<i class="ms-2 text-[--orange] bi bi-link-45deg text-lg"></i>
              </a>
              <span v-else>{{ data.name }}</span>
            </h1>
            <ul class="list-disc ms-6">
              <li class="my-2">
                <p>
                  <span class="font-bold">Categories: </span>
                  <span class="px-1 py-0.5 rounded bg-[--orange] mx-1" v-for="item in data.category" :key="item">{{ item }}</span>
                </p>
              </li>
              <li class="my-2">
                <p>
                  <span class="font-bold">Tech: </span>
                  <span class="px-1 py-0.5 rounded bg-[--orange] mx-1" v-for="item in data.tech" :key="item">{{ item }}</span>
                </p>
              </li>
            </ul>
          </div>
          <div class="p-3 m-2 bg-[--semi-dark] rounded-lg">
            <h1 class="text-2xl uppercase text-center mb-3">Description</h1>
            <p>
              {{ data.description }}. {{ data.details }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.modal-backdrop {
  background-color: rgba(0, 0, 0, .5);
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
}

.carousel__slide {
  padding: 5px;
}

.carousel__viewport {
  perspective: 2000px;
}

.carousel__track {
  transform-style: preserve-3d;
}

.carousel__slide--sliding {
  transition: 0.5s;
}

.carousel__slide {
  opacity: 0.9;
  transform: rotateY(-20deg) scale(0.9);
}

.carousel__slide--active~.carousel__slide {
  transform: rotateY(20deg) scale(0.9);
}

.carousel__slide--prev {
  opacity: 1;
  transform: rotateY(-20deg) scale(0.9);
}

.carousel__slide--next {
  opacity: 1;
  transform: rotateY(-20deg) scale(0.9);
}

.carousel__slide--active {
  opacity: 1;
  transform: rotateY(0) scale(1);
}
</style>
