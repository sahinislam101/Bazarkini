<script setup>
defineProps({ cartItems: Array })
</script>

<template>
    <div class="max-w-6xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">🛒 Your Cart</h1>
        <div v-if="cartItems.length">
            <div v-for="item in cartItems" :key="item.id" class="border-b py-4 flex justify-between">
                <div>
                    <h2 class="font-semibold">{{ item.product.name }}</h2>
                    <p>Quantity: {{ item.quantity }}</p>
                </div>
                <p class="font-bold">${{ item.product.price }}</p>
            </div>
        </div>
        <p v-else class="text-gray-600">Your cart is empty.</p>
    </div>
</template>
