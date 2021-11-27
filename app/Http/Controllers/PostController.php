<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $posts = Post::all();
        return view('posts.index')->with(['posts' => $posts]);
    }

    /**
     * @param Post $post
     * @return View
     */
    public function showCurrentPost(Post $post): View
    {
        $commentIds = $post->comments()->where("parent_id", null)->get("id");
        if ($commentIds->isNotEmpty()){
            $result = DB::select("
            with recursive cte (id, post_id, user_id, parent_id, text, created_at, updated_at, deleted_at, path, lvl) as (
              select     id,
                         post_id,
                         user_id,
                         parent_id,
                         text,
                         created_at,
                         updated_at,
                         deleted_at,
                         text as path,
                         0 lvl
              from       comments
              where      id  IN  (".implode(',', $commentIds->pluck('id')->toArray()).")
              union all
              select     p.id,
                         p.post_id,
                         p.user_id,
                         p.parent_id,
                         p.text,
                         p.created_at,
                         p.updated_at,
                         p.deleted_at,
                         CONCAT(cte.path, ' > ', p.text),
                         cte.lvl + 1
              from       comments p
              inner join  cte
                      on p.parent_id = cte.id
            )
            select cte.*, users.name as user_name, users.is_admin as user_is_admin from cte left join users on users.id = cte.user_id
            ORDER BY path;
           ");
            $comments = collect($result)->toArray();
        }else{
            $comments = [];
        }

        $user = Auth::user();
        return view('posts.post')->with(['post' => $post, 'comments' => $comments, 'user' => $user]);
    }
}
