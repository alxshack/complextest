<?php
include 'vendor/autoload.php';

use App\Complex\ComplexNumberAlgebraic;
use App\Complex\ComplexNumberTrigonometric;
use App\Complex\ComplexMath as CMath;

echo '<div>';

$cA = new ComplexNumberAlgebraic(['r' => 2, 'i' => 1]);
$cB = new ComplexNumberAlgebraic([3, 4]);

$cA->getType();

outParagraph('комплексные числа:');
outParagraph('Z1 = ' . $cA . ', Z2 = ' . $cB);
outParagraph('Результат сложения: ' . CMath::add($cA, $cB));

$cA = new ComplexNumberTrigonometric(['m' => 20, 'a' => 3.141592654 / 2]);
$cB = new ComplexNumberTrigonometric([15, 3.141592654]);

outParagraph('комплексные числа:');
outParagraph('Z1 = ' . $cA . ', Z2 = ' . $cB);
outParagraph('Результат сложения: ' . CMath::add($cA, $cB));

$cA = new ComplexNumberTrigonometric(['m' => 15, 'a' => 3.141592654 * 2]);
$cB = new ComplexNumberAlgebraic([10, 20]);

outParagraph('комплексные числа:');
outParagraph('Z1 = ' . $cA . ', Z2 = ' . $cB);
outParagraph('Результат сложения: ' . $cA->add($cB));

echo '</div>';

function outParagraph(string $string){
    echo '<p>' . $string . '</p>';
}