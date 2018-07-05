<?php

namespace App\Http\Controllers\Base;

use App\Http\Requests\Base\Permission\StoreRequest;
use App\Http\Requests\Base\Permission\UpdateRequest;
use App\Http\Requests\Base\Permission\DestroyRequest;
use App\Model\BasePermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Modules\BasePermission\Interfaces;
use App\Searchs\Modules\Base\Permission\IndexSearch;
use Validator;

class PermissionController extends Controller
{
    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    /**
     * 获取所有权限
     * @method index
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function index(Request $request)
    {
        $search = new IndexSearch(
            $request->only(['islink'])
        );

        return $this->respondWithSuccess(
            $this->repo->getWhere(
                $search->toArray(),
                ['id', 'parent_id', 'name', 'icon', 'islink', 'display_name as title', 'sort']
            )
        );
    }

    /**
     * 新增权限
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
            $this->repo->create($request->only(['parent_id', 'name', 'icon', 'islink', 'display_name', 'description', 'sort']))
        );
    }

    /**
     * 获取单个权限
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
        return $this->respondWithSuccess(
            $this->repo->find($id, ['id', 'parent_id', 'name', 'icon', 'islink', 'display_name', 'description', 'sort'])
        );
    }

    /**
     * 更新
     * @method update
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
            $this->repo->updateOrCreate(
                ['id' => $id],
                $request->only(['parent_id', 'name', 'icon', 'islink', 'display_name', 'description', 'sort'])
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
            BasePermission::find($id)
        );

        if ($valid) {
            $this->respondWithSuccess('删除成功');
        } else {
            $this->respondWithError('删除失败');
        }
    }
}
