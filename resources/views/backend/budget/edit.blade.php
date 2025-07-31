@extends('layouts.dash')


@section('content')
    <div class="container" style="font-family: 'Mangal', Arial, sans-serif;">
        <div class="text-center mb-3">
            <img src="https://nepal.gov.np/splash/nepal-govt.png" style="width: 80px;" alt="Logo">
            <h5>नेपाल सरकार</h5>
            <h5>गृह मन्त्रालय</h5>
            <h5>नेपाल प्रहरी अस्पताल, महाराजगञ्ज</h5>
            <p>कार्यालय कोड नं.: ३४७०३५०८</p>
        </div>
        {{--
        <p class="text-end">न.प्र.फाराम नं.: ४०१</p>
        <h3 class="text-center fw-bold">माग फाराम</h3> --}}

        <form action="{{ route('budget.update', $budget->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-md-3 mb-2">
                    <label>आर्थिक वर्ष :</label>
                    <select name="fiscal_id" class="form-control" required>
                        <option value="">--आर्थिक वर्ष छान्नुहोस्--</option>
                        @foreach ($fiscalYears as $row)
                            <option value="{{ $row->id }}"
                                {{ old('fiscal_id', $budget->fiscal_id ?? '') == $row->id ? 'selected' : '' }}>
                                {{ $row->year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <label>बजेटको प्रकार :</label>
                    <select name="budget_type" class="form-control" required>
                        <option value="" disabled selected>--बजेटको प्रकार छान्नुहोस्--</option>
                        <option value="recurrent"
                            {{ old('budget_type', $budget->budget_type ?? '') == 'recurrent' ? 'selected' : '' }}>चालु
                        </option>

                        <option value="capital"
                            {{ old('budget_type', $budget->budget_type ?? '') == 'capital' ? 'selected' : '' }}>पुँजिगत
                        </option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label>बजेटको शीर्षक :</label>
                    <input type="text" name="budget_title" class="form-control"
                        value="{{ old('budget_title', $budget->budget_title ?? '') }}" placeholder="शीर्षक लेख्नुहोस्">
                </div>

                <div class="col-md-3 mb-2">
                    <label>खर्च सिमा :</label>
                    <input type="number" name="allocated_amount" class="form-control"
                        value="{{ old('allocated_amount', $budget->allocated_amount ?? '') }}" placeholder="रकम लेख्नुहोस्">
                </div>
                <div class="col-md-3 mb-2">
                    <label>हाल सम्मको खर्च :</label>
                    <input type="number" name="expenditure" class="form-control"
                        value="{{ old('expenditure', $budget->expenditure ?? '') }}" placeholder="रकम लेख्नुहोस्">
                </div>
                <div class="col-md-3 mb-2">
                    <label>बाँकी रकम :</label>
                    <input type="number" name="balance" class="form-control"
                        value="{{ old('balance', $budget->balance ?? '') }}" placeholder="रकम लेख्नुहोस्">
                </div>
                <div class="col-md-3">
                    <label>मिति :</label>
                    <input type="text" id="nepaliDate" name="date_bs" class="form-control"
                        value="{{ old('date_bs', $budget->date_bs ?? '') }}">
                </div>
                <div class="col-md-12">
                    <label>टिप्पणीहरू :</label>
                    <textarea type="text" name="remarks" rows="4" class="form-control" placeholder="टिप्पणीहरू लेख्नुहोस्">{{ old('remarks', $budget->remarks ?? '') }}</textarea>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-warning">अपडेट गर्नुहोस्</button>
            </div>
        </form>
    </div>
@endsection
