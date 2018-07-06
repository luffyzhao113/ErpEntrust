<?php

namespace App\Http\Controllers\Base\Auth;

use App\Searchs\Modules\Base\Auth\MessageSearch;
use Illuminate\Http\Request;
use App\Repositories\Modules\Notification\Interfaces;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    /**
     * 获取邮件列表
     * @method index
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function index(Request $request){
        $search = new MessageSearch($request->all());
        return $this->respondWithSuccess(
            auth('base')->user()->notifications()->where($search->toArray())->paginate()
        );
    }

    /**
     * 获取邮件内容
     * @method show
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function update(Request $request, $id){

        $notification = auth('base')->user()->notifications()->where('id', '=', $id)->first();
        if($notification && is_null($notification->read_at)){
            $notification->markAsRead();
        }
        return $this->respondWithSuccess([]);
    }

    /**
     * 获取未读数量
     * @method notRead
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function notRead(Request $request){
        return $this->respondWithSuccess([
            'count' => auth('base')->user()->notifications()->whereNull('read_at')->count()
        ]);
    }
}
