@extends('layouts.dash')


@section('content')
    <div class="col-md-12 mb-4">
        <div class="breadcrumb">
            <h1>Budgets</h1>
            <ul>
                <li>
                    <a href="{{ route('budget.create') }}" class="btn btn-primary text-white">
                        Add New
                    </a>
                </li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="card text-left">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-bordered" id="zero_configuration_table"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>आर्थिक वर्ष</th>
                                <th>बजेटको शीर्षक</th>
                                <th>खर्च सिमा</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($budgets as $row)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $row->fiscalYear->year }}</td>
                                    <td>{{ $row->budget_title }}</td>
                                    <td>{{ $row->allocated_amount }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-warning mr-1" href="{{ route('budget.edit', $row->slug) }}">
                                                <i class="nav-icon i-Pen-2"></i>
                                            </a>
                                        </div>
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
