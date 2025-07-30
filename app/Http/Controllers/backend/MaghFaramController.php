<?php

namespace App\Http\Controllers\backend;

use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
use App\Http\Controllers\Controller;
use App\Models\FiscalYear;
use App\Models\MaghFaram;
use App\Models\MaghItem;
use App\Models\NepaliMonth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaghFaramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maghFarams = MaghFaram::with(['fiscalYear','months'])->get();
        return view('backend.magh-faram.index', compact('maghFarams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fiscalYears = FiscalYear::all();
        $nepaliMonths = NepaliMonth::all();
        return view('backend.magh-faram.create',compact('fiscalYears','nepaliMonths'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::beginTransaction();


        try {

            // Create demand form
            $demandForm = MaghFaram::create([
                'fiscal_id' => $request->fiscal_id,
                'month_id' => $request->month_id,
                'form_no' => $request->form_no,
                'date_ad' => LaravelNepaliDate::from($request->date_ad)->toEnglishDate(),


                // Requested By
                'requested_by_name' => $request->requested_by_name,
                'requested_by_position' => $request->requested_by_position,
                'requested_by_date' => LaravelNepaliDate::from($request->requested_by_date)->toEnglishDate(),
                'purpose' => $request->purpose,

                // Recommended By
                'recommended_by_name' => $request->recommended_by_name,
                'recommended_by_position' => $request->recommended_by_position,
                'recommended_by_date' => LaravelNepaliDate::from($request->recommended_by_date)->toEnglishDate(),

                // Storekeeper Section
                'store_action' => json_encode($request->store_action),
                'storekeeper_signature' => $request->storekeeper_signature,
                'storekeeper_name' => $request->storekeeper_name,

                // Receiver
                'receiver_name' => $request->receiver_name,
                'receiver_position' => $request->receiver_position,
                'receiver_date' => LaravelNepaliDate::from($request->receiver_date)->toEnglishDate(),

                // Accountant
                'accountant_name' => $request->accountant_name,
                'accountant_position' => $request->accountant_position,
                'accountant_date' => LaravelNepaliDate::from($request->accountant_date)->toEnglishDate(),

                // Approver
                'approver_name' => $request->approver_name,
                'approver_position' => $request->approver_position,
                'approver_date' => LaravelNepaliDate::from($request->approver_date)->toEnglishDate(),
            ]);



            // Save each item
            foreach ($request->items as $item) {
                MaghItem::create([
                    'magh_faram_id' => $demandForm->id,
                    'name' => $item['name'],
                    'specification' => $item['specification'] ?? null,
                    'unit' => $item['unit'] ?? null,
                    'quantity' => $item['quantity'] ?? null,
                    'remarks' => $item['remarks'] ?? null,
                ]);
            }



            DB::commit();

            return redirect()->back()->with('status', 'माग फाराम सफलतापूर्वक पेश भयो');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('delete', 'त्रुटि भयो: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $maga = MaghFaram::with('items')->findOrFail($id);
        return view('backend.magh-faram.view', compact('maga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $maghFaram = MaghFaram::with('items')->findOrFail($id);
        $fiscalYears = FiscalYear::all();
        $nepaliMonths = NepaliMonth::all();
        return view('backend.magh-faram.edit', compact('maghFaram','fiscalYears','nepaliMonths'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaghFaram $maghFaram)
    {

        DB::beginTransaction();

        try {
            // Update main form
            $maghFaram->update([
                'fiscal_id' => $request->fiscal_id,
                'month_id' => $request->month_id,
                'form_no' => $request->form_no,
                'date_ad' => \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($request->date_ad)->toEnglishDate(),

                'requested_by_name' => $request->requested_by_name,
                'requested_by_position' => $request->requested_by_position,
                'requested_by_date' => \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($request->requested_by_date)->toEnglishDate(),
                'purpose' => $request->purpose,

                'recommended_by_name' => $request->recommended_by_name,
                'recommended_by_position' => $request->recommended_by_position,
                'recommended_by_date' => \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($request->recommended_by_date)->toEnglishDate(),

                'store_action' => json_encode($request->store_action ?? []),
                'storekeeper_signature' => $request->storekeeper_signature,
                'storekeeper_name' => $request->storekeeper_name,

                'receiver_name' => $request->receiver_name,
                'receiver_position' => $request->receiver_position,
                'receiver_date' => \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($request->receiver_date)->toEnglishDate(),

                'accountant_name' => $request->accountant_name,
                'accountant_position' => $request->accountant_position,
                'accountant_date' => \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($request->accountant_date)->toEnglishDate(),

                'approver_name' => $request->approver_name,
                'approver_position' => $request->approver_position,
                'approver_date' => \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($request->approver_date)->toEnglishDate(),
            ]);

            if (!empty($request->items) && is_array($request->items)) {
                $existingItemIds = [];

                foreach ($request->items as $item) {
                    if (!empty($item['id'])) {
                        // Update existing item
                        $existingItem = $maghFaram->items()->find($item['id']);
                        if ($existingItem) {
                            $existingItem->update([
                                'name' => $item['name'],
                                'specification' => $item['specification'] ?? null,
                                'unit' => $item['unit'] ?? null,
                                'quantity' => $item['quantity'] ?? null,
                                'remarks' => $item['remarks'] ?? null,
                            ]);
                            $existingItemIds[] = $existingItem->id;
                        }
                    } else {
                        // Create new item
                        $newItem = $maghFaram->items()->create([
                            'name' => $item['name'],
                            'specification' => $item['specification'] ?? null,
                            'unit' => $item['unit'] ?? null,
                            'quantity' => $item['quantity'] ?? null,
                            'remarks' => $item['remarks'] ?? null,
                        ]);
                        $existingItemIds[] = $newItem->id;
                    }
                }

                // Delete removed items
                $maghFaram->items()->whereNotIn('id', $existingItemIds)->delete();
            } else {
                // If no items sent, optionally delete all existing items
                $maghFaram->items()->delete();
            }

            DB::commit();

            return redirect()->route('maghFaram.index')->with('status', 'माग फाराम सफलतापूर्वक अपडेट भयो।');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['delete' => 'त्रुटि भयो: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
