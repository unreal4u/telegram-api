<?php

declare(strict_types = 1);

namespace unreal4u\Telegram\Types;

use unreal4u\InternalFunctionality\AbstractFiller;
use unreal4u\Telegram\Types\Custom\PhotoSizeArray;

/**
 * This object represents a message.
 *
 * Objects defined as-is december 2015
 *
 * @see https://core.telegram.org/bots/api#message
 */
class Message extends AbstractFiller
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
    public $from = null;

    /**
     * Date the message was sent in Unix time
     * @var int
     */
    public $date = 0;

    /**
     * Conversation the message belongs to
     * @var Chat
     */
    public $chat = null;

    /**
     * Optional. For forwarded messages, sender of the original message
     * @var User
     */
    public $forward_from = null;

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
    public $reply_to_message = null;

    /**
     * Optional. For text messages, the actual UTF-8 text of the message
     * @var string
     */
    public $text = '';

    /**
     * Optional. Message is an audio file, information about the file
     * @var Audio
     */
    public $audio = null;

    /**
     * Optional. Message is a general file, information about the file
     * @var Document
     */
    public $document = null;

    /**
     * Optional. Message is a photo, available sizes of the photo
     * @var array
     */
    public $photo = [];

    /**
     * Optional. Message is a sticker, information about the sticker
     * @var Sticker
     */
    public $sticker = null;

    /**
     * Optional. Message is a video, information about the video
     * @var Video
     */
    public $video = null;

    /**
     * Optional. Message is a voice message, information about the file
     * @var Voice
     */
    public $voice = null;

    /**
     * Optional. Caption for the photo or video
     * @var string
     */
    public $caption = '';

    /**
     * Optional. Message is a shared contact, information about the contact
     * @var Contact
     */
    public $contact = null;

    /**
     * Optional. Message is a shared location, information about the location
     * @var Location
     */
    public $location = null;

    /**
     * Optional. A new member was added to the group, information about them (this member may be the bot itself)
     * @var User
     */
    public $new_chat_participant = null;

    /**
     * Optional. A member was removed from the group, information about them (this member may be the bot itself)
     * @var User
     */
    public $left_chat_participant = null;

    /**
     * Optional. A chat title was changed to this value
     * @var string
     */
    public $new_chat_title = '';

    /**
     * Optional. A chat photo was change to this value
     * @var array
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
     * Optional. Service message: the supergroup has been created
     * @var bool
     */
    public $supergroup_chat_created = false;

    /**
     * Optional. Service message: the channel has been created
     * @var bool
     */
    public $channel_chat_created = false;

    /**
     * Optional. The group has been migrated to a supergroup with the specified identifier, not exceeding 1e13 by
     * absolute value
     * @var int
     */
    public $migrate_to_chat_id = 0;

    /**
     * Optional. The supergroup has been migrated from a group with the specified identifier, not exceeding 1e13 by
     * absolute value
     * @var int
     */
    public $migrate_from_chat_id = 0;

    public function __construct(\stdClass $data = null)
    {
        // From is of User type of data
        if (!empty($data->from)) {
            $data->from = new User($data->from);
        }

        // Chat always should be a chat object
        if (!empty($data->chat)) {
            $data->chat = new Chat($data->chat);
        }

        // forward_from == User object
        if (!empty($data->forward_from)) {
            $data->forward_from = new User($data->forward_from);
        }

        // reply_to_message == Message object
        if (!empty($data->reply_to_message)) {
            $data->reply_to_message = new Message($data->reply_to_message);
        }

        // ... etc
        if (!empty($data->audio)) {
            $data->audio = new Audio($data->audio);
        }

        if (!empty($data->document)) {
            $data->document = new Document($data->document);
        }

        if (!empty($data->photo)) {
            $photoArray = new PhotoSizeArray($data->photo);
            $data->photo = $photoArray->data;
        }

        if (!empty($data->sticker)) {
            $data->sticker = new Sticker($data->sticker);
        }

        if (!empty($data->video)) {
            $data->video = new Video($data->video);
        }

        if (!empty($data->voice)) {
            $data->voice = new Voice($data->voice);
        }

        if (!empty($data->contact)) {
            $data->contact = new Contact($data->contact);
        }

        if (!empty($data->location)) {
            $data->location = new Location($data->location);
        }

        if (!empty($data->new_chat_participant)) {
            $data->new_chat_participant = new User($data->new_chat_participant);
        }

        if (!empty($data->left_chat_participant)) {
            $data->left_chat_participant = new User($data->left_chat_participant);
        }

        if (!empty($data->new_chat_photo)) {
            $photoArray = new PhotoSizeArray($data->new_chat_photo);
            $data->new_chat_photo = $photoArray->data;
        }

        parent::__construct($data);
    }
}
