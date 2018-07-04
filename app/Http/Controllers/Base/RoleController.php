<?php

namespace App\Http\Controllers\Base;

use App\Http\Requests\Base\Role\DestroyRequest;
use App\Http\Requests\Base\Role\StoreRequest;
use App\Http\Requests\Base\Role\UpdateRequest;
use App\Searchs\Modules\Base\Role\IndexSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Modules\BaseRole\Interfaces;
use Validator;

class RoleController extends Controller
{
    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 系统角色列表
     * @method index
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function index(Request $request)
    {
        $search = new IndexSearch($request->all());

        return $this->respondWithSuccess(
            $this->repo->scope(['hideSuper'])->withCount(['users'])->paginate(
                $search->toArray(),
                20,
                ['id', 'name', 'status']
            )
        );
    }

    /**
     * 全部的角色用于select
     * @method select
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function select(Request $request)
    {
        $search = new IndexSearch($request->all());

        return $this->respondWithSuccess(
            $this->repo->scope(['hideSuper'])->getWhere(
                $search->toArray(),
                ['id', 'name', 'status']
            )
        );
    }

    /**
     * 新增角色
     * @method store
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function store(StoreRequest $request)
    {
        return $this->respondWithSuccess(
            $this->repo->create($request->only(['name', 'status', 'description']))
        );
    }

    /**
     * 获取单个角色
     * @method show
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function show(Request $request, $id)
    {
        return $this->respondWithSuccess($this->repo->find($id, ['id', 'name', 'status', 'description']));
    }

    /**
     * 更新角色
     * @method store
     * @param UpdateRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->respondWithSuccess(
            $this->repo->update(
                $request->role(),
                $request->only(['name', 'status', 'description'])
            )
        );
    }

    /**
     * 删除
     * @method destroy
     * @param DestroyRequest $request
     * @param $id
     *
     * @author luffyzhao@vip.126.com
     */
    public function destroy(DestroyRequest $request, $id)
    {
        $valid = $this->repo->delete(
            $request->role()
        );

        if ($valid) {
            $this->respondWithSuccess('删除成功');
        } else {
            $this->respondWithError('删除失败');
        }
    }
}
