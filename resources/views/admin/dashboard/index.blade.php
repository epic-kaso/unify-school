@extends('app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="btn-group">
                <button class="btn btn-default">All</button>
                <button class="btn btn-default">Nursery</button>
                <button class="btn btn-default">Primary</button>
                <button class="btn btn-default">Junior Secondary</button>
                <button class="btn btn-default">Senior Secondary</button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="list-group">
                    <a class="list-group-item" href="">Students</a>
                    <a class="list-group-item" href="">Academics</a>
                    <a class="list-group-item" href="">Reports</a>
                </div>
            </div>

            <div class="col-sm-8">
                //Center
            </div>
        </div>
    </div>
@endsection
