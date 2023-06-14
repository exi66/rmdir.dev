<script setup>
import axios from 'axios'
import '@/js/polygon.js'
import Projects from '@/js/projects.js'
import Experience from '@/js/experience.js'

import Portfolio from '@/components/PortfolioComponent.vue'
import Techs from '@/components/TechsComponent.vue'

import ExiLine from '@/components/icons/IconExiLine.vue'
import ExiItalic from '@/components/icons/IconExiItalic.vue'

import { shallowRef } from 'vue'
</script>

<script>
axios.defaults.headers.post = {
  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content || ''
}

export default {
  data() {
    return {
      projects: shallowRef(Projects),
      currentSection: null,
      showToTop: false,
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
        offset: 500,
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

    this.$nextTick(() => {
      this.handleScroll();
    });
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
      this.showToTop = window.scrollY >= window.innerHeight;
      const h = window.scrollY;
      if (h >= this.homeSection.top && h < this.homeSection.bottom - this.aboutSection.offset) this.currentSection = 'home';
      else if (h >= this.aboutSection.top - this.aboutSection.offset && h < this.aboutSection.bottom - this.portfolioSection.offset) this.currentSection = 'about';
      else if (h >= this.portfolioSection.top - this.portfolioSection.offset && h < this.portfolioSection.bottom - this.contactsSection.offset) this.currentSection = 'portfolio';
      else if (h >= this.contactsSection.top - this.contactsSection.offset && h < this.contactsSection.bottom) this.currentSection = 'contacts';
    }
  }
}
</script>

