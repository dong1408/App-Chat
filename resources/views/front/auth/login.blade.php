<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>

    <link rel="stylesheet" href="{{ url('frontend/css/style.css') }}">
</head>

<body>
    <div class="main">
        <section class="signup">

            <div class="container">
                <div class="signup-content">

                    <form id="signup-form" class="signup-form" method="POST" action="{{ url('login') }}">
                        @csrf
                        <!--    <img src="images/logo.svg" alt="">-->
                        <h2 class="form-title">Login Here</h2>
                        <div class="form-group">
                            <input type="email" class="form-input" value="{{ old('email') }}" name="email"
                                id="email" placeholder="Your Email" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="password" id="password"
                                placeholder="Password" />
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        @error('email')
                            <div style="color: red">{{ $message }}</div>
                        @enderror

                        @error('password')
                            <div style="color: red">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign in" />
                        </div>
                    </form>
                    <p class="loginhere">
                        New User? <a href="reg-form.html" class="loginhere-link">Register here</a>
                    </p>
                </div>
            </div>
        </section>
    </div>
</body>

</html>