<?php

declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types;

use unreal4u\TelegramAPI\Abstracts\TelegramTypes;

/**
 * This object describes the position on faces where a mask should be placed by default
 *
 * Objects defined as-is july 2017
 *
 * @see https://core.telegram.org/bots/api#maskposition
 */
class MaskPosition extends TelegramTypes
{
    /**
     * The part of the face relative to which the mask should be placed. One of "forehead", "eyes", "mouth", or "chin"
     * @var string
     */
    public $point = '';

    /**
     * Shift by X-axis measured in widths of the mask scaled to the face size, from left to right. For example, choosing
     * -1.0 will place mask just to the left of the default mask position
     * @var float
     */
    public $x_shift = 0.0;

    /**
     * Shift by Y-axis measured in heights of the mask scaled to the face size, from top to bottom. For example, 1.0
     * will place the mask just below the default mask position
     * @var string
     */
    public $y_shift = 0.0;

    /**
     * Mask scaling coefficient. For example, 2.0 means double size
     * @var float
     */
    public $zoom = 0.0;
}
