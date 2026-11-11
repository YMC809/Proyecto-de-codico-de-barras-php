<?php

/**
 * T3. Os códigos de barras.
 *
 * @author yagomc
*/

declare(strict_types=1);

require_once __DIR__ . '/T3_yagomc.php';

$productName = 'Teclado mecánico';
$price = 4995;
$code = '8412345678905';
$units = 8;
$perRow = 3;

$rows = (int) $units/$perRow;
$label = 1;
?>
<!DOCTYPE html>
<html lang="gl">
<head>
    <meta charset="UTF-8">
    <title>A folla de etiquetas</title>
    <style> td { border: 1px solid #999; padding: 0.5em; width: 10em; } </style>
</head>
<body>
    <h1>P&aacute;xina de etiquetas</h1>
    <p>O produto de nome: <?= $productName ?>; ten <?= $units ?> etiquetas por <?= $perRow ?> filas.</p>
    <?php if(isValidEan13($code)===false) {
        echo "<p>O código" . $code . " non &eacute; valido.</p>";
    } else{
        echo "<table>";
        for($row=0; $row < $rows; $row++){
            echo "<tr>";
            for($col=0; $col < $perRow; $col++){
                echo "<td>";
                echo $label . " de " . $units . ", " . $productName . ", " . $code . ", " . formatEuros($price);
                echo "</td>";
                $label++;
                if($label>$units){
                    if($units%$perRow!==0){
                        echo "<td>";
                        echo "</td>";
                    }
                    break;
                }
            }
            echo "<tr>";
        }
        echo "</table>";
    }?>
</body>
</html>