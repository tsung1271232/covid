@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-success">
                        <h4 class="text-muted">User List</h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>姓名</th>
                        <th>身分證</th>
                        <th>病歷號</th>
                        <th>性別</th>
                        <th>作答紀錄</th>
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
                            <td><a href="{{ route('topicRecords.index', $user->id) }}" class="btn btn-sm btn-primary">View</a> </td>
                         </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
