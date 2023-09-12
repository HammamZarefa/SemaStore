<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsTickerController extends Controller
{
    public function addNews(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'link' => 'required|url',
        ]);

        $news = News::create($validatedData);

        return response()->json($news, 201);
    }

    public function editNews(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'link' => 'required|url',
        ]);

        $news = News::findOrFail($id);
        $news->update($validatedData);

        return response()->json($news, 200);
    }

    public function deleteNews($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return response()->json(null, 204);
    }

    public function previewNews($id)
    {
        $news = News::findOrFail($id);

        return response()->json($news, 200);
    }
}
