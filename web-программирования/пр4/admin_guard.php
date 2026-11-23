<?php
session_start();
if (($_SESSION['role'] ?? '') !== 'admin') {
    http_response_code(403);
    exit('Доступ запрещен. Эта страница только для администратора.');
}
