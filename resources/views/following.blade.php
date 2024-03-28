<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>




    <div class="container d-flex justify-content-center align-items-center flex-column bg-light">
        <h3 class="text-center p-3 bg-light m-2">You Follow This people</h3>


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
                        <button class="btn btn-outline-primary follow" id="<?php echo $userdata[$i][0]['id'];   ?>">Unfollow</button>
                    </div>
                </div>
            </div>






        </div>





    <?php
    }
    ?>
</body>

</html>