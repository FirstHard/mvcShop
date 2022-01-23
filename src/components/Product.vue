<template>
  <div class="col-md-6 col-lg-3 py-3">
    <div class="card">
      <a :href="`/product/view/${id}`">
        <img class="card-img-top" :src="image_name" :alt="name">
      </a>
      <div class="card-body">
        <h5 class="card-title">
          <a :href="`/product/view/${id}`">
            {{ name }}
          </a>
        </h5>
        <p>
          <b>Articule:</b>
          {{ shop_articule }}
        </p>
        <div class="card-text short-description" v-html="short_description">
        </div>
        <div v-if="new_price > 0">
          <span class="product-old-price">{{ `$${parseInt(price)}` }}</span>
          <span class="product-new-price">{{ `$${parseInt(new_price)}` }}</span>
        </div>
        <div v-else>
          <span class="product-new-price">{{ `$${parseInt(price)}` }}</span>
        </div>
        <p class="mt-3">
          Stock:
          <strong v-if="availability" class="text-success">Available</strong>
          <strong v-else class="text-danger">Sold out</strong>
        </p>
        <div class="card-button">
          <button
              v-if="!addedToCart"
              :class="`btn text-uppercase ${availability ? 'btn-default' : 'btn-secondary' }`"
              :disabled="!availability"
              @click="$emit('add-to-cart')"
          >
            <i class="bi bi-bag-plus"></i>
            Add to cart
          </button>
          <button
              v-else
              class="btn btn-secondary"
              disabled
          >
            Already in cart
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Product",
  props: {
    id: {
      type: Number,
      isRequired: true,
    },
    name: {
      type: String,
      isRequired: true,
    },
    shop_articule: {
      type: String,
    },
    short_description: {
      type: String,
    },
    price: {
      type: Number,
    },
    new_price: {
      type: Number,
    },
    image_name: {
      type: String,
    },
    availability: {
      type: Number,
    },
  },
  computed: {
    addedToCart() {
      return !!this.$store.getters.getProductById(this.id);
    }
  },
}
</script>
