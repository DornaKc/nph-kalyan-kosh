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

        <p class="text-end">न.प्र.फाराम नं.: {{ $maghFaram->form_no }}</p>
        <h3 class="text-center fw-bold">माग फाराम सम्पादन</h3>

        <form action="{{ route('maghFaram.update', $maghFaram->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-3">
                    <label>आर्थिक वर्ष :</label>
                    <select name="fiscal_id" class="form-control" required>
                        <option value="">--आर्थिक वर्ष छान्नुहोस्--</option>
                        @foreach($fiscalYears as $row)
                            <option value="{{ $row->id }}" {{ $row->id == $maghFaram->fiscal_id ? 'selected' : '' }}>
                                {{ $row->year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>महिना :</label>
                    <select name="month_id" class="form-control" required>
                        <option value="">--महिना छान्नुहोस्--</option>
                        @foreach($nepaliMonths as $row)
                            <option value="{{ $row->id }}" {{ $row->id == $maghFaram->month_id ? 'selected' : '' }}>
                                {{ $row->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>माग फाराम नं :</label>
                    <input type="text" name="form_no" class="form-control" value="{{ $maghFaram->form_no }}">
                </div>
                <div class="col-md-3">
                    <label>मिति :</label>
                    <input type="text" id="nepaliDate" name="date_ad" class="form-control" value="{{ \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($maghFaram->date_ad)->toNepaliDate() }}">
                </div>
            </div>

            <table class="table table-bordered text-center align-middle" id="demand-table">
                <thead>
                <tr>
                    <th rowspan="2">क्र.सं.</th>
                    <th rowspan="2">सामानको नाम</th>
                    <th rowspan="2">स्पेसिफिकेसन</th>
                    <th colspan="2">माग गरिएको</th>
                    <th rowspan="2">कैफियत</th>
                    <th rowspan="2">Action</th>
                </tr>
                <tr>
                    <th>एकाई</th>
                    <th>परिमाण</th>
                </tr>
                <tr>
                    <th>१</th>
                    <th>२</th>
                    <th>३</th>
                    <th>४</th>
                    <th>५</th>
                    <th>६</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="demand-body">
                @php $rowIndex = 0; @endphp
                @foreach($maghFaram->items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><input type="text" name="items[{{ $rowIndex }}][name]" class="form-control" value="{{ $item->name }}" required></td>
                        <td><input type="text" name="items[{{ $rowIndex }}][specification]" class="form-control" value="{{ $item->specification }}"></td>
                        <td><input type="text" name="items[{{ $rowIndex }}][unit]" class="form-control" value="{{ $item->unit }}"></td>
                        <td><input type="number" name="items[{{ $rowIndex }}][quantity]" class="form-control" value="{{ $item->quantity }}"></td>
                        <td><input type="text" name="items[{{ $rowIndex }}][remarks]" class="form-control" value="{{ $item->remarks }}"></td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">हटाउनुहोस्</button></td>
                    </tr>
                    @php $rowIndex++; @endphp
                @endforeach
                </tbody>
            </table>

            <div class="mb-3">
                <button type="button" class="btn btn-success" onclick="addRow()">पंक्ति थप्नुहोस्</button>
            </div>

            <table class="table table-bordered">
                <tr>
                    <td>
                        <strong>माग गर्ने:</strong><br>
                        नाम: <input type="text" name="requested_by_name" class="form-control mb-1" value="{{ $maghFaram->requested_by_name }}">
                        पद: <input type="text" name="requested_by_position" class="form-control mb-1" value="{{ $maghFaram->requested_by_position }}">
                        मिति: <input type="text" id="nepaliDate" name="requested_by_date" class="form-control mb-1" value="{{ \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($maghFaram->requested_by_date)->toNepaliDate() }}">
                        प्रयोजन: <input type="text" name="purpose" class="form-control" value="{{ $maghFaram->purpose }}">
                    </td>

                    <td>
                        <strong>सिफारिस गर्ने:</strong><br>
                        नाम: <input type="text" name="recommended_by_name" class="form-control mb-1" value="{{ $maghFaram->recommended_by_name }}">
                        पद: <input type="text" name="recommended_by_position" class="form-control mb-1" value="{{ $maghFaram->recommended_by_position }}">
                        मिति: <input type="text" id="nepaliDate" name="recommended_by_date" class="form-control" value="{{ \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($maghFaram->recommended_by_date)->toNepaliDate() }}">
                    </td>

                    <td>
                        <strong>स्टोरकिपरले भर्ने</strong><br>
                        <div class="form-check">
                            <input type="radio" name="store_action" value="buy" class="form-check-input"
                                {{ ($maghFaram->store_action ?? '') === 'buy' ? 'checked' : '' }}>
                            <label class="form-check-label">क) बजारबाट खरिद गर्नु पर्ने</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="store_action" value="stock" class="form-check-input"
                                {{ ($maghFaram->store_action ?? '') === 'stock' ? 'checked' : '' }}>
                            <label class="form-check-label">ख) मौज्दातमा रहेको</label>
                        </div>
                        <div class="mt-2">स्टोरकिपरको दस्तखत:
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
                        नाम: <input type="text" name="receiver_name" class="form-control mb-1" value="{{ $maghFaram->receiver_name }}">
                        पद: <input type="text" name="receiver_position" class="form-control mb-1" value="{{ $maghFaram->receiver_position }}">
                        मिति: <input type="text" id="nepaliDate" name="receiver_date" class="form-control" value="{{ \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($maghFaram->receiver_date)->toNepaliDate() }}">
                    </td>

                    <td>
                        <strong>खर्च निकासा खातामा चढाउने:</strong><br>
                        नाम: <input type="text" name="accountant_name" class="form-control mb-1" value="{{ $maghFaram->accountant_name }}">
                        पद: <input type="text" name="accountant_position" class="form-control mb-1" value="{{ $maghFaram->accountant_position }}">
                        मिति: <input type="text" id="nepaliDate" name="accountant_date" class="form-control" value="{{ \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($maghFaram->accountant_date)->toNepaliDate() }}">
                    </td>

                    <td>
                        <strong>स्वीकृत गर्ने:</strong><br>
                        नाम: <input type="text" name="approver_name" class="form-control mb-1" value="{{ $maghFaram->approver_name }}">
                        पद: <input type="text" name="approver_position" class="form-control mb-1" value="{{ $maghFaram->approver_position }}">
                        मिति: <input type="text" id="nepaliDate" name="approver_date" class="form-control" value="{{ \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($maghFaram->approver_date)->toNepaliDate() }}">
                    </td>
                </tr>
            </table>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">अपडेट गर्नुहोस्</button>
            </div>
        </form>
    </div>

    <script>
        let rowIndex = {{ count($maghFaram->items) }};

        function addRow() {
            const tbody = document.getElementById('demand-body');
            const row = document.createElement('tr');

            row.innerHTML = `
            <td>${rowIndex + 1}</td>
            <td><input type="text" name="items[${rowIndex}][name]" class="form-control" required></td>
            <td><input type="text" name="items[${rowIndex}][specification]" class="form-control"></td>
            <td><input type="text" name="items[${rowIndex}][unit]" class="form-control"></td>
            <td><input type="number" name="items[${rowIndex}][quantity]" class="form-control"></td>
            <td><input type="text" name="items[${rowIndex}][remarks]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">हटाउनुहोस्</button></td>
        `;

            tbody.appendChild(row);
            rowIndex++;
        }

        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();

            // Re-index the remaining rows
            const rows = document.querySelectorAll('#demand-body tr');
            rows.forEach((row, index) => {
                row.cells[0].innerText = index + 1;
            });
        }
    </script>
@endsection


