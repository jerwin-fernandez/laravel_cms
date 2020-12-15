<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Photo;

use Illuminate\Support\Facades\Session;

class AdminMediaController extends Controller
{
    public function index() {

        $photos = Photo::all();

        return view('admin.media.index', [
            'photos' => $photos
        ]);
    }

    public function create() {
        return view('admin.media.create');
    }

    public function store(Request $request) {
        $file = $request->file('file');

        $name = time() . $file->getClientOriginalName();

        $photo = Photo::create([
            'file' => $name
        ]);

        if($photo) {
            $file->move(trim(Photo::$photo_dir, '/'), $name);
        }

        

        return redirect('/admin/media');

    }
  
    public function destroy($id) {
        $photo = Photo::find($id);

        if($photo) {
            unlink(public_path() . $photo->file);
        }

        if($photo->delete()) {
            Session::flash('deleted_media', 'Photo has been deleted');
        }

        return redirect('/admin/media');
    }
}
