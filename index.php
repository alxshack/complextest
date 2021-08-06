<?php
include 'vendor/autoload.php';

use App\Complex\ComplexNumberAlgebraic;
use App\Complex\ComplexNumberTrigonometric;
use App\Complex\ComplexMath as CMath;

echo '<div>';

$cA = new ComplexNumberAlgebraic(['r' => 2, 'i' => 1]);
$cB = new ComplexNumberAlgebraic([3, 4]);

outParagraph($cA->getType());

outParagraph('комплексные числа:');
outParagraph('Z1 = ' . $cA . ', Z2 = ' . $cB);
outParagraph('Результат сложения: ' . CMath::add($cA, $cB));

$cC = new ComplexNumberTrigonometric(['m' => 20, 'a' => 3.141592654 / 2]);
$cD = new ComplexNumberTrigonometric([15, 3.141592654]);

outParagraph('Z1 = ' . $cC . ', Z2 = ' . $cD);
outParagraph('inverse: ' . $cC->inverse());
outParagraph('Результат вычитания: ' . CMath::subtract($cC, $cD));

outParagraph('комплексные числа:');
outParagraph('Z1 = ' . $cA . ', Z2 = ' . $cB);
outParagraph('Результат вычитания: ' . CMath::subtract($cA, $cB));

$cA = new ComplexNumberTrigonometric(['m' => 15, 'a' => 3.141592654 * 2]);
$cB = new ComplexNumberAlgebraic([10, 20]);

outParagraph('комплексные числа:');
outParagraph('Z1 = ' . $cA . ', Z2 = ' . $cB);
outParagraph('Результат сложения: ' . $cA->add($cB));

$cA = new ComplexNumberAlgebraic(['r'=>-5, 'i'=>5]);
$cB = new ComplexNumberAlgebraic(['r' => 10, 'i' => -10]);

$cA = new ComplexNumberAlgebraic('1+1i');
$cB = new ComplexNumberAlgebraic('-2-2i');

outParagraph('комплексные числа:');
outParagraph('Z1 = ' . $cA . ', Z2 = ' . $cB);
outParagraph('Результат умножения: ' . $cA->divide($cB));

echo '</div>';

function outParagraph(string $string){
    echo '<p>' . $string . '</p>';
}