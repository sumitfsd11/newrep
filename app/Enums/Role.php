<?php

namespace App\Enums;

enum Role: int
{
    case SuperAdmin = 0;
    case Admin = 1;
    case Staff = 2;
    case Interviewer = 3;
}
