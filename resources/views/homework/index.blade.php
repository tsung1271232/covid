@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-success">
                        <h4 class="text-muted">DB Button</h4>
                    </div>
                </div>
            </div>
            <div>
                <a type="button" class="btn btn-info" href="{{ route('homework.buttonExample',  'count') }}"><span class="cil-contrast btn-icon"></span> "count" 計算目前有幾位使用者</a>
                <a type="button" class="btn btn-info" href="{{ route('homework.buttonExample',  'max') }}"><span class="cil-contrast btn-icon"></span> "max" 題目最多幾題</a>
                <a type="button" class="btn btn-info" href="{{ route('homework.buttonExample',  'min') }}"><span class="cil-contrast btn-icon"></span> "min" 題目最少幾題</a>
                <a type="button" class="btn btn-info" href="{{ route('homework.buttonExample',  'avg') }}"><span class="cil-contrast btn-icon"></span> "avg" 平均完成填答幾份</a>
                <a type="button" class="btn btn-info" href="{{ route('homework.buttonExample',  'sum') }}"><span class="cil-contrast btn-icon"></span> "sum" 所有題數</a>
                <a type="button" class="btn btn-info" href="{{ route('homework.buttonExample',  'having') }}"><span class="cil-contrast btn-icon"></span> "having" 列出有完成作答的人</a>
                <a type="button" class="btn btn-info" href="{{ route('homework.buttonExample',  'exist') }}"><span class="cil-contrast btn-icon"></span> "exist" 列出有作答紀錄的人</a>
                <a type="button" class="btn btn-info" href="{{ route('homework.buttonExample',  'in') }}"><span class="cil-contrast btn-icon"></span> "in" 列出有作答紀錄的人</a>
            </div>

            <div class="form-group">
                <form action = "{{ route('homework.queryExample') }}" method="post">
                    @csrf
                    SQL指令:<textarea type="text" name="sql_command"></textarea>
                    <button type="submit">送出</button>
                </form>
            </div>

            @if(!empty($heads))
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            @foreach($heads as $h)
                                <th>{{$h}}</th>
                            @endforeach
                        </tr>
                        </thead>
                            <tbody>
                            @foreach($contents as $c)
                                <tr>
                                @if(is_object($c))
                                    @foreach($heads as $h)
                                        <td>{{ $c->$h }}</td>
                                    @endforeach
                                @else
                                        <td>{{ $c }}</td>
                                @endif
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <script>
    </script>
@endsection
