<?php
require 'vendor/autoload.php'; // Include Composer autoload if using Composer

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

$data = base64_decode($_REQUEST['data']);

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode;

$result = Builder::create()
    ->writer(new PngWriter())
    ->writerOptions([])
    ->data($data)
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(ErrorCorrectionLevel::High)
    ->size(300)
    ->margin(10)
    ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
    ->labelText('')
    ->labelFont(new \Endroid\QrCode\Label\Font\NotoSans(20))
    ->labelAlignment(LabelAlignment::Center)
    ->build();


// Save it to a file
// $result->saveToFile(__DIR__ . '/qrcode.png');

// Directly output the QR code image
header('Content-Type: ' . $result->getMimeType());
echo $result->getString();
