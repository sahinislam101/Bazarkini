<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import { ChevronLeft, ChevronRight } from 'lucide-vue-next'

const props = defineProps({
  flash_sales: Array,
})

// Scroll logic
const scrollContainer = ref(null)
const scrollLeft = () => scrollContainer.value.scrollBy({ left: -300, behavior: 'smooth' })
const scrollRight = () => scrollContainer.value.scrollBy({ left: 300, behavior: 'smooth' })
</script>

<template>
  <section class="py-10">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold flex items-center gap-2">Sales</h2>

        <!-- ✅ View All Products Button -->
        <Link
          :href="route('products.all')"
          class="bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition"
        >
          View All
        </Link>
      </div>

      <div class="relative">
        <button
          @click="scrollLeft"
          class="absolute -left-3 top-1/2 -translate-y-1/2 bg-white shadow rounded-full p-2 z-10 hover:bg-gray-100"
        >
          <ChevronLeft class="w-5 h-5" />
        </button>

        <div ref="scrollContainer" class="flex gap-6 overflow-x-auto pb-4 scrollbar-hide scroll-smooth">
          <div
            v-for="item in flash_sales"
            :key="item.id"
            class="min-w-[200px] border rounded-lg p-3 shadow-sm hover:shadow-md transition flex-shrink-0"
          >
            <div class="relative flex justify-center">
              <img :src="item.image" alt="Product" class="h-32 object-contain" />
            </div>

            <h3 class="mt-3 text-sm font-medium text-gray-900 text-center line-clamp-2">
              {{ item.name }}
            </h3>

            <div class="mt-2 text-center">
              <span class="text-lg font-bold text-gray-900">৳ {{ item.price }}</span>
              <span
                v-if="item.discount_price"
                class="ml-2 text-sm text-gray-500 line-through"
              >৳ {{ item.discount_price }}</span>
            </div>

            <!-- ✅ শুধুমাত্র View বাটন -->
            <div class="flex w-full mt-4">
              <Link
                :href="`/product/${item.slug}`"
                class="flex-1 bg-black text-white text-sm py-2 rounded-lg hover:bg-gray-800 transition text-center"
              >
                View
              </Link>
            </div>
          </div>
        </div>

        <button
          @click="scrollRight"
          class="absolute -right-3 top-1/2 -translate-y-1/2 bg-white shadow rounded-full p-2 z-10 hover:bg-gray-100"
        >
          <ChevronRight class="w-5 h-5" />
        </button>
      </div>
    </div>
  </section>
</template>

<style>
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
