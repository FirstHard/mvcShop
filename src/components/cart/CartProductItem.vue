<template>
  <div class="col-2">
    <div class="card mb-3">
      <img class="img-fluid rounded-1" :src="image_name" width="70" :alt="name">
    </div>
  </div>
  <div class="col-4">
    <p class="mb-0">
      {{ name }}
    </p>
  </div>
  <div class="col-3">
    <div class="text-center">
      <div class="btn-group d-flex align-items-center" role="group">
        <button @click="$emit('decrement-amount')" :disabled="amount === 1" type="button" class="btn shadow-none">-</button>
        <span class="mx-2">{{ amount }}</span>
        <button @click="$emit('increment-amount')" type="button" class="btn shadow-none">+</button>
      </div>
    </div>
  </div>
  <div class="col-2">
    <div class="text-center py-3">{{ `$${parseInt(price)}` }}</div>
  </div>
  <div class="col-1">
    <div>
      <button @click="$emit('remove')" class="btn shadow-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
          <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/>
        </svg>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "CartProductItem",
  props: {
    name: {
      type: String,
      isRequired: true,
    },
    price: {
      type: Number,
    },
    image_name: {
      type: String,
    },
    amount: {
      type: Number,
    },
  },
}
</script>
