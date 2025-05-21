<?php

    include('phpqrcode/qrlib.php');
    
    // outputs image directly into browser, as PNG stream
    // QRcode::png('PHP QR Code :)');

    $tempDir = 'files/';

$codeContents = 'your message here...';

$fileName = 'qrcode_name.png';

$pngAbsoluteFilePath = $tempDir.$fileName;
$urlRelativeFilePath = 'files/'.$fileName;

QRcode::png($codeContents, $pngAbsoluteFilePath); 