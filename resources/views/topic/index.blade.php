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
                        <th>描述</th>
                        <th>總題數</th>
                        <th>題目</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topics as $topic)
                        <tr>
                            <td>{{ $topic->id }}</td>
                            <td>{{ $topic->description }}</td>
                            <td>{{ $topic->max_number }}</td>
                            <td><a href="{{ route('questions.index', $topic->id) }}" class="btn btn-sm btn-primary">Questions</a> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
