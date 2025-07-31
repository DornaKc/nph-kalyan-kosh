@extends('layouts.dash')

@section('content')
    <div class="container" style="font-family: 'Mangal', Arial, sans-serif;">
        <div class="text-center mb-3">
            <img src="https://nepal.gov.np/splash/nepal-govt.png" style="width: 80px;" alt="Logo">
            <h5>नेपाल सरकार</h5>
            <h5>गृह मन्त्रालय</h5>
            <h5>नेपाल प्रहरी अस्पताल, महाराजगञ्ज</h5>
            <p>कार्यालय कोड नं.: ३१४०४३५०८</p>
        </div>

        <p class="text-end">म.ले.प. फाराम नं.: ४०२</p>
        <h3 class="text-center fw-bold">खरिद आदेश</h3>

        <form action="{{ route('kharidAadesh.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>श्री (आदेश गरिएको व्यक्ति/फर्म/निकाय):</label>
                    <input type="text" name="vendor_name" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>ठेगाना:</label>
                    <input type="text" name="vendor_address" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>स्थायी लेखा (PAN/VAT) नम्बर:</label>
                    <input type="text" name="vendor_pan" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>फोन नं.:</label>
                    <input type="text" name="vendor_phone" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>आर्थिक वर्ष:</label>
                    <select name="fiscal_id" class="form-control">
                        @foreach($fiscalYears as $row)
                            <option value="{{ $row->id }}">{{ $row->year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>खरिद आदेश नं.:</label>
                    <input type="text" name="order_no" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>खरिद आदेश मिति:</label>
                    <input type="text" name="order_date" id="nepaliDate" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>खरिद सम्वन्धी निर्णय नं :</label>
                    <input type="text" name="proposal_no" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>निर्णय मिति:</label>
                    <input type="text" name="proposal_date" id="nepaliDate" class="form-control">
                </div>
            </div>

            <table class="table table-bordered text-center align-middle" id="order-table">
                <thead>
                <tr>
                    <th rowspan="2">क्र.सं.</th>
                    <th colspan="6">सम्पत्ति तथा जिन्सी मालसामानको</th>
                    <th colspan="2">मूल्य (मु.अ.का. बाहेक)</th>
                    <th rowspan="2">कैफियत</th>
                    <th rowspan="2">Action</th>
                </tr>
                <tr>
                    <th>सङ्केत नं.</th>
                    <th>नाम</th>
                    <th>स्पेसिफिकेसन</th>
                    <th>मोडल</th>
                    <th>इकाई</th>
                    <th>परिमाण</th>
                    <th>दर</th>
                    <th>जम्मा</th>
                </tr>
                </thead>
                <tbody id="order-body">
                <!-- Rows added dynamically -->
                </tbody>
            </table>

            <button type="button" class="btn btn-success mb-3" onclick="addOrderRow()">पंक्ति थप्नुहोस्</button>

            <table class="table table-bordered">
                <tr>
                    <td>
                        <strong>तयार गर्ने:</strong><br>
                        नाम: <input type="text" name="prepared_by_name" class="form-control mb-1">
                        पद: <input type="text" name="prepared_by_position" class="form-control mb-1">
                        मिति: <input type="text" name="prepared_by_date" class="form-control mb-1">
                    </td>
                    <td>
                        <strong>सिफारिस गर्ने:</strong><br>
                        नाम: <input type="text" name="recommended_by_name" class="form-control mb-1">
                        पद: <input type="text" name="recommended_by_position" class="form-control mb-1">
                        मिति: <input type="text" name="recommended_by_date" class="form-control mb-1">
                    </td>
                </tr>
            </table>

            <table class="table table-bordered">
                <tr>
                    उल्लेखित  सामानहरु बजेट उपशीर्षक न <input type="text" name="sub_heading_no" style="width: 100px;">
                    को खर्च शीर्षक न <input type="text" name="expenditure_title_no" style="width: 100px;">
                    को क्रियाकलाप नं <input type="text" name="activity_no" style="width: 100px;">
                    बाट भुक्तानी दिन बजेट बाँकी रहेको देखिन्छ ।
                </tr>
                <tr>
                    <td>
                        <strong>आर्थिक प्रशासन शाखा:</strong><br>
                        नाम: <input type="text" name="financial_admin_name" class="form-control mb-1">
                        पद: <input type="text" name="financial_admin_position" class="form-control mb-1">
                        मिति: <input type="text" name="financial_admin_date" class="form-control mb-1">
                    </td>
                    <td>
                        <strong>स्वीकृत गर्ने:</strong><br>
                        नाम: <input type="text" name="approved_by_name" class="form-control mb-1">
                        पद: <input type="text" name="approved_by_position" class="form-control mb-1">
                        मिति: <input type="text" name="approved_by_date" class="form-control mb-1">
                    </td>
                </tr>
            </table>

            <table class="table table-bordered">
                <tr>
                    उल्लेखित  सामानहरु बजेट उपशीर्षक न <input type="text" name="sub_heading_no" style="width: 100px;">
                    को खर्च शीर्षक न <input type="text" name="expenditure_title_no" style="width: 100px;">
                    को क्रियाकलाप नं <input type="text" name="activity_no" style="width: 100px;">
                    बाट भुक्तानी दिन बजेट बाँकी रहेको देखिन्छ ।
                </tr>
                <tr>
                    <td>
                        <strong>आर्थिक प्रशासन शाखा:</strong><br>
                        नाम: <input type="text" name="financial_admin_name" class="form-control mb-1">
                        पद: <input type="text" name="financial_admin_position" class="form-control mb-1">
                        मिति: <input type="text" name="financial_admin_date" class="form-control mb-1">
                    </td>
                    <td>
                        <strong>स्वीकृत गर्ने:</strong><br>
                        नाम: <input type="text" name="approved_by_name" class="form-control mb-1">
                        पद: <input type="text" name="approved_by_position" class="form-control mb-1">
                        मिति: <input type="text" name="approved_by_date" class="form-control mb-1">
                    </td>
                </tr>
            </table>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">पेश गर्नुहोस्</button>
            </div>
        </form>
    </div>

    <script>
        let orderIndex = 0;

        function addOrderRow() {
            const tbody = document.getElementById('order-body');
            const row = document.createElement('tr');

            row.innerHTML = `
                <td>${orderIndex + 1}</td>
                <td><input type="text" name="items[${orderIndex}][code]" class="form-control"></td>
                <td><input type="text" name="items[${orderIndex}][name]" class="form-control"></td>
                <td><input type="text" name="items[${orderIndex}][specification]" class="form-control"></td>
                <td><input type="text" name="items[${orderIndex}][model]" class="form-control"></td>
                <td><input type="text" name="items[${orderIndex}][unit]" class="form-control"></td>
                <td><input type="number" name="items[${orderIndex}][quantity]" class="form-control" oninput="calculateTotal(this)"></td>
                <td><input type="number" name="items[${orderIndex}][unit_price]" class="form-control" oninput="calculateTotal(this)"></td>
                <td><input type="number" name="items[${orderIndex}][total]" class="form-control" readonly></td>
                <td><input type="text" name="items[${orderIndex}][remarks]" class="form-control"></td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">हटाउनुहोस्</button></td>
            `;
                        tbody.appendChild(row);
            orderIndex++;
        }

        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();

            // Re-index
            const rows = document.querySelectorAll('#order-body tr');
            rows.forEach((row, index) => {
                row.cells[0].innerText = index + 1;
            });
        }

        function calculateTotal(input) {
            const row = input.closest('tr');
            const quantity = row.querySelector('input[name^="items"][name$="[quantity]"]').value;
            const price = input.value;
            const totalField = row.querySelector('input[name^="items"][name$="[total]"]');
            totalField.value = (parseFloat(quantity || 0) * parseFloat(price || 0)).toFixed(2);
        }
    </script>
@endsection
