<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller {
    /**
     * Show commentspage.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function comments($publication_id = null) {
        $comments =  App\Comment::where(['publication_id' => $publication_id, 'geaccepteerd' => 1])->paginate(10);
        return view('pages.commentpage', ['id' => $publication_id, 'comments' => $comments]);
    }

    /**
     * Inserts a comment into the database.
     * @return \Illuminate\Http\RedirectResponse
     */
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
            $comment->publication_id = $request->publication_id;
            $comment->naam = $request->name;
            $comment->reactie = $request->comment;
            $comment->save();
            return back();
        }
    }
}
