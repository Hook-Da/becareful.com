<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
//use App\Comment;
use Session;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //create a variable and store all the blog posts in it from database
        $posts=Post::orderBy('id','desc')->paginate(3);
        //return a view and pass in the aboe variable
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $cats = [];
        foreach($categories as $category)
        {
            $cats[$category->id] = $category->name;
        }
        $ctags = Tag::all();
        $tags = [];
        foreach($ctags as $ctag)
        {
            $tags[$ctag->id] = $ctag->name;
        }
        return view('posts.create')->withCategories($cats)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request,array(
            'title'             =>'required|max:255',
            'slug'              =>'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body'              =>'required',
            'featured_image'    =>'sometimes|image'
            ));
        $post = new Post;
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->slug = $request->slug;
        $post->body = Purifier::clean($request->body);
        if($request->hasFile('featured_image')){
            $image = $request->file('featured_image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
        Image::make($image)->resize(800,400)->save($location);
        $post->image = $filename;
        }

        $post->save();

        $post->tags()->sync($request->tags,false);
        Session::flash('success','The blog post was successfully saved');

        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        //$comment = Comment::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the post in the database and save as a var
        $categories = Category::all();
        $cats = [];
        foreach($categories as $category){
            $cats[$category->id]=$category->name;}
        
        $post = Post::find($id);
        $ctags = Tag::all();
        $tags = [];
        foreach($ctags as $ctag)
        {
            $tags[$ctag->id] = $ctag->name;
        }

        //return the view and pass in the var we previously created
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        //Validate the data
        /*if($request->slug == $post->slug){
        $this->validate($request,array(
            'title' =>'required|max:255',
            //'slug'  =>'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body'  =>'required'
            )); }
        //Save the data to the database
        else{*/
            $this->validate($request,array(
            'title' =>'required|max:255',
            'slug'  =>"required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'body'  =>'required',
            'featured_image' => 'image'
            ));
        
        

        $post->title        = $request->title;
        $post->slug         = $request->slug;
        $post->body         = Purifier::clean($request->body);
        $post->category_id  = $request->category_id;

        if($request->hasFile('featured_image')){
            //add the new photo
            $image = $request->file('featured_image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(800,400)->save($location);
            
            $oldFilename = $post->image;
            //updatae the database
            $post->image = $filename;
            //Delete the old photo
            Storage::delete($oldFilename);
        }

        $post->save();
        $post->tags()->sync($request->tags);
        //set flash data with success message
        Session::flash('success','This post was successfully saved');
        //redirect with flash data to posts.show
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        $post->delete();
        Session::flash('success','Post was successfully deleted');
        return redirect()->route('posts.index');
    }
}
