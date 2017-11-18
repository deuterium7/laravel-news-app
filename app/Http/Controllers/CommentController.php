<?php

namespace App\Http\Controllers;

use App\Contracts\CommentInterface;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    protected $comments;

    /**
     * CommentController constructor.
     *
     * @param CommentInterface $comments
     */
    public function __construct(CommentInterface $comments)
    {
        $this->comments = $comments;
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
        $this->comments->create($request->all());

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
        $this->authorize('edit', $comment);

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
        $this->comments->update($comment->id, $request->all());

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
        $this->comments->delete($id);

        return redirect()->back();
    }
}
