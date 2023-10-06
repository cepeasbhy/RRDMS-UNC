@extends('layouts.app')
@extends('layouts.header')

@section('content')
<section class="student">
    <a href="{{ route('index') }}">
        <i class="bi bi-arrow-bar-left"></i> BACK
    </a>

    <h1>Student Information</h1>
    <span style="margin-left: 1rem" class="badge bg-success mb-2">{{ session('msg') }}</span>

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
                <label for="archive-id">Archive ID</label>
                <input id="archive-id" name="archive-id" type="text" value="{{ $student->archive_id }}" readonly>
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
                <label for="admission-year">Admisson Date</label>
                <input type="text" name="admission-date" id="admission-date" value="{{ $student->admission_date }}" readonly>
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
                    <label for="date-graduated">Date Graduated</label>
                    <input type="text" name="date-graduated" id="date-graduated" value="{{ date('Y-m-d', strtotime($student->date_graduated)) }}" readonly>
                </div>
            @endif
            <div class="form-group">
                <label for="date-archived">Date Archived</label>
                <input type="text" name="date-archived" id="date-archived" value="{{ date('Y-m-d', strtotime($student->date_archived)) }}" readonly>
            </div>
            <div class="form-group">
                <label for="date-filed">Date Filed</label>
                <input type="text" name="date-filed" id="date-filed" value="{{ date('Y-m-d', strtotime($student->date_filed)) }}" readonly>
            </div>
            <div class="form-group">
                <label for="last-updated">Last Updated</label>
                <input type="text" name="last-updated" id="last-updated" value="{{ date('Y-m-d', strtotime($student->updated_at)) }}" readonly>
            </div>

            <div class="student__data--user-btn">
                <button id="clickButton" data-bs-toggle="modal" data-bs-target="#update-modal">Update</button>
                <button class="dispose" data-bs-toggle="modal" data-bs-target="#delete-modal">Dispose</button>
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
            <button class="add" data-bs-toggle="modal" data-bs-target="#add-single-rec">
                Add a Record
            </button>
        </div>
    </section>
    </div>

</section>

<!--Modal for Archiving Credential-->
@extends('layouts.modals.ArchivedRecords.archiveCredModal')
<!--Modal for Deleting Record-->
@extends('layouts.modals.deleteModal', ['routeName' => 'deleteRecord', 'word' => 'archives'])
<!--Modal for Updating Record-->
@extends('layouts.modals.updateModal', ['routeName' => 'updateRecord'])
<!--Modal for Viewing Credential-->
@extends('layouts.modals.viewCredModal', ['fromRequestedView' => false])
<!--Modal for Deleting Credential-->
@extends('layouts.modals.deleteCredModal', ['routeName' => 'deleteCredential'])
<!--Modal for Updating Credential-->
@extends('layouts.modals.updateCredModal', ['routeName' => 'updateCredential'])
<!--Modal for adding a Credential-->
@extends('layouts.modals.addSingleRecModal', ['routeName' => 'addSingleRecArchive'])
@extends('layouts.modals.proceedUpdateCred')

@if (Session::has('errors'))
<script>
    window.onload = function() {
        document.getElementById('clickButton').click();
    }
</script>
@endif
@endsection
