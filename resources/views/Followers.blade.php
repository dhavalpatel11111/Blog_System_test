<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>











    <div class="container d-flex justify-content-center align-items-center flex-column bg-light">
        <h3 class="text-center p-3 bg-light m-2"> This people Follow You</h3>

        <div class="container d-flex justify-content-center align-items-center">
            <a href="/create" class="btn btn-outline-dark mx-3">Create Post</a>
            <a href="/list" class="btn btn-outline-dark mx-3">Your Post</a>
            <a href="/alluser_list" class="btn btn-outline-dark mx-3">Explore</a>


        </div>

    </div>























    <?php

    for ($i = 0; $i < count($userdata); $i++) {

    ?>

        <div class="row m-3">


            <div class="col-sm-4 mb-4">
                <div class="card bg-light">
                    <div class="card-body  d-flex justify-content-center align-items-center">
                        <h5 class="card-title mx-5 px-5"><?php echo $userdata[$i][0]['name']; ?></h5>
                        <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                        <button class="btn btn-outline-primary follow" id="<?php echo $userdata[$i][0]['id'];   ?>">Follow</button>
                    </div>
                </div>
            </div>






        </div>





    <?php
    }
    ?>


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