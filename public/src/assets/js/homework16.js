const renderProduct = (Item) => {
  return `<div class="card mb-3"><a href="product/${Item.id}"><img src="/src/images/products/${Item.image_name}"
  class="card-img-top" alt="${Item.name}"></a><div class="card-body"><h5 class="card-title"><a href="product/${Item.id}">
  ${Item.name}</a></h5><p>Articule: ${Item.shop_articule}</p><div class="card-price"><span>$&nbsp;${Item.price}
  </span></div><div class="card-text">${Item.short_description}</div><div class="card-button">
  <a href="#" class="btn btn-default text-uppercase"><i class="bi bi-bag-plus"></i> Buy</a></div></div></div>`;
}

document.addEventListener("DOMContentLoaded", () => {
  const el = document.getElementById("products_collection");
  fetch('http://staging.buinoff.tk:8080/api/product')
  .then((response) => 
    response.json()
  )
  .then((json) => {
    json.products.forEach(product => {
      const item = renderProduct(product);
      const item_wrapper = document.createElement('div');
      item_wrapper.className = 'col-12 col-md-6 col-lg-3';
      item_wrapper.insertAdjacentHTML('afterbegin', item);
      el.appendChild(item_wrapper);
    });
    if (json.pagination) {
      el.insertAdjacentHTML('afterbegin', json.pagination);
      el.insertAdjacentHTML('beforeend', json.pagination);
    }
  });
});