window.addEventListener('DOMContentLoaded', async () => {
  const status = document.getElementById('status');
  const productsBox = document.getElementById('products');
  const statsBox = document.getElementById('stats');
  const noticeBox = document.getElementById('notice');

  const productsResponse = await fetch('api/slow-part.php?part=products');
  const productsData = await productsResponse.json();
  productsBox.innerHTML = productsData.products.map(product => `
    <article class="card">
      <h3>${product.name}</h3>
      <p>${product.category}</p>
      <p class="price">${money(product.price)}</p>
    </article>`).join('');

  const statsResponse = await fetch('api/slow-part.php?part=stats');
  const statsData = await statsResponse.json();
  statsBox.textContent = `Товаров: ${statsData.count}. Общий остаток: ${statsData.stock}.`;

  const noticeResponse = await fetch('api/slow-part.php?part=notice');
  const noticeData = await noticeResponse.json();
  noticeBox.textContent = noticeData.message;

  status.textContent = 'Данные загружены тремя последовательными запросами.';
});
