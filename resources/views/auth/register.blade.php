<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            height: 500px;
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
            width: 270px;
            height: 270px;
            object-fit: cover;
            border-radius: 50%;
        }
        .card .right {
            width: 60%;
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
        .login {
            margin-top: 15px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }
        .login a {
            text-decoration: none;
            color: green;
        }
        .login a:hover {
            text-decoration: underline;
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
            <h1>Sign Up</h1>
            <form action="{{ url('/register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" name="password_confirmation" required>
                </div>
                <!-- Hidden Role Field -->
                <input type="hidden" name="role" value="user">
                <div class="form-group">
                    <button type="submit">Register</button>
                </div>
            </form>
            <div class="login">
                Already have an account? <a href="{{ url('/login') }}">Log in Now</a>
            </div>
        </div>
    </div>
</body>
</html>
