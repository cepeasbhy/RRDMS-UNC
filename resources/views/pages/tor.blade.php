@extends('layouts.app')



@section('content')
    <section>


        <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i>
            <a style="color: white" href="javascript:history.back()">BACK</a></button><br><br>
        <br>
        <form method="POST">

            <div>
                <div class="border-start border-danger border-4">
                    <h4>TRANSCRIPT OF RECORDS</h4>
                </div>
                <br>

                <div>
                    <h5 class="border-start border-danger border-4">Select school credential(s) to request and specify the
                        number of copies</h5> <br>
                </div>

                <form class="radio" action="post">
                    <p><input type="radio" name="tor" value="rr"><a>Records & References</a></p>

                    <p><input type="radio" name="tor" value="be">Board Examination</p>
                    <p><input type="radio" name="tor" value="emp">Employment</p>
                    <p><input type="radio" name="tor" value="barE">Bar Examination</p>
                    <p>
                        <input type="radio" name="tor" value="others">
                        Others
                        <input type="text" name="tor" placeholder="Please Specify">
                    </p>
                    <input type="text" name="nc" placeholder="Number of Copy"> <br><br>
                    <p><input type="submit"></p>

                </form>



            </div>
        @endsection
