<?php

use PHPUnit\Framework\TestCase;
use Picqer\Barcode\Renderers\SvgRenderer;
use Picqer\Barcode\Types\TypeCode39;
use Picqer\Barcode\Types\TypeCode39Checksum;
use Picqer\Barcode\Types\TypeCode39Extended;

class TypesTest extends TestCase
{
    public function test_generator_can_generate_code_39_barcode()
    {
        $barcode = (new TypeCode39())->getBarcode('1234567890ABC');
        $renderer = new SvgRenderer();
        $result = $renderer->render($barcode, $barcode->getWidth() * 2);

        $this->assertStringEqualsFile('tests/verified-files/TypeCode39-1234567890ABC.svg', $result);
    }

    public function test_generator_can_generate_code_39_checksum_barcode()
    {
        $barcode = (new TypeCode39Checksum())->getBarcode('1234567890ABC');
        $renderer = new SvgRenderer();
        $result = $renderer->render($barcode, $barcode->getWidth() * 2);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_code_39_extended_barcode()
    {
        $barcode = (new TypeCode39Extended())->getBarcode('1234567890abcABC');
        $renderer = new SvgRenderer();
        $result = $renderer->render($barcode, $barcode->getWidth() * 2);

        $this->assertStringEqualsFile('tests/verified-files/TypeCode39Extended-1234567890abcABC.svg', $result);
    }

    public function test_generator_can_generate_code_39_extended_checksum_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('1234567890abcABC', $generator::TYPE_CODE_39E_CHECKSUM);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_code_93_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('1234567890abcABC', $generator::TYPE_CODE_93);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_standard_2_5_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('1234567890', $generator::TYPE_STANDARD_2_5);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_standard_2_5_checksum_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('1234567890', $generator::TYPE_STANDARD_2_5_CHECKSUM);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_interleaved_2_5_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('1234567890', $generator::TYPE_INTERLEAVED_2_5);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_interleaved_2_5_checksum_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('1234567890', $generator::TYPE_INTERLEAVED_2_5_CHECKSUM);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_code_128_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('1234567890abcABC-283*33', $generator::TYPE_CODE_128);

        $this->assertStringEqualsFile('tests/verified-files/TypeCode128-1234567890abcABC-283-33.svg', $result);
    }

    public function test_generator_can_generate_code_128_a_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('1234567890', $generator::TYPE_CODE_128_A);

        $this->assertStringEqualsFile('tests/verified-files/TypeCode128A-1234567890.svg', $result);
    }

    public function test_generator_can_generate_code_128_b_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('1234567890abcABC-283*33', $generator::TYPE_CODE_128_B);

        $this->assertStringEqualsFile('tests/verified-files/TypeCode128B-1234567890abcABC-283-33.svg', $result);
    }

    public function test_generator_can_generate_ean_2_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('22', $generator::TYPE_EAN_2);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_ean_5_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('1234567890abcABC-283*33', $generator::TYPE_EAN_5);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_ean_8_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('1234568', $generator::TYPE_EAN_8);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_ean_13_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('1234567890', $generator::TYPE_EAN_13);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_upc_a_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('123456789', $generator::TYPE_UPC_A);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_upc_e_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('123456789', $generator::TYPE_UPC_E);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_msi_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('123456789', $generator::TYPE_MSI);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_msi_checksum_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('123456789', $generator::TYPE_MSI_CHECKSUM);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_postnet_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('123456789', $generator::TYPE_POSTNET);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_planet_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('123456789', $generator::TYPE_PLANET);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_rms4cc_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('123456789', $generator::TYPE_RMS4CC);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_kix_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('123456789', $generator::TYPE_KIX);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_imb_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('123456789', $generator::TYPE_IMB);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_codabar_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('123456789', $generator::TYPE_CODABAR);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_code_11_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('123456789', $generator::TYPE_CODE_11);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_pharma_code_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('123456789', $generator::TYPE_PHARMA_CODE);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_pharma_code_2_tracks_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('123456789', $generator::TYPE_PHARMA_CODE_TWO_TRACKS);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_telepen_alpha_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('1234567890ASCD', $generator::TYPE_TELEPEN_ALPHA);

        $this->assertGreaterThan(100, strlen($result));
    }

    public function test_generator_can_generate_telepen_numeric_barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
        $result = $generator->getBarcode('1234567890', $generator::TYPE_TELEPEN_NUMERIC);
        
        $this->assertGreaterThan(100, strlen($result));
    }
}
