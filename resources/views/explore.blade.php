<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center flex-column bg-light p-3 my-3">
        <h1 class="text-center">Welcome</h1>
        <div class="container d-flex justify-content-center align-items-center">
            <a href="/home" class="btn btn-outline-dark mx-3">
                < Back</a>
                    <a href="/list" class="btn btn-outline-dark mx-3">Your Post</a>
                    <a href="/create" class="btn btn-outline-dark mx-3">Create Post</a>

        </div>

    </div>



    <div class="container ">
        <h1 class="text-center my-3">explore</h1>

        <div class="row m-3">

            <?php

            use Illuminate\Support\Facades\Auth;

            for ($i = 0; $i < count($results); $i++) {

                if (Auth::user()->id == $results[$i]->id) {
                    continue;
                } else {

            ?>


                    <div class="col-sm-4 mb-4">
                        <div class="card bg-light">
                            <div class="card-body  d-flex justify-content-center align-items-center">
                                <h5 class="card-title mx-5 px-5"><?php echo $results[$i]->name; ?></h5>
                                <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                                <button class="btn btn-outline-primary follow" id="<?php echo $results[$i]->id;   ?>">Follow</button>
                            </div>
                        </div>
                    </div>


            <?php
                }
            }
            ?>







        </div>

    </div>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {








            $(document).on("click", ".follow", function() {

                var id = $(this).attr("id");
                $(this).html("Followed");

                $.ajax({
                    url: "/addto_you_foloow",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id
                    },
                    success: function(responce) {
                        console.log('responce:', responce)
                        alert(responce.msg);
                        location.reload();
                    }
                })




            })




















































        })
    </script>
</body>

</html>