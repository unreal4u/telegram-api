<?php

include('basics.php');

use \unreal4u\MonologHandler;
use \unreal4u\TelegramLog;
use \Monolog\Logger;

#$monologTgLogger = new MonologHandler(new TelegramLog(BOT_TOKEN), A_USER_CHAT_ID, Logger::DEBUG); // Sends from DEBUG+
$monologTgLogger = new MonologHandler(new TelegramLog(BOT_TOKEN), A_USER_CHAT_ID, Logger::ERROR); // Sends ERROR+

//Create logger
$logger = new Logger('TelegramLogger');
$logger->pushHandler($monologTgLogger);

//Now you can use the logger, and further attach additional information
$logger->debug('Nobody gives a dime for debug messages', ['moreInfo' => 'Within here']);
$logger->info('A user has logged in');
$logger->notice('Something unusual has happened!', ['it did indeed']);
$logger->warning('Somebody should attend this', ['some', 'extra' => 'information']);
$logger->error('Something really bad happened');
$logger->critical('A critical message', ['please' => 'Check this out']);
$logger->alert('This is an alert', ['oh no...' => 'This might be urgent']);
$logger->emergency('Run for your lives!', ['this is it' => 'everything has stopped working']);
