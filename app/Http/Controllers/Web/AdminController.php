<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2018/8/14
 * Time: 17:41
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function admin(){
        return view('admin');
    }
}