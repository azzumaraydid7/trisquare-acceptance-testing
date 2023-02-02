<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .select2-container .select2-selection--single {
            height: calc(3.5rem + 2px);
            line-height: 1.25;
            padding: 1rem 0.75rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image for card set in CSS! -->
                    </div>
                    <div class="card-body p-4 p-sm-5">
                        <form id="register-form" onsubmit="return false">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInputUsername" name="name" placeholder="myusername" autofocus>
                                <label for="floatingInputUsername">Username</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInputEmail" name="email" placeholder="name@example.com">
                                <label for="floatingInputEmail">Email address</label>
                            </div>

                            <hr>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPasswordConfirm" name="password_confirmation" placeholder="Confirm Password">
                                <label for="floatingPasswordConfirm">Confirm Password</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="dateOfBirth" name="dob">
                                <label for="dateOfBirth">Date of Birth</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="js-example-basic-single form-control" name="country">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $key => $co)
                                        <option value="{{ $co }}">{{ $co }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-grid mb-2">
                                <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            $("#register-form").submit(() => {
                var formdata = new FormData($("#register-form")[0]);
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }

                $.ajax({
                    url: "{{ URL::to('api/register') }}",
                    type: "POST",
                    data: formdata,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        console.log(formdata)
                    },
                    success: function(response) {
                        toastr.success(response.message)
                        window.location.href = "{{ URL::to('users') }}"
                    },
                    error: function(response, a, b) {
                        var json_data = response.responseJSON.errors;
                        var result = [];

                        for (var i in json_data) {
                            result.push([json_data[i]]);
                        }

                        result.forEach(element => {
                            toastr.error(element)
                        });
                    }
                })
            })
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
</body>

</html>
