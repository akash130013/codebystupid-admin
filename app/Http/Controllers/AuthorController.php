<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Http\Request;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if ($request->filled('search')) {
            $authors = Author::search($request->search)->paginate(10);
            // dd($blogs);
        } else {
            $authors = Author::paginate(10);
        }
        // $blogs = Blog::paginate(10);
        return view('author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAuthorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuthorRequest $request)
    {
        Author::create([
            'name' => $request->name,
            'is_active' => 1,
            'profile_image_url' => $request->profile_image_url ?? '',
            'created_at' => Carbon::now(),

        ]);
        // 
        return redirect()->route('author')->with('success', 'Author created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author, $id)
    {
        $author = $author->find($id);
        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuthorRequest  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthorRequest $request, Author $author, $id)
    {
        $author::where('id', $id)->update([
            'name' => $request->name,
            'is_active' => $request->is_active ? 1 : 0,
            'profile_image_url' => $request->profile_image_url ?? '',
            'updated_at' => Carbon::now()
        ]);
        return redirect()->route('author')->with('success', 'Author updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        //
    }
}
