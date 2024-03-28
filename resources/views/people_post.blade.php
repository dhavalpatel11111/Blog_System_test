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
    <h1 class="text-center my-3 bg-light p-3">People Post</h1>
    <div class="container my-2 d-flex  justify-content-center align-items-center p-2 flex-wrap" style="width: auto;">
        <?php



        foreach ($ConfirmData as $key => $value) {

            if (!empty($value)) {
                foreach ($value as $key => $value2) {

        ?>




                    <div class="card m-3 border border-dark rounded" style="width: 400px; height: auto;">
                        <div class="card-header bg-dark text-light">
                            <h5 class="card-title"><?php

                                                    for ($i = 0; $i < count($user); $i++) {
                                                        if ($value2['userid'] == $user[$i][0]['id']) {
                                                            echo $user[$i][0]['name'];
                                                        }
                                                    }

                                                    ?></h5>

                        </div>
                        <div class="card-body  d-flex  justify-content-center align-items-center flex-column">
                            <h5 class="card-title mb-2  "> Title : <?php echo $value2['title'];  ?></h5>
                            <p class="card-text text-break"><strong>Post :</strong> <?php echo $value2['post'];   ?></p>
                        </div>



                        <div class="card-footer d-flex flex-column justify-content-center align-items-center bg-dark text-light">
                            <a href="#" class="like text-light" id="<?php echo $value2['id'];   ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                </svg>
                            </a>

                            <a href="#" class="dis_like text-light" id="<?php echo $value2['id'];   ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                </svg>
                            </a>
                        </div>


                    </div>

        <?php

                }
            }
        }
        ?>

    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {
            $(".dis_like").hide();


            $(document).on("click", ".like", function() {
                $(this).hide();
                $(this).siblings(".dis_like").show();
                var id = $(this).attr("id");
                $.ajax({
                    url: "/like",
                    data: {
                        id: id
                    },
                    cache: false,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('response from like:', response);
                        alert(response.msg);

                    }
                })

            })


            $(document).on("click", ".dis_like", function() {
                $(this).hide();
                $(this).siblings(".like").show();
                var id = $(this).attr("id");
                $.ajax({
                    url: "/dislike",
                    data: {
                        id: id
                    },
                    cache: false,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('response from like:', response);
                        alert(response.msg);

                    }
                })

            })


        })
    </script>
</body>

</html>