@extends('layouts.app')



@section('content')
    <section>


        <button class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i>
            <a style="color: white" href="javascript:history.back()">BACK</a></button><br><br>



        <br>
        <form method="POST">

            <div>
                <div class="border-start border-danger border-4">
                    <h4>DIPLOMA</h4>
                </div>
                <br>

                <div>
                    <h5 class="border-start border-danger border-4">Select school credential(s) to request and specify the
                        number of copies</h5> <br>
                </div>

                <form class="radio" action="post">
                    <p><input type="radio" name="dp" value="bl"><a>BACHELOR/ LAW</a></p>

                    <p><input type="radio" name="dp" value="grad">GRADUATE</p>
                    <p><input type="radio" name="dp" value="tesda">TESDA</p>
                    <p><input type="radio" name="dp" value="cg">CARE GIVING</p>
                    <input type="text" name="dp" placeholder="Number of Copy"> <br><br>
                    <p><input type="submit"></p>

                </form>



            </div>
        @endsection
