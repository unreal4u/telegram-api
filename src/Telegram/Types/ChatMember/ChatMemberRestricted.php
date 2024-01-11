<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types\ChatMember;

use unreal4u\TelegramAPI\Telegram\Types\ChatMember;

/**
 * Represents a chat member that is under certain restrictions in the chat. Supergroups only.
 *
 * @see https://core.telegram.org/bots/api#chatmemberrestricted
 */
class ChatMemberRestricted extends ChatMember
{
    public const STATUS = 'restricted';

    /**
     * The member's status in the chat, always “restricted”
     * @var string
     */
    public $status = self::STATUS;

    /**
     * True, if the user is a member of the chat at the moment of the request
     * @var bool
     */
    public $is_member = false;

    /**
     * True, if the user is allowed to send text messages, contacts, invoices, locations and venues
     * @var bool
     */
    public $can_can_send_messages = false;

    /**
     * True, if the user is allowed to send audios
     * @var bool
     */
    public $can_send_audios = false;

    /**
     * True, if the user is allowed to send documents
     * @var bool
     */
    public $can_send_documents = false;

    /**
     * True, if the user is allowed to send photos
     * @var bool
     */
    public $can_send_photos = false;

    /**
     * True, if the user is allowed to send videos
     * @var bool
     */
    public $can_send_videos = false;

    /**
     * True, if the user is allowed to send video notes
     * @var bool
     */
    public $can_send_video_notes = false;

    /**
     * True, if the user is allowed to send voice notes
     * @var bool
     */
    public $can_send_voice_notes = false;

    /**
     * True, if the user is allowed to send polls
     * @var bool
     */
    public $can_send_polls = false;

    /**
     * True, if the user is allowed to send animations, games, stickers and use inline bots
     * @var bool
     */
    public $can_send_other_messages = false;

    /**
     * True, if the user is allowed to add web page previews to their messages
     * @var bool
     */
    public $can_add_web_page_previews = false;

    /**
     * True, if the user is allowed to change the chat title, photo and other settings
     * @var bool
     */
    public $can_change_info = false;

    /**
     * True, if the user is allowed to invite new users to the chat
     * @var bool
     */
    public $can_invite_users = false;

    /**
     * True, if the user is allowed to pin messages
     * @var bool
     */
    public $can_pin_messages = false;

    /**
     * True, if the user is allowed to create forum topics
     * @var bool
     */
    public $can_manage_topics = false;

    /**
     * Date when restrictions will be lifted for this user; Unix time. If 0, then the user is restricted forever
     * @var int
     */
    public $until_date = 0;

}
