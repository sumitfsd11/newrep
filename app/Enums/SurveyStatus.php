<?php

namespace App\Enums;

enum SurveyStatus: int
{
    case Unpublished = 0;
    case Published = 1;
    case Completed = 2;
}
