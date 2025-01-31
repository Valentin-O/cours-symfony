<?php

namespace App\Enum;

enum CommentStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case DELETED = 'deleted';       
}
