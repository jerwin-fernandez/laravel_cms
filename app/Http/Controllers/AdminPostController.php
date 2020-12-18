<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\PostCreateRequest;

use App\Post;

use App\Photo;

use App\Category;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

class AdminPostController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $posts = Post::all();

      return view('admin.posts.index', [
      'posts' => $posts,
      ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $categories = Category::pluck('name', 'id');
   
    $categories->prepend('Choose Category', '');

    return view('admin.posts.create', [
      'categories' => $categories,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(PostCreateRequest $request)
  {
    $user = Auth::user();

    $input = $request->all();

    if($file = $request->file('photo_id') ){
      $name = time() . $file->getClientOriginalName();

      $file->move(trim(Photo::$photo_dir, '/'), $name);

      $photo = Photo::create(['file' => $name]);

      $input['photo_id'] = $photo->id;
    }
    
    $user->posts()->create($input);

    Session::flash('created_post', "Post {$request->title} has been posted");

    return redirect('/admin/posts');

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

    $post = Post::find($id);

    $categories = Category::pluck('name', 'id');
  
    $categories->prepend('Choose Category', '');
    
    return view('admin.posts.edit', [
      'post' => $post,
      'categories' => $categories
    ]);
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
    $this->validate($request, [
      'title' => 'required|unique:posts,title,'.$id,
    ]);

    $input = $request->all();

    if($file = $request->file('photo_id')) {
      $name = time() . $file->getClientOriginalName();

      $file->move(trim(Photo::$photo_dir, '/'), $name);

      $photo = Photo::create(['file' => $name]);

      $input['photo_id'] = $photo->id;
    }

    Post::whereId($id)->first()->update($input);

    Session::flash('updated_post', "Post {$request->title} has been updated");

    return redirect('/admin/posts');

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $post = Post::findOrFail($id);

      if($post) {
        if($post->photo) {
          unlink(public_path() . $post->photo->file);
        }

        $post->photo()->delete();
  
        $post->delete();

        Session::flash('updated_post', "Post has been deleted");

      }
      
      return redirect('/admin/posts');
  }

  public function post($id) {
    $post = Post::findOrFail($id);

    return view('post', ['post' => $post]);
  }
}
