<?php
session_start();
include 'php/database.php'; // Include your database connection file

if (isset($_SESSION['user_id'])) {
    header('Location: start.php'); // Redirect logged-in users to the main page
    exit();
}

$username = $password = $confirmPassword = "";
$username_err = $password_err = $confirmPassword_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirmPassword_err = "Please confirm your password.";
    } else {
        $confirmPassword = trim($_POST["confirm_password"]);
        if ($password != $confirmPassword) {
            $confirmPassword_err = "Passwords do not match.";
        }
    }

    if (empty($username_err) && empty($password_err) && empty($confirmPassword_err)) {
        $sql = "SELECT user_id FROM users WHERE username = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
                        $param_username = $username;
                        $param_password = password_hash($password, PASSWORD_DEFAULT);
                        if (mysqli_stmt_execute($stmt)) {
                            header("location: login.php");
                        } else {
                            echo "Something went wrong. Please try again later.";
                        }
                        mysqli_stmt_close($stmt);
                    }
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - DragonBall Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        section {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
            background-image: url(img/kamehouse.jpg);
            background-size: cover;
            background-position: center;
        }

        .login-box {
            position: relative;
            width: 400px;
            height: 500px;
            background: rgba(0, 0, 0, 0.3);
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(15px);
            flex-direction: column;
            padding: 20px;
        }

        h2 {
            font-size: 2.5em;
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
            font-family: 'Pacifico', cursive;
        }

        .input-box {
            position: relative;
            width: 310px;
            margin: 20px 0;
        }

        .input-box label {
            position: absolute;
            top: -20px;
            left: 5px;
            font-size: 1em;
            color: #fff;
            pointer-events: none;
            transition: .5s;
        }

        .input-box input:focus~label,
        .input-box input:valid~label {
            top: -5px;
            font-size: 0.8em;
        }

        .input-box input {
            width: 100%;
            height: 50px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            color: #fff;
            padding: 0 35px 0 5px;
        }

        .input-box .icon {
            position: absolute;
            left: -29px;
            color: #fff;
            font-size: 1.5em;
            line-height: 43px;
        }

        .input-box .underline {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #fff;
            transform: scaleX(0);
            transition: transform 0.3s ease-in-out;
        }

        .input-box input:focus ~ .underline,
        .input-box input.valid ~ .underline {
            transform: scaleX(1);
        }

        .input-box .eye-icon {
            position: absolute;
            right: 8px;
            color: #fff;
            font-size: 1.2em;
            line-height: 57px;
            cursor: pointer;
        }

        .remember-forget {
            margin: 15px 0;
            font-size: .9em;
            color: #fff;
            display: flex;
            justify-content: space-between;
        }

        .remember-forget label input {
            margin: right 3px;
        }

        .remember-forget a {
            color: #fff;
            text-decoration: none;
        }

        .remember-forget a:hover {
            text-decoration: underline;
        }

        button {
            width: 100%;
            height: 40px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            cursor: pointer;
            font-size: 1em;
            color: #000;
            font-weight: 500;
        }

        .register-link {
            font-size: .9em;
            color: #fff;
            text-align: center;
            margin: 15px 0 10px;
        }

        .register-link p a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link p a:hover {
            text-decoration: underline;
        }

        .notice {
            color: #fff;
            text-align: center;
            margin-top: 20px;
        }
    </style>
    </style>
</head>
<body>

<section>
    <div class="login-box">
        <h2>User Registration</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-box">
                <input type="text" name="username" id="username" required>
                <label for="username">Username</label>
                <div class="underline"></div>
                <!-- Username icon -->
                <i class="icon fa fa-user"></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
                <div class="underline"></div>
                <!-- Password icon -->
                <i class="icon fa fa-lock"></i>
                <!-- Eye icon for password -->
                <i class="eye-icon fa fa-eye"></i>
            </div>
            <div class="input-box">
                <input type="password" name="confirm_password" id="confirm_password" required>
                <label for="confirm_password">Confirm Password</label>
                <div class="underline"></div>
                <!-- Confirm Password icon -->
                <i class="icon fa fa-check-circle"></i>
                <!-- Eye icon for confirm password -->
                <i class="eye-icon fa fa-eye"></i>
            </div>
            <button type="submit" name="register">Register</button>
            <div class="register-link">
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </div>
        </form>
        <?php if (!empty($username_err) || !empty($password_err) || !empty($confirmPassword_err)): ?>
            <div class="notice">
                <p><?php echo $username_err; ?></p>
                <p><?php echo $password_err; ?></p>
                <p><?php echo $confirmPassword_err; ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
    // JavaScript for password visibility toggling
    const passwordFields = document.querySelectorAll('input[type="password"]');
    const eyeIcons = document.querySelectorAll('.eye-icon');

    eyeIcons.forEach((icon, index) => {
        icon.addEventListener('click', () => {
        const type = passwordFields[index].getAttribute('type') === 'password' ? 'text' : 'password';
        passwordFields[index].setAttribute('type', type);
        icon.classList.toggle('fa-eye-slash');
        });
    });
</script>

</body>
</html>
