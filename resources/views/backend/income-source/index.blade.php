@extends('layouts.dash')


@section('content')
    <div class="col-md-12 mb-4">
        <div class="breadcrumb">
            <h1>आम्दानी स्रोतहरू</h1>
            <ul>
                <li>
                    <a href="{{ route('income-source.create') }}" class="btn btn-primary text-white">
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
                                <th>क्र.स.</th>
                                <th>वर्गको नाम</th>
                                <th>आम्दानी स्रोतको नाम</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sources as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->category_name }}</td>
                                    <td>{{ $row->source_name }}</td>
                                    <td>
                                        <a href="{{ route('income-source.edit', $row->id) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <a href="{{ route('income-source.show', $row->id) }}" class="btn btn-info btn-sm">
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
