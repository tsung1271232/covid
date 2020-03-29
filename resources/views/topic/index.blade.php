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
                        <th>Description</th>
                        <th>Max_Number</th>
                        <th>Question</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topics as $topic)
                        <tr>
                            <td>{{ $topic->id }}</td>
                            <td>{{ $topic->description }}</td>
                            <td>{{ $topic->max_number }}</td>
                            <td><a href="{{ route('questions.index', $topic->id) }}" class="btn btn-sm btn-primary">Questions</a> </td>
{{--                            <td><a href="{{ route('line-nonce.index', $login->id) }}" class="btn btn-sm btn-primary">Nonce</a> </td>--}}
{{--                            <td><a href="{{ route('line-user.index', $login->id) }}" class="btn btn-sm btn-primary">User</a> </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
