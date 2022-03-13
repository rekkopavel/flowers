<?
// Регистрируем переменную
session_start();
session_register("secret_number");

function mt() {
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
}

header("Content-type: image/png");

// создаем изображение
$im=imagecreate(101, 26);

// Выделяем цвет фона (белый)
$w=imagecolorallocate($im, 255, 255, 255);

// Выделяем цвет для фона (светло-серый)
$g1=imagecolorallocate($im, 192, 192, 192);

// Выделяем цвет для более темных помех (темно-серый)
$g2=imagecolorallocate($im, 64,64,64);

// Выделяем четыре случайных темных цвета для символов
$cl1=imagecolorallocate($im,rand(0,128),rand(0,128),rand(0,128));
$cl2=imagecolorallocate($im,rand(0,128),rand(0,128),rand(0,128));
$cl3=imagecolorallocate($im,rand(0,128),rand(0,128),rand(0,128));
$cl4=imagecolorallocate($im,rand(0,128),rand(0,128),rand(0,128));

// Рисуем сетку
for ($i=0;$i<=100;$i+=5) imageline($im,$i,0,$i,25,$g1);
for ($i=0;$i<=25;$i+=5) imageline($im,0,$i,100,$i,$g1);

// Выводим каждую цифру по отдельности, немного смещая случайным образом
imagestring($im, 10, 0+rand(0,10), 5+rand(-5,5),
    substr($_SESSION["secret_number"],0,1), $cl1);
imagestring($im, 10, 25+rand(-10,10), 5+rand(-5,5),
    substr($_SESSION["secret_number"],1,1), $cl2);
imagestring($im, 10, 50+rand(-10,10), 5+rand(-5,5),
    substr($_SESSION["secret_number"],2,1), $cl3);
imagestring($im, 10, 75+rand(-10,10), 5+rand(-5,5),
    substr($_SESSION["secret_number"],3,1), $cl4);

// Выводим пару случайных линий тесного цвета, прямо поверх символов.
// Для увеличения количества линий можно увеличить,
// изменив число выделенное красным цветом
for ($i=0;$i<8;$i++)
    imageline($im,rand(0,100),rand(0,25),rand(0,100),rand(0,25),$g2);


// Коэффициент увеличения/уменьшения картинки
$k=1.7;

// Создаем новое изображение, увеличенного размера
$im1=imagecreatetruecolor(101*$k,26*$k);

// Копируем изображение с изменением размеров в большую сторону
imagecopyresized($im1, $im, 0, 0, 0, 0, 101*$k, 26*$k, 101, 26);

// Создаем новое изображение, нормального размера
$im2=imagecreatetruecolor(101,26);

// Копируем изображение с изменением размеров в меньшую сторону
imagecopyresampled($im2, $im1, 0, 0, 0, 0, 101, 26, 101*$k, 26*$k);

// Генерируем изображение
imagepng($im2);

// Освобождаем память
imagedestroy($im2);
imagedestroy($im1);
imagedestroy($im);
?>
