<?php

namespace App\Enums;

enum UserRole: string
{
    case User = "user";
    case Admin = "admin";
    case Coordinator = "coordinator";
    case Area_manager  = "area_manager";
}
