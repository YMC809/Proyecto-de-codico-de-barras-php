<?php

/**
 * T3. Os códigos de barras.
 *
 * @author yagomc
*/

declare(strict_types=1);

function isDigits(string $text): bool{
    $variableBool= false;
    for ($i = 0; $i < strlen($text); $i++){
        if(str_contains('0123456789', $text[$i])){
            $variableBool = true;
        } else {
            $variableBool = false;
            break;
        }
    }
    return $variableBool;
}

/**
 * Calcula o díxito de control dun código EAN-13.
 *
 * Multiplica cada cifra polo seu peso, 1 nas posicións impares e 3
 * nas pares, contando desde 1 pola esquerda, e devolve o que lle
 * falta á suma para chegar a un múltiplo de 10.
 *
 * @param string $digits As 12 primeiras cifras do código.
 * @return int Díxito de control, de 0 a 9.
 * @throws ValueError Se $digits non son exactamente 12 cifras.
 */
function ean13CheckDigit(string $digits): int {
    if (strlen($digits) !== 12 || !isDigits($digits)) {
        throw new ValueError('Fan falta 12 cifras');
    }

    $sum = 0;

    for ($i = 0; $i < strlen($digits); $i++) {
        $digit = (int) $digits[$i];
        // A posición $i + 1 é impar cando $i é par
        $weight = $i % 2 === 0 ? 1 : 3;
        $sum += $digit * $weight;
    }

    return (10 - $sum % 10) % 10;
}

function isValidEan13(string $code): bool{
    $valorBool = false;
    if(strlen($code) === 13 && isDigits($code) === true && ean13CheckDigit(substr($code, 0, 12)) === (int) $code[12]){
        $valorBool = true;
    } else {
        $valorBool = false;
    }
    return $valorBool;
}

function formatEuros(int $cents): string{
    return $cents/100 . ' €';
}