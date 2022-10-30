@extends('layouts.app')



@section('content')
    <section>


        <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i>
            <a style="color: white" href="javascript:history.back()">BACK</a></button><br><br>
        <br>
        <form method="POST">

            <div>
                <div class="border-start border-danger border-4">
                    <h4>Photo Copy</h4>
                </div>
                <br>

                <div>
                    <h5 class="border-start border-danger border-4">Select school credential(s) to request number of copies
                    </h5> <br>
                </div>

                <form class="radio" action="post">
                    <p><input type="radio" name="auth" value="tor"><a>TOR</a></p>

                    <p><input type="radio" name="auth" value="diploma">Diploma</p>
                    <p><input type="radio" name="auth" value="cert">Certification</p>


                    <p><input type="submit"></p>

                </form>



            </div>
        @endsection
