@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center flex-column bg-light">
    <h1 class="text-center">Welcome</h1>
    <div class="container d-flex justify-content-center align-items-center">
        <a href="/create" class="btn btn-outline-dark mx-3">Create Post</a>
        <a href="/list" class="btn btn-outline-dark mx-3">Your Post</a>
        <a href="/people_post" class="btn btn-outline-dark mx-3">People Post</a>
        <a href="/alluser_list" class="btn btn-outline-dark mx-3">Explore</a>
        
        <div class="container bg-light d-flex justify-content-center align-items-center" style="width: 300px; margin: 0; padding: 0;">


                <a href="/following" class="btn btn-outline-info pt-3 m-1">
                    <h5 class="text-center text-dark" id="following"><?php echo $data; ?> following</h5>
                </a>

                <a href="/Followers" class="btn btn-outline-info pt-3 m-1">
                    <h5 class=" text-center text-dark"><?php echo $Followers; ?> Followers</h5>

                </a>




        </div>








    </div>

</div>

@endsection