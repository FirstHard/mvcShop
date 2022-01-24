<template>
  <div class="container">
    <div class="row border-bottom border-2 border-dark fw-bold">
      <div class="col-2">Image</div>
      <div class="col-4">Name</div>
      <div class="col-3 text-center">Quantity</div>
      <div class="col-2 text-center">Price</div>
      <div class="col-1"></div>
    </div>
    <div class="row align-items-center justify-content-center">
      <cart-product-item
          v-for="(product, index) in cartProducts"
          :key="product.id"
          :name="product.name"
          :price="parseInt(product.price)"
          :image_name="`/src/images/products/${product.image_name}`"
          :amount="product.amount"
          @increment-amount="$store.commit('incrementProductAmount', index)"
          @decrement-amount="$store.commit('decrementProductAmount', index)"
          @remove="$store.commit('removeProductFromCart', index)"
      />
    </div>
    <div class="row fw-bold border-top border-2 border-dark fw-bold">
      <div class="col-7 text-end">
        <span>
          Total:
        </span>
      </div>
      <div class="col-3 text-center">
        <span>{{ totalAmount }} pcs.</span>
      </div>
      <div class="col-2 text-end">
        <span>{{ `$${totalPrice}` }}</span>
      </div>
    </div>
  </div>
</template>

<script>
import CartProductItem from "./CartProductItem";

export default {
  name: "CartProductsList",
  components: { CartProductItem },
  computed: {
    cartProducts() {
      return this.$store.state.cartProducts;
    },
    totalAmount() {
      return this.$store.getters.totalAmount;
    },
    totalPrice() {
      return this.$store.getters.totalPrice;
    }
  },
}
</script>
