<script setup>
import anime from 'animejs/lib/anime.es.js'
import Card from '@/components/PortfolioCard.vue'
import Modal from '@/components/PortfolioModal.vue'
import { ref } from 'vue'
</script>
<script>
export default {
  components: [
    Card,
  ],
  props: {
    data: {
      type: Array,
      required: true
    },
  },
  data() {
    return {
      projects: [],
      categories: [],
      openModal: ref(false),
      currentData: {},
      minHeight: 'auto',
    }
  },
  mounted() {
    let tmp = this.data.map(e => e.category), __tmp = [];
    for (let e of tmp) {
      __tmp = __tmp.concat(e);
    }
    this.categories = __tmp.filter((value, index, array) => array.indexOf(value) === index);
    this.projects = this.data;
  },
  created() {
    this.$nextTick(() => {
      this.minHeight = this.$refs.wrapper.clientHeight + 'px';
    });
  },
  methods: {
    openDetails(data) {
      this.currentData = data;
      document.body.classList.add('modal-open');
      this.openModal = true;
    },
    closeDetails() {
      document.body.classList.remove('modal-open');
      this.openModal = false;
    },
    sortProjects(cat) {
      if (cat !== 'all') {
        this.projects = this.data.filter(e => e.category.includes(cat));
      } else {
        this.projects = this.data;
      }
    },
    beforeEnter: function (el) {
      anime.set(el, {
        opacity: 0,
        scale: 0.8
      });
    },
    enter: function (el, done) {
      anime({
        targets: el,
        delay: el.dataset.index * 30,
        duration: 300,
        easing: 'easeOutCubic',
        opacity: 1,
        scale: 1,
        complete: done
      });
    },
    leave: function (el, done) {
      el.classList.add('items-leave-active')
      anime({
        targets: el,
        duration: 300,
        easing: 'easeOutCubic',
        opacity: 0,
        scale: 0.5,
        complete: () => {
          el.classList.remove('items-leave-active')
          done();
        }
      });
    },
    beforeLeave() { },
    afterLeave() { },
    afterEnter() { },
  }
}
</script>

<template>
  <div class="relative calc-height" ref="wrapper">
    <div class="flex flex-row flex-wrap">
      <button class="border flex-1 rounded-md px-2 py-1 m-2 hover:text-black hover:bg-white uppercase"
        @click="sortProjects('all')">All</button>
      <button v-for="item in categories" :key="item"
        class="border flex-1 rounded-md px-2 py-1 m-2 hover:text-black hover:bg-white uppercase"
        @click="sortProjects(item)">{{ item }}</button>
    </div>
    <div class="flex flex-col md:flex-row flex-wrap my-2 relative">
      <transition-group name="items" :css="false" @before-enter="beforeEnter" @before-leave="beforeLeave"
        @after-enter="afterEnter" @after-leave="afterLeave" @enter="enter" @leave="leave">
        <Card v-for="item in projects" :key="item.name" :image="item.thumbnail" :text="item.description"
          :title="item.name" :data="item" style="min-width: 25%;" class="card" @openDetails="openDetails">
        </Card>
      </transition-group>
    </div>
  </div>
  <Modal v-model:open="openModal" v-model:data="currentData" @closeModal="closeDetails"></Modal>
</template>

<style scoped>
.calc-height {
  min-height: v-bind(minHeight);
}

.items-leave-active {
  position: absolute;
}

.items-move {
  transition: transform .3s ease-out;
}

@media (min-width: 768px) {
  .card {
    max-width: 25%;
  }
}
</style>
