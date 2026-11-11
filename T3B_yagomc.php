<?php

/**
 * T3. Os códigos de barras.
 *
 * @author yagomc
*/

declare(strict_types=1);

require_once __DIR__ . '/T3_yagomc.php';

function check(string $call, mixed $expected, mixed $actual): void {
$result = $expected === $actual ? 'OK' : 'FALLA';
echo "{$result} {$call}: esperado "
. var_export($expected, true) . ', obtido '
. var_export($actual, true) . PHP_EOL;
}

check("isDigits('0123456789')", true, isDigits('0123456789'));
check("isDigits('12a4')", false, isDigits('12a4'));
check("ean13CheckDigit('590123412345')", 7, ean13CheckDigit('590123412345'));
check("ean13CheckDigit('841234567890')", 5, ean13CheckDigit('841234567890'));
check("ean13CheckDigit('841234567895')", 0, ean13CheckDigit('841234567895'));
check("isValidEan13('5901234123457')", true, isValidEan13('5901234123457'));
check("isValidEan13('5901234123458')", false, isValidEan13('5901234123458'));
check("isValidEan13('8412345678905')", true, isValidEan13('8412345678905'));
check("formatEuros(4995)", '49.95 €', formatEuros(4995));

// Casos do enunciado cun ValueError
try {
    $actual = ean13CheckDigit('59012341234');
    echo "FALLA  ean13CheckDigit('59012341234'): devolveu ",
        var_export($actual, true), PHP_EOL;
} catch (ValueError $e) {
    echo "OK  ean13CheckDigit('59012341234'): ",
        $e->getMessage(), PHP_EOL;
}

try {
    $actual = ean13CheckDigit('59012341234X');
    echo "FALLA  ean13CheckDigit('59012341234X'): devolveu ",
        var_export($actual, true), PHP_EOL;
} catch (ValueError $e) {
    echo "OK  ean13CheckDigit('59012341234X'): ",
        $e->getMessage(), PHP_EOL;
}

// Casos inventados
check("isDigits(' ')", false, isDigits(' '));
check("isDigits('1')", true, isDigits('1'));
check("isDigits('a123456789')", false, isDigits('a123456789'));
check("isDigits('012345678a')", false, isDigits('012345678a'));
check("isValidEan13('590123412345')", false, isValidEan13('590123412345'));
check("isValidEan13('590123412345Y')", false, isValidEan13('590123412345Y'));
check("isValidEan13('84123456789059')", false, isValidEan13('84123456789059'));
check("ean13CheckDigit('841088100011')", 2, ean13CheckDigit('841088100011'));
check("isValidEan13('8410881000112')", true, isValidEan13('8410881000112'));

// Apartado c
check("ean13CheckDigit('590123412345')", 7, ean13CheckDigit('590123412345'));