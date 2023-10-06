@extends('layouts.app')
@extends('layouts.header')

@section('content')
<section class="main-container" style="max-width: 80%">
    <div style="place-self: start">
        <form class="mb-3" action="{{ route('StudCredHome') }}" method="get">
            <button class="green-button button-design"><i class="bi bi-arrow-bar-left"></i> BACK</button>
        </form>
    </div>
    <span class="badge bg-success mb-2">{{ session('msg') }}</span>
    <div class="grid-container student-information">
        <div>
            <h4 class="head-container request-head">STUDENT INFORMATION</h4>
            <div class="flex-container pic-direction">
                <img class="profile-image view-request-val" data-bs-toggle="modal" data-bs-target="{{ '#' . $picturePath->document_id }}" src="{{ asset('storage/' . $picturePath->document_loc) }}">
                <div class="user-info">
                    <span class="h4 fw-bold">{{ $student->last_name }}, {{ $student->first_name }}
                        {{ mb_substr($student->middle_name, 0, 1) . '.' }}</span>
                    <span>{{ $student->student_id }}</span>
                    <span>{{ $student->course_name }}</span>
                </div>
            </div>

            <div class="flex-container inner">
                <div class="readonly-container">
                    <label class="col-form-label col-form-label-sm" for="">Email</label>
                    <input class="readonly-box" type="text" value="{{ $student->email }}" readonly>
                </div>
                <div class="readonly-container">
                    <label class="col-form-label col-form-label-sm" for="">Department</label>
                    <input class="readonly-box" type="text" value="{{ $student->dept_name }}" readonly>
                </div>
                <div class="readonly-container">
                    <label class="col-form-label col-form-label-sm" for="">Admisson Date</label>
                    <input class="readonly-box" type="text" value="{{ $student->admission_date }}" readonly>
                </div>
                <div class="readonly-container">
                    <label class="col-form-label col-form-label-sm" for="">Status</label>
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
                <div class="readonly-container">
                    <label class="col-form-label col-form-label-sm" for="">Date Graduated</label>
                    <input class="readonly-box" type="text" value="{{ date('Y-m-d', strtotime($student->date_graduated)) }}" readonly>
                </div>
                @endif
                <div class="readonly-container">
                    <label class="col-form-label col-form-label-sm" for="">Date Filed</label>
                    <input class="readonly-box" type="text" value="{{ date('Y-m-d', strtotime($student->created_at)) }}" readonly>
                </div>
                <div class="readonly-container">
                    <label class="col-form-label col-form-label-sm" for="">Last Updated</label>
                    <input class="readonly-box" type="text" value="{{ date('Y-m-d', strtotime($student->updated_at)) }}" readonly>
                </div>
                @if (Auth::user()->account_role == 'cic')
                <div class="form-button-container">
                    <button id="clickButton" class="green-button button-design" style="width: 45%" data-bs-toggle="modal" data-bs-target="#update-modal">UPDATE</button>
                </div>
                @endif
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
            @if (Auth::user()->account_role == 'cic')
            <div class="form-button-container">
                <button class="green-button button-design" style="width: 45%" data-bs-toggle="modal" data-bs-target="#add-single-rec">ADD
                    A RECORD</button>
            </div>
            @endif
        </div>
    </div>
</section>



<!--Modal for Updating Student Information-->
@extends('layouts.modals.updateModal', ['routeName' => 'updateStudent', 'staff' => $staff])
<!--Modal for Viewing Credential-->
@extends('layouts.modals.viewCredModal', ['fromRequestedView' => false])
<!--Modal for updating Credential-->
@extends('layouts.modals.updateCredModal', ['routeName' => 'updateCred'])
<!--Modal for adding a Credential-->
@extends('layouts.modals.addSingleRecModal', ['routeName' => 'addSingleRec'])
@extends('layouts.modals.proceedUpdateCred')

@if (Session::has('errors'))
<script>
    window.onload = function() {
        document.getElementById('clickButton').click();
    }
</script>
@endif
@endsection