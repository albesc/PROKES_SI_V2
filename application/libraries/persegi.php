<?php
class Persegi
{
    function keliling($sisi)
    {
        $keliling = $sisi * 4;
        echo "Keliling Persegi dengan sisi " . $sisi . " adalah " . $keliling;
    }
    function luas($sisi)
    {
        $luas = $sisi * $sisi;
        echo "Luas Persegi dengan sisi " . $sisi . " adalah " . $luas;
    }
}
