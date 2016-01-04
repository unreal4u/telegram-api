Telegram Log 
======

Enables sending messages to Telegram via PHP.

About this class
--------

* Enables you to send messages, stickers, location and other methods via PHP to Telegram.
* Respects and implements the default types and methods made by Telegram itself.
* Doesn't need any dependency: you are free to do whatever you want with the available data.
* Can integrate with Monolog via the Monolog Handler.

Detailed description
---------

This project was born to study the new concepts of PHP7 and to integrate some other knowledge I had previously heard
about but didn't have the time to play with them. The idea behind was to create a simple to use class which could
play nicely with the Telegram API. 

Installation
----------

<pre>
// @TODO
</pre>

Basic usage
----------

<pre>
$tgLog = new TelegramLog(BOT_TOKEN);

$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'Hello world!';
$message = $tgLog->performApiRequest($sendMessage);
</pre>

With the SendMessage() object, you can create a message to be sent through the TelegramLog object.  
All other functionality is based upon this behaviour, so every other method is very similar: you instantiate an object, 
pass that object to TelegramLog->performApiRequest() and you'll get the native Telegram response back as an object. 
Different methods return different object types. 

Please refer to the examples directory to view examples of all implemented methods.

TODOs
---------

Without any preference or ordering: 

* UptimeRobot integration (maybe another project?)
* InlineBots
* Keyboard integration
* Better documentation
* Unit tests (note that until this is done, the code should be considered very alpha!)
* Composer package

Why this class?
----------

There are some pretty good alternatives around there, such as: 

[The (unofficial) SDK](https://github.com/irazasyed/telegram-bot-sdk)  
[akalongman's approach](https://github.com/akalongman/php-telegram-bot)

But I wanted to study a bunch of new concepts for me and make a standalone client that doesn't require Laravel or MySQL: 

* Telegram API
* PHP7
* Vagrant
* Monolog
* Guzzle
* PHP-CS

I had heard of all these great tools previously but I didn't have a nice project to work on and learn properly. So this
project was born. 

Extra requirements
----------

You need an actual working bot at Telegram to get started. To do so, initiate a talk with the @BotFather (lol) and 
follow its instructions. More information on how to do so can be found at the amazing documentation here:
[https://core.telegram.org/bots](https://core.telegram.org/bots)

Also [check here for step-by-step instructions](https://github.com/akalongman/php-telegram-bot/blob/master/README.md).

Getting everything started up
-----------

The most difficult thing to do when performing an action with the Telegram API is to get the chat_id, which is the 
actual conversation window the bot talks to. You can execute the GetUpdates() method in order to get this chatId. Note
that there are some caveats on this, so you may be better out with the SetWebhook() method instead. 

Want to colaborate?
-----------

You are free to do so, just send a pull request. Try to respect the PSR-2 styling guide (or PSR-12 whenever it comes 
out). 

