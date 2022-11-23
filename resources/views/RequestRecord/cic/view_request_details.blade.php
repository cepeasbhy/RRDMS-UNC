@extends('layouts.app')
@extends('layouts.header')

@section('request-content')
    <div class="container mb-3">
        <div class="row mb-3">
            <form class="mb-3" action="{{ route('cic.request') }}" method="get">
                <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i> BACK</button>
            </form>
            <div class="border-start border-danger border-4 mb-2">
                <h4 class="ms-1 my-auto">STUDENT INFORMATION</h4>
            </div>
            <div class="row align-items-center mb-3 w-50 ms-2">
                <img class="col-3 img-fluid rounded-circle student-pic"
                    src="{{ asset('storage/' . $picturePath->document_loc) }}">
                <div class="col-9">
                    <span class="h4 fw-bold">{{ $student->last_name }}, {{ $student->first_name }}
                        {{ mb_substr($student->middle_name, 0, 1) . '.' }}</span>
                    <br>
                    <span>{{ $student->student_id }}</span>
                    <br>
                    <span>{{ $student->course_name }}</span>
                    <br>
                    <span>Request ID: {{ $requestedDocumentDetails->request_id }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="border-start border-danger border-4 mb-3">
                <h4 class="ms-1 my-auto">REQUEST DETAILS</h4>
            </div>
            <div class="col ms-3">
                <table class="table">
                    <thead>
                        <th class="custom-th bg-danger">Document Name</th>
                        <th class="custom-th bg-danger">Quantity</th>
                    </thead>
                    <tbody>
                        @if ($requestedDocumentDetails->certificate != null)
                            @foreach ($requestedDocumentDetails->certificate as $certs)
                                @foreach ($certs as $key => $value)
                                    <tr class="custom-tr">
                                        <td class="custom-td">{{ $key }} </td>
                                        <td class="custom-td">{{ $value }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endif
                        @if ($requestedDocumentDetails->diploma != null)
                            <tr class="custom-tr">
                                @foreach ($requestedDocumentDetails->diploma as $diploma)
                                    <td class="custom-td">
                                        {{ $diploma }}
                                    </td>
                                    <td class="custom-td"> 1</td>
                                @endforeach
                            </tr>
                        @endif
                        @if ($requestedDocumentDetails->transcript_of_record != null)
                            <tr class="custom-tr">
                                <td class="custom-td">
                                    Transcript of Record
                                </td>
                                <td class="custom-td">
                                    @foreach ($requestedDocumentDetails->transcript_of_record as $records)
                                        {{ $records }}
                                    @break
                                @endforeach
                            </td>
                        </tr>
                    @endif
                    @if ($requestedDocumentDetails->copy_of_grades != null)
                        <tr class="custom-tr">
                            <td class="custom-td">
                                Copy of Grades
                            </td>
                            <td class="custom-td">
                                @foreach ($requestedDocumentDetails->copy_of_grades as $grades)
                                    {{ $grades }}
                                @break
                            @endforeach
                        </td>
                    </tr>
                @endif
                @if ($requestedDocumentDetails->authentication != null)
                    <tr class="custom-tr">
                        @foreach ($requestedDocumentDetails->authentication as $authentication)
                            <td class="custom-td">
                                {{ $authentication }}
                            </td>
                            <td class="custom-td"> 1</td>
                        @endforeach
                    </tr>
                @endif
                @if ($requestedDocumentDetails->photocopy != null)
                    <tr class="custom-tr">
                        @foreach ($requestedDocumentDetails->photocopy as $copies)
                            <td class="custom-td">{{ $copies }}</td>
                            <td class="custom-td">1</td>
                        @break
                    @endforeach
                </tr>
            @endif
        </tbody>
    </table>

    <div class=" text-xl text-danger">
        Total Fee: {{ $requestedDocumentDetails->total_fee }}
    </div>




</div>

</div>

<div class="col mt-5 text-center">
<button class="btn btn-sm btn-success me-3">ACCEPT REQUEST</button>
<button class="btn btn-sm btn-danger">REJECT REQUEST</button>
</div>

</div>
<script src="{{ asset('js/main.js') }}"></script>
@endsection
