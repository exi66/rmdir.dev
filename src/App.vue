<script setup>
import axios from 'axios'
import '@/js/polygon.js';
import Projects from '@/js/projects.js';

import Portfolio from '@/components/PortfolioComponent.vue';
import ExiLine from '@/components/icons/IconExiLine.vue';
import ExiItalic from '@/components/icons/IconExiItalic.vue';

import { shallowRef } from 'vue';
</script>

<script>
axios.defaults.headers.post = {
  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content || ''
}

export default {
  data() {
    return {
      projects: shallowRef(Projects),
      currentSection: 'home',
      homeSection: {
        top: 0,
        bottom: 0,
        offset: 200,
      },
      aboutSection: {
        top: 0,
        bottom: 0,
        offset: 200,
      },
      portfolioSection: {
        top: 0,
        bottom: 0,
        offset: 200,
      },
      contactsSection: {
        top: 0,
        bottom: 0,
        offset: 200,
      },
      form: {
        name: '',
        email: '',
        message: '',
      },
      formResponse: '',
    }
  },
  mounted() {
    this.homeSection.top = window.scrollY + this.$refs.home.getBoundingClientRect().y;
    this.homeSection.bottom = window.scrollY + this.homeSection.top + this.$refs.home.clientHeight;
    this.aboutSection.top = window.scrollY + this.$refs.about.getBoundingClientRect().y;
    this.aboutSection.bottom = window.scrollY + this.aboutSection.top + this.$refs.about.clientHeight;
    this.portfolioSection.top = window.scrollY + this.$refs.portfolio.getBoundingClientRect().y;
    this.portfolioSection.bottom = window.scrollY + this.portfolioSection.top + this.$refs.portfolio.clientHeight;
    this.contactsSection.top = window.scrollY + this.$refs.contacts.getBoundingClientRect().y;
    this.contactsSection.bottom = window.scrollY + this.contactsSection.top + this.$refs.contacts.clientHeight;
  },
  created() {
    window.addEventListener('scroll', this.handleScroll);
  },
  unmounted() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    async submit() {
      try {
        const body = new URLSearchParams(this.form).toString();
        let res = await axios.post('./form/', body);
        if (res.status === 200 && res.data.success) {
          this.formResponse = res.data.success;
        } else {
          this.formResponse = 'Error! ' + res.data.errors || res.status;
        }
      } catch (e) {
        this.formResponse = 'Error! ' + e.message;
      }
    },
    handleScroll() {
      const h = window.scrollY;
      if (h > this.homeSection.top - this.homeSection.offset && h < this.homeSection.bottom - this.homeSection.offset) this.currentSection = 'home';
      else if (h > this.aboutSection.top - this.homeSection.offset && h < this.aboutSection.bottom - this.homeSection.offset) this.currentSection = 'about';
      else if (h > this.portfolioSection.top - this.homeSection.offset && h < this.portfolioSection.bottom - this.homeSection.offset) this.currentSection = 'portfolio';
      else if (h > this.contactsSection.top - this.homeSection.offset && h < this.contactsSection.bottom - this.homeSection.offset) this.currentSection = 'contacts';
    }
  }
}
</script>

