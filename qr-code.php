<?php
require "vendor/autoload.php";

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;


if(isset($_POST['submit'])){

    $qr =($_POST['qr']);

    $result = Builder::create()
    ->writer(new PngWriter())
    ->writerOptions([])
    ->data('$qr')
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
    ->size(300)
    ->margin(10)
    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
   /*  ->logoPath(__DIR__.'/assets/symfony.png')
    ->logoResizeToWidth(50)
    ->logoPunchoutBackground(true) */
    ->labelText('Github Profile')
    ->labelFont(new NotoSans(20))
    ->labelAlignment(new LabelAlignmentCenter())
    ->validateResult(false)
    ->build();



    // Directly output the QR code
    header('Content-Type: '.$result->getMimeType());
    echo $result->getString();

    // Save it to a file
    // use uniqid() to generate random indentifiers to prevent overwriting.
    $result->saveToFile(__DIR__.'/qr-folder/'. uniqid() . '.png');

    // Generate a data URI to include image data inline (i.e. inside an <img> tag)
    $dataUri = $result->getDataUri();
}

header("location: index.html");

?>
