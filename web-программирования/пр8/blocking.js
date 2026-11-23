// намеренно блокирующий JS: учебная демонстрация
const start = Date.now();
while (Date.now() - start < 350) {}
console.log('blocking.js выполнен');
