@extends('layouts.app')
@extends('layouts.header')

@section('content')
<section class="main-container" style="max-width: 80%">
    <form class="mb-3" action="{{ route('index') }}" method="get">
        <button class="green-button button-design"><i class="bi bi-arrow-bar-left"></i> BACK</button>
    </form>

    <div class="grid-container wide-gap grid-orientation" style="width: 100%">
        <div class="flex-container inner">
            <div class="head-container request-head">
                <h4>STUDENT INFORMATION</h4>
                <span class="badge bg-success mb-2">{{ session('msg') }}</span>
            </div>
            <div class="flex-container pic-direction" style="align-items: center">
                <img class="profile-image view-request-val" data-bs-toggle="modal" data-bs-target="{{ '#' . $picturePath->document_id }}" src="{{ asset('storage/' . $picturePath->document_loc) }}">
                <div class="user-info">
                    <span class="h4 fw-bold">{{ $student->last_name }}, {{ $student->first_name }}
                        {{ mb_substr($student->middle_name, 0, 1) . '.' }}</span>

                    <span>{{ $student->student_id }}</span>
                    <span>{{ $student->course_name }}</span>
                </div>
            </div>
            <div>
                <div class="form-group mb-2">
                    <label style="font-size: 0.85rem" for="archive-id">Archive ID</label>
                    <input class="form-control form-control-sm" name="archive-id" type="text" value="{{ $student->archive_id }}" readonly>
                </div>
                <div class="form-group mb-2">
                    <label style="font-size: 0.85rem" for="email">Email</label>
                    <input class="form-control form-control-sm" name="email" type="text" value="{{ $student->email }}" readonly>
                </div>
                <div class="form-group mb-2">
                    <label style="font-size: 0.85rem" for="program">Program</label>
                    <input class="form-control form-control-sm" name="program" type="text" value="{{ $student->dept_name }}" readonly>
                </div>
                <div class="form-group mb-2">
                    <label style="font-size: 0.85rem" for="admission-year">Admisson Date</label>
                    <input class="form-control form-control-sm" type="text" name="admission-date" value="{{ $student->admission_date }}" readonly>
                </div>
                <div class="form-group mb-2">
                    <label style="font-size: 0.85rem" for="">Status</label>
                    @switch($student->status)
                    @case(1)
                    <input class="form-control form-control-sm" type="text" value="ACTIVE" readonly>
                    @break

                    @case(2)
                    <input class="form-control form-control-sm" type="text" value="TRANSFERRED" readonly>
                    @break

                    @case(3)
                    <input class="form-control form-control-sm" type="text" value="DROPPED OUT" readonly>
                    @break

                    @default
                    <input class="form-control form-control-sm" type="text" value="GRADUATED" readonly>
                    @endswitch
                </div>
                @if ($student->status == 4)
                <div class="form-group mb-2">
                    <label style="font-size: 0.85rem" for="date-graduated">Date Graduated</label>
                    <input class="form-control form-control-sm" type="text" name="date-graduated" value="{{ date('Y-m-d', strtotime($student->date_graduated)) }}" readonly>
                </div>
                @endif
                <div class="form-group mb-2">
                    <label style="font-size: 0.85rem" for="date-archived">Date Archived</label>
                    <input class="form-control form-control-sm" type="text" name="date-archived" value="{{ date('Y-m-d', strtotime($student->date_archived)) }}" readonly>
                </div>
                <div class="form-group mb-2">
                    <label style="font-size: 0.85rem" for="date-filed">Date Filed</label>
                    <input class="form-control form-control-sm" type="text" name="date-filed" value="{{ date('Y-m-d', strtotime($student->date_filed)) }}" readonly>
                </div>
                <div class="form-group mb-2">
                    <label style="font-size: 0.85rem" for="last-updated">Last Updated</label>
                    <input class="form-control form-control-sm" type="text" name="last-updated" value="{{ date('Y-m-d', strtotime($student->updated_at)) }}" readonly>
                </div>
            </div>
            <div class="form-button-container flex-container" style="justify-content: center">
                <div>
                    <button id="clickButton" class="green-button button-design" style="padding-block: 0.15rem; width: 8rem" data-bs-toggle="modal" data-bs-target="#update-modal">UPDATE</button>
                </div>
                <div>
                    <button class="red-button button-design" style="padding-block: 0.15rem; width: 8rem" data-bs-toggle="modal" data-bs-target="#delete-modal">DISPOSE</button>
                </div>
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
            <div class="form-button-container">
                <button class="green-button button-design" data-bs-toggle="modal" data-bs-target="#add-single-rec">ADD A
                    RECORD</button>
            </div>
        </div>
    </div>
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