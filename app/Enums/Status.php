<?php

namespace App\Enums;

enum Status:string
{
    case BESTELD = 'besteld';
    case BINNEN = 'binnen';
    case ONDERWEG = 'onderweg';
    case GEANNULEREN = 'geannuleerd';
}
