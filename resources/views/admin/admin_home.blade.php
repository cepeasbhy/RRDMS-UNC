@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <div class="row justify-content-center mb-3">
        <div class="row">
            <div class="border-start border-danger border-4 mb-2">
                <h4 class="ms-1 my-auto">ADMIN TOOLS</h4>
            </div>
            <div class="row">
                <div class="col">
                    <a class="btn btn-success btn-small w-100" href="{{route('viewAccounts')}}" rel="noopener noreferrer">ACCOUNT MANAGEMENT</a>
                </div>
                <div class="col">
                    <a class="btn btn-success btn-small w-100" href="{{route('admin.exportGraduates')}}" rel="noopener noreferrer">EXPORT LIST OF GRADUATES</a>
                </div>
                <div class="col">
                    <a class="btn btn-success btn-small w-100" href="{{route('admin.exportStudList')}}" rel="noopener noreferrer">EXPORT LIST OF STUDENTS</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-3">
        <div class="row">
            <div class="border-start border-danger border-4 mb-2">
                <h4 class="ms-1 my-auto">RECORDS OVERVIEW</h4>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col border p-2 rounded border-dark me-2">
                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <a href="{{route('admin.viewDepartment', ['deptID' => '001'])}}">
                            <img src="{{asset('/img/dept_logo/as_logo.png')}}" height="50px" width="50px"> 
                        </a>
                    </div>
                    <div class="col">
                        <h6>Arts and Science</h6>
                        <h5>{{$deptCount['asCount']}}</h5>
                        <label class="label-sm">TOTAL RECORDS</label>
                    </div>
                </div>
            </div>
            <div class="col border p-2 rounded border-dark me-2">
                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <a href="{{route('admin.viewDepartment', ['deptID' => '002'])}}">
                            <img src="{{asset('/img/dept_logo/cba_logo.png')}}" height="50px" width="50px">
                        </a>
                    </div>
                    <div class="col">
                        <h6>Business and Accountancy</h6>
                        <h5>{{$deptCount['cbaCount']}}</h5>
                        <label class="label-sm">TOTAL RECORDS</label>
                    </div>
                </div>
            </div>
            <div class="col border p-2 rounded border-dark me-2">
                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <a href="{{route('admin.viewDepartment', ['deptID' => '003'])}}">
                            <img src="{{asset('/img/dept_logo/cs_logo.png')}}" height="50px" width="50px">
                        </a>
                    </div>
                    <div class="col">
                        <h6>Computer Studies</h6>
                        <h5>{{$deptCount['csCount']}}</h5>
                        <label class="label-sm">TOTAL RECORDS</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col border p-2 rounded border-dark me-2">
                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <a href="{{route('admin.viewDepartment', ['deptID' => '004'])}}">
                            <img src="{{asset('/img/dept_logo/cje_logo.png')}}" height="50px" width="50px">
                        </a>
                        </div>
                    <div class="col">
                        <h6>Criminal Justice Education</h6>
                        <h5>{{$deptCount['cjeCount']}}</h5>
                        <label class="label-sm">TOTAL RECORDS</label>
                    </div>
                </div>
            </div>
            <div class="col border p-2 rounded border-dark me-2">
                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <a href="{{route('admin.viewDepartment', ['deptID' => '005'])}}">
                            <img src="{{asset('/img/dept_logo/educ_logo.png')}}" height="50px" width="50px">
                        </a>
                    </div>
                    <div class="col">
                        <h6>Education</h6>
                        <h5>{{$deptCount['educCount']}}</h5>
                        <label class="label-sm">TOTAL RECORDS</label>
                    </div>
                </div>
            </div>
            <div class="col border p-2 rounded border-dark me-2">
                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <a href="{{route('admin.viewDepartment', ['deptID' => '006'])}}">
                            <img src="{{asset('/img/dept_logo/ea_logo.png')}}" height="50px" width="50px">
                        </a>
                    </div>
                    <div class="col">
                        <span style="font-size: 15px">Engineering and Architecture</span>
                        <h5>{{$deptCount['eaCount']}}</h5>
                        <label class="label-sm">TOTAL RECORDS</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col border p-2 rounded border-dark me-2">
                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <a href="{{route('admin.viewDepartment', ['deptID' => '007'])}}">
                            <img src="{{asset('/img/dept_logo/nursing_logo.png')}}" height="50px" width="50px">
                        </a>
                        </div>
                    <div class="col">
                        <h6>Nursing</h6>
                        <h5>{{$deptCount['nursingCount']}}</h5>
                        <label class="label-sm">TOTAL RECORDS</label>
                    </div>
                </div>
            </div>
            <div class="col border p-2 rounded border-dark me-2">
                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <a href="{{route('admin.viewDepartment', ['deptID' => '008'])}}">
                            <img src="{{asset('/img/dept_logo/grad_logo.png')}}" height="50px" width="50px">
                        </a>
                    </div>
                    <div class="col">
                        <h6>Graduate Studies</h6>
                        <h5>{{$deptCount['gradCount']}}</h5>
                        <label class="label-sm">TOTAL RECORDS</label>
                    </div>
                </div>
            </div>
            <div class="col border p-2 rounded border-dark me-2">
                <div class="d-flex align-items-center">
                    <div class="col-3">
                        <a href="{{route('admin.viewDepartment', ['deptID' => '009'])}}">
                            <img src="{{asset('/img/dept_logo/law_logo.png')}}" height="50px" width="50px">
                        </a>
                        </div>
                    <div class="col">
                        <h6>School of Law</h6>
                        <h5>{{$deptCount['lawCount']}}</h5>
                        <label class="label-sm">TOTAL RECORDS</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection