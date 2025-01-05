<?php

namespace App\Model;

enum Roles: string
{
    case ROLES_EMPLOYEE = 'employee';
    case ROLES_CLIENT = 'client';
}
