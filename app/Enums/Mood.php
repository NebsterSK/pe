<?php

namespace App\Enums;

enum Mood: string
{
    case OK = 'ok';
    case HAPPY = 'happy';
    case SAD = 'sad';
    case DEPRESSED = 'depressed';
    case DETERMINED = 'determined';
    case TIRED = 'tired';
    case ENERGIZED = 'energized';
}
