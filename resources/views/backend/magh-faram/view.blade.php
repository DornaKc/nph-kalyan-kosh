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

        <p class="text-end">न.प्र.फाराम नं.: ४०१</p>
        <h3 class="text-center fw-bold">माग फाराम</h3>

        <div class="row mb-3">
            <div class="col-md-3">
                <label>आर्थिक वर्ष :</label>
                <p class="form-control">{{ $maga->fiscalYear->year }}</p>
            </div>
            <div class="col-md-3">
                <label>महिना :</label>
                <p class="form-control">{{ $maga->months->name }}</p>
            </div>
            <div class="col-md-3">
                <label>माग फाराम नं :</label>
                <p class="form-control">{{ $maga->form_no }}</p>
            </div>
            <div class="col-md-3">
                <label>मिति :</label>
                <p class="form-control">{{ $maga->date_ad }}</p>
            </div>
        </div>

        <table class="table table-bordered text-center align-middle">
            <thead>
            <tr>
                <th>क्र.सं.</th>
                <th>सामानको नाम</th>
                <th>स्पेसिफिकेसन</th>
                <th>एकाई</th>
                <th>परिमाण</th>
                <th>कैफियत</th>
            </tr>
            </thead>
            <tbody>
            @foreach($maga->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->specification }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->remarks }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <table class="table table-bordered">
            <tr>
                <td>
                    <strong>माग गर्ने:</strong><br>
                    नाम: {{ $maga->requested_by_name }}<br>
                    पद: {{ $maga->requested_by_position }}<br>
                    मिति: {{ $maga->requested_by_date }}<br>
                    प्रयोजन: {{ $maga->purpose }}
                </td>

                <td>
                    <strong>सिफारिस गर्ने:</strong><br>
                    नाम: {{ $maga->recommended_by_name }}<br>
                    पद: {{ $maga->recommended_by_position }}<br>
                    मिति: {{ $maga->recommended_by_date }}
                </td>

                <td>
                    <strong>स्टोरकिपरले भर्ने</strong><br>
                    <div class="form-check">
                        <input type="radio" name="store_action" value="buy" class="form-check-input"
                            {{ ($maghFaram->store_action ?? '') == 'buy' ? 'checked' : '' }}>
                        <label class="form-check-label">क) बजारबाट खरिद गर्नु पर्ने</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="store_action" value="stock" class="form-check-input"
                            {{ ($maghFaram->store_action ?? '') == 'stock' ? 'checked' : '' }}>
                        <label class="form-check-label">ख) मौज्दातमा रहेको</label>
                    </div>
                    <div class="mt-2">
                        स्टोरकिपरको दस्तखत:
                        <input type="text" name="storekeeper_signature" class="form-control mb-1"
                               value="{{ $maghFaram->storekeeper_signature }}">
                    </div>
                    नाम:
                    <input type="text" name="storekeeper_name" class="form-control"
                           value="{{ $maghFaram->storekeeper_name }}">
                </td>
            </tr>

            <tr>
                <td>
                    <strong>मालसामान बुझिलिने:</strong><br>
                    नाम: {{ $maga->receiver_name }}<br>
                    पद: {{ $maga->receiver_position }}<br>
                    मिति: {{ $maga->receiver_date }}
                </td>

                <td>
                    <strong>खर्च निकासा खातामा चढाउने:</strong><br>
                    नाम: {{ $maga->accountant_name }}<br>
                    पद: {{ $maga->accountant_position }}<br>
                    मिति: {{ $maga->accountant_date }}
                </td>

                <td>
                    <strong>स्वीकृत गर्ने:</strong><br>
                    नाम: {{ $maga->approver_name }}<br>
                    पद: {{ $maga->approver_position }}<br>
                    मिति: {{ $maga->approver_date }}
                </td>
            </tr>
        </table>

        <div class="text-center">
            <a href="{{ route('maghFaram.edit', $maga->id) }}" class="btn btn-secondary" target="_blank">प्रिन्ट गर्नुहोस्</a>
            <a href="{{ route('maghFaram.index') }}" class="btn btn-primary">पृष्ठमा फर्कनुहोस्</a>
        </div>
    </div>
@endsection
