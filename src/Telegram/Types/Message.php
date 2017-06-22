<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\Custom\PhotoSizeArray;
use unreal4u\TelegramAPI\Telegram\Types\Custom\MessageEntityArray;
use unreal4u\TelegramAPI\Telegram\Types\Custom\UserArray;

/**
 * This object represents a message.
 *
 * Objects defined as-is december 2015
 *
 * @see https://core.telegram.org/bots/api#message
 */
class Message extends TelegramTypes
{
    /**
     * Unique message identifier
     * @var int
     */
    public $message_id = 0;

    /**
     * Optional. Sender, can be empty for messages sent to channels
     * @var User
     */
    public $from;

    /**
     * Date the message was sent in Unix time
     * @var int
     */
    public $date = 0;

    /**
     * Conversation the message belongs to
     * @var Chat
     */
    public $chat;

    /**
     * Optional. For forwarded messages, sender of the original message
     * @var User
     */
    public $forward_from;

    /**
     * Optional. For messages forwarded from a channel, information about the original channel
     * @var Chat
     */
    public $forward_from_chat;

    /**
     * Optional. For forwarded channel posts, identifier of the original message in the channel
     * @var int
     */
    public $forward_from_message_id = 0;

    /**
     * Optional. For forwarded messages, date the original message was sent in Unix time
     * @var int
     */
    public $forward_date = 0;

    /**
     * Optional. For replies, the original message. Note that the Message object in this field will not contain further
     * reply_to_message fields even if it itself is a reply.
     * @var Message
     */
    public $reply_to_message;

    /**
     * Optional. Date the message was last edited in Unix time
     * @var int
     */
    public $edit_date = 0;

    /**
     * Optional. For text messages, the actual UTF-8 text of the message, 0-4096 characters
     * @var string
     */
    public $text = '';

    /**
     * Optional. For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text
     * @var MessageEntityArray
     */
    public $entities = [];

    /**
     * Optional. Message is an audio file, information about the file
     * @var Audio
     */
    public $audio;

    /**
     * Optional. Message is a general file, information about the file
     * @var Document
     */
    public $document;

    /**
     * Optional. Message is a game, information about the game
     * @see https://core.telegram.org/bots/api#games
     * @var Game
     */
    public $game;

    /**
     * Optional. Message is a photo, available sizes of the photo
     * @var PhotoSizeArray
     */
    public $photo = [];

    /**
     * Optional. Message is a sticker, information about the sticker
     * @var Sticker
     */
    public $sticker;

    /**
     * Optional. Message is a video, information about the video
     * @var Video
     */
    public $video;

    /**
     * Optional. Message is a voice message, information about the file
     * @var Voice
     */
    public $voice;

    /**
     * Optional. Message is a video note, information about the video message
     * @var VideoNote
     */
    public $video_note;

    /**
     * Optional. New members that were added to the group or supergroup and information about them (the bot itself may
     * be one of these members)
     * @var User[]
     */
    public $new_chat_members;

    /**
     * Optional. Caption for the photo or video
     * @var string
     */
    public $caption = '';

    /**
     * Optional. Message is a shared contact, information about the contact
     * @var Contact
     */
    public $contact;

    /**
     * Optional. Message is a shared location, information about the location
     * @var Location
     */
    public $location;

    /**
     * Optional. Message is a venue, information about the venue
     * @var Venue
     */
    public $venue;

    /**
     * Optional. A new member was added to the group, information about them (this member may be the bot itself)
     * @var User
     */
    public $new_chat_member;

    /**
     * Optional. A member was removed from the group, information about them (this member may be the bot itself)
     * @var User
     */
    public $left_chat_member;

    /**
     * Optional. A chat title was changed to this value
     * @var string
     */
    public $new_chat_title = '';

    /**
     * Optional. A chat photo was change to this value
     * @var PhotoSizeArray
     */
    public $new_chat_photo = [];

    /**
     * Optional. Service message: the chat photo was deleted
     * @var bool
     */
    public $delete_chat_photo = false;

    /**
     * Optional. Service message: the group has been created
     * @var bool
     */
    public $group_chat_created = false;

    /**
     * Optional. Service message: the supergroup has been created. This field can‘t be received in a message coming
     * through updates, because bot can’t be a member of a supergroup when it is created. It can only be found in
     * reply_to_message if someone replies to a very first message in a directly created supergroup
     * @var bool
     */
    public $supergroup_chat_created = false;

    /**
     * Optional. Service message: the channel has been created. This field can‘t be received in a message coming
     * through updates, because bot can’t be a member of a channel when it is created. It can only be found in
     * reply_to_message if someone replies to a very first message in a channel
     * @var bool
     */
    public $channel_chat_created = false;

    /**
     * Optional. The group has been migrated to a supergroup with the specified identifier. This number may be greater
     * than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it smaller
     * than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier
     * @var int
     */
    public $migrate_to_chat_id = 0;

    /**
     * Optional. The supergroup has been migrated from a group with the specified identifier. This number may be greater
     * than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it smaller
     * than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier
     * @var int
     */
    public $migrate_from_chat_id = 0;

    /**
     * Optional. Specified message was pinned. Note that the Message object in this field will not contain further
     * reply_to_message fields even if it is itself a reply.
     * @var Message
     */
    public $pinned_message;

    /**
     * Optional. Message is an invoice for a payment, information about the invoice
     * @see https://core.telegram.org/bots/api#payments
     * @var Invoice
     */
    public $invoice;

    /**
     * Optional. Message is a service message about a successful payment, information about the payment
     * @var SuccessfulPayment
     */
    public $successful_payment;

    /**
     * A message may contain one or more subobjects, map them always in this function
     *
     * @param string $key
     * @param array $data
     * @return TelegramTypes
     */
    protected function mapSubObjects(string $key, array $data): TelegramTypes
    {
        switch ($key) {
            case 'from':
            case 'forward_from':
            case 'new_chat_member':
            case 'left_chat_member':
                return new User($data, $this->logger);
            case 'new_chat_members':
                return new UserArray($data, $this->logger);
            case 'photo':
            case 'new_chat_photo':
                return new PhotoSizeArray($data, $this->logger);
            case 'chat':
            case 'forward_from_chat':
                return new Chat($data, $this->logger);
            case 'reply_to_message':
            case 'pinned_message':
                return new Message($data, $this->logger);
            case 'entities':
                return new MessageEntityArray($data, $this->logger);
            case 'audio':
                return new Audio($data, $this->logger);
            case 'document':
                return new Document($data, $this->logger);
            case 'game':
                return new Game($data, $this->logger);
            case 'sticker':
                return new Sticker($data, $this->logger);
            case 'video':
                return new Video($data, $this->logger);
            case 'voice':
                return new Voice($data, $this->logger);
            case 'video_note':
                return new VideoNote($data, $this->logger);
            case 'contact':
                return new Contact($data, $this->logger);
            case 'location':
                return new Location($data, $this->logger);
            case 'venue':
                return new Venue($data, $this->logger);
            case 'invoice':
                return new Invoice($data, $this->logger);
            case 'successful_payment':
                return new SuccessfulPayment($data, $this->logger);
        }

        // Return always null if none of the objects above matches
        return parent::mapSubObjects($key, $data);
    }
}
