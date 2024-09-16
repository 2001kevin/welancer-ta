<?php

namespace App\Http\Controllers;

use App\Models\CommentProject;
use Illuminate\Http\Request;

class CommentProjectController extends Controller
{
    public function comment(Request $request, $id)
    {

        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $comment = new CommentProject();
            $comment->senderUser_id = $user_id;
            $comment->senderPegawai_id = null;
            $comment->project_id = $id;
            $comment->comment = $request->comment;
            $success = $comment->save();
            if ($success) {
                toast('Comment Added Successfully', 'success');
                return redirect()->back();
            }
        } else {
            $pegawai_id = auth()->guard('pegawai')->id();
            $comment = new CommentProject();
            $comment->senderUser_id = null;
            $comment->senderPegawai_id = $pegawai_id;
            $comment->project_id = $id;
            $comment->comment = $request->comment;
            $success = $comment->save();
            if ($success) {
                toast('Comment Added Successfully', 'success');
                return redirect()->back();
            }

        }
    }
}
