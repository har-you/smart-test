<?php


namespace App\DBAL;

/**
 * Class EnumChannelType
 */
class EnumChannelType extends EnumType
{
    const CHANNEL_FAQ = 'faq';
    const CHANNEL_BOT = 'bot';
    protected $name = 'enumchannel';
    protected $values = [self::CHANNEL_FAQ, self::CHANNEL_BOT];
}