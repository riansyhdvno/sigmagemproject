<?php

namespace App\Http\Controllers;

use App\Models\ListCategory;
use Illuminate\Http\Request;

class ListCategoryController extends Controller
{
    //
    public function index()
    {
        $categories = ListCategory::all();
        return view('home', compact('categories'));
    }
}
