<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function StoreComment(Request $request)
    {

        $pid = $request->post_id;
        // dd($pid);
        Comment::insert([
            'user_id' => Auth::user()->id,
            'post_id' => $pid,
            'parent_id' => null,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);

        return redirect()->back()->with('message', 'Comment added Successfully')
            ->with('alert-type', 'success');
    }

    public function AdminBlogComment()
    {
        $comment = Comment::where('parent_id', null)->latest()->get();
        return view('backend_admin.comment.comment_all', compact('comment'));
    }


    public function AdminCommentReply($id)
    {

        $comment = Comment::where('id', $id)->first();
        return view('backend_admin.comment.reply_comment', compact('comment'));
    }

    public function ReplyMessage(Request $request)
    {
        $id = $request->id;
        $user_id = $request->user_id;
        $post_id = $request->post_id;
        // dd($id);
        Comment::insert([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'parent_id' => $id,//id elcomment tab3 el user
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);
        return redirect()->back()->with('message', 'Reply Comment added Successfully')
            ->with('alert-type', 'success');
    }
}
