<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('login-form-20/css/style.css')}}">

</head>

<body class="img js-fullheight" style="background-image: url(login-form-20/images/snow.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section"><strong class="text-dark">PPG</strong> | <strong class="text-warning">Gilang</strong></h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center"> <strong> Masuk</strong></h3>
                        <form class="signin-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password-field" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3"><strong>Log In</strong></button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50 text-md-left">
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" style="color: #fff">
                                        Lupa Password ?
                                    </a>
                                    @endif
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="{{url('register')}}"> <strong>Register</strong> <i class="bi bi-arrow-right"></i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                        </svg></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="{{ asset('login-form-20/js/jquery.min.js')}}"></script>
    <script src="{{ asset('login-form-20/js/popper.js')}}"></script>
    <script src="{{ asset('login-form-20/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('login-form-20/js/main.js')}}"></script>
</body>

</html>
