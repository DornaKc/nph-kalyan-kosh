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

        <form action="{{ route('income-source.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <div class="col-md-4 mb-2">
                    <label>वर्गको नाम :</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">--वर्गको नाम छान्नुहोस्--</option>
                        @foreach ($sourceCategories as $row)
                            <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label>आम्दानी स्रोतको नाम :</label>
                    <input type="text" name="source_name" class="form-control" placeholder="स्रोतको नाम लेख्नुहोस्">
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">पेश गर्नुहोस्</button>
            </div>
        </form>
    </div>
@endsection
