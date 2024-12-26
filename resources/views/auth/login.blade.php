
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
        }
        .card {
            display: flex;
            width: 700px;
            height: 550px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
        }
        .card .left {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: green;
        }
        .card .left img {
            width: 300px;
            height: 300px;
            object-fit: cover;
            border-radius: 50%;
        }
        .card .right {
            width: 50%;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .card h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }
        .form-group input {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group button {
            width: 95%;
            padding: 10px;
            margin-top: 50px;
            background-color: green;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: grey;
            color: green;
        }
        .form-show{
            display: flex;
            justify-content: start;
            font-size: 14px;
            color: #555;
        }
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0;
            font-size: 14px;
            color: #555;
        }
        .form-footer a {
            text-decoration: none;
            color: green;
        }
        .form-footer a:hover {
            text-decoration: underline;
        }
        .signup {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }
        .signup a {
            text-decoration: none;
            color: green;
        }
        .signup a:hover {
            text-decoration: underline;
        }
        .role {
        margin: 15px 0;
        font-family: Arial, sans-serif;
    }
    .role label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        color: green;
    }
    .role select {
        width: 90%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        color: green;
        background-color: white;
        cursor: pointer;
    }
    .role select option {
        background-color: green;
        color: white;
        padding: 5px;
    }
    .role select:focus {
        outline: none;
        border-color: green;
        box-shadow: 0 0 5px rgba(0, 128, 0, 0.5);
    }
    </style>
</head>
<body>
    <div class="card">
        <!-- Left side: Circular Image -->
        <div class="left">
            <img src="img/FARML.png" alt="Profile Image">
        </div>

        <!-- Right side: Form -->
        <div class="right">
            <h1>Login</h1>
            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <label>
                <div class="form-show">
                <input type="checkbox" id="show-password" onclick="togglePassword()">Show Password
                </label>
                </div>
                <div class="role">
    <label for="role">Select Role:</label>
    <select name="role" required>
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>
</div>
                <div class="form-footer">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                    <!-- <a href="{{ url('/forgot-password') }}">Forgot Password?</a> -->
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
            </form>
            <div class="signup">
                Don't have an account? <a href="{{ url('/register') }}">Sign up Now</a>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
