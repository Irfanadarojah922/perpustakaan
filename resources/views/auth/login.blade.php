<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Pustaka Pintar | Login</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('assets/bg-login.jpg') no-repeat;
            background-size: cover;
            background-position: center;
        }

        .wrapper {
            width: 420px;
            background: transparent;
            border: 2px solid(255, 255, 255, .2);
            backdrop-filter: blur(5px);
            box-shadow: 0 0 10px rgba(193, 187, 187, 0.2);
            color: white;
            border-radius: 10px;
            padding: 30px 40px;
        }

        .wrapper h1 {
            font-size: 36px;
            text-align: center;
        }

        .wrapper .input-box {
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 40px;
            font-size: 16px;
            color: white;
            padding: 20px 45px 20px 20px;

        }

        .input-box input::placeholder {
            color: white;
        }

        .input-box i {
            position: absolute;
            right: 50px;
            top: 35%;
            transform: translateY(-50%);
            font-size: 20px;
        }

        .wrapper .remember-forgot {
            display: flex;
            justify-content: space-between;
            font-size: 14.5px;
            margin: -15px 0 15px;
        }

        .remember-forgot label input {
            accent-color: white;
            margin-right: 3px;
        }

        .remember-forgot a {
            color: white;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .wrapper .btn {
            width: 100%;
            height: 45px;
            background: white;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #000000;
            font-weight: 600;
        }

        .wrapper .register-link {
            font-size: 14.5px;
            text-align: center;
            margin: 20px 0 15px;
        }

        .register-link p a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="wrapper">
        <form action="{{route('login')}}" method="post">
            @csrf
            <h1>Login</h1>

            <div class="input-box">
                <input type="text" placeholder="Username" name="email" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" name="password" required>
            </div>

            @if ($errors->has('email') || $errors->has('password'))
                <div class="alert alert-danger mt-2">
                    {{ $errors->first('email') ?: $errors->first('password') }}
                </div>
            @endif


            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me </label>
                <a href="#">Forgot password</a>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register link">
                <p> Don't have a account ?
                    <a href="#"> Register </a>
                </p>
            </div>
        </form>
    </div>
    {{-- <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="col-md-4">
            <div class="card border-0 shadow rounded">
                <div class="card-body">

                    <h4 class="font-weight-bold">LOGIN</h4>
                    <hr>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-bold text-uppercase">Email address</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Masukkan Alamat Email">
                            @error('email')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-uppercase">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukkan Password">
                            @error('password')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">LOGIN</button>
                        <hr>

                        <a href="/forgot-password">Lupa Password ?</a>

                    </form>
                </div>
            </div>
            <div class="register mt-3 text-center">
                <p>Belum punya akun ? Daftar <a href="/register">Disini</a></p>
            </div>
        </div>
    </div> --}}

</body>

</html>