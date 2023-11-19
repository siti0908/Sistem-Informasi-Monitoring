<?php

use Picqer\Barcode\BarcodeGeneratorPNG;

function generate_barcode($text, $type = 'ean13', $width = 2, $height = 30)
{
  $generator = new BarcodeGeneratorPNG();
  echo '<img width="100%" src="data:image/png;base64,' . base64_encode($generator->getBarcode($text, $generator::TYPE_CODE_128)) . '">';
}
