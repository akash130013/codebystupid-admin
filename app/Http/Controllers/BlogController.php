<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use Carbon\Carbon;

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
            $blogs = Blog::search($request->search)
                ->query(function ($query) {
                    return $query->notDeleted()->orderBy('created_at', 'desc');
                })
                ->simplePaginate(PAGINATE);
        } else {
            $blogs = Blog::with(['author', 'category'])->notDeleted()->orderBy('created_at', 'desc')->simplePaginate(PAGINATE);
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
        $category = Category::all();
        $duration = DURATION;
        return view('blog.create', compact(['authors', 'category', 'duration']));
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
            'is_enable' => $request->is_enable ? ACTIVE : INACTIVE,
            'author_id' => $request->author_id,
            'img_name' => $imageName,
            'thumb_img_url' => $imageName,
            'status' => ACTIVE,
            'category_id' => $request->category_id,
            'duration' => $request->duration
        ];

        Blog::create($blogArr);
        return redirect()->route('blogs')->with('success', 'Blog created successfully');
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
        $blog = $blog::with(['author', 'category'])->find($id);
        $authors = Author::all();
        $category = Category::all();
        $duration = DURATION;
        return view('blog.edit', compact('blog', 'authors', 'category', 'duration'));
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
            'category_id' => $request->category_id,
            'duration' => $request->duration,
            'updated_at' => Carbon::now(),
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
