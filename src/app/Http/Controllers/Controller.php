<?php

namespace App\Http\Controllers;

abstract class Controller
{
    use \App\Traits\PermissionTrait;
    use \App\Traits\ApiResponse;
}
