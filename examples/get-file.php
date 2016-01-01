<?php

include('basics.php');

use GuzzleHttp\Exception\ClientException;
use \unreal4u\TelegramLog;
use \unreal4u\Telegram\Methods\GetFile;

$tgLog = new TelegramLog(BOT_TOKEN);

$getFile = new GetFile();
$getFile->file_id = A_FILE_ID;
try {
    $file = $tgLog->performApiRequest($getFile);
} catch (ClientException $e) {
    echo '<pre>';
    print_r(json_decode((string)$e->getResponse()->getBody()));
    echo '</pre>';
}

#echo '<pre>';
#var_dump($file);
#echo '</pre>';

if (!headers_sent()) {
    $downloadedFile = $tgLog->downloadFile($file);
    // For some reason, all images are downloaded as jpeg files (yes, even original .gif's)
    header('Content-Type: image/jpeg');
    // Display in browser
    header(sprintf('Content-Disposition: inline; filename="%s"', basename($file->file_path)));
    echo $downloadedFile;
}


