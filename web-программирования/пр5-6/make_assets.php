<?php
function writeBmp(string $path, int $width, int $height, array $rgb): void
{
    $rowSize = (int)(ceil(($width * 3) / 4) * 4);
    $pixelSize = $rowSize * $height;
    $fileSize = 54 + $pixelSize;
    $header = 'BM' . pack('V', $fileSize) . pack('V', 0) . pack('V', 54) . pack('V', 40)
        . pack('V', $width) . pack('V', $height) . pack('v', 1) . pack('v', 24)
        . pack('V', 0) . pack('V', $pixelSize) . pack('V', 2835) . pack('V', 2835)
        . pack('V', 0) . pack('V', 0);
    [$r, $g, $b] = $rgb;
    $pixel = chr($b) . chr($g) . chr($r);
    $padding = str_repeat("\0", $rowSize - $width * 3);
    $row = str_repeat($pixel, $width) . $padding;
    $fp = fopen($path, 'wb');
    if ($fp === false) throw new RuntimeException('Не удалось создать файл: ' . $path);
    fwrite($fp, $header);
    for ($y = 0; $y < $height; $y++) fwrite($fp, $row);
    fclose($fp);
}

$assetsDir = __DIR__ . '/assets';
if (!is_dir($assetsDir) && !mkdir($assetsDir, 0775, true) && !is_dir($assetsDir)) {
    http_response_code(500);
    exit('Не удалось создать папку assets. Проверьте права доступа.');
}

writeBmp($assetsDir . '/hero-large.bmp', 1600, 900, [68, 86, 120]);
writeBmp($assetsDir . '/promo-large.bmp', 1600, 900, [116, 77, 102]);

$heroSvg = <<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 675" role="img" aria-labelledby="t d"><title id="t">DemoShop</title><desc id="d">Учебный баннер интернет-магазина</desc><defs><linearGradient id="g" x1="0" x2="1"><stop stop-color="#334b73"/><stop offset="1" stop-color="#6c7fa3"/></linearGradient></defs><rect width="1200" height="675" fill="url(#g)"/><circle cx="980" cy="140" r="170" fill="#fff" opacity=".08"/><text x="90" y="280" fill="#fff" font-family="Arial" font-size="86" font-weight="700">DemoShop</text><text x="94" y="350" fill="#eef3ff" font-family="Arial" font-size="34">Быстрый каталог учебного проекта</text></svg>
SVG;
file_put_contents($assetsDir . '/hero-optimized.svg', $heroSvg);

$promoSvg = <<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 675" role="img" aria-labelledby="t d"><title id="t">Подборка недели</title><desc id="d">Учебный промо-баннер</desc><rect width="1200" height="675" fill="#65465d"/><rect x="65" y="65" width="1070" height="545" rx="42" fill="#fff" opacity=".08"/><text x="100" y="300" fill="#fff" font-family="Arial" font-size="76" font-weight="700">Подборка недели</text><text x="103" y="375" fill="#f8edf5" font-family="Arial" font-size="34">Оптимизируем ресурсы и запросы</text></svg>
SVG;
file_put_contents($assetsDir . '/promo-optimized.svg', $promoSvg);

header('Content-Type: text/plain; charset=utf-8');
echo "Размеры BMP должны быть примерно 4 320 054 байт каждый.\n";
echo 'hero-large.bmp: ' . filesize($assetsDir . '/hero-large.bmp') . " байт\n";
echo 'promo-large.bmp: ' . filesize($assetsDir . '/promo-large.bmp') . " байт\n";
echo 'hero-optimized.svg: ' . filesize($assetsDir . '/hero-optimized.svg') . " байт\n";
echo 'promo-optimized.svg: ' . filesize($assetsDir . '/promo-optimized.svg') . " байт\n";
