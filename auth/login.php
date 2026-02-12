<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
</head>
    <style>
    body{
        height: 100vh;
        background-color: #f4f6f8;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .login-container {
        width: 350px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .login-page{
        background-color: #ffffff;
        width: 100%;
        padding: 30px;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        gap: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .login-page label{
        color: #333;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .login-page input{
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.3s;
        margin-bottom: 10px;
    }

    .login-page input:focus{
        outline: none;
        border-color: #4a90e2;
        box-shadow: 0 0 0 2px rgba(74,144,226,0.1);
    }

    .login-page button{
        background-color: #4a90e2;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 10px;
    }

    .login-page button:hover{
        background-color: #357ae8;
    }
    </style>

<body>
    <div class="login-container">

        <form action="" method="post" class="login-form">
            <div class="login-page">
                <h2 style="text-align: center; margin-top: 0; color: #333;">Login Admin</h2>
                <p style="text-align: center; color: #666; margin-bottom: 20px; font-size: 14px;">
                    Sistem Pengaduan Sekolah
                </p>

                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" name="submit">Login</button>
            </div>
        </form>

    </div>
    <?php
    include "../koneksi.php";

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = MD5($_POST['password']);
        $query = $koneksi->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        $data = $query->fetch_assoc();
        if ($data) {
            session_start();
            $_SESSION['username'] = $data['username'];
            $_SESSION['password'] = $data['password'];

            header("Location: ../admin/?page=aspirasi");
            exit();
        } else {
            echo "<script>alert('Username atau password salah!'); location='login.php';</script>";
            exit();
        }
    }

    ?>
</body>

</html>