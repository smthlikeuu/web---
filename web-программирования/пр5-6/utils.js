function money(value) {
  return new Intl.NumberFormat('ru-RU').format(value) + ' руб.';
}
