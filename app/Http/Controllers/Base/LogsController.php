<?php
/**
 * Created by PhpStorm.
 * User: luffyzhao
 * Date: 2018/7/3
 * Time: 21:46
 */

namespace App\Http\Controllers\Base;


use App\Http\Controllers\Controller;
use App\Repositories\Modules\BaseLogs\Interfaces;
use App\Searchs\Modules\Base\Logs\IndexSearch;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    protected $repo;

    public function __construct(Interfaces $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request){
        $search = new IndexSearch($request->only([
            'admin_id'
        ]));

        $make = ['admin' => function($query){
            $query->select(['id', 'name']);
        }];

        return $this->respondWithSuccess(
            $this->repo->make($make)->paginate(
                $search->toArray()
            )
        );
    }
}