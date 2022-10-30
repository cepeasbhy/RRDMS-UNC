@extends('layouts.app')


@section('content')
    <section>

        <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i>
            <a style="color: white" href="javascript:history.back()">BACK</a></button><br><br>
        <br>
        <form method="POST">

            <div>
                <div class="border-start border-danger border-4">
                    <h4>Request Form</h4>
                </div>
                <br>

                <div>
                    <h5 class="border-start border-danger border-4">Select school credential(s) to request and specify the
                        number of copies</h5> <br>
                </div>

                <div>
                    <h5 class="border-start border-danger border-4">Credentials</h5><br>

                </div>

                <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i>
                    <a style="color: white" href="diploma">DIPLOMA</a></button><br><br>

                <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i>
                    <a style="color: white" href="tor">TRANSCRIPT OF RECORDS</a></button><br><br>

                <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i>
                    <a style="color: white" href="certification">CERTIFICATION</a></button><br><br>

                <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i>
                    <a style="color: white" href="authentication">AUTHENTICATION</a></button><br><br>

                <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i>
                    <a style="color: white" href="photoCopy">PHOTO COPY</a></button><br><br>



            </div>
            <div class="border-start border-danger border-4">
                <h4 class="ms-3">REQUESTED RECORDS</h4>




            </div>
        @endsection
