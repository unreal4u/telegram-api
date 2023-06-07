<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;
use unreal4u\TelegramAPI\Telegram\Types\Custom\MessageEntityArray;
use unreal4u\TelegramAPI\Telegram\Types\Custom\PhotoSizeArray;
use unreal4u\TelegramAPI\Telegram\Types\Custom\UserArray;
use unreal4u\TelegramAPI\Telegram\Types\Inline\Keyboard\Markup;
use lucadevelop\TelegramEntitiesDecoder\EntityDecoder;

/**
 * This object represents a message.
 *
 * Objects defined as-is november 2020, Bot API v5.0
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
     * Optional. Unique identifier of a message thread to which the message belongs; for supergroups only
     * @var int
     */
    public $message_thread_id = 0;

    /**
     * Optional. Sender, can be empty for messages sent to channels
     * @var User
     */
    public $from;

    /**
     * Optional. Sender of the message, sent on behalf of a chat. The channel itself for channel messages. The
     * supergroup itself for messages from anonymous group administrators. The linked channel for messages automatically
     * forwarded to the discussion group
     * @var Chat
     */
    public $sender_chat;

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
     * Optional. For messages forwarded from channels, signature of the post author if present
     * @var string
     */
    public $forward_signature = '';

    /**
     * Optional. Sender's name for messages forwarded from users who disallow adding a link to their account in
     * forwarded messages
     * @var string
     */
    public $forward_sender_name = '';

    /**
     * Optional. For forwarded messages, date the original message was sent in Unix time
     * @var int
     */
    public $forward_date = 0;

	/**
	 * Optional. True, if the message is sent to a forum topic
	 */
	public $is_topic_message = false;

	/**
	 * @var bool
	 */
	public $is_automatic_forward = false;

    /**
     * Optional. For replies, the original message. Note that the Message object in this field will not contain further
     * reply_to_message fields even if it itself is a reply.
     * @var Message
     */
    public $reply_to_message;

    /**
     * Optional. Bot through which the message was sent
     * @var User
     */
    public $via_bot;

    /**
     * Optional. Date the message was last edited in Unix time
     * @var int
     */
    public $edit_date = 0;

    /**
     * 	Optional. True, if the message can't be forwarded
     * @var bool
     */
    public $has_protected_content = false;

    /**
     * Optional. The unique identifier of a media message group this message belongs to
     * @var string
     */
    public $media_group_id;

    /**
     * Optional. Signature of the post author for messages in channels, or the custom title of an anonymous group
     * administrator
     * @var string
     */
    public $author_signature = '';

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
     * Optional. Message is an animation, information about the animation. For backward compatibility, when this field
     * is set, the document field will also be set
     * @var Animation
     */
    public $animation;

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
     * Optional. Message is a video note, information about the video message
     * @var VideoNote
     */
    public $video_note;

    /**
     * Optional. Message is a voice message, information about the file
     * @var Voice
     */
    public $voice;

    /**
     * Optional. Caption for the photo or video
     * @var string
     */
    public $caption = '';

    /**
     * Optional. For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in
     * the caption
     * @var MessageEntityArray
     */
    public $caption_entities = [];

    /**
     * Optional. True, if the message media is covered by a spoiler animation
     * the caption
     * @var bool
     */
    public $has_media_spoiler = false;

    /**
     * Optional. Message is a shared contact, information about the contact
     * @var Contact
     */
    public $contact;

    /**
     * Optional. Message is a dice with random value from 1 to 6
     * @var Dice
     */
    public $dice;

    /**
     * Optional. Message is a game, information about the game
     * @see https://core.telegram.org/bots/api#games
     * @var Game
     */
    public $game;

    /**
     * Optional. Message is a native poll, information about the poll
     * @var Poll
     */
    public $poll;

    /**
     * Optional. Message is a venue, information about the venue
     * @var Venue
     */
    public $venue;

    /**
     * Optional. Message is a shared location, information about the location
     * @var Location
     */
    public $location;

    /**
     * Optional. New members that were added to the group or supergroup and information about them (the bot itself may
     * be one of these members)
     * @var User[]
     */
    public $new_chat_members;

    /**
     * Optional. A new member was added to the group, information about them (this member may be the bot itself)
     *
     * @deprecated Backward compatibility, use $new_chat_members array instead
     * @var User
     */
    public $new_chat_member;

    /**
     * Optional. A new member was added to the group, information about them (this member may be the bot itself)
     *
     * @deprecated Backward compatibility, use $new_chat_members array instead
     * @var User
     */
    public $new_chat_participant;

    /**
     * Optional. A member was removed from the group, information about them (this member may be the bot itself)
     * @var User
     */
    public $left_chat_member;

    /**
     * Optional. A member was removed from the group, information about them (this member may be the bot itself)
     *
     * @deprecated Backward compatibility, use $left_chat_member instead
     * @var User
     */
    public $left_chat_participant;

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
     * Optional. Service message: auto-delete timer settings changed in the chat
     * @see https://core.telegram.org/bots/api#messageautodeletetimerchanged @TODO
     */
    public $message_auto_delete_timer_changed;

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
     * Optional. Service message: a user was shared with the bot
     * @see https://core.telegram.org/bots/api#usershared @TODO
     */
    public $user_shared;

    /**
     * Optional. Service message: a chat was shared with the bot
     * @see https://core.telegram.org/bots/api#chatshared @TODO
     */
    public $chat_shared;

    /**
     * Optional. The domain name of the website on which the user has logged in
     * @see https://core.telegram.org/widgets/login
     * @var string
     */
    public $connected_website = '';

    /**
     * Optional. Service message: the user allowed the bot added to the attachment menu to write messages
     * @see https://core.telegram.org/bots/api#writeaccessallowed @TODO
     */
    public $write_access_allowed;

    /**
     * Optional. Telegram Passport data
     * @see https://core.telegram.org/bots/api#passportdata @TODO
     */
    public $passport_data;

    /**
     * Optional. Service message. A user in the chat triggered another user's proximity alert while sharing Live
     * Location
     * @var ProximityAlertTriggered
     */
    public $proximity_alert_triggered;

	/**
     * Optional. Service message: forum topic created
	 * @var ForumTopicCreated
	 */
	public $forum_topic_created;

	/**
     * Optional. Service message: forum topic edited
	 * @var ForumTopicEdited
	 */
	public $forum_topic_edited;

	/**
     * Optional. Service message: forum topic closed
	 * @var ForumTopicClosed
	 */
	public $forum_topic_closed;

	/**
     * Optional. Service message: forum topic reopened
	 * @var ForumTopicReopened
	 */
	public $forum_topic_reopened;

    /**
     * Optional. Service message: the 'General' forum topic hidden
     * @see https://core.telegram.org/bots/api#generalforumtopichidden @TODO
     */
    public $general_forum_topic_hidden;

    /**
     * Optional. Service message: the 'General' forum topic unhidden
     * @see https://core.telegram.org/bots/api#generalforumtopicunhidden @TODO
     */
    public $general_forum_topic_unhidden;

    /**
     * Optional. Service message: video chat scheduled
     * @see https://core.telegram.org/bots/api#videochatscheduled @TODO
     */
    public $video_chat_scheduled;

    /**
     * Optional. Service message: video chat started
     * @see https://core.telegram.org/bots/api#videochatstarted @TODO
     */
    public $video_chat_started;

    /**
     * Optional. Service message: video chat ended
     * @see https://core.telegram.org/bots/api#videochatended @TODO
     */
    public $video_chat_ended;

    /**
     * Optional. Service message: new participants invited to a video chat
     * @see https://core.telegram.org/bots/api#videochatparticipantsinvited @TODO
     */
    public $video_chat_participants_invited;

    /**
     * Optional. Service message: data sent by a Web App
     * @see https://core.telegram.org/bots/api#webappdata @TODO
     */
    public $web_app_data;

    /**
     * @var Markup
     */
    public $reply_markup;

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
            case 'new_chat_participant':
            case 'left_chat_member':
            case 'left_chat_participant':
            case 'via_bot':
                return new User($data, $this->logger);
            case 'new_chat_members':
                return new UserArray($data, $this->logger);
            case 'photo':
            case 'new_chat_photo':
                return new PhotoSizeArray($data, $this->logger);
            case 'sender_chat':
            case 'chat':
            case 'forward_from_chat':
                return new Chat($data, $this->logger);
            case 'reply_to_message':
            case 'pinned_message':
                return new Message($data, $this->logger);
            case 'entities':
            case 'caption_entities':
                return new MessageEntityArray($data, $this->logger);
            case 'audio':
                return new Audio($data, $this->logger);
            case 'document':
                return new Document($data, $this->logger);
            case 'animation':
                return new Animation($data, $this->logger);
            case 'game':
                return new Game($data, $this->logger);
            case 'dice':
                return new Dice($data, $this->logger);
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
            case 'poll':
                return new Poll($data, $this->logger);
            case 'invoice':
                return new Invoice($data, $this->logger);
            case 'successful_payment':
                return new SuccessfulPayment($data, $this->logger);
            case 'reply_markup':
                return new Markup($data, $this->logger);
            case 'proximity_alert_triggered':
                return new ProximityAlertTriggered($data, $this->logger);
            case 'forum_topic_created':
                return new ForumTopicCreated($data, $this->logger);
            case 'forum_topic_edited':
                return new ForumTopicEdited($data, $this->logger);
            case 'forum_topic_closed':
                return new ForumTopicClosed($data, $this->logger);
            case 'forum_topic_reopened':
                return new ForumTopicReopened($data, $this->logger);
        }

        // Return always null if none of the objects above matches
        return parent::mapSubObjects($key, $data);
    }

    /**
     * Decode style entities from Telegram bot messages in text with inline entities.
     *
     * @param string $style Use 'HTML', 'MarkdownV2' or 'Markdown'
     * 
     * @throws InvalidArgumentException if the provided style name is invalid.
     * 
     * @return string
     */
    public function decodeEntities($style = 'HTML'): string
    {
        $entitiesDecoder = new EntityDecoder($style);
        return $entitiesDecoder->decode($this);
    }
}
