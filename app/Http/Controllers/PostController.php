<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class PostController extends Controller {

    public function getIndex() {
        $post = resolve('App\Post');
        $posts = $post->getPosts();
        return view('blog.index', ['posts' => $posts]);
    }
     public function getAdminIndex() {
        $post = resolve('App\Post');
        $posts = $post->getPosts();
        return view('admin.index', ['posts' => $posts]);
     }

     public function getPost($id) {
        $post = resolve('App\Post');
        $post = $post->getPost('$id');
        return view('blog.post', ['post' => $post]);
     }

    public function getAdminCreate() {
        return view('admin.create');
    }

    public function getAdminEdit($id) {
        $post = resolve ('App\Post');
        $post = $post->getPost ($id);
        return view('admin.edit', ['post' => $post , 'postId' => $id]);
    }

    /*** @throws ValidationException */
    public function postAdminCreate(Request $request): RedirectResponse {
        $this->validate($request, [
            'title'   => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = resolve('App\Post');
        $post->addPost(
            $request->input('title'),
            $request->input('content')
        );
        return redirect()
            ->route('admin.index')
            ->with('info', 'Post created, Title is: ' . $request->input('title'));
    }

    /*** @throws ValidationException */
    public function postAdminUpdate(Request $request): RedirectResponse {
        $this->validate($request, [
            'title'   => 'required|min:5',
            'content' => 'required|min:10'
        ]);
        $post = resolve('App\Post');
        $post->editPost(
            $request->input('id'),
            $request->input('title'),
            $request->input('content')
        );
        return redirect()
            ->route('admin.index')
            ->with('info', 'Post edited, new Title is: ' . $request->input('title'));
    }

}
