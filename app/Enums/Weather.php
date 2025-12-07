<?php

namespace App\Enums;

enum Weather: string
{
    case CLEAR = 'clear';
    case SUNNY = 'sunny';
    case CLOUDY = 'cloudy';
    case RAINY = 'rainy';
    case STORMY = 'stormy';
    case SNOWY = 'snowy';
    case WINDY = 'windy';
}
