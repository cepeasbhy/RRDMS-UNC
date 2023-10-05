@extends('layouts.app')
@extends('layouts.header')

@section('content')
<section class="main-container" style="max-width: 80%; margin-top: 2rem">
    <form class="mb-3" action="{{ route('admin.viewDepartment', ['deptID' => $deptID]) }}" method="get">
        <button class="green-button button-design"><i class="bi bi-arrow-bar-left"></i> BACK</button>
    </form>
    <div class="grid-container wide-gap grid-orientation" style="width: 100%">
        <div>
            <h4 class="head-container request-head">STUDENT INFORMATION</h4>
            <span class="badge bg-success mb-2">{{ session('msg') }}</span>
            <div class="flex-container pic-direction" style="margin-bottom: 1rem">
                <img class="profile-image view-request-val" data-bs-toggle="modal" data-bs-target="{{ '#' . $picturePath->document_id }}" src="{{ asset('storage/' . $picturePath->document_loc) }}">
                <div class="user-info">
                    <span class="h4 fw-bold">{{ $student->last_name }}, {{ $student->first_name }}
                        {{ mb_substr($student->middle_name, 0, 1) . '.' }}</span>
                    <span>{{ $student->student_id }}</span>
                    <span>{{ $student->course_name }}</span>
                </div>
            </div>
            <div class="readonly-container">
                <label style="font-size: 0.85rem" for="">Email</label>
                <input class="readonly-box" type="text" value="{{ $student->email }}" readonly>
            </div>
            <div class="readonly-container" style="margin-top: 0.5rem">
                <label style="font-size: 0.85rem" for="">Program</label>
                <input class="readonly-box" type="text" value="{{ $student->dept_name }}" readonly>
            </div>
            <div class="readonly-container" style="margin-top: 0.5rem">
                <label style="font-size: 0.85rem" for="">Admisson Date</label>
                <input class="readonly-box" type="text" value="{{ $student->admission_date }}" readonly>
            </div>
            <div class="readonly-container" style="margin-top: 0.5rem">
                <label style="font-size: 0.85rem" for="">Status</label>
                @switch($student->status)
                @case(1)
                <input class="readonly-box" type="text" value="ACTIVE" readonly>
                @break

                @case(2)
                <input class="readonly-box" type="text" value="TRANSFERRED" readonly>
                @break

                @case(3)
                <input class="readonly-box" type="text" value="DROPPED OUT" readonly>
                @break

                @default
                <input class="readonly-box" type="text" value="GRADUATED" readonly>
                @endswitch
            </div>
            @if ($student->status == 4)
            <div class="readonly-container" style="margin-top: 0.5rem">
                <label style="font-size: 0.85rem" for="">Date Graduated</label>
                <input class="readonly-box" type="text" value="{{ date('Y-m-d', strtotime($student->date_graduated)) }}" readonly>
            </div>
            @endif
            <div class="readonly-container" style="margin-top: 0.5rem">
                <label style="font-size: 0.85rem" for="">Date Filed</label>
                <input class="readonly-box" type="text" value="{{ date('Y-m-d', strtotime($student->created_at)) }}" readonly>
            </div>
            <div class="readonly-container" style="margin-top: 0.5rem">
                <label style="font-size: 0.85rem" for="">Last Updated</label>
                <input class="readonly-box" type="text" value="{{ date('Y-m-d', strtotime($student->updated_at)) }}" readonly>
            </div>
        </div>
        <div>
            <h4 class="head-container request-head">STUDENT CREDENTIALS</h4>
            <span class="badge bg-success mb-2">{{ session('msgCred') }}</span>
            <div class="flex-container inner outer-cred-card">
                @foreach ($credentials as $credential)
                @if ($credential->document_name != 'Picture')
                <div class="cred-card">
                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="{{ '#' . $credential->document_id }}">
                        <img class="img-fluid p-1" src="{{ asset('storage/' . $credential->document_loc) }}">
                    </button>
                    <div style="text-align: center;">
                        <label class="col-form-label col-form-label-sm">{{ $credential->document_name }}</label>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
</section>
<!--Modal for Viewing Credential-->
@extends('layouts.modals.viewCredModal', ['fromRequestedView' => true])
<!--Modal for deleting Credential-->
@endsection