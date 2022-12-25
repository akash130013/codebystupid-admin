<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Blog;
use App\Models\Category;
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
                case 'author':

                    Author::find($request->id)->update(['is_active' => $request->status]);

                    return response(['code' =>  HTTP_OK, 'msg' => 'successfully done']);

                case 'category':

                    Category::find($request->id)->update(['status' => $request->status]);

                    return response(['code' =>  HTTP_OK, 'msg' => 'successfully done']);
                default:
                    # code...
                    break;
            }
        } catch (\Throwable $th) {
            return response(['code' => HTTP_NOT_FOUND, 'msg' => 'something went wrong!!']);
        }
    }

    public function storeImage(Request $request)
    {
        try {
            //code...
            if ($request->hasFile('upload')) {
                $originName = $request->file('upload')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('upload')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;

                $request->file('upload')->move(public_path('media'), $fileName);

                $url = asset('media/' . $fileName);
                return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
            }
        } catch (\Throwable $th) {
            return response()->json(['code' => HTTP_INTERNAL_SERVER, 'msg' => $th->getMessage()]);
        }
    }
}
