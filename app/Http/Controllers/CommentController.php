<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class CommentController extends Controller
{
    /**
     * Show commentspage.
     * @param int $publication_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function comments($publication_id = null)
    {
        $comments = App\Comment::where(['publication_id' => $publication_id, 'geaccepteerd' => 1])->paginate(10);
        return view('pages.commentpage', ['id' => $publication_id, 'comments' => $comments]);
    }

    /**
     * Inserts a comment into the database.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment(Request $request)
    {
        $messages = array(
            'required' => 'Het veld :attribute is verplicht!'
        );
        $validator = Validator::make($request->all(), [
            'naam' => 'string|required',
            'bericht' => 'string|required'
        ], $messages);

        if ($validator->fails()) {
            $view = View::make('subviews.comment-failure', ['errors' => $validator->errors()]);
            $data['html'] = $view->render();
            $data['success'] = 'false';
            echo json_encode($data);
        } else {
            $comment = new App\Comment();
            $comment->publication_id = $request->publication_id;
            $comment->naam = $request->naam;
            $comment->reactie = $request->bericht;
            $comment->save();
            $view = View::make('subviews.comment-succes');
            $data['html'] = $view->render();
            $data['success'] = 'true';
            echo json_encode($data);
        }
    }
}
