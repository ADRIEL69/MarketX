<?php

namespace Picqer\Barcode\Types;

/*
 * CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
 * General-purpose code in very wide use world-wide
 */

class TypeCode39Extended extends TypeCode39
{
    protected bool $extended = true;
    protected bool $checksum = false;
}
