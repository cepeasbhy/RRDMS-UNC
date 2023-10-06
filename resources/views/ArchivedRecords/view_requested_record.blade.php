@extends('layouts.app')
@extends('layouts.header')

@section('content')
<section class="student">
    <a href="{{ route('viewRequestDetails', ['requestID' => $requestID]) }}">
        <i class="bi bi-arrow-bar-left"></i> BACK
    </a>
    <h1>Student Information</h1>

    <section class="student__data">
        <div class="student__data--user">
            <h2>Data</h2>
            <div class="student__data--user-info">
                <img draggable="false" data-bs-toggle="modal" data-bs-target="{{ '#' . $picturePath->document_id }}" src="{{ asset('storage/' . $picturePath->document_loc) }}">
                <div class="details">
                    <p>{{ $student->last_name }}, {{ $student->first_name }}
                        {{ mb_substr($student->middle_name, 0, 1) . '.' }}</p>
                    <p>{{ $student->student_id }}</p>
                    <p>{{ $student->course_name }}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="a-id">Archive ID</label>
                <input id="a-id" name="a-id" type="text" value="{{ $student->archive_id }}" readonly>
            </div>
            <div class="form-group">
                <label for="mail">Email</label>
                <input id="mail" name="mail" type="text" value="{{ $student->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="prog">Program</label>
                <input id="prog" name="prog" type="text" value="{{ $student->dept_name }}" readonly>
            </div>
            <div class="form-group">
                <label for="ad-date">Admisson Date</label>
                <input id="ad-date" name="ad-date" type="text" value="{{ $student->admission_date }}" readonly>
            </div>
            <div class="form-group">
                <label for="stat">Status</label>
                @switch($student->status)
                    @case(1)
                        <input id="stat" name="stat" type="text" value="ACTIVE" readonly>
                    @break

                    @case(2)
                        <input id="stat" name="stat" type="text" value="TRANSFERRED" readonly>
                    @break

                    @case(3)
                        <input id="stat" name="stat" type="text" value="DROPPED OUT" readonly>
                    @break

                    @default
                        <input id="stat" name="stat" type="text" value="GRADUATED" readonly>
                @endswitch
            </div>
            @if ($student->status == 4)
            <div class="form-group">
                <label for="d-grad">Date Graduated</label>
                <input id="d-grad" name="d-grad" type="text" value="{{ date('Y-m-d', strtotime($student->date_graduated)) }}" readonly>
            </div>
            @endif
            <div class="form-group">
                <label for="d-archived">Date Archived</label>
                <input id="d-archived" name="d-archived" type="text" value="{{ date('Y-m-d', strtotime($student->date_archived)) }}" readonly>
            </div>
            <div class="form-group">
                <label for="d-filed">Date Filed</label>
                <input id="d-filed" name="d-filed" type="text" value="{{ date('Y-m-d', strtotime($student->date_filed)) }}" readonly>
            </div>
            <div class="form-group">
                <label for="update">Last Updated</label>
                <input id="update" name="update" type="text" value="{{ date('Y-m-d', strtotime($student->updated_at)) }}" readonly>
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
                            <img draggable="false" loading="lazy" src="{{ asset('storage/' . $credential->document_loc) }}">
                        </button>
                        <p class="col-form-label col-form-label-sm">{{ $credential->document_name }}</p>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
</section>

<!--Modal for Viewing Credential-->
@extends('layouts.modals.viewCredModal', ['fromRequestedView' => true])
@endsection
