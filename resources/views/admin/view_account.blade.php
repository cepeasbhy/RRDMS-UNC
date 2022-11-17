@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <div class="row w-50">
        <div class="col">
            <div class="mb-3">
                <a class="btn btn-success btn-sm" href="{{route('admin.viewAccounts')}}"><i class="bi bi-arrow-bar-left"></i> BACK</a>
            </div>
            <div class="border-start border-danger border-4">
                <h4 class="ms-3">ACCOUNT INFORMATION</h4>
            </div>

            
        </div>
    </div>
@endsection