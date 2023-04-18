<script setup>
</script>
<script>
export default {
  data() {
    return {
      tech: [
        {
          label: 'CSS',
          techs: ['Bootstrap', 'Tailwindcss'],
        },
        {
          label: 'Frontend',
          techs: ['Vue.js', 'Webpack', 'jQuery'],
        },
        {
          label: 'Backend',
          techs: ['Laravel', 'Express.js'],
        },
        {
          label: 'Database',
          techs: ['MySQL'],
        },
        {
          label: 'Web server',
          techs: ['Nginx'],
        },
        {
          label: 'Environment',
          techs: ['Ubuntu', 'CentOS', 'Docker'],
        },
      ]
    }
  }
}
</script>

<template>
  <div class="flex flex-row">
    <div class="hidden lg:flex flex-col">
      <div class="my-auto flex" v-for="t in tech" :key="t">
        <span class="uppercase">{{ t.label }}</span>
        <div class="ms-2 flex-grow divide my-auto"></div>
      </div>
    </div>
    <div class="hidden lg:flex flex-col flex-grow">
      <div class="flex flex-row my-2" v-for="(t, index) in tech" :key="t">
        <div class="text-center rounded mx-2 p-2 flex-1 align-middle" v-for="f in t.techs" :key="f"
          :class="`bg-orange-${index > 4 ? 10 : (index + 1) * 2}`">
          {{ f }}
        </div>
      </div>
    </div>
    <div class="flex flex-col flex-grow lg:hidden">
      <fieldset class="flex flex-row my-2 py-2 border rounded-md" v-for="(t, index) in tech" :key="t">
        <div class="text-center rounded mx-2 p-2 flex-1 flex" v-for="f in t.techs" :key="f"
          :class="`bg-orange-${index > 4 ? 10 : (index + 1) * 2}`">
          <span class="my-auto mx-auto">{{ f }}</span>
        </div>
        <legend class="mx-auto px-2 uppercase">{{ t.label }}</legend>
      </fieldset>
    </div>
  </div>
</template>

<style scoped>
.bg-orange-1 {
  background-color: rgba(var(--orange-rgb), .1);
}
.bg-orange-2 {
  background-color: rgba(var(--orange-rgb), .2);
}
.bg-orange-3 {
  background-color: rgba(var(--orange-rgb), .3);
}
.bg-orange-4 {
  background-color: rgba(var(--orange-rgb), .4);
}

.bg-orange-5 {
  background-color: rgba(var(--orange-rgb), .5);
}
.bg-orange-6 {
  background-color: rgba(var(--orange-rgb), .6);
}
.bg-orange-7 {
  background-color: rgba(var(--orange-rgb), .7);
}
.bg-orange-8 {
  background-color: rgba(var(--orange-rgb), .8);
}
.bg-orange-9 {
  background-color: rgba(var(--orange-rgb), .9);
}
.bg-orange-10 {
  background-color: rgba(var(--orange-rgb), 1);
}
.divide {
  height: 0px;
  min-width: 1rem;
  border-top: 1px solid white;
}
</style>
