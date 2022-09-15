<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $blogs = Blog::search($request->search)->simplePaginate(10);
        } else {
            $blogs = Blog::with('author')->simplePaginate(10);
        }

        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $authors = Author::all();
        return view('blog.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {

        $imageName = time() . '.' . $request->thumb_img->extension();
        // Public Folder
        $request->thumb_img->move(public_path('images'), $imageName);

        $blogArr = [
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'long_desc' => htmlentities($request->long_desc),
            'is_enable' => $request->is_enable ? 1 : 0,
            'author_id' => $request->author_id,
            'img_name' => $imageName,
            'thumb_img_url' => $imageName,
            'status' => 1
        ];

        Blog::create($blogArr);
        // 
        return redirect()->route('blogs')->with('success', 'Blog created successfully');
        // return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog, $id)
    {
        $blog = $blog::with('author')->find($id);
        $authors = Author::all();
        return view('blog.edit', compact('blog', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog, $id)
    {

        $blogArr = [
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'long_desc' => htmlentities($request->long_desc),
            'is_enable' => $request->is_enable ? 1 : 0,
            'author_id' => $request->author_id,
            // 'img_name' => $imageName,
            // 'thumb_img_url' => $imageName
        ];

        if ($request->hasFile('thumb_img')) {
            $imageName = time() . '.' . $request->thumb_img->extension();
            // Public Folder
            $request->thumb_img->move(public_path('images'), $imageName);
            $blogArr['img_name'] = $imageName;
            $blogArr['thumb_img_url'] = $imageName;
        }
        // dd($blogArr);
        $blog::where('id', $id)->update($blogArr);
        return redirect()->route('blogs')->with('success', 'Blog update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
