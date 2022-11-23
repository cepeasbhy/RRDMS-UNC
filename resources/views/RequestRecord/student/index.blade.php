@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="row justify-content-center">
        <div class="col mb-2">
            <div class="border-start border-danger border-4">
                <h4 class="ms-2">
                    Request History
                </h4>
            </div>
            <span class="badge bg-success mb-2">{{ session('msg') }}</span>
        </div>
        <div class="col-10">
            <div class="row mb-3">
                <div class="col-6">
                    <form id="searchRequest" action="" method="post">
                        <input class="form-control form-control-sm"type="text" name="search" id="" required>
                    </form>
                </div>
                <div class="col-6">
                    <div class="row justify-content-center">
                        <div class="col-7">
                            <button class="btn btn-success btn-sm w-100" form="searchRequest">SEARCH REQUEST</button>
                        </div>
                        <div class="col-5">
                            <a href="{{ route('stud.makeRequest') }}" class="btn btn-danger btn-sm w-100">REQUEST</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row mt-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="makeRequestTab" data-bs-toggle="tab" data-bs-target="#make-request"
                    type="button" role="tab" aria-controls="make-request" aria-selected="true">Pending
                    Requests</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="requests-tab" data-bs-toggle="tab" data-bs-target="#user-request"
                    type="button" role="tab" aria-controls="user-request" aria-selected="false">Approved
                    Requests</button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="make-request" role="tabpanel" aria-labelledby="make-request-tab">
                <div class="mt-3">
                    <table class="table myTable">
                        <thead>
                            <th class="custom-th bg-danger">Request ID</th>
                            <th class="custom-th bg-danger">Student ID</th>
                            <th class="custom-th bg-danger">First Name</th>
                            <th class="custom-th bg-danger">Last Name</th>
                            <th class="custom-th bg-danger">Course</th>
                            <th class="custom-th bg-danger">Action</th>
                        </thead>

                    </table>
                </div>
            </div>
            <div class="tab-pane fade show" id="user-request" role="tabpanel" aria-labelledby="requests-tab">
                <div class="mt-3">
                    <table class="table myRequest">
                        <thead>
                            <th class="custom-th bg-danger">Request ID</th>
                            <th class="custom-th bg-danger">Student ID</th>
                            <th class="custom-th bg-danger">First Name</th>
                            <th class="custom-th bg-danger">Last Name</th>
                            <th class="custom-th bg-danger">Release Date</th>
                            <th class="custom-th bg-danger">Course</th>
                            <th class="custom-th bg-danger">Action</th>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
