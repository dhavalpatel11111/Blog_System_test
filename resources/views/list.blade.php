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






    <!-- Modal -->
    <div class="modal fade" id="editpost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" id="Updatepost" onsubmit="return false;">
                        @csrf
                        <input type="hidden" name="hid" id="hid">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                            <label for="title" class="form-label">Title</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Leave a comment here" id="post" style="height: 250px" name="post"></textarea>
                            <label for="floatingTextarea2">Post Content</label>
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>

                    </form>
                </div>
            </div>
        </div>
    </div>





































    <div class="container d-flex justify-content-center align-items-center flex-column bg-light my-3">
        <h1 class="text-center">Welcome</h1>
        <div class="container d-flex justify-content-center align-items-center">
            <a href="/home" class="btn btn-outline-dark mx-3">
                < Back</a>
                    <a href="/create" class="btn btn-outline-dark mx-3">Create Post</a>

                    <a href="/alluser_list" class="btn btn-outline-dark mx-3">Explore</a>
        </div>

    </div>

    <div class="container d-flex  justify-content-center align-items-center border border-dark rounded bg-light px-5 flex-wrap">

        <?php

        use Illuminate\Support\Facades\Auth;

        if (empty($post)) {
            echo "<h1 class='text-center text-light'>You didn't Post </h1>";
        } else {



            for ($i = 0; $i < count($post); $i++) {

        ?>
                <div class="container my-2 d-flex flex-column justify-content-center align-items-center p-2" style="width: 500px;">
                    <div class="card border border-dark rounded " style="width: 400px; height: auto;">
                        <div class="card-header bg-dark text-light">
                            <h5 class="card-title"><?php echo Auth::user()->name; ?></h5>

                        </div>
                        <div class="card-body  d-flex  justify-content-center align-items-center flex-column bg-light">
                            <h5 class="card-title mb-2  "> Title : <?php echo $post[$i]['title'];  ?></h5>
                            <p class="card-text text-break"><strong>Discription :</strong> <?php echo $post[$i]['post'] ?></p>



                        </div>

                        <div class="card-footer d-flex flex-column justify-content-center align-items-center bg-dark text-light">
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button class="btn btn-outline-danger delete" id="<?php echo $post[$i]['id']; ?>">Delete Post</button>
                                <button class="btn btn-outline-success edit" id="<?php echo  $post[$i]['id']; ?>">Edit Post</button>
                            </div>
                        </div>

                    </div>
                </div>

        <?php
            }
        }
        ?>

    </div>

    .

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {

            $("#Updatepost").submit(function() {
                var formData = new FormData($("#Updatepost")[0]);
                $.ajax({
                    url: "/add",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        // $("#addpost")[0].reset();
                        // location.href = "/list";
                        alert(response.msg);
                        $("#hid").val("");
                        $('#editpost').modal('hide');
                        location.reload();


                    }
                })
            });



            $(document).on("click", ".delete", function() {
                var id = $(this).attr("id");
                $.ajax({
                    url: "/delete",
                    type: 'POST',
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('response:', response);
                        alert(response.msg);
                        location.reload();

                    }
                })
            })


            $(document).on("click", ".edit", function() {
                $('#editpost').modal('show');

                var id = $(this).attr("id");
                $.ajax({
                    url: "/edit",
                    type: 'POST',
                    data: {
                        id: id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // console.log('response:', response.title);
                        // alert(response.msg);
                        // location.reload();
                        $("#title").val(response.title);
                        $("#post").val(response.post);
                        $("#hid").val(response.id);
                    }
                })
            })











        })
    </script>
</body>

</html>