<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsPostRequest;
use App\Models\News;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();

        return response([
            'status' => [
                'code' => Response::HTTP_OK,
                'message' => Response::$statusTexts[Response::HTTP_OK]
            ],
            'data' => $news
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\NewsPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsPostRequest $request)
    {

        $request->validated();

        $news = new News();
        $news->title = $request->title;
        $news->author_name = $request->authorName;
        $news->save();

        return response([
            'status' => [
                'code' => Response::HTTP_CREATED,
                'message' => Response::$statusTexts[Response::HTTP_CREATED]
            ],
            'data' => $news
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
        $news = News::find($id);
        if (!$news) {
            throw new NotFoundHttpException();
        }

        $news->comments = $news->comments;

        return response([
            'status' => [
                'code' => Response::HTTP_OK, 'message' => Response::$statusTexts[Response::HTTP_OK]
            ],
            'data' => $news
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\NewsPostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsPostRequest $request, $id)
    {
        $request->validated();

        $news = News::find($id);
        if (!$news) {
            throw new NotFoundHttpException();
        }
        $news->title = $request->title;
        $news->author_name = $request->authorName;
        $news->save();

        return response([
            'status' => [
                'code' => Response::HTTP_OK,
                'message' => Response::$statusTexts[Response::HTTP_OK]
            ],
            'data' => $news
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
        $news = News::find($id);
        if (!$news) {
            throw new NotFoundHttpException();
        }

        $news->delete();

        return response([
            'status' => [
                'code' => Response::HTTP_OK,
                'message' => Response::$statusTexts[Response::HTTP_OK]
            ]
        ], Response::HTTP_OK);
    }

    /**
     * Upvote a news.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upvote($id)
    {
        $news = News::find($id);
        if (!$news) {
            throw new NotFoundHttpException();
        }

        $news->upvote += 1;
        $news->save();

        return response([
            'status' => [
                'code' => Response::HTTP_ACCEPTED,
                'message' => Response::$statusTexts[Response::HTTP_ACCEPTED]
            ],
            'data' => $news
        ], Response::HTTP_ACCEPTED);
    }
}
