<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Repositories\Contracts\CommentInterface;
use Illuminate\Support\Carbon;

class CommentController extends Controller
{
    protected $comment;

    /**
     * CommentController constructor.
     *
     * @param CommentInterface $comment
     */
    public function __construct(CommentInterface $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentRequest $request)
    {
        $this->comment->create($request->all());

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
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
     * @param CommentRequest $request
     * @param Comment        $comment
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $this->comment->update($comment->id, $request->all());

        return redirect()->route('articles.show', ['article' => $comment->article->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->comment->delete($id);

        return redirect()->back();
    }
}