<template>
  <header class="fixed top-0 lg:top-1/2 lg:-translate-y-1/2 w-full lg:w-auto z-10">
    <div class="flex flex-row lg:flex-col justify-center py-2 lg:px-3">
      <a href="#home" class="p-2 uppercase sm:text-xl lg:text-4xl" title="Home"
        :class="currentSection == 'home' ? 'orange' : ''" @click="currentSection = 'home'">
        <span class="lg:hidden">Home</span><i class="hidden lg:inline bi bi-house"></i>
      </a>
      <a href="#about" class="p-2 uppercase sm:text-xl lg:text-4xl" title="About"
        :class="currentSection == 'about' ? 'orange' : ''" @click="currentSection = 'about'">
        <span class="lg:hidden">About</span><i class="hidden lg:inline bi bi-person-circle"></i>
      </a>
      <a href="#portfolio" class="p-2 uppercase sm:text-xl lg:text-4xl" title="Portfolio"
        :class="currentSection == 'portfolio' ? 'orange' : ''" @click="currentSection = 'portfolio'">
        <span class="lg:hidden">Portfolio</span><i class="hidden lg:inline bi bi-box"></i>
      </a>
      <a href="#contacts" class="p-2 uppercase sm:text-xl lg:text-4xl" title="Contacts"
        :class="currentSection == 'contacts' ? 'orange' : ''" @click="currentSection = 'contacts'">
        <span class="lg:hidden">Contacts</span><i class="hidden lg:inline bi bi-person-lines-fill"></i>
      </a>
    </div>
  </header>
  <main>
    <section id="home" ref="home" class="mx-auto container flex flex-col justify-center min-h-screen">
      <ExiLine style="height: auto; width: 100%; max-width: 32rem;" class="mb-5 block mx-auto px-3"></ExiLine>
      <h1 class="mx-auto text-3xl md:text-4xl">I'm a <span class="orange">junior web developer</span></h1>
      <div class="mx-auto mt-3">
        <div class="home-links flex justify-center content-center">
          <a href="https://github.com/exi66" class="mx-3 icon"><i class="bi bi-github"></i></a>
          <a href="https://t.me/exi666" class="mx-3 icon"><i class="bi bi-telegram"></i></a>
        </div>
      </div>
    </section>
    <section id="about" ref="about" class="bg-semi-dark">
      <div class="mx-auto p-8 container flex flex-col">
        <h2 class="mx-auto text-4xl uppercase mb-3">About</h2>
        <div class="mx-auto flex flex-col md:flex-row mb-8">
          <ExiItalic class="block mx-auto md:me-10 my-auto orange" style="max-width: 20rem;"></ExiItalic>
          <div>
            <h3 class="mx-auto text-2xl uppercase my-3"><i class="bi bi-person me-3"></i>Life</h3>
            <p>
              I am 22 years old, I was born and raised in Russia but currently live in Armenia. Interest in computer
              science appeared at
              school. I wrote my full-fledged program in the 11th grade. It was a cheat for a modded minecraft server,
              written in Java using the javassist library to modify classes in the runtime. I became interested in web
              technologies already at the university.
            </p>
            <h3 class="mx-auto text-2xl uppercase my-3"><i class="bi bi-book me-3"></i>Education</h3>
            <p>
              I studied at the Kuban State University. As part of my studies, I used technologies: dotNET (C#, C++), Java,
              Asm, JS, PHP, Python (Django), SQL (Oracle). I dropped out in my third year because the knowledge was too
              common. In fact, in each course, we studied the basics of previously unlearned programming languages,
              without learning the main advantages and features of the language. General knowledge and skills in web
              development were obtained by me through self-study. I had experience in developing chatbots for interaction
              with the API of various services.
            </p>
          </div>
        </div>
        <h2 class="mx-auto text-4xl uppercase mb-3">Tech that I use</h2>
        <div class="mb-8 flex flex-row">
          <div class="hidden lg:flex flex-col">
            <div class="my-auto flex">
              <span class="uppercase">CSS</span>
              <div class="ms-2 flex-grow divide my-auto"></div>
            </div>
            <div class="my-auto flex">
              <span class="uppercase">Frontend</span>
              <div class="ms-2 flex-grow divide my-auto"></div>
            </div>
            <div class="my-auto flex">
              <span class="uppercase">Backend</span>
              <div class="ms-2 flex-grow divide my-auto"></div>
            </div>
            <div class="my-auto flex">
              <span class="uppercase">DB</span>
              <div class="ms-2 flex-grow divide my-auto"></div>
            </div>
            <div class="my-auto flex">
              <span class="uppercase">Web server</span>
              <div class="ms-2 flex-grow divide my-auto"></div>
            </div>
            <div class="my-auto flex">
              <span class="uppercase">Environment</span>
              <div class="ms-2 flex-grow divide my-auto"></div>
            </div>
          </div>
          <div class="hidden lg:flex flex-col flex-grow">
            <div class="flex flex-row my-2">
              <div class="bg-orange-1 text-center rounded mx-2 p-2 flex-1 align-middle">Bootstrap</div>
              <div class="bg-orange-1 text-center rounded mx-2 p-2 flex-1 align-middle">Tailwindcss</div>
            </div>
            <div class="flex flex-row my-2">
              <div class="bg-orange-2 text-center rounded mx-2 p-2 flex-1 align-middle">Vue.js</div>
              <div class="bg-orange-2 text-center rounded mx-2 p-2 flex-1 align-middle">Webpack + jQuery</div>
            </div>
            <div class="flex flex-row my-2">
              <div class="bg-orange-4 text-center rounded mx-2 p-2 flex-1">Laravel</div>
              <div class="bg-orange-4 text-center rounded mx-2 p-2 flex-1">Express.js</div>
              <div class="bg-orange-4 text-center rounded mx-2 p-2 flex-1">Pure php</div>
            </div>
            <div class="flex flex-row my-2">
              <div class="bg-orange-6 text-center rounded mx-2 p-2 flex-1">MySQL</div>
            </div>
            <div class="flex flex-row my-2">
              <div class="bg-orange-8 text-center rounded mx-2 p-2 flex-1">Nginx</div>
            </div>
            <div class="flex flex-row my-2">
              <div class="bg-orange text-center rounded mx-2 p-2 flex-1">Ubuntu</div>
              <div class="bg-orange text-center rounded mx-2 p-2 flex-1">CentOS</div>
              <div class="bg-orange text-center rounded mx-2 p-2 flex-1">Docker</div>
            </div>
          </div>
          <div class="flex flex-col flex-grow lg:hidden">
            <fieldset class="flex flex-row my-2 py-2 border rounded-md">
              <div class="bg-orange-1 text-center rounded mx-2 p-2 flex-1 flex">
                <span class="my-auto mx-auto">Bootstrap</span>
              </div>
              <div class="bg-orange-1 text-center rounded mx-2 p-2 flex-1 flex">
                <span class="my-auto mx-auto">Tailwindcss</span>
              </div>
              <legend class="mx-auto px-2 uppercase">CSS</legend>
            </fieldset>
            <fieldset class="flex flex-row my-2 py-2 border rounded-md">
              <div class="bg-orange-2 text-center rounded mx-2 p-2 flex-1 flex">
                <span class="my-auto mx-auto">Vue.js</span>
              </div>
              <div class="bg-orange-2 text-center rounded mx-2 p-2 flex-1 flex">
                <span class="my-auto mx-auto">Webpack + jQuery</span>
              </div>
              <legend class="mx-auto px-2 uppercase">Frontend</legend>
            </fieldset>
            <fieldset class="flex flex-row my-2 py-2 border rounded-md">
              <div class="bg-orange-4 text-center rounded mx-2 p-2 flex-1 flex">
                <span class="my-auto mx-auto">Laravel</span>
              </div>
              <div class="bg-orange-4 text-center rounded mx-2 p-2 flex-1 flex">
                <span class="my-auto mx-auto">Express.js</span>
              </div>
              <div class="bg-orange-4 text-center rounded mx-2 p-2 flex-1 flex">
                <span class="my-auto mx-auto">Pure PHP</span>
              </div>
              <legend class="mx-auto px-2 uppercase">Backend</legend>
            </fieldset>
            <fieldset class="flex flex-row my-2 py-2 border rounded-md">
              <div class="bg-orange-6 text-center rounded mx-2 p-2 flex-1 flex">
                <span class="my-auto mx-auto">MySQL</span>
              </div>
              <legend class="mx-auto px-2 uppercase">Database</legend>
            </fieldset>
            <fieldset class="flex flex-row my-2 py-2 border rounded-md">
              <div class="bg-orange-8 text-center rounded mx-2 p-2 flex-1 flex">
                <span class="my-auto mx-auto">Nginx</span>
              </div>
              <legend class="mx-auto px-2 uppercase">Web Server</legend>
            </fieldset>
            <fieldset class="flex flex-row my-2 py-2 border rounded-md">
              <div class="bg-orange text-center rounded mx-2 p-2 flex-1 flex">
                <span class="my-auto mx-auto">Ubuntu</span>
              </div>
              <div class="bg-orange text-center rounded mx-2 p-2 flex-1 flex">
                <span class="my-auto mx-auto">CentOS</span>
              </div>
              <div class="bg-orange text-center rounded mx-2 p-2 flex-1 flex">
                <span class="my-auto mx-auto">Docker</span>
              </div>
              <legend class="mx-auto px-2 uppercase">Environment</legend>
            </fieldset>
          </div>
        </div>
      </div>
    </section>
    <section id="portfolio" ref="portfolio">
      <div class="mx-auto p-8 container flex flex-col">
        <h2 class="mx-auto text-4xl uppercase mb-2">Portfolio</h2>
        <Portfolio :data="projects"></Portfolio>
      </div>
    </section>
    <section id="contacts" ref="contacts" class="bg-semi-dark">
      <div class="mx-auto p-8 container flex flex-col">
        <h2 class="mx-auto text-4xl uppercase mb-2">Contacts</h2>
        <div class="flex flex-col lg:flex-row">
          <div class="my-auto p-2 flex-1">
            <div class="flex flex-col">
              <div class="p-2 flex flex-row">
                <i class="bi bi-github my-auto me-3 text-5xl"></i>
                <div class="flex flex-col my-auto">
                  <span class="text-lg">GitHub</span>
                  <a href="https://github.com/exi66" target="_blank" class="orange underline">@exi66</a>
                </div>
              </div>
              <div class="p-2 flex flex-row">
                <i class="bi bi-telegram my-auto me-3 text-5xl"></i>
                <div class="flex flex-col my-auto">
                  <span class="text-lg">Telegram</span>
                  <a href="https://t.me/exi666" target="_blank" class="orange underline">@exi666</a>
                </div>
              </div>
              <div class="p-2 flex flex-row">
                <i class="bi bi-envelope-at-fill my-auto me-3 text-5xl"></i>
                <div class="flex flex-col my-auto">
                  <span class="text-lg">Email</span>
                  <a href="mailto:eternityexi@gmail.ru" target="_blank" class="orange underline">eternityexi@gmail.ru</a>
                </div>
              </div>
            </div>
          </div>
          <div class="mx-auto p-2 flex-1">
            <div v-if="formResponse" class="rounded m-2 p-3 relative" :class="formResponse.includes('Error') ? 'bg-red-800' : 'bg-green-800'">
              <button class="absolute top-0 right-0" @click="formResponse = ''">
                <i class="bi bi-x-lg text-base mx-0.5"></i>
              </button>
              <p>{{ formResponse }}</p>
            </div>
            <form class="flex flex-row flex-wrap" ref="form" @submit.prevent="submit">
              <div class="px-2 flex-1 mt-2">
                <label class="min-w-full">Name <span class="text-red-500">*</span>
                  <input type="text" name="name" class="rounded-md min-w-full p-2 text-black"
                    placeholder="Enter your name" required autocomplete="off" v-model="form.name">
                </label>
              </div>
              <div class="px-2 flex-1 mt-2">
                <label class="min-w-full">Email <span class="text-red-500">*</span>
                  <input type="email" name="email" class="rounded-md min-w-full p-2 text-black"
                    placeholder="Enter an email that I can reply to" required autocomplete="off" v-model="form.email">
                </label>
              </div>
              <div class="px-2 mt-2 w-full">
                <label class="min-w-full">Message <span class="text-red-500">*</span>
                  <textarea type="email" name="email" class="rounded-md min-w-full p-2 text-black"
                    placeholder="Write your message" rows="4" required autocomplete="off"
                    v-model="form.message"></textarea>
                </label>
              </div>
              <div style="width: 100%;" class="px-2 mt-4 flex">
                <button type="submit"
                  class="border flex-grow rounded-md px-2 py-1 hover:text-black hover:bg-white uppercase">
                  Send message
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer class="flex flex-col my-8">
    <div class="mx-auto text-center flex">
      <img alt="favicon" src="/images/favicon.svg" width="24" title="by exi66">
      <small class="my-auto ms-2">© 2023</small>
    </div>
    <small class="my-auto mx-auto">made on Vue.js</small>
  </footer>
</template>

<style scoped>
.icon {
  font-size: 2.5rem;
}

.divide {
  height: 0px;
  min-width: 1rem;
  border: 1px solid white;
}

header {
  background: rgba(26, 26, 26, 0.4);
  backdrop-filter: blur(5px);
  border-radius: 0 1rem 1rem 0;
}
</style>
