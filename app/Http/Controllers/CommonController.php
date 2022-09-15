<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;


class CommonController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changeStatus(Request $request)
    {

        try {
            //code...
            switch ($request->type) {
                case 'blog':

                    Blog::find($request->id)->update(['status' => $request->status]);

                    return response(['code' =>  HTTP_OK, 'msg' => 'successfully done']);
                    // break;

                default:
                    # code...
                    break;
            }
        } catch (\Throwable $th) {
            return response(['code' => HTTP_NOT_FOUND, 'msg' => 'something went wrong!!']);
        }
    }
}
