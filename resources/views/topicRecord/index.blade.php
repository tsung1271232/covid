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
                        <th>Topic ID</th>
                        <th>Is Finish</th>
                        <th>Signature</th>
                        <th>QuestionRecord</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->topic_id }}</td>
                            <td>{{ $record->finish }}</td>
                            @if ($record->signature_path === null)
                                <td>No Found</td>
                            @else
                                <td>{{$record->signature_path}}</td>
                            @endif
                            <td><a href="{{ route('questionRecords.index', $record->id) }}" class="btn btn-sm btn-primary">Questions</a> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
