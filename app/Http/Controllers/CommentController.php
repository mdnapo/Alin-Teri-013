<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller {
    /**
     * Show the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function comments($publication_id = null) {
        $comments =  App\Comment::getAcceptedComments((int) $publication_id);
        return view('pages.commentpage', ['id' => $publication_id, 'comments' => $comments]);
    }

    public function comment(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'comment' => 'string|required'
        ]);

        if ($validator->fails()) {
            return back()->
            withErrors($validator->errors())->
            withInput();
        } else {
            $comment = new App\Comment();
            $comment->media_id = $request->media_id;
            $comment->naam = $request->name;
            $comment->reactie = $request->comment;
            $comment->save();
            return back();
        }
    }
}