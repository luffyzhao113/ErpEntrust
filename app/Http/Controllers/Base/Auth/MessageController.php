<?php

namespace App\Http\Controllers\Base\Auth;

use App\Searchs\Modules\Base\Auth\MessageSearch;
use Illuminate\Http\Request;
use App\Repositories\Modules\Notification\Interfaces;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index(Request $request){
        $search = new MessageSearch($request->all());
        return $this->respondWithSuccess(
            auth('base')->user()->notifications()->where($search->toArray())->paginate()
        );
    }
}
