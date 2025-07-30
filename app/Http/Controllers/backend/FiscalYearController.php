<?php

namespace App\Http\Controllers\backend;

use Anuzpandey\LaravelNepaliDate\Constants\NepaliDate;
use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
use App\Http\Controllers\Controller;
use App\Models\FiscalYear;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FiscalYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fiscalYears = FiscalYear::where('is_deleted',0)->get();
        return view('backend.fiscal-year.index',compact('fiscalYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year'   => 'required|string',
            'start_date_bs' => 'required',
            'end_date_bs'   => 'required',
        ]);

        $startAD = LaravelNepaliDate::from($request->start_date_bs)->toEnglishDate();
        $endAD   = LaravelNepaliDate::from($request->end_date_bs)->toEnglishDate();

        $fiscalYear = new FiscalYear();
        $fiscalYear->year = $request->year;
        $fiscalYear->slug =  Str::slug($request->year);
        $fiscalYear->start_date_bs = $request->start_date_bs;
        $fiscalYear->end_date_bs = $request->end_date_bs;
        $fiscalYear->start_date_ad = $startAD;
        $fiscalYear->end_date_ad = $endAD;
        $fiscalYear->save();

        return redirect()->back()->with('status', 'आर्थिक वर्ष सफलतापूर्वक सुरक्षित गरियो।');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
