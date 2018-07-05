<?php

namespace App\Http\Controllers\Base\Auth;

use Illuminate\Http\Request;
use App\Repositories\Modules\Notification\Interfaces;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index(){
        return $this->respondWithSuccess(
            auth('base')->user()->notifications()->paginate()
        );
    }
}
