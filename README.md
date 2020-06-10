[![PHP 7 Telegram Bot API Library](https://github.com/unreal4u/telegram-api/blob/master/examples/binary-test-data/logo-php7-telegram-bot-api-small.png?raw=true)](https://github.com/unreal4u/telegram-api/wiki/100-stars!)

# Telegram API Library

[![Latest Stable Version](https://poser.pugx.org/unreal4u/telegram-api/v/stable)](https://packagist.org/packages/unreal4u/telegram-api)
[![Total Downloads](https://poser.pugx.org/unreal4u/telegram-api/downloads)](https://packagist.org/packages/unreal4u/telegram-api)
[![Build Status](https://travis-ci.org/unreal4u/telegram-api.svg)](https://travis-ci.org/unreal4u/telegram-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/unreal4u/telegram-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/unreal4u/telegram-api/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/unreal4u/telegram-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/unreal4u/telegram-api/?branch=master)
[![License](https://poser.pugx.org/unreal4u/telegram-api/license)](https://packagist.org/packages/unreal4u/telegram-api)

This is a PHP7 bot API implementation for Telegram implementing the **vast majority** of
[Bot API up until v4.7](https://core.telegram.org/bots/api-changelog#march-30-2020). The only thing it does not implement
is Telegram Passport which was introduced in [Bot API v4.0](https://core.telegram.org/bots/api#july-26-2018). It is
unlikely to be introduced as it may introduce security vulnerabilities. However, if you think you have a strong case for
the need, feel free to let me know.

### About this package

* Enables you to anything supported by the Telegram Bot API: messages, stickers, location, inline bots and any other supported method via PHP to a Telegram user (either direct conversation, channel, group or supergroup).
* Respects and implements the default types and methods made by Telegram itself. Have any doubts about any method? [Just check the original documentation](https://core.telegram.org/bots/api), this implementation will not differ too much.
* Doesn't need any mandatory dependencies, except for ReactPHP, which you can inject if you already use it elsewhere.
* **Full** inline bots support.
* **Full** support for payment system.

## Known bugs

[![Telegram](http://trellobot.doomdns.org/telegrambadge.svg)](https://t.me/PHPBotAPI)

The only thing that is not included in this library (yet) is the Passport support. This was an ongoing development, but
it ended up being a lot more work than initially thought, so if someone wants to pick that up... be my guest!

All other known bugs can be found in the form of issues or pull requests. Found a new bug? Feel free to [submit a PR](https://github.com/unreal4u/telegram-api/pulls) or
[create an issue](https://github.com/unreal4u/telegram-api/issues)! Not sure if you've found a new bug? You can always ask
in the [special group](https://t.me/PHPBotAPI) :)

## Roadmap

- v4 (no branch yet) will be the next major release. [More information](https://github.com/unreal4u/telegram-api/projects/5).
- v3 (master branch) is the current active branch.
- v2 (v2 branch) is deprecated and no new work will be done there.
- v1 is deprecated and no new work will be done there.
- v0 is deprecated and no new work will be done there.

## Installation

[![Total Downloads](https://poser.pugx.org/unreal4u/telegram-api/downloads)](https://packagist.org/packages/unreal4u/telegram-api)

Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you. [Read this for installation instructions](https://getcomposer.org/doc/00-intro.md).  
The preferred (and only for now) installation method is Composer, so add the following to your composer.json:

```json
{
  "require": {
    "unreal4u/telegram-api": "~3.4"
  }
}
```

If you are not familiar with it, I suggest reading the basic usage manual [located here](https://getcomposer.org/doc/01-basic-usage.md).

### Tip for Russian users

In order to use a proxy, you can use the https://github.com/clue/php-socks-react package and pass on the following options to the Client:

```php
<?php

use Clue\React\Socks\Client;

$loop = Factory::create();
// Replace PROXY_ADDRESS and PROXY_PORT with the correct configuration
$proxy = new Client('socks5://' . PROXY_ADDRESS . ':' . PROXY_PORT, new Connector($loop));
$handler = new HttpClientRequestHandler($loop, [
    'tcp' => $proxy,
    'timeout' => 3.0,
    'dns' => false
]);

$this->tgLog = new TgLog(BOT_TOKEN, $handler);
// The rest is exactly the same as it normally is, see the examples folder for more information
```

With these simple steps, a proxy is configured in no time!

### Upgrading v2.x to v3

A lot of backwards incompatibility changes, but in a nutshell: 
* ReactPHP is the new Guzzle (Async requests!)
* Changed parameter order when invoking the constructor of `TgLog`
* Custom -Array types now implement IteratorAggregate (Solves #21 !)

Please check [the following Wiki page](https://github.com/unreal4u/telegram-api/wiki/Upgrading-from-v2-to-v3) if you 
have to upgrade from v2 to v3.

## General usage

### Basic usage example:

```php
<?php

use \unreal4u\TelegramAPI\HttpClientRequestHandler;
use \unreal4u\TelegramAPI\TgLog;
use \unreal4u\TelegramAPI\Telegram\Methods\SendMessage;

$loop = \React\EventLoop\Factory::create();
$handler = new HttpClientRequestHandler($loop);
$tgLog = new TgLog(BOT_TOKEN, $handler);

$sendMessage = new SendMessage();
$sendMessage->chat_id = A_USER_CHAT_ID;
$sendMessage->text = 'Hello world!';

$tgLog->performApiRequest($sendMessage);
$loop->run();
```
(Side note: In case `React\EventLoop\Factory` cannot be resolved in the above code, add `include('vendor/autoload.php')` to your PHP file).

With the `SendMessage()` object, you can create a message to be sent through the TgLog object.  
All other functionality is based upon this behaviour, so every other method is very similar: you instantiate an object, 
pass that object to TelegramLog->performApiRequest(), which will return a Promise. If the method returns a reply, 
pass a callback to its `onFulfilled` parameter and you'll get the native Telegram response back as an object. 
Different methods return different object types. 

Please refer to the [examples directory](https://github.com/unreal4u/telegram-api/tree/master/examples) to view examples 
of some of the implemented methods, including inline bots. 

For examples of actual code that works in a production environment, please refer to my other repo: https://github.com/unreal4u/telegram-bots

### Getting updates via Webhook

Please check [the following wiki section](https://github.com/unreal4u/telegram-api/wiki/Getting-updates-via-Webhook) for
more information on this.

### Inline bots

Please checkout the [special wiki page](https://github.com/unreal4u/telegram-api/wiki/Inline-Bots) about inline bots.

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

Collaborations are **very** welcome! [Check this Wiki page out](https://github.com/unreal4u/telegram-api/wiki/Want-to-colaborate%3F) 
for more information that will make the development easier!

### Contact the author

[![Telegram](http://trellobot.doomdns.org/telegrambadge.svg)](https://t.me/PHPBotAPI)

I actually don't use Telegram. Nah, kidding, I created a group where you can contact me at [https://t.me/PHPBotAPI](https://t.me/PHPBotAPI).
Another great way to get in touch is to simply [create an issue](https://github.com/unreal4u/telegram-api/issues) or a
[pull request](https://github.com/unreal4u/telegram-api/pulls)!

### Bugs related with security

I would appreciate it if you could handle these responsibly. If you happen to find a security issue relating to this 
Telegram Bot API client, please ask me to contact you privately [over here](https://t.me/PHPBotAPI).

### Special thanks to

- :+1: A VERY (!!) special thanks to **[NanoSector](https://github.com/Yoshi2889)** for making the entire API async worthy!
- :+1: **Intensify** for reporting [this fatal error](https://github.com/unreal4u/telegram-api/issues/15).
- :+1: All the amazing people who make [issues](https://github.com/unreal4u/telegram-api/issues) and [pull requests](https://github.com/unreal4u/telegram-api/pulls)!
