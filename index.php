<?php
require "vendor/autoload.php";

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

$result = Builder::create()
    ->writer(new PngWriter())
    ->writerOptions([])
    ->data('https://github.com/AlessandroKE')
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
    $result->saveToFile(__DIR__.'/qrcode.png');

    // Generate a data URI to include image data inline (i.e. inside an <img> tag)
    $dataUri = $result->getDataUri();
?>
<!-- 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            body {overflow: hidden;}
            
            .margin {
                margin-top: 100px
            }

            .head-margin {
                margin-top: 160px;
                margin-bottom: -80px
            }
        </style>
        <title>QR Generator</title>
    </head>
    <body>
       
        <div class="conatiner">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <h3 class="text-center head-margin">Generate a QR</h3>
                    <form class="mb-4 card p-2 margin" method="POST" action="">
                        <div class="input-group">
                            <input type="text" name="qr" class="form-control" placeholder="enter code here">
                            <div class="input-group-append">
                                <button type="submit" name="submit" class="btn btn-success">Generate</button>
                            </div>
                        </div>
                    </form>


                </div>
           </div>
        </div>

      
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>
     
    </body>
</html>
 -->