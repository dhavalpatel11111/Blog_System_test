<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />

    <title>Document</title>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center flex-column bg-light">
        <h1 class="text-center">Welcome</h1>
        <div class="container d-flex justify-content-center align-items-center">
            <a href="/home" class="btn btn-outline-dark mx-3">
                < Back</a>
                    <a href="/list" class="btn btn-outline-dark mx-3">Your Post</a>
                    <a href="/alluser_list" class="btn btn-outline-dark mx-3">Explore</a>
        </div>

    </div>
    <div class="container bg-light border border-dark rounded mt-5 p-5">
        <form method="post" enctype="multipart/form-data" id="addpost" onsubmit="return false;">
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


            <button type="submit" class="btn btn-primary">Save</button>

        </form>
    </div>




















    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {


            $("#addpost").submit(function() {
                var formData = new FormData($("#addpost")[0]);
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
                        $("#addpost")[0].reset();
                        // location.href = "/list";
                        alert(response.msg);

                    }
                })
            });











        });
    </script>
</body>

</html>