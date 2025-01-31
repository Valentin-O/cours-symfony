<?php

namespace App\Enum;

enum MediaTypeEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case DELETED = 'deleted';       
}
