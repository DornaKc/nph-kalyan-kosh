<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
use App\Models\Budget;
use App\Models\FiscalYear;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::where('is_deleted', false)->get();
        return view('backend.budget.index', compact('budgets'));
    }

    public function create()
    {
        $fiscalYears = FiscalYear::get();
        return view('backend.budget.create', compact('fiscalYears'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'fiscal_id' => 'required',
                'budget_title' => 'required',
                'budget_type' => 'required',
                'allocated_amount' => 'required',
                'expenditure' => 'required',
                'balance' => 'required',
                'date_bs' => 'required',
                'remarks' => 'required',
            ]);
            $dateAD = LaravelNepaliDate::from($request->date_bs)->toEnglishDate();

            $budget = new Budget();
            $budget->fiscal_id = $request->fiscal_id;
            $budget->budget_title = $request->budget_title;
            $budget->slug = Str::slug($request->budget_title);
            $budget->budget_type = $request->budget_type;
            $budget->allocated_amount = $request->allocated_amount;
            $budget->expenditure = $request->expenditure;
            $budget->balance = $request->balance;
            $budget->date_bs = $request->date_bs;
            $budget->date_ad = $dateAD;
            $budget->remarks = $request->remarks;
            $budget->save();

            return redirect()->route('budget.index')->with('status', 'बजेट सफलतापूर्वक सुरक्षित गरियो।');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function show($slug)
    {

    }

    public function edit($slug)
    {
        $fiscalYears = FiscalYear::get();
        $budget = Budget::where('slug', $slug)->first();
        return view('backend.budget.edit', compact('fiscalYears','budget'));
    }

    public function update(Request $request, $slug)
    {
        // dd($request->all());
        try {
            $budget = Budget::where('slug', $slug)->first();
            $request->validate([
                'fiscal_id' => 'required',
                'budget_title' => 'required',
                'budget_type' => 'required',
                'allocated_amount' => 'required',
                'expenditure' => 'required',
                'balance' => 'required',
                'date_bs' => 'required',
                'remarks' => 'required',
            ]);
            $dateAD = LaravelNepaliDate::from($request->date_bs)->toEnglishDate();

            $budget->fiscal_id = $request->fiscal_id;
            $budget->budget_title = $request->budget_title;
            $budget->slug = Str::slug($request->budget_title);
            $budget->budget_type = $request->budget_type;
            $budget->allocated_amount = $request->allocated_amount;
            $budget->expenditure = $request->expenditure;
            $budget->balance = $request->balance;
            $budget->date_bs = $request->date_bs;
            $budget->date_ad = $dateAD;
            $budget->remarks = $request->remarks;
            $budget->save();

            return redirect()->route('budget.index')->with('status', 'बजेट सफलतापूर्वक सुरक्षित गरियो।');
        } catch (\Exception $e) {
            dd($e);
        }
    } 

    public function destroy($slug)
    {

    }
}
