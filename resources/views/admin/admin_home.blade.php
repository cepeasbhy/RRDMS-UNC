@extends('layouts.app')
@extends('layouts.header')

@section('content')
    <section class="admin">
        <h1>Admin Panel</h1>
        <span class="badge bg-danger mb-2">{{ session('errorMsg') }}</span>
        <span class="badge bg-success mb-2">{{ session('successMsg') }}</span>
        <section class="admin__tools">
            <h2>Tools</h2>
            <div class="admin__tools--shortcut">
                <a class="green-button button-design button-design__link" href="{{ route('admin.viewAccounts') }}"
                    rel="noopener noreferrer">
                    Account Management
                </a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#admin-export-grad">
                    Export List of Graduates
                </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#admin-export-stud">EXPORT
                    List of Students
                </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#admin-rec-prices">MANAGE
                    Record Prices
                </button>
            </div>
        </section>

        <section class="admin__cards">
            <h2>Records Overview</h2>
            <div class="admin__cards--group">
                <div class="admin__cards--group-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '001']) }}">
                        <div class="contents">
                            <img src="{{ asset('/img/dept_logo/as_logo.png') }}" height="50px" width="50px">
                            <div class="department-info">
                                <h6>Arts and Science</h6>
                                <h5>{{ $deptCount['asCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="admin__cards--group-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '002']) }}">
                        <div class="contents">
                            <img src="{{ asset('/img/dept_logo/cba_logo.png') }}" height="50px" width="50px">
                            <div class="department-info">
                                <h6>Business and Accountancy</h6>
                                <h5>{{ $deptCount['cbaCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="admin__cards--group-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '003']) }}">
                        <div class="contents">
                            <img src="{{ asset('/img/dept_logo/cs_logo.png') }}" height="50px" width="50px">
                            <div class="department-info">
                                <h6>Computer Studies</h6>
                                <h5>{{ $deptCount['csCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="admin__cards--group-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '004']) }}">
                        <div class="contents">
                            <img src="{{ asset('/img/dept_logo/cje_logo.png') }}" height="50px" width="50px">
                            <div class="department-info">
                                <h6>Criminal Justice Education</h6>
                                <h5>{{ $deptCount['cjeCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="admin__cards--group-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '005']) }}">
                        <div class="contents">
                            <img src="{{ asset('/img/dept_logo/educ_logo.png') }}" height="50px" width="50px">
                            <div class="department-info">
                                <h6>Education</h6>
                                <h5>{{ $deptCount['educCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="admin__cards--group-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '006']) }}">
                        <div class="contents">
                            <img src="{{ asset('/img/dept_logo/ea_logo.png') }}" height="50px" width="50px">
                            <div class="department-info">
                                <span style="font-size: 15px">Engineering and Architecture</span>
                                <h5>{{ $deptCount['eaCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="admin__cards--group-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '007']) }}">
                        <div class="contents">
                            <img src="{{ asset('/img/dept_logo/nursing_logo.png') }}" height="50px" width="50px">
                            <div class="department-info">
                                <h6>Nursing</h6>
                                <h5>{{ $deptCount['nursingCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="admin__cards--group-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '008']) }}">
                        <div class="contents">
                            <img src="{{ asset('/img/dept_logo/grad_logo.png') }}" height="50px" width="50px">
                            <div class="department-info">
                                <h6>Graduate Studies</h6>
                                <h5>{{ $deptCount['gradCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="admin__cards--group-card">
                    <a href="{{ route('admin.viewDepartment', ['deptID' => '009']) }}">
                        <div class="contents">
                            <img src="{{ asset('/img/dept_logo/law_logo.png') }}" height="50px" width="50px">
                            <div class="department-info">
                                <h6>School of Law</h6>
                                <h5>{{ $deptCount['lawCount'] }}</h5>
                                <label class="label-sm">TOTAL RECORDS</label>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </section>


    </section>


    @extends('layouts.modals.exportStudListModal')
    @extends('layouts.modals.exportGradListModal')
    @extends('layouts.modals.recPricesModal')
@endsection
