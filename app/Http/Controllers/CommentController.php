<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        DB::table('comments')->insert([
            'article_id' => $request->article_id,
            'user_id' => \Auth::user()->id,
            'body' => $request->body,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Comment  $comment
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        if (\Auth::user()->id !== $comment->user_id) {
            return redirect()->back()->with('message', trans('catalog.dontAccessOperation'));
        }

        if (Carbon::now()->diffInMinutes($comment->created_at) > 5) {
            return redirect()->back()->with('message', trans('catalog.timeExpired'));
        }

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Comment  $comment
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->body = $request->body;
        $comment->save();

        return redirect()->route('articles.show', ['article' => $comment->article->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comment  $comment
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
