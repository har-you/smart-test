<?php

namespace App\DBAL;

/**
 * Class EnumStatusType
 */
class EnumStatusType extends EnumType
{
    const STATUS_PUBLISHED = 'published';
    const STATUS_DRAFT = 'draft';

    protected $name = 'enumstatus';
    protected $values = ['published', 'draft'];
}
