[![Latest Stable Version](https://poser.pugx.org/unreal4u/telegram-api/v/stable)](https://packagist.org/packages/unreal4u/telegram-api)
[![Build Status](https://travis-ci.org/unreal4u/telegram-api.svg)](https://travis-ci.org/unreal4u/telegram-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/unreal4u/telegram-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/unreal4u/telegram-api/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/unreal4u/telegram-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/unreal4u/telegram-api/?branch=master)
[![License](https://poser.pugx.org/unreal4u/telegram-api/license)](https://packagist.org/packages/unreal4u/telegram-api)

# Telegram API

This is a complete PHP7 bot API implementation for Telegram implementing the totality of Bot API version 2.3 (Except the
gaming platform introduced in October 2016, please check [the open issues](https://github.com/unreal4u/telegram-api/issues/12)
for more details)

## Current status

The current version is stable enough to be used in production, with some methods still to be implemented. These missing
methods are:

- Some new methods related to games added in October 2016, [please check this link](https://core.telegram.org/bots/api-changelog#october-3-2016) and [the following issue](https://github.com/unreal4u/telegram-api/issues/12).
- Ability to pass on an url as InputFile, there is barely any documentation on this subject.

If you are sure that you'll not use these capabilities, feel free to test it out, the basics should all be working
correctly at all times. If not, [let me know](https://github.com/unreal4u/telegram-api/issues) or send out a PR!

### About this class

* Enables you to send messages, stickers, location and other methods via PHP to a Telegram user (either direct conversation, channel or group).
* Respects and implements the default types and methods made by Telegram itself. Have any doubts about any method? [Just check the original documentation](https://core.telegram.org/bots/api), this implementation will not differ too much.
* Doesn't need any dependency, except for Guzzle, which you can inyect if you already use it elsewhere.
* **Full** inline bots support!

### Detailed description

This project was born to study the new concepts of PHP7 and to integrate some other knowledge I had previously heard
about but didn't have the time to play with them. The idea behind was to create a simple to use class which could
play nicely with the Telegram API. The end result however ended up being a complete bot API implementation.

## Installation

The preferred method is composer, so add the following to your composer.json:

```json
{
  "require": {
    "unreal4u/telegram-api": "~2.1"
  }
}
```

### Upgrading v1.x to v2

Please check [the following Wiki page](https://github.com/unreal4u/telegram-api/wiki/Upgrading-from-v1-to-v2) if you 
have to upgrade from v1 to v2.

## General usage

### Basic usage example:

```php
use \unreal4u\TelegramAPI\TgLog;
use \unreal4u\TelegramAPI\Telegram\Methods\SendMessage;

$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'Hello world!';

$tgLog = new TgLog(BOT_TOKEN);
$message = $tgLog->performApiRequest($sendMessage);
```

With the `SendMessage()` object, you can create a message to be sent through the TgLog object.  
All other functionality is based upon this behaviour, so every other method is very similar: you instantiate an object, 
pass that object to TelegramLog->performApiRequest() and you'll get the native Telegram response back as an object. 
Different methods return different object types. 

Please refer to the [examples directory](https://github.com/unreal4u/telegram-api/tree/master/examples) to view examples 
of some of the implemented methods, including inline bots. 

For examples of actual code that works in a production environment, please refer to my other repo: https://github.com/unreal4u/tg-timebot

### Getting updates via Webhook

Please check [the following wiki section](https://github.com/unreal4u/telegram-api/wiki/Getting-updates-via-Webhook) for
more information on this.

### Inline bots

Please checkout the [special wiki page](https://github.com/unreal4u/telegram-api/wiki/Inline-Bots) about Inline bots.

### Extra requirements

If you want to use this package, you'll need a bot API key. Check 
[the following documentation](https://github.com/unreal4u/telegram-api/wiki/Creating-a-bot) for more instructions 
on that.

### Getting everything started up

The most difficult thing to do when performing an action with the Telegram API is to get the chat_id, which is the 
actual conversation window the bot talks to. You can execute the GetUpdates() method in order to get this chatId. Note
that there are some caveats on this, so you may be better out with the SetWebhook() method instead. 

## Development

### Semver

I will try my best to respect [Semantic Versioning](http://semver.org).  
That being said, the first stable release is v1.0.0, from there on no mayor BC changes will occur unless we update
the major.

### Want to colaborate?

Colaborations are **very** welcome! [Check this Wiki page out](https://github.com/unreal4u/telegram-api/wiki/Want-to-colaborate%3F) 
for more information that will make the development easier!

### Contact the author

I actually don't use Telegram. Nah, kidding, you can contact me at [https://telegram.me/unreal4u](https://telegram.me/unreal4u).
Another great way to help is to simply [create an issue](https://github.com/unreal4u/telegram-api/issues) or a
[pull request](https://github.com/unreal4u/telegram-api/pulls)!

### Special thanks to

- Intensify for reporting [this fatal error](https://github.com/unreal4u/telegram-api/issues/15).
