/* Change quantity */
const numCount = document.querySelector('#num_count');
const plusBtn = document.querySelector('#button_plus');
const minusBtn = document.querySelector('#button_minus');
let qty = parseInt(numCount.value);

plusBtn.onclick = () => {
  qty = qty + 1;
  numCount.value = qty;
}

minusBtn.onclick = () => {
  if (qty >= 2) {
    qty = qty - 1;
    numCount.value = qty;
  }
}