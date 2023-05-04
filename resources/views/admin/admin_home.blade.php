@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="main-container" style="max-width: 80%; margin-top: 1rem">
        <h4 class="head-container request-head">ADMIN TOOLS</h4>
        <span class="badge bg-danger mb-2">{{ session('errorMsg') }}</span>
        <span class="badge bg-success mb-2">{{ session('successMsg') }}</span>
        <div class="flex-container tri-button-container">
            <div class="print" style="text-align: center">
                <a style="text-decoration: none; color: white" href="{{ route('admin.viewAccounts') }}"
                    rel="noopener noreferrer">ACCOUNT
                    MANAGEMENT</a>
            </div>
            <div>
                <button class="print" data-bs-toggle="modal" data-bs-target="#admin-export-grad">EXPORT LIST OF
                    GRADUATES</button>
            </div>
            <div>
                <button class="print" data-bs-toggle="modal" data-bs-target="#admin-export-stud">EXPORT LIST OF
                    STUDENTS</button>
            </div>
            <div>
                <button class="print" data-bs-toggle="modal" data-bs-target="#admin-rec-prices">MANAGE RECORD
                    PRICES</button>
            </div>
        </div>

        <div style="margin-top: 2rem">
            <div class="head-container request-head">
                <h4>RECORDS OVERVIEW</h4>
            </div>
            <div class="grid-container wide-gap grid-departments" style="width: 100%">
                <div class="department-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '001']) }}">
                        <div class="flex-container department-card__contents">
                            <img src="{{ asset('/img/dept_logo/as_logo.png') }}" height="50px" width="50px">
                            <div class="user-info">
                                <h6>Arts and Science</h6>
                                <h5>{{ $deptCount['asCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="department-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '002']) }}">
                        <div class="flex-container department-card__contents">
                            <img src="{{ asset('/img/dept_logo/cba_logo.png') }}" height="50px" width="50px">
                            <div class="user-info">
                                <h6>Business and Accountancy</h6>
                                <h5>{{ $deptCount['cbaCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="department-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '003']) }}">
                        <div class="flex-container department-card__contents">
                            <img src="{{ asset('/img/dept_logo/cs_logo.png') }}" height="50px" width="50px">
                            <div class="user-info">
                                <h6>Computer Studies</h6>
                                <h5>{{ $deptCount['csCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="department-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '004']) }}">
                        <div class="flex-container department-card__contents">
                            <img src="{{ asset('/img/dept_logo/cje_logo.png') }}" height="50px" width="50px">
                            <div class="user-info">
                                <h6>Criminal Justice Education</h6>
                                <h5>{{ $deptCount['cjeCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="department-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '005']) }}">
                        <div class="flex-container department-card__contents">
                            <img src="{{ asset('/img/dept_logo/educ_logo.png') }}" height="50px" width="50px">
                            <div class="user-info">
                                <h6>Education</h6>
                                <h5>{{ $deptCount['educCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="department-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '006']) }}">
                        <div class="flex-container department-card__contents">
                            <img src="{{ asset('/img/dept_logo/ea_logo.png') }}" height="50px" width="50px">
                            <div class="user-info">
                                <span style="font-size: 15px">Engineering and Architecture</span>
                                <h5>{{ $deptCount['eaCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="department-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '007']) }}">
                        <div class="flex-container department-card__contents">
                            <img src="{{ asset('/img/dept_logo/nursing_logo.png') }}" height="50px" width="50px">
                            <div class="user-info">
                                <h6>Nursing</h6>
                                <h5>{{ $deptCount['nursingCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="department-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '008']) }}">
                        <div class="flex-container department-card__contents">
                            <img src="{{ asset('/img/dept_logo/grad_logo.png') }}" height="50px" width="50px">
                            <div class="user-info">
                                <h6>Graduate Studies</h6>
                                <h5>{{ $deptCount['gradCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="department-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '009']) }}">
                        <div class="flex-container department-card__contents">
                            <img src="{{ asset('/img/dept_logo/law_logo.png') }}" height="50px" width="50px">
                            <div class="user-info">
                                <h6>School of Law</h6>
                                <h5>{{ $deptCount['lawCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>


    </section>


    @extends('layouts.modals.exportStudListModal')
    @extends('layouts.modals.exportGradListModal')
    @extends('layouts.modals.recPricesModal')
@endsection
