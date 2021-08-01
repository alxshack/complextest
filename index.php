<?php

spl_autoload_register(function ($className) {
    $className = str_replace('\\', '/', $className);
    $includeFile = __DIR__ . '/Classes/' . $className . '.php';
    include_once $includeFile;
});

use App\Complex\ComplexNumber;
use App\Complex\ComplexMath as CMath;

$cA = new ComplexNumber(['r' => 2, 'i' => 1]);
$cB = new ComplexNumber([3, 4]);
$cB->setValue('15.2+22.5i')->setImaginary(13.4)->setReal(66);

echo '<div>';

outParagraph('комплексные числа:');
outParagraph('Z1 = ' . $cA . ', Z2 = ' . $cB);
outParagraph('Результат сложения: ' . CMath::add($cA, $cB));

$printedSubstractValue = (CMath::substract($cA, $cB))->toPrinted(); // не обязательно, но метод есть, почему не показать? ))
outParagraph("Результат вычитания: $printedSubstractValue");

outParagraph('Результат умножения:' . CMath::multiply($cA, $cB));

outParagraph('Результат деления:' . CMath::substract($cA, $cB));

echo '</div>';

function outParagraph(string $string){
    echo '<p>' . $string . '</p>';
}