<template>
  <header class="fixed top-0 w-full z-10">
    <div class="flex flex-row justify-center py-2 lg:px-3">
      <a href="#home" class="p-2 uppercase text-lg md:text-xl" title="Home"
        :class="currentSection == 'home' ? 'text-[--orange]' : ''" @click="currentSection = 'home'">
        <i class="hidden lg:inline bi bi-house me-2"></i>
        <span>Home</span>
      </a>
      <a href="#about" class="p-2 uppercase text-lg md:text-xl" title="About"
        :class="currentSection == 'about' ? 'text-[--orange]' : ''" @click="currentSection = 'about'">
        <i class="hidden lg:inline bi bi-person-circle me-2"></i>
        <span>About</span>
      </a>
      <a href="#portfolio" class="p-2 uppercase text-lg md:text-xl" title="Portfolio"
        :class="currentSection == 'portfolio' ? 'text-[--orange]' : ''" @click="currentSection = 'portfolio'">
        <i class="hidden lg:inline bi bi-braces me-2"></i>
        <span>Portfolio</span>
      </a>
      <a href="#contacts" class="p-2 uppercase text-lg md:text-xl" title="Contacts"
        :class="currentSection == 'contacts' ? 'text-[--orange]' : ''" @click="currentSection = 'contacts'">
        <i class="hidden lg:inline bi bi-envelope me-2"></i>
        <span>Contacts</span>
      </a>
    </div>
  </header>
  <main>
    <section id="home" ref="home" class="mx-auto container flex flex-col min-h-screen">
      <div class="flex flex-col flex-grow justify-center">
        <ExiLine class="mb-5 block mx-auto px-3 w-full max-w-lg"></ExiLine>
        <h1 class="mx-auto text-xl md:text-4xl text-center">Hi, my name Egor, I'm a <span class="text-[--orange]">junior web
            developer</span></h1>
        <div class="mx-auto mt-8">
          <div class="home-links flex justify-center content-center">
            <a href="https://github.com/exi66" class="mx-4 text-4xl" title="My GitHub"><i class="bi bi-github"></i></a>
            <a href="https://t.me/exi666" class="mx-4 text-4xl" title="Write to my"><i class="bi bi-telegram"></i></a>
            <a href="/resume.pdf" class="mx-4 icon text-4xl" title="Download PDF"><i class="bi bi-download"></i></a>
          </div>
        </div>
      </div>
    </section>
    <section id="about" ref="about" class="bg-[--semi-dark]">
      <div class="mx-auto p-8 container flex flex-col">
        <h2 class="mx-auto text-4xl uppercase mb-3">About</h2>
        <div class="mx-auto flex flex-col md:flex-row mb-8">
          <ExiItalic class="block mx-auto md:me-10 my-auto text-[--orange] max-w-lg"></ExiItalic>
          <div class="my-auto">
            <h3 class="mx-auto text-2xl uppercase my-3"><i class="bi bi-person me-3"></i>Summary</h3>
            <p class="text-white opacity-80">
              Highly motivated junior web developer with 1 years of experience in developing and maintaining web
              applications. Proficient in <span class="text-[--orange] font-bold">Vue</span>, <span
                class="text-[--orange] font-bold">Laravel</span> and <span class="text-[--orange] font-bold">SQL</span>,
              with a strong
              understanding
              of front-end and back-end web development. Skilled in creating responsive and user-friendly interfaces, as
              well as troubleshooting and debugging code. Committed to staying up-to-date with the latest web development
              trends and best practices. Looking for an opportunity to apply and expand my skills as part of a dynamic
              development team.
              <!-- I am 22 years old, I was born and raised in Russia but currently live in Armenia. Interest in computer science appeared at school. I wrote my full-fledged program in the 11th grade. It was a cheat for a modded minecraft server, written in Java using the javassist library to modify classes in the runtime. I became interested in web technologies already at the university. -->
            </p>
            <h3 class="mx-auto text-2xl uppercase my-3"><i class="bi bi-book me-3"></i>Education</h3>
            <p class="text-white opacity-80">
              I studied at the Kuban State University with a Bachelor's degree in <span
                class="text-[--orange] font-bold">Software
                Engineering and Information
                Systems Management</span>. As part of my studies, I used technologies: <span
                class="text-[--orange] font-bold">dotNET
                (C#, C++)</span>, <span class="text-[--orange] font-bold">Java</span>,
              <span class="text-[--orange] font-bold">ASM</span>, <span class="text-[--orange] font-bold">JS</span>, <span
                class="text-[--orange] font-bold">PHP</span>, <span class="text-[--orange] font-bold">Python</span>, <span
                class="text-[--orange] font-bold">SQL</span>. I dropped out in my third year because the knowledge was too
              common. In fact, in each course, we studied the basics of previously unlearned programming languages,
              without learning the main advantages and features of the language. General knowledge and skills in web
              development were obtained by me through self-study. I had experience in developing chatbots for interaction
              with the API of various services.
            </p>
          </div>
        </div>
        <h2 class="mx-auto text-4xl uppercase mb-6">Experience</h2>
        <ol class="relative mb-8 mx-10">
          <li class="pb-8 pl-8 border-l border-[--orange]" v-for="e in Experience" :key="e">
            <span
              class="absolute flex items-center justify-center w-8 h-8 -left-4 rounded-full bg-white ring-8 ring-opacity-60 ring-[--orange]"
              v-html="e.icon">
            </span>
            <h3 class="mb-1 text-lg uppercase leading-none">{{ e.job }}</h3>
            <span class="block mb-3 leading-none opacity-70 text-sm font-normal"><span v-if="e.title" :title="e.type">{{
              e.title + ', ' }}</span>
              <time class="inline-block">{{ e.subtitle }}</time>
            </span>
            <p class="text-base font-normal opacity-70">
              {{ e.desctiption }}
            </p>
          </li>
          <li class="pl-8 border-l border-transparent">
            <span
              class="absolute flex items-center justify-center w-8 h-8 -left-4 rounded-full bg-white ring-8 ring-opacity-60 ring-[--orange]">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-question text-black"
                viewBox="0 0 16 16">
                <path
                  d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
              </svg>
            </span>
            <h3 class="mb-1 text-lg uppercase leading-none">...</h3>
            <span class="block mb-3 leading-none opacity-70 text-sm font-normal">
              <span title="Company">It can be your company</span>
            </span>
          </li>
        </ol>
      </div>
    </section>
    <section id="portfolio" ref="portfolio">
      <div class="mx-auto p-8 container flex flex-col">
        <h2 class="mx-auto text-4xl uppercase mb-3">Tech that I use</h2>
        <Techs class="mb-8"></Techs>
        <h2 class="mx-auto text-4xl uppercase mb-2">Portfolio</h2>
        <Portfolio :data="projects"></Portfolio>
      </div>
    </section>
    <section id="contacts" ref="contacts" class="bg-[--semi-dark]">
      <div class="mx-auto p-8 container flex flex-col">
        <h2 class="mx-auto text-4xl uppercase mb-2">Contacts</h2>
        <div class="flex flex-col lg:flex-row">
          <div class="my-auto p-2 flex-1">
            <div class="flex flex-col">
              <div class="p-2 flex flex-row">
                <i class="bi bi-github my-auto me-3 text-5xl"></i>
                <div class="flex flex-col my-auto">
                  <span class="text-lg">GitHub</span>
                  <a href="https://github.com/exi66" target="_blank" class="text-[--orange] underline">@exi66</a>
                </div>
              </div>
              <div class="p-2 flex flex-row">
                <i class="bi bi-telegram my-auto me-3 text-5xl"></i>
                <div class="flex flex-col my-auto">
                  <span class="text-lg">Telegram</span>
                  <a href="https://t.me/exi666" target="_blank" class="text-[--orange] underline">@exi666</a>
                </div>
              </div>
              <div class="p-2 flex flex-row">
                <i class="bi bi-envelope-at-fill my-auto me-3 text-5xl"></i>
                <div class="flex flex-col my-auto">
                  <span class="text-lg">Email</span>
                  <a href="mailto:me@exi.moe" target="_blank"
                    class="text-[--orange] underline">me@exi.moe</a>
                </div>
              </div>
            </div>
          </div>
          <div class="mx-auto p-2 flex-1">
            <transition name="fade">
              <div v-if="formResponse" class="rounded m-2 p-3 relative"
                :class="formResponse.includes('Error') ? 'bg-red-800' : 'bg-green-800'">
                <button class="absolute top-0 right-0" @click="formResponse = ''">
                  <i class="bi bi-x-lg text-base mx-0.5"></i>
                </button>
                <p>{{ formResponse }}</p>
              </div>
            </transition>
            <form class="flex flex-row flex-wrap" ref="form" @submit.prevent="submit">
              <div class="px-2 flex-1 mt-2">
                <label class="min-w-full uppercase">Name <span class="text-red-500" title="Required">*</span>
                  <input type="text" name="name" class="mt-1 rounded-md min-w-full p-2 text-black"
                    placeholder="Enter your name" required autocomplete="off" v-model="form.name">
                </label>
              </div>
              <div class="px-2 flex-1 mt-2">
                <label class="min-w-full uppercase">Email <span class="text-red-500" title="Required">*</span>
                  <input type="email" name="email" class="mt-1 rounded-md min-w-full p-2 text-black"
                    placeholder="Enter an email that I can reply to" required autocomplete="off" v-model="form.email">
                </label>
              </div>
              <div class="px-2 mt-2 w-full">
                <label class="min-w-full uppercase">Message <span class="text-red-500" title="Required">*</span>
                  <textarea type="email" name="email" class="mt-1 rounded-md min-w-full p-2 text-black"
                    placeholder="Write your message" rows="4" required autocomplete="off"
                    v-model="form.message"></textarea>
                </label>
              </div>
              <div class="px-2 mt-4 flex w-full">
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
  <transition name="fade">
    <div v-if="showToTop" class="fixed bottom-0 right-0 z-10 p-4">
      <a title="To top" href="#home"
        class="p-2 rounded-full flex bg-[--dark] hover:text-[--orange] opacity-80 leading-none">
        <i class="bi bi-arrow-up-circle text-5xl my-auto align-baseline leading-none"></i>
      </a>
    </div>
  </transition>
  <footer class="flex flex-col my-8">
    <div class="mx-auto text-center flex">
      <img alt="favicon" src="/images/favicon.svg" width="24" title="by exi66">
      <small class="my-auto ms-2">© 2023</small>
    </div>
    <small class="my-auto mx-auto">made on Vue.js</small>
  </footer>
</template>

<style scoped>
.fade-enter-active {
  transition: opacity .3s ease-in-out;
}

.fade-leave-active {
  transition: opacity .3s ease-in-out;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

header {
  background: rgba(26, 26, 26, 0.4);
  backdrop-filter: blur(5px);
  border-radius: 0 1rem 1rem 0;
}</style>
