<?php

namespace Picqer\Barcode\Types;

/*
 * EAN13 and UPC-A barcodes.
 * EAN13: European Article Numbering international retail product code
 * UPC-A: Universal product code seen on almost all retail products in the USA and Canada
 * UPC-E: Short version of UPC symbol
 *
 * @param $code (string) code to represent.
 * @param $len (string) barcode type: 6 = UPC-E, 8 = EAN8, 13 = EAN13, 12 = UPC-A
 */

class TypeUpcE extends TypeEanUpcBase
{
    protected int $length = 12;
    protected bool $upca = false;
    protected bool $upce = true;
}
