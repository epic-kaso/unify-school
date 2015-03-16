@extends('super-admin.dashboard.layout')

@section('script')
    document.data = {};
    document.data.schools = {!! $schools->toJson() !!};
@stop

@section('navbar')
    <li><a href="#">Home</a></li>
@stop
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-4">
                <div class="list-group">
                    <a class="list-group-item" href="">Schools</a>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="panel">
                    <div class="panel-heading">
                        <h3>Schools</h3>
                    </div>
                    <table class="table">
                        <tr>
                            <td>S/N</td>
                            <td>Name</td>
                            <td>Active</td>
                        </tr>

                        @for($i = 1; $i <= count($schools); $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $schools[$i - 1]->name }}</td>
                                <td>
                                    @if($schools[$i - 1]->active)
                                        <span class="label label-success">Active</span>
                                    @else
                                        <span class="label label-danger">InActive</span>
                                    @endif
                                </td>
                            </tr>
                        @endfor
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection