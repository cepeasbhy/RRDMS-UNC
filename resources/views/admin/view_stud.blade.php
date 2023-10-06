@extends('layouts.app')
@extends('layouts.header')

@section('content')
<section class="student">
    <a href="{{ route('admin.viewDepartment', ['deptID' => $deptID]) }}">
        <i class="bi bi-arrow-bar-left"></i>
        BACK
    </a>
    <h1>Student Information</h1>
    <div class="student__data">
        <div class="student__data--user">
            <span style="margin-left: 1rem" class="badge bg-success mb-2">{{ session('msg') }}</span>
            <h2>Data</h2>
            <div class="student__data--user-info">
                <img draggable="false" loading="lazy" data-bs-toggle="modal" data-bs-target="{{ '#' . $picturePath->document_id }}" src="{{ asset('storage/' . $picturePath->document_loc) }}">
                <div class="details">
                    <p>{{ $student->last_name }}, {{ $student->first_name }}
                        {{ mb_substr($student->middle_name, 0, 1) . '.' }}</p>
                    <p>{{ $student->student_id }}</p>
                    <p>{{ $student->course_name }}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="text" value="{{ $student->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="program">Program</label>
                <input id="program" name="program" type="text" value="{{ $student->dept_name }}" readonly>
            </div>
            <div class="form-group">
                <label for="admission">Admisson Date</label>
                <input id="admission" name="adminssion-date" type="text" value="{{ $student->admission_date }}" readonly>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                @switch($student->status)
                    @case(1)
                    <input id="status" name="status" type="text" value="ACTIVE" readonly>
                    @break

                    @case(2)
                    <input id="status" name="status" type="text" value="TRANSFERRED" readonly>
                    @break

                    @case(3)
                    <input id="status" name="status" type="text" value="DROPPED OUT" readonly>
                    @break

                    @default
                    <input id="status" name="status" type="text" value="GRADUATED" readonly>
                @endswitch
            </div>
            @if ($student->status == 4)
                <div class="form-group">
                    <label for="grad">Date Graduated</label>
                    <input id="grad" name="grad" type="text" value="{{ date('Y-m-d', strtotime($student->date_graduated)) }}" readonly>
                </div>
            @endif
                <div class="form-group">
                    <label for="filed">Date Filed</label>
                    <input id="filed" name="filed" type="text" value="{{ date('Y-m-d', strtotime($student->created_at)) }}" readonly>
                </div>
                <div class="form-group">
                    <label for="updated">Last Updated</label>
                    <input id="updated" name="updated" type="text" value="{{ date('Y-m-d', strtotime($student->updated_at)) }}" readonly>
                </div>
        </div>
        <div class="student__data--logs">
            <h2>Credentials</h2>
            <span style="margin-left: 1rem" class="badge bg-success mb-2">{{ session('msgCred') }}</span>
            <div class="student__data--logs-group">
                @foreach ($credentials as $credential)
                    @if ($credential->document_name != 'Picture')
                    <div class="card">
                        <button data-bs-toggle="modal" data-bs-target="{{ '#' . $credential->document_id }}">
                            <img draggable="false" loading="lazy" class="img-fluid p-1" src="{{ asset('storage/' . $credential->document_loc) }}">
                        </button>
                        <p>{{ $credential->document_name }}</p>
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
