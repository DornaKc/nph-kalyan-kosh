<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\IncomeSource;
use App\Models\IncomeSourceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IncomeSourceController extends Controller
{
    public function index()
    {
        $sources = IncomeSource::where('is_deleted', false)->get();
        return view('backend.income-source.index', compact('sources'));
    }

    public function create()
    {
        $sourceCategories = IncomeSourceCategory::all();
        return view('backend.income-source.create', compact('sourceCategories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required',
            ]);

            $category = new IncomeSource();
            $category->category_id = $request->category_id;
            $category->source_name = $request->source_name;
            $category->slug = Str::slug($request->source_name);

            return redirect()->route('income-source.index')->with('status', 'वर्ग सफलतापूर्वक सुरक्षित गरियो।');
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
        $sourceCategories = IncomeSourceCategory::all();
        $category = IncomeSource::where('slug', $slug)->first();
        return view('backend.income-source.edit', compact('sourceCategories','category'));
    }

    public function update(Request $request, $slug)
    {
        try {
        $category = IncomeSource::where('slug', $slug)->first();

        $category->category_id = $request->category_id;
        $category->source_name = $request->source_name;
        $category->slug = Str::slug($request->source_name);

        return redirect()->route('income-source.index')->with('status', 'वर्ग सफलतापूर्वक सुरक्षित गरियो।');
        } catch (\Exception $e) {

        }
    }
}
