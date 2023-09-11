<?php

declare(strict_types=1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * Describes actions that a non-administrator user is allowed to take in a chat
 *
 * Objects defined as-is may 2020
 *
 * @see https://core.telegram.org/bots/api#chatpermissions
 */
class ChatPermissions extends TelegramTypes
{
    /**
     * Optional. True, if the user is allowed to send text messages, contacts, locations and venues
     *
     * @var bool
     */
    public $can_send_messages;

    /**
     * Optional. True, if the user is allowed to send audios, documents, photos, videos, video notes and voice notes,
     * implies can_send_messages
     *
     * @var bool
     * @deprecated Use more granual permissions instead (Bot API 6.5, February 3, 2023 https://core.telegram.org/bots/api-changelog#february-3-2023)
     */
    public $can_send_media_messages;

    /**
     * Optional. True, if the user is allowed to send audios
     *
     * @var bool
     */
    public $can_send_audios;

    /**
     * Optional. True, if the user is allowed to send documents
     *
     * @var bool
     */
    public $can_send_documents;

    /**
     * Optional. True, if the user is allowed to send photos
     *
     * @var bool
     */
    public $can_send_photos;

    /**
     * Optional. True, if the user is allowed to send videos
     *
     * @var bool
     */
    public $can_send_videos;

    /**
     * Optional. True, if the user is allowed to send video notes
     *
     * @var bool
     */
    public $can_send_video_notes;

    /**
     * Optional. True, if the user is allowed to send voice notes
     *
     * @var bool
     */
    public $can_send_voice_notes;

    /**
     * Optional. True, if the user is allowed to send polls, implies can_send_messages
     *
     * @var bool
     */
    public $can_send_polls;

    /**
     * Optional. True, if the user is allowed to send animations, games, stickers and use inline bots, implies
     * can_send_media_messages
     *
     * @var bool
     */
    public $can_send_other_messages;

    /**
     * Optional. True, if the user is allowed to add web page previews to their messages, implies
     * can_send_media_messages
     *
     * @var bool
     */
    public $can_add_web_page_previews;

    /**
     * Optional. True, if the user is allowed to change the chat title, photo and other settings. Ignored in public
     * supergroups
     *
     * @var bool
     */
    public $can_change_info;

    /**
     * Optional. True, if the user is allowed to invite new users to the chat
     *
     * @var bool
     */
    public $can_invite_users;

    /**
     * Optional. True, if the user is allowed to pin messages. Ignored in public supergroups
     *
     * @var bool
     */
    public $can_pin_messages;

    /**
     * Optional. True, if the user is allowed to create forum topics. If omitted defaults to the
     * value of can_pin_messages
     *
     * @var bool
     */
    public $can_manage_topics;
}
