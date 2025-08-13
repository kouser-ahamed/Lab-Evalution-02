<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <h2>User Registration</h2>
    <form method="POST">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit" name="register">Register</button>
    </form>

    <?php
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
        echo "Registration successful! <a href='login.php'>Login</a>";
    }
    ?>
</body>

</html>