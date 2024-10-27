<?php

namespace App\Http\Controllers;

use App\Models\ListCategory;
use Illuminate\Http\Request;

class ListCategoryController extends Controller
{
    public function index()
    {
        $listcategories = ListCategory::with('categories')->get();
        return view('home', compact('listcategories'));
    }
}
