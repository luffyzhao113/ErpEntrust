<?php
/**
 * Created by PhpStorm.
 * User: luffyzhao
 * Date: 2018/6/26
 * Time: 20:30
 */

namespace App\Http\Controllers\Base;


use App\Http\Controllers\Controller;
use App\Http\Requests\Base\Admin\StoreRequest;
use App\Http\Requests\Base\Admin\UpdateRequest;
use App\Model\BaseAdmin;
use App\Repositories\Modules\BaseAdmin\Interfaces;
use App\Searchs\Modules\Base\Admin\IndexSearch;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 用户管理
     * @method index
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function index(Request $request){
        $search = new IndexSearch($request->all());

        $make = ['roles' => function($query){
            $query->select(['id', 'name', 'super']);
        }];
        
        return $this->respondWithSuccess(
            $this->repo->make($make)->paginate(
                $search->toArray(),
                20,
                ['id', 'email', 'status', 'role_id', 'name']
            )
        );
    }

    /**
     * 所有用户用于select
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \luffyzhao\laravelTools\Searchs\Exceptions\SearchException
     */
    public function select(Request $request){
        $search = new IndexSearch($request->only(['status']));
        return $this->respondWithSuccess(
            $this->repo->getWhere(
                $search->toArray(),
                ['id', 'name', 'email']
            )
        );
    }

    /**
     * 添加用户
     * @method store
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function store(StoreRequest $request){
        return $this->respondWithSuccess(
            $this->repo->create($request->only(['name', 'password', 'status', 'role_id', 'email']))
        );
    }

    /**
     * 获取单个用户信息
     * @method show
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function show(Request $request, $id){
        return $this->respondWithSuccess(
            $this->repo->find($id)
        );
    }

    /**
     * 更新用户
     * @method update
     * @param UpdateRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function update(UpdateRequest $request, $id){
        return $this->respondWithSuccess(
            $this->repo->update(
                $request->admin(),
                $request->only(['name', 'password', 'status', 'role_id', 'email'])
            )
        );
    }

    /**
     * 删除
     * @method destroy
     * @param $id
     *
     * @author luffyzhao@vip.126.com
     */
    public function destroy($id){
        $valid = $this->repo->delete(
            BaseAdmin::find($id)
        );
        if ($valid) {
            $this->respondWithSuccess([], '删除成功');
        } else {
            $this->respondWithError('删除失败');
        }
    }
}