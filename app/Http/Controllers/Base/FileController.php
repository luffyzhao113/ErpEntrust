<?php
/**
 * luffy-restaurant-order
 * FileController.php.
 * @author luffyzhao@vip.126.com
 */

namespace App\Http\Controllers\Base;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * 文件上传
     * @method store
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author luffyzhao@vip.126.com
     */
    public function store(Request $request)
    {
//        $file = $request->file('file');
//        $path = $file->getClientOriginalExtension() . date('/Y/m-d');
//        $filename = Storage::putFile($path, $file);
//        return $this->respondWithSuccess([
//            'url' => Storage::url($filename)
//        ]);

        return $this->respondWithSuccess([
            'url' => 'https://lorempixel.com/400/400/'
        ]);
    }
}