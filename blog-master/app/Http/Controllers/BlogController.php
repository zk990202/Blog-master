<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class BlogController extends Controller
{

    function __construct()
    {

        $this->middleware('auth');
    }

    //view all blogs
    public function AllBlog()
    {
        $min = DB::table('blog')->min('id');
        $max = DB::table('blog')->max('id');
        $AllBlog = DB::table('blog')->whereBetween('id', [$min, $max])->orderBy('id', 'desc')->paginate(5);
        $user = Auth::user();
        $uid = $user->id;
        return view('Blog.AllBlog', ['AllBlog' => $AllBlog, 'uid' => $uid]);
    }

    //add a post
    public function add(Request $request) {
        $title = $request->input('title');
        $content = $request->input('content');
        $user = Auth::user();
        $date = date('Y-m-d H:i:s', time()+8*60*60);
        DB::insert('insert into blog (title, content, uid, name, created_at, updated_at)
          VALUES (?,?,?,?,?,?)', [$title, $content, $user->id, $user->name,$date, $date]);

        return redirect()->route('All');
    }


    //get a post
    public function get($id)
    {
        $user = Auth::user();
        $uid = $user->id;
        $is_admin = $user->is_admin;
        $blog = DB::table('blog')->where('id', $id)->get();
        $comment = DB::table('comment')->where('bid', $id)->get();
        return view('Blog.BlogView', ['blog' => $blog, 'comment' => $comment, 'uid' => $uid,'is_admin' => $is_admin]);
    }

    public function update(Request $request, $id) {
        $user = Auth::user();
        $title = $request->input('title');
        $content = $request->input('content');
        $date = date('Y-m-d H:i:s', time()+8*60*60);
        DB::update('update blog set title = ?, content = ? , updated_at = ? where id = ?' ,
            [$title, $content, $date, $id]);
//        return view('Blog.UpdateSuccess', ['id' => $id]);
        return redirect()->route('A_blog',['id'=>$id]);
    }

    public function delete($id){
        $user = Auth::user();
        $uid = $user->id;
        DB::delete('delete from blog where id = ?' , [$id]);
        DB::delete('delete from comment where bid = ?', [$id]);
        return redirect()->route('All');
    }

    //Comment:
    public function CommentAdd(Request $request, $bid)
    {

        $user = Auth::user();
        $comment = $request->input('comment');
        $date = date('Y-m-d H:i:s', time()+8*60*60);
        DB::insert('insert into comment (bid, uid, name, comment, created_at, updated_at) 
            VALUE (?, ?, ?, ?, ?, ?)',
            [$bid, $user->id, $user->name, $comment, $date, $date]);
//        return view('Comment.AddSuccess', ['is' => 'is_success', 'bid' => $bid]);
//        $url = Request::all();
        return redirect()->route('A_blog',['bid'=>$bid]);
    }

    public function CommentUpdate(Request $request, $bid, $id)
    {
        $comment = $request->input('comment');
        $date = date('Y-m-d H:i:s', time()+8*60*60);
        DB::update('update comment set comment = ?, updated_at = ? where id = ?' ,
            [$comment, $date, $id]);
//        return view('Comment.UpdateSuccess' ,['bid' => $bid]);
        return redirect()->route('A_blog',['id'=>$bid]);
    }

    public function CommentDelete($bid, $id)
    {
        $user = Auth::user();
        $uid = $user->id;
        DB::delete('delete from comment where id = ?' , [$id,]);
//        return view('Comment.DeleteSuccess', ['bid' => $bid]);
        return redirect()->route('A_blog',['id'=>$bid]);
    }
}
