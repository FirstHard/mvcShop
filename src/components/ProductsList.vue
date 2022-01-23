<template>
  <div class="container mb-5">
    <div class="row">
      <product
          v-for="product in products"
          :key="product.id"
          :id="product.id"
          :name="product.name"
          :shop_articule="product.shop_articule"
          :short_description="product.short_description"
          :price="parseInt(product.price)"
          :new_price="parseInt(product.new_price)"
          :image_name="`/src/images/products/${product.image_name}`"
          :availability="product.availability"
          @add-to-cart="addProductToCart(product)"
      />
    </div>
  </div>
</template>

<script>
import Product from "./Product";
export default {
  name: "ProductsList",
  components: {
    Product,
  },
  data: () => ({
    products: [],
  }),
  mounted() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await fetch("http://staging.buinoff.tk:8080/api/product");
        this.products = await response.json();
      } catch (e) {
        console.error("Fetching error");
      }
    },
    addProductToCart(product) {
      this.$store.commit("addProductToCart", product);
    },
  },
}
</script>
