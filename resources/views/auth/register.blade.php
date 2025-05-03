<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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

            margin-top: 40px;
            margin-bottom: 40px;
        }

        .wrapper h1 {
            font-size: 36px;
            text-align: center;
        }

        .wrapper .input-box {
            width: 100%;
            height: 50px;
            margin: 30px 0;
            border-bottom: 2px solid #162938;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            /* border: 2px solid rgba(255, 255, 255, .2);
    border-radius: 40px; */
            font-size: 16px;
            color: white;
            padding: 20px 45px 20px 20px;
            border-bottom: 2px solid rgba(78, 73, 73, 0.652);
        }

        .input-box input:focus {
            border-bottom: 2px solid #dfeaea;
        }


        .input-box input::placeholder {
            color: gray;
        }

        .input-box input:focus::placeholder {
            color: transparent;
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
            margin-bottom: 20px;
        }

        .wrapper .register-link {
            font-size: 14.5px;
            text-align: center;
            margin: 30px 0 15px;
        }

        .register-link p a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
        }

        .register-link p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="wrapper">

        <div class="registrasi">
            <form action="">
                <h1>Registration</h1>

                <div class="input-box">
                    <input type="text" placeholder="No. NIK" name="anggota_id" required>
                </div>

                <div class="input-box">
                    <input type="text" placeholder="Nama Lengkap" name="nama" required>
                </div>

                <div class="input-box">
                    <input type="date" placeholder="Tempat Lahir" name="tempat_lahir" required>
                </div>

                <div class="input-box">
                    <input type="date" placeholder="Tanggal Lahir" name="tanggal_lahir" required>
                </div>

                <div class="input-box">
                    <input type="text" placeholder="Jenis Kelamin" name="jenis_kelamin" required>
                </div>

                <div class="input-box">
                    <input type="text" placeholder="Alamat" name="alamat" required>
                </div>

                <div class="input-box">
                    <input type="text" placeholder="No. Telepon" name="no_telepon" required>
                </div>

                <div class="input-box">
                    <input type="email" placeholder="E-mail" name="email" required>
                </div>

                <div class="input-box">
                    <input type="text" placeholder="Password" name="password" required>
                </div>


                <div class="remember-forgot">
                    <label>
                        <input type="checkbox"> I agree to the terms & conditions
                    </label>
                </div>

                <button type="submit" class="btn"> Register </button>

                <div class="register link">
                    <p> Already have account ?
                        <a href="#"> Login </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

</body>

</html>