<script setup>
import { ref } from 'vue'
import { Link, usePage, router } from '@inertiajs/vue3'

// State setup
const profileOpen = ref(false)
const mobileMenuOpen = ref(false)
const toggleMobileMenu = () => (mobileMenuOpen.value = !mobileMenuOpen.value)

const { props } = usePage()
const user = props.auth?.user || null
const cartCount = props.cartCount || 0 // ✅ Laravel থেকে পাঠানো cart item সংখ্যা

const logout = () => {
  router.post('/logout')
}

// ✅ Cart Navigation Logic (best practice)
const goToCart = () => {
  if (!user) {
    router.visit(route('login')) // user লগইন না থাকলে login page এ যাবে
  } else {
    router.visit(route('cart.index')) // logged in থাকলে cart পেজে যাবে
  }
}
</script>

<template>
  <header class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">

        <!-- Logo -->
        <div class="flex-shrink-0 text-2xl font-bold text-gray-800">
          <Link :href="route('home')">Bazarkini</Link>
        </div>

        <!-- Desktop Menu -->
        <nav class="hidden md:flex space-x-6 items-center">
          <Link :href="route('home')"
                :class="route().current('home') ? 'text-black border-b-2 border-black pb-1' : 'text-gray-600 hover:text-black'">
            Home
          </Link>
          <Link :class="'text-gray-600 hover:text-black'">About</Link>
          <Link :class="'text-gray-600 hover:text-black'">Contact</Link>

          <!-- Auth Area -->
          <div v-if="!user">
            <Link :href="route('login')"
                  :class="route().current('login') ? 'text-black border-b-2 border-black pb-1' : 'text-gray-600 hover:text-black'">
              Sign Up
            </Link>
          </div>

          <!-- Profile -->
          <div v-else class="relative">
            <button @click="profileOpen = !profileOpen"
                    class="flex items-center space-x-2 text-gray-700 hover:text-black focus:outline-none">
              <img :src="`https://ui-avatars.com/api/?name=${user.name}`" alt="avatar"
                   class="w-8 h-8 rounded-full border" />
              <span>{{ user.name }}</span>
            </button>

            <div v-if="profileOpen"
                 class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg py-2 z-20">
              <Link class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</Link>
              <button @click="logout"
                      class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                Logout
              </button>
            </div>
          </div>
        </nav>

        <!-- Search + Icons -->
        <div class="hidden md:flex items-center space-x-4">
          <!-- Search -->
          <div class="relative">
            <input
              type="text"
              placeholder="Search products..."
              class="pl-4 pr-10 py-2 border rounded-full bg-gray-100 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-emerald-500"
            />
            <span
              class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">🔍</span>
          </div>

          <button title="Wishlist" aria-label="Wishlist">🤍</button>

          <!-- ✅ Cart Button with badge -->
          <button @click="goToCart" title="Cart" aria-label="Cart" class="relative">
            🛒
            <span
              v-if="cartCount > 0"
              class="absolute -top-2 -right-3 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full"
            >
              {{ cartCount > 9 ? '9+' : cartCount }}
            </span>
          </button>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden flex items-center">
          <button @click="toggleMobileMenu" class="focus:outline-none">
            <svg v-if="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div v-if="mobileMenuOpen" class="md:hidden bg-white shadow-inner">
      <div class="px-4 pt-2 pb-4 space-y-2">
        <Link :href="route('home')" class="block text-gray-700 hover:text-black">Home</Link>
        <Link class="block text-gray-700 hover:text-black">About</Link>
        <Link class="block text-gray-700 hover:text-black">Contact</Link>

        <div v-if="!user">
          <Link :href="route('login')" class="block text-gray-700 hover:text-black">Sign Up</Link>
        </div>
        <div v-else>
          <Link class="block text-gray-700 hover:text-black">Profile</Link>
          <button @click="logout"
                  class="block w-full text-left text-gray-700 hover:text-black">Logout</button>
        </div>

        <!-- Mobile Search -->
        <div class="mt-2 relative">
          <input type="text" placeholder="Search products..."
                 class="pl-4 pr-10 py-2 border rounded-full bg-gray-100 text-sm w-full focus:outline-none focus:ring-2 focus:ring-emerald-500" />
          <span
            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">🔍</span>
        </div>

        <div class="flex space-x-4 mt-2">
          <button title="Wishlist" aria-label="Wishlist">🤍</button>

          <!-- ✅ Mobile Cart Button with badge -->
          <button @click="goToCart" title="Cart" aria-label="Cart" class="relative">
            🛒
            <span
              v-if="cartCount > 0"
              class="absolute -top-2 -right-3 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full"
            >
              {{ cartCount > 9 ? '9+' : cartCount }}
            </span>
          </button>
        </div>
      </div>
    </div>
  </header>
</template>
