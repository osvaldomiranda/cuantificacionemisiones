<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
	public function index(Request $request)
    {
    	$declaration_id = $request->input('declaration_id'); 
        $comments = Comment::where('declaration_id', $declaration_id)->get();

        return response()->json($comments);
    }

	public function create(Request $request)
    {

    	$declaration_id = $request->input('declaration_id'); 
    	$comment_text = $request->input('comment'); 
        
    	$comment = new Comment();
    	$comment->comment = $comment_text;
    	$comment->declaration_id = $declaration_id;
    	$comment->user_id = 1;
    	$comment->state   = 'ACTIVO';
    	$comment->save();

    	$comments = Comment::where('declaration_id', $declaration_id)->get();
        return response()->json($comments);
    }

}