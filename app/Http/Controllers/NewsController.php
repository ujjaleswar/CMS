<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $newsItems = News::latest()->take(20)->get();
        return response()->json($newsItems);


    }
    public function showNewsPage()
{
    $blogs = News::all();
    return view('news.index', compact('blogs'));
}
public function indexJson()
{
    $news = News::latest()->get();
    return response()->json($news);
}



 public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $blogs= new News;
        $blogs->title=$request->news_title;
        $blogs->description=$request->news_description;
        // dd( $blogs);
        $blogs->save();
        return redirect()->route('blogs.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Myblog  $myblog
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Myblog  $myblog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogs= News::where('id',$id)->first();
        return view('news.edit',compact('blogs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Myblog  $myblog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $blogs= News::find($id);
        $blogs->title=$request->news_title;
        $blogs->description=$request->news_description;
        // dd( $blogs);

        $blogs->save();
        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Myblog  $myblog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blogs= News::find($id);
        $blogs->delete();
        return redirect()->route('blogs.index');

    }


}
