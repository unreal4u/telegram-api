<?php

declare(strict_types = 1);

include 'basics.php';

use GuzzleHttp\Exception\ClientException;
use unreal4u\TelegramAPI\TgLog;
use unreal4u\TelegramAPI\Telegram\Methods\GetFile;

$tgLog = new TgLog(BOT_TOKEN);

$getFile = new GetFile();
// You can get a file id from an update, webhook or any other message object
$getFile->file_id = A_FILE_ID;

try {
    $file = $tgLog->performApiRequest($getFile);
} catch (ClientException $e) {
    // Do whatever you want, function below contains exact JSON output from Telegram
    echo '<pre>';
    print_r(json_decode((string)$e->getResponse()->getBody()));
    echo '</pre>';
}

// Don't do anything if we have already output (as we can't modify those headers)
if (!headers_sent()) {
    $tgDocument = $tgLog->downloadFile($file);
    header(sprintf('Content-Type: %s', $tgDocument->mime_type));
    header(sprintf('Content-Length: %d', $tgDocument->file_size));
    header(sprintf('Content-Disposition: inline; filename="%s"', basename($file->file_path)));
    print $tgDocument;
}
