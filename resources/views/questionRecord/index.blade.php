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
                        <th>Topic Record ID</th>
                        <th>Question Number</th>
                        <th>Question Type</th>
                        <th>Question Code</th>
                        <th>Options Code</th>
                        <th>Answer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->topic_record_id }}</td>
                            <td>{{ $record->question_number }}</td>
                            <td>{{ $record->question_type }}</td>
                            <td>{{ $record->question_code }}</td>
                            @if ($record->options_code === null)
                                <td>None</td>
                            @else
                                <td>{{$record->options_code}}</td>
                            @endif
                            @if ($record->value === null)
                                <td>None</td>
                            @else
                                <td>{{$record->value}}</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
