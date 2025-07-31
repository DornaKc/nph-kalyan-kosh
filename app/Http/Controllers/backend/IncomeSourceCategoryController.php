<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\IncomeSourceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IncomeSourceCategoryController extends Controller
{
    public function index()
    {
        $categories = IncomeSourceCategory::where('is_deleted', false)->get();
        return view('backend.income-source-category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.income-source-category.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_name' => 'required',
            ]);

            $category = new IncomeSourceCategory();
            $category->category_name = $request->category_name;
            $category->slug = Str::slug($request->category_name);

            return redirect()->route('income-source-category.index')->with('status', 'वर्ग सफलतापूर्वक सुरक्षित गरियो।');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function show($slug)
    {
        //
    }

    public function edit($slug)
    {
        $category = IncomeSourceCategory::where('slug', $slug)->first();
        return view('backend.income-source-category.edit', compact('category'));
    }

    public function update(Request $request, $slug)
    {
        try {
        $category = IncomeSourceCategory::where('slug', $slug)->first();

        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->category_name);

        return redirect()->route('income-source-category.index')->with('status', 'वर्ग सफलतापूर्वक सुरक्षित गरियो।');
        } catch (\Exception $e) {

        }
    }

    public function destroy($slug)
    {
        //
    }
}
