[![Latest Stable Version](https://poser.pugx.org/unreal4u/telegram-api/v/stable)](https://packagist.org/packages/unreal4u/telegram-api)
[![Build Status](https://travis-ci.org/unreal4u/telegram-api.svg)](https://travis-ci.org/unreal4u/telegram-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/unreal4u/telegram-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/unreal4u/telegram-api/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/unreal4u/telegram-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/unreal4u/telegram-api/?branch=master)
[![License](https://poser.pugx.org/unreal4u/telegram-api/license)](https://packagist.org/packages/unreal4u/telegram-api)

Telegram Log 
======

Enables sending messages, photos, videos and many other things to Telegram from PHP via the open-source Telegram API.
I hope I'll be able to build a complete implementation soon. For now it remains a bit of work in progress.

About this class
--------

* Enables you to send messages, stickers, location and other methods via PHP to Telegram.
* Respects and implements the default types and methods made by Telegram itself.
* Doesn't need any dependency: you are free to do whatever you want with the available data.

Detailed description
---------

This project was born to study the new concepts of PHP7 and to integrate some other knowledge I had previously heard
about but didn't have the time to play with them. The idea behind was to create a simple to use class which could
play nicely with the Telegram API. 

Why PHP7 only?
----------

Mainly because PHP7 is a fantastic release and I wanted to release some new software based solely on this new version. 
If however there is a lot of interest from the community to get a PHP5.6 or PHP5.5 compatible version, I could make one.
You are free as well to contribute with a PHP-earlier branch. Just send in a pull request. However, take into 
consideration that the master branch will be PHP7 only.

Installation
----------

The preferred method is composer, so add the following to your composer.json:

<pre>
{
  "require": {
    "unreal4u/telegram-api": "~1.0"
  }
}
</pre>

Basic usage
----------

<pre>
$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'Hello world!';

$tgLog = new TgLog(BOT_TOKEN);
$message = $tgLog->performApiRequest($sendMessage);
</pre>

With the SendMessage() object, you can create a message to be sent through the TelegramLog object.  
All other functionality is based upon this behaviour, so every other method is very similar: you instantiate an object, 
pass that object to TelegramLog->performApiRequest() and you'll get the native Telegram response back as an object. 
Different methods return different object types. 

Please refer to the examples directory to view examples of all implemented methods.

Getting updates via Webhook
---------

The first you'll have to do is register a webhook with Telegram via the SetWebhook method:

<pre>
$setWebhook = new SetWebhook();
$setWebhook->url = '[YOUR HTTPS URL]';

$tgLog = new TgLog(BOT_TOKEN);
$tgLog->performApiRequest($setWebhook);
</pre>

This will leave you prepared to start receiving updates on the chosen URL: 

<pre>
$update = new Update($_POST);
</pre>

Now <code>$update</code> will contain the actual Update object. Hope that wasn't too difficult :)

More information on this? You can check [how I implemented](https://github.com/unreal4u/tg-timebot) my 
[timeBot](https://telegram.me/TheTimeBot).

Inline bots
----------

These type of bots were introduced in January 2016 and extend the capabilities current bots have. With this type of bots
you can basically just invoke a bot in whatever conversation you have with somebody and then some quick search results
will appear so that you can choose from one.

This class implements those type of bots and the usage is pretty simple, set up a webhook and put the $_POST request
into an update class. This will fill out any details you may have. 

What's different from normal updates however is that you are now required to check the Update object: in an inline bot
message will not be set, but inline_query will be. (Or optionally chosen_inline_result). You will also get an ID which
you are required to send back (so that Telegram knows what to display to which user). 

The following example code should help you a lot with this: 

<pre>
$update = new Update($_POST);

if (!empty($update->inline_query)) {
    $inlineQueryResultArticle = new InlineQueryResultArticle();
    $inlineQueryResultArticle->title = 'Hello world';
    $inlineQueryResultArticle->message_text = 'This should be interesting';
    $inlineQueryResultArticle->id = md5(uniqid());
    
    $answerInlineQuery = new AnswerInlineQuery();
    $answerInlineQuery->inline_query_id = $update->inline_query->id;
    $answerInlineQuery->results[] = $inlineQueryResultArticle;
    
    $tgLog = new TgLog(BOT_TOKEN);
    $result = $tgLog->performApiRequest($answerInlineQuery);
}
</pre>

A functional example can be found in a [working implementation](https://github.com/unreal4u/tg-timebot).

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

You need an actual working bot at Telegram to get started. To do so, initiate a talk with the 
[@BotFather](https://telegram.me/botfather) (lol) and follow its instructions. More information on how to do so can be 
found at the amazing documentation here: [https://core.telegram.org/bots](https://core.telegram.org/bots)

Also [check here for step-by-step instructions](https://github.com/akalongman/php-telegram-bot/blob/master/README.md).

Getting everything started up
-----------

The most difficult thing to do when performing an action with the Telegram API is to get the chat_id, which is the 
actual conversation window the bot talks to. You can execute the GetUpdates() method in order to get this chatId. Note
that there are some caveats on this, so you may be better out with the SetWebhook() method instead. 

Semver
-----------

I will try my best to respect Semantic Versioning.  
That being said, the first stable release is v1.0.0, from there on no mayor BC changes will occur unless we update
the major.

Want to colaborate?
-----------

You are free to do so, just send a pull request. Try to respect the PSR-2 styling guide (or PSR-12 whenever it comes 
out). 

Instructions

1- Clone this repo

2- Execute: 
<pre>
vagrant up # Might take a while :)
vagrant ssh
cd /var/www/default/
composer install -o
</pre>

3- To unit test:
<pre>
vagrant ssh
cd /var/www/default/
vendor/bin/phpunit
</pre>

4- That's all folks!
