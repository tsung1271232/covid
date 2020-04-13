@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-success">
                        <h4 class="text-muted">Topic List</h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>SSN</th>
                        <th>Medical NO</th>
                        <th>Sex</th>
                        <th>Topic Records</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clientUsers as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->id_number }}</td>
                            <td>{{ $user->medical_number }}</td>
                            <td>{{ $user->sex }}</td>
                            <td><a href="{{ route('topicRecords.index', $user->id) }}" class="btn btn-sm btn-primary">Records</a> </td>
                         </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
