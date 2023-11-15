<?php 
include_once("config.php");

if (isset($_POST["register"])) {
    // Ambil data dari form
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];
    $email = htmlspecialchars($_POST["email"]);
    $no_hp = htmlspecialchars($_POST["no_hp"]);

    // Hash password sebelum menyimpannya ke database (untuk keamanan)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk menyimpan data pengguna ke database
    $query = "INSERT INTO users (username, password, email, no_hp) VALUES ('$username', '$hashed_password', '$email', '$no_hp')";

    if (mysqli_query($conn, $query)) {
        // Registrasi berhasil, alihkan pengguna ke halaman login
        echo "
        <script>
            alert('Register berhasil!');
        </script>
        ";
        header("Location: login.php");
    } else {
        echo "
        <script>
            alert('Register gagal!');
        </script>
        ";
    }

}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="login-container row mx-auto">
            <div class="col-lg-8 mx-auto col-sm-10 col-md-10">
                <h1 class="text-center">Register</h1>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No Handphone</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <p>Sudah punya akun? <a href="login.php">Login</a></p>
                    <button type="submit" name="register" class="btn btn-primary">Register</button>
                </form>

            </div>

        </div>
    </div>




    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
