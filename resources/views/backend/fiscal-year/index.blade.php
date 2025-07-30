@extends('layouts.dash')


@section('content')

    <!-- Header section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@anuz-pandey/nepali-date-picker/dist/nepali-date-picker.min.css">



    <div class="col-md-12 mb-4">
        <div class="breadcrumb">
            <h1>Fiscal Years</h1>
            <ul>
                <li><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">
                        Add New
                    </button>
                </li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="card text-left">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>आर्थिक वर्ष</th>
                            <th>शुरू मिति</th>
                            <th>अन्त्य मिति</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fiscalYears as $row)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$row->year}}</td>
                                <td>{{$row->start_date_bs}}</td>
                                <td>{{$row->end_date_bs}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!--  Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Fiscal Year</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('fiscalYear.store')}}" method="post" class="needs-validation" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <input name="election" value="" hidden="hidden">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom03">आर्थिक वर्ष</label>
                                <input class="form-control" id="validationCustom03" type="text" name="year" placeholder="Enter fiscal year" required="required" />
                                <div class="invalid-feedback">
                                    Please enter a designation title.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">शुरू मिति</label>
                                <input class="form-control" id="nepaliDate" type="text" name="start_date_bs"  autocomplete="off" required="required" />
                                <div class="invalid-feedback">
                                    Please enter a designation title.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom03">अन्त्य मिति</label>
                                <input class="form-control" id="nepaliDate" type="text" name="end_date_bs" autocomplete="off"  required="required" />
                                <div class="invalid-feedback">
                                    Please enter a designation title.
                                </div>
                            </div>
                            <button class="btn btn-primary ml-2" type="submit">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer or bottom of body -->
    <script src="https://cdn.jsdelivr.net/npm/@anuz-pandey/nepali-date-picker/dist/nepali-date-picker.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const nepaliInput = document.getElementById("nepaliDate");
            const englishInput = document.getElementById("englishDate");

            // Initialize picker
            const picker = new NepaliDatePicker('#nepaliDate', {
                onChange: ({ bsDate, adDate }) => {
                    const englishInput = document.getElementById("englishDate");
                    const formattedAd = adDate.toISOString().split('T')[0]; // YYYY-MM-DD
                    englishInput.value = formattedAd;
                }
            });
        });
    </script>

@endsection
