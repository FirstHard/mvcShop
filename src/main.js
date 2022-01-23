import { createApp } from "vue";
import storage from "./store";
import "bootstrap/dist/js/bootstrap.bundle.min";
import "./styles.css";

import ProductsList from "./components/ProductsList";
import CartButton from "./components/CartButton";
import CartModal from "./components/cart/CartModal";

const app = createApp({});

app.use(storage);

app.component("products-list", ProductsList);
app.component("cart-button", CartButton);
app.component("cart-modal", CartModal);

app.mount("#app");
