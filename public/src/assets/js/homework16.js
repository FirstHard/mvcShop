const el = document.getElementById("products_collection");

document.addEventListener("DOMContentLoaded", () => {
  let currentUrl = '';
  let urlPage = getPageParamFromUrl();

  if (urlPage && typeof(urlPage) != 'indefined' && urlPage !== null) {
    currentUrl = `?page=${urlPage}`;
  }
  
  fetch(`http://staging.buinoff.tk:8080/api/product${currentUrl}`)
  .then((response) => 
    response.json()
  )
  .then((json) => {
    json.products.forEach(product => {
      const item = renderProduct(product);
      addWrapperElement(item);
    });
    if (json.pagination) {
      el.insertAdjacentHTML('afterbegin', json.pagination);
      el.insertAdjacentHTML('beforeend', json.pagination);
    }
  });
});

const getPageParamFromUrl = () => {
  return new URL(window.location).searchParams.get('page');
}

const renderProduct = (Item) => {
  return `<div class="card mb-3"><a href="product/${Item.id}"><img src="/src/images/products/${Item.image_name}"
  class="card-img-top" alt="${Item.name}"></a><div class="card-body"><h5 class="card-title"><a href="product/${Item.id}">
  ${Item.name}</a></h5><p>Articule: ${Item.shop_articule}</p><div class="card-price"><span>$&nbsp;${Item.price}
  </span></div><div class="card-text short-description">${Item.short_description}</div><div class="card-button">
  <a href="#" class="btn btn-default text-uppercase"><i class="bi bi-bag-plus"></i> Buy</a></div></div></div>`;
}

const addWrapperElement = (item) => {
  const item_wrapper = document.createElement('div');
  item_wrapper.className = 'col-12 col-md-6 col-lg-3';
  item_wrapper.insertAdjacentHTML('afterbegin', item);
  el.appendChild(item_wrapper);
}