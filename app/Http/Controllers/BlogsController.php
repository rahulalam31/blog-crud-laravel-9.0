<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blogs::with('user', 'comments')->latest()->get();
        // dd($blogs);
        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50|string',
            'content' => 'required|max:1024',
        ]);

        $nb = new Blogs();
        $nb->title = $request->title;
        $nb->content = $request->content;
        $nb->user_id = auth()->user()->id;
        $nb->save();

        return redirect()->route('posts');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function show(Blogs $blogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $userID = auth()->user()->id;
        $data = Blogs::where('id',$id)->firstOrFail();

        abort_if($data && $data->user_id !== $userID, 403);

        return view('blog.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:50|string',
            'content' => 'required|max:1024',
        ]);

        $nb = Blogs::findOrFail($id);
        $nb->title = $request->title;
        $nb->content = $request->content;
        $nb->user_id = auth()->user()->id;
        $nb->update();

        return redirect()->route('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blogs::where('id', $id)->firstOrFail();
        $blog->delete();

        return redirect()->route('posts');

    }
}
