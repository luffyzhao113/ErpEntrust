<?php
/**
 * luffy-restaurant-order
 * PermissionController.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Http\Controllers\Base\Role;


use App\Http\Controllers\Controller;
use App\Http\Requests\Base\Role\PermissionUpdateRequest;
use App\Model\BaseRole;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * 角色关联的权限
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $id){
        return $this->respondWithSuccess(
            BaseRole::with('perms')->find($id)
        );
    }

    /**
     * 给角色分配权限
     * @param PermissionUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PermissionUpdateRequest $request, $id){
        $valid = BaseRole::find($id)->perms()->sync($request->input('permission'));
        if($valid){
            return $this->respondWithSuccess([], '分配成功');
        }else{
            return $this->respondWithError('分配失败');
        }
    }
}