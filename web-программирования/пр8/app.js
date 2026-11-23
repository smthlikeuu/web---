document.querySelectorAll('.stock-btn').forEach(button => {
    button.addEventListener('click', async () => {
        const result = document.getElementById('stock-result');
        result.textContent = 'Загружаем...';
        try {
            const response = await fetch('api/stock.php');
            const data = await response.json();
            result.textContent = 'Остаток: ' + data.stock + ' шт.';
        } catch (error) {
            console.error(error);
            result.textContent = 'Не удалось получить остаток';
        }
    });
});
