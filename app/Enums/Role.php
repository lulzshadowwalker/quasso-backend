<?php

namespace App\Enums;

enum Role: string
{
    case SUPER_ADMIN = 'SUPER_ADMIN';
    case RESTAURANT_OWNER = 'RESTAURANT_OWNER';
}
