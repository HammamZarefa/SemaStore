<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use HammamZarefa\RapidRanker\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        $page_title = "الشرائح";
        return view('admin.levels.index', compact('page_title', 'levels'));
    }
}
