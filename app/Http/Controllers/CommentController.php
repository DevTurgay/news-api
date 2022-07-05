<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentPostRequest;
use App\Http\Requests\CommentPutRequest;
use App\Models\Comment;
use App\Models\News;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentController extends Controller
{
    /**
     * Display a listing of the comments of a news.
     *
     * @return \Illuminate\Http\Response
     */
    public function allByNews($id)
    {
        $comments = Comment::where('news_id', $id)->get();

        return response([
            'status' => [
                'code' => Response::HTTP_OK,
                'message' => Response::$statusTexts[Response::HTTP_OK]
            ],
            'data' => $comments
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CommentPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentPostRequest $request)
    {
        $request->validated();

        // Check if news exists
        $news = News::find($request->newsId);
        if (!$news) {
            throw new NotFoundHttpException();
        }

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->news_id = $request->newsId;
        $comment->author_name = $request->authorName;
        $comment->save();

        return response([
            'status' => [
                'code' => Response::HTTP_CREATED,
                'message' => Response::$statusTexts[Response::HTTP_CREATED]
            ],
            'data' => $comment
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            throw new NotFoundHttpException();
        }
        return response([
            'status' => [
                'code' => Response::HTTP_OK, 'message' => Response::$statusTexts[Response::HTTP_OK]
            ],
            'data' => $comment
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CommentPostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentPutRequest $request, $id)
    {
        $request->validated();

        $comment = Comment::find($id);
        if (!$comment) {
            throw new NotFoundHttpException();
        }
        $comment->content = $request->content;
        $comment->author_name = $request->authorName;
        $comment->save();

        return response([
            'status' => [
                'code' => Response::HTTP_OK,
                'message' => Response::$statusTexts[Response::HTTP_OK]
            ],
            'data' => $comment
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            throw new NotFoundHttpException();
        }

        $comment->delete();

        return response([
            'status' => [
                'code' => Response::HTTP_OK,
                'message' => Response::$statusTexts[Response::HTTP_OK]
            ]
        ], Response::HTTP_OK);
    }
}
