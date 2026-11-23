function money(value) {
  return new Intl.NumberFormat('ru-RU').format(value) + ' руб.';
}

document.addEventListener('DOMContentLoaded', async () => {
  const status = document.getElementById('status');
  try {
    const response = await fetch('api/fast-data.php');
    if (!response.ok) throw new Error('HTTP ' + response.status);
    const data = await response.json();
    document.getElementById('products').innerHTML = data.products.map(product => `
      <article class="card">
        <h3>${product.name}</h3>
        <p>${product.category}</p>
        <p class="price">${money(product.price)}</p>
      </article>`).join('');
    document.getElementById('stats').textContent =
      `Товаров: ${data.stats.count}. Общий остаток: ${data.stats.stock}.`;
    document.getElementById('notice').textContent = data.notice;
    status.textContent = 'Все данные получены одним запросом.';
  } catch (error) {
    status.textContent = 'Ошибка загрузки: ' + error.message;
  }
});
