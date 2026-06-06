<?php

namespace App\Enums;

enum Status:string
{
    case BESTELD = 'Besteld';
    case BINNEN = 'Binnen';
    case ONDERWEG = 'Onderweg';
}
