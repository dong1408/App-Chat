<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <link rel="stylesheet" href="{{ url('frontend/css/style.css') }}">
</head>

<body>
    <div class="main">
        <section class="signup">

            <div class="container">
                <div class="signup-content">

                    <form id="signup-form" class="signup-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <h2 class="form-title">Register Here</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" value="{{ old('name') }}" name="name" id="name"
                                placeholder="Your Name" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" value="{{ old('email') }}" name="email"
                                id="email" placeholder="Your Email" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password"
                                placeholder="Password" />
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password_confirmation"
                                id="password_confirmation" placeholder="Confirm Password" />
                        </div>
                        @error('name')
                            <div style="color: red">{{ $message }}</div>
                        @enderror

                        @error('email')
                            <div style="color: red">{{ $message }}</div>
                        @enderror

                        @error('password')
                            <div style="color: red">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Register" />
                        </div>
                    </form>
                    <p class="loginhere">
                        Already have an account? <a href="{{ route('login') }}" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>
    </div>
</body>

</html>