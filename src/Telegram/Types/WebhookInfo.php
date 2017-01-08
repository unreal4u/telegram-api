<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * Contains information about the current status of a webhook
 *
 * Objects defined as-is october 2016
 *
 * @see https://core.telegram.org/bots/api/#webhookinfo
 */
class WebhookInfo extends TelegramTypes
{
    /**
     * Webhook URL, may be empty if webhook is not set up
     * @var string
     */
    public $url = '';

    /**
     * True, if a custom certificate was provided for webhook certificate checks
     * @var boolean
     */
    public $has_custom_certificate = false;

    /**
     * Number of updates awaiting delivery
     * @var int
     */
    public $pending_update_count = 0;

    /**
     * Optional. Unix time for the most recent error that happened when trying to deliver an update via webhook
     * @var int
     */
    public $last_error_date = 0;

    /**
     * Optional. Error message in human-readable format for the most recent error that happened when trying to deliver
     * an update via webhook
     * @var int
     */
    public $last_error_message = '';

    /**
     * Optional. Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery
     * @var int
     */
    public $max_connections;

    /**
     * Optional. A list of update types the bot is subscribed to. Defaults to all update types
     * @var string[]
     */
    public $allowed_updates = [];
}
