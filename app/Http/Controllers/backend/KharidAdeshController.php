<?php

namespace App\Http\Controllers\backend;

use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
use App\Http\Controllers\Controller;
use App\Models\FiscalYear;
use App\Models\KharidAadesh;
use App\Models\KharidItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KharidAdeshController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fiscalYears = FiscalYear::all();
        return view('backend.kharid-aadesh.create',compact('fiscalYears'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'vendor_name' => 'required|string|max:255',
//            'order_no' => 'required|string|max:255',
//            'order_date' => 'required|string',
//            'items.*.name' => 'required|string',
//            'items.*.quantity' => 'required|numeric',
//            'items.*.rate' => 'required|numeric',
//            'items.*.total' => 'required|numeric',
//            'grand_total' => 'required|numeric',
//        ]);

        DB::beginTransaction();

        try {
            // Store main form data
            $kharid = KharidAadesh::create([
                'vendor_name' => $request->vendor_name,
                'vendor_address' => $request->vendor_address,
                'vendor_pan' => $request->vendor_pan,
                'vendor_phone' => $request->vendor_phone,

                'fiscal_id' => $request->fiscal_id,
                'order_no' => $request->order_no,
                'order_date' => LaravelNepaliDate::from($request->order_date)->toEnglishDate(),
                'proposal_no' => $request->proposal_no,
                'proposal_date' => LaravelNepaliDate::from($request->proposal_date)->toEnglishDate(),

                'grand_total' => $request->grand_total,

                'prepared_by_name' => $request->prepared_by_name,
                'prepared_by_position' => $request->prepared_by_position,
                'prepared_by_date' => LaravelNepaliDate::from($request->prepared_by_date)->toEnglishDate(),

                'recommended_by_name' => $request->recommended_by_name,
                'recommended_by_position' => $request->recommended_by_position,
                'recommended_by_date' => LaravelNepaliDate::from($request->recommended_by_date)->toEnglishDate(),

                'sub_heading_no' => $request->sub_heading_no,
                'expenditure_title_no' => $request->expenditure_title_no,
                'activity_no' => $request->activity_no,

                'financial_admin_name' => $request->financial_admin_name,
                'financial_admin_position' => $request->financial_admin_position,
                'financial_admin_date' => LaravelNepaliDate::from($request->financial_admin_date)->toEnglishDate(),

                'approved_by_name' => $request->approved_by_name,
                'approved_by_position' => $request->approved_by_position,
                'approved_by_date' => LaravelNepaliDate::from($request->approved_by_date)->toEnglishDate(),

                'vendor_commit_date' => LaravelNepaliDate::from($request->vendor_commit_date)->toEnglishDate(),
                'vendor_commit_location' => $request->vendor_commit_location,
                'vendor_commit_name' => $request->vendor_commit_name,
                'vendor_commit_signature' => $request->vendor_commit_signature,
                'vendor_issued_date' => LaravelNepaliDate::from($request->vendor_issued_date)->toEnglishDate(),
                'vendor_commit_stamp' => $request->vendor_commit_stamp,
            ]);

            // Store item rows
            foreach ($request->items as $item) {
                KharidItem::create([
                    'kharid_aadesh_id' => $kharid->id,
                    'name' => $item['name'],
                    'code' => $item['code'],
                    'specification' => $item['specification'] ?? null,
                    'unit' => $item['unit'] ?? null,
                    'quantity' => $item['quantity'],
                    'model' => $item['model'],
                    'unit_price' => $item['unit_price'],
                    'total' => $item['total'],
                    'remarks' => $item['remarks'],
                ]);
            }

            DB::commit();

            return redirect()->back()->with('status', 'खरिद आदेश सफलतापूर्वक सुरक्षित गरियो');
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
