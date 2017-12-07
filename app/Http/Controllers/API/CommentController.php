<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\Comment as CommentContract;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * @var CommentContract
     */
    protected $comments;

    /**
     * CommentController constructor.
     *
     * @param CommentContract $comments
     */
    public function __construct(CommentContract $comments)
    {
        $this->comments = $comments;
    }

    /**
     * Получить все комментарии администратора.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function commentsAdmin()
    {
        return $this->comments->getCommentsAdmin();
    }

    /**
     * Получить все комментарии клиента.
     *
     * @param $id
     * @param string $model === 'article'|'user'
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function commentsClient($id, $model)
    {
        return $this->comments->getCommentsClient($id, $model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     *
     * @return \App\Contracts\Model
     */
    public function store(CommentRequest $request)
    {
        return $this->comments->create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param CommentRequest $request
     *
     * @return \App\Contracts\Model
     */
    public function update($id, CommentRequest $request)
    {
        $this->comments->update($id, $request->all());

        return response()->json([
            'message' => 'Comment updated successfully!'
        ], 200);
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