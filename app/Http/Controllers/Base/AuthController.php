<?php
/**
 * Created by PhpStorm.
 * User: luffyzhao
 * Date: 2018/6/30
 * Time: 17:25
 */

namespace App\Http\Controllers\Base;


use App\Http\Controllers\Controller;
use App\Http\Requests\Base\Auth\LockRequest;
use App\Http\Requests\Base\Auth\PhotoRequest;
use App\Http\Requests\Base\Auth\StoreRequest;
use App\Http\Requests\Base\Auth\UserRequest;
use App\Notifications\Welcome;
use App\Repositories\Modules\BaseAdmin\Interfaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Modules\BaseLogs\Interfaces as BaseLogsInterfaces;

class AuthController extends Controller
{
    /**
     * 获取登录人员信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->respondWithSuccess(
            auth('base')->user()
        );
    }

    /**
     * 登录
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $token = auth('base')->attempt(
            $request->only(
                [
                    'email',
                    'password',
                ]
            )
        );

        if (!$token) {
            return $this->respondWithError('用户不存在,或者密码不正确！');
        }
        // 登录通知
        auth('base')->user()->notify(new Welcome(auth('base')->user()));

        return $this->respondWithSuccess(
            [
                'token' => $token->get(),
            ]
        );
    }

    /**
     * 更新
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        return $this->respondWithSuccess(
            [
                'token' => auth('base')->refresh()->get(),
            ]
        );
    }

    /**
     * 退出登录
     */
    public function destroy()
    {
        auth('base')->logout();

        return $this->respondWithSuccess([]);
    }

    /**
     * 用户菜单&权限
     * @method permission
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function permission()
    {
        return $this->respondWithSuccess(
            auth('base')->user()->cachedRole()->cachedPermissions()
        );
    }

    /**
     * 更新用户
     * @method user
     * @param UserRequest $request
     * @param Interfaces $repo
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function user(UserRequest $request, Interfaces $repo)
    {
        return $this->respondWithSuccess(
            $repo->update(
                auth('base')->user(),
                $request->only(['name', 'password', 'email'])
            )
        );
    }

    /**
     * 上传头像
     * @method photo
     * @param PhotoRequest $request
     * @param Interfaces $repo
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function photo(PhotoRequest $request, Interfaces $repo)
    {
        return $this->respondWithSuccess(
            $repo->update(
                auth('base')->user(),
                $request->only(['photo'])
            )
        );
    }

    /**
     * 验证密码
     * @method lock
     * @param LockRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function lock(LockRequest $request)
    {
        if (!Hash::check($request->input('password'), $request->user()->password)) {
            return $this->respondWithError('密码错误！');
        } else {
            return $this->respondWithSuccess([]);
        }
    }

    /**
     * 获取登录用户操作日志
     * @method logs
     * @param BaseLogsInterfaces $repo
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function logs(BaseLogsInterfaces $repo)
    {
        $make = ['admin' => function($query){
            $query->select(['id', 'name']);
        }];

        return $this->respondWithSuccess(
            $repo->make($make)->limit(
                [
                    ['admin_id', '=', auth('base')->user()->id],
                ],
                10
            )
        );
    }
}