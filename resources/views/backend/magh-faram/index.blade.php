@extends('layouts.dash')


@section('content')


    <div class="col-md-12 mb-4">
        <div class="breadcrumb">
            <h1>माग फारम</h1>
            <ul>
                <li><a href="{{route('maghFaram.create')}}" class="btn btn-primary text-white">
                        Add New
                    </a>
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
                            <th>क्र.स.</th>
                            <th>आर्थिक वर्ष</th>
                            <th>महिना</th>
                            <th>माग फारम नं.</th>
                            <th>मिति (वि.सं.)</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($maghFarams as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->fiscalYear->year}}</td>
                                <td>{{ $row->months->name }}</td>
                                <td>{{ $row->form_no }}</td>
                                <td>{{ \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($row->date_ad)->toNepaliDate(format: 'D, j F Y', locale: 'np')}}</td>
                                <td>
                                    <a href="{{ route('maghFaram.edit', $row->id) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <a href="{{ route('maghFaram.show', $row->id) }}" class="btn btn-info btn-sm">
                                        View More
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
