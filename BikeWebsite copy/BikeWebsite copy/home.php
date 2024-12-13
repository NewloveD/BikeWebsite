
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: #E6F7FF;
            font-family: Arial, sans-serif;
        }
        form {
            width: 300px;
            margin: 100px auto;
            padding: 30px;
            background: #fff;
            border: 1px solid #ddd;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <form action="authenticate.php" method="post">
        <div><label>Username:</label><input type="text" name="username" required></div>
        <div><label>Password:</label><input type="password" name="password" required></div>
        <div><button type="submit">Login</button></div>
        <h1>List of Users</h1>
    <table>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>User Role</th>
        </tr>
        <?php
        include 'config.php';

        $servername = "localhost";
        $username = "your_username";  // Adjust as needed
        $password = "your_password";  // Adjust as needed
        $dbname = "CampusBike";  // Adjust as needed

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname); // Make sure to correct the variable names here

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT UserID, FirstName, LastName, Email, UserRole FROM Users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["UserID"]. "</td><td>" . $row["FirstName"]. "</td><td>" . $row["LastName"]. "</td><td>" . $row["Email"]. "</td><td>" . $row["UserRole"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No users found</td></tr>";
        }
        $conn->close();
        ?>
        <h2>Login</h2>
    <form action="authenticate.php" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </table>

    </form>
</body>
<form action="authenticate.php" method="post">
        <div><label>Username:</label><input type="text" id="username" name="username" required><span id="username-status" class="status"></span></div>
        <div><label>Password:</label><input type="password" name="password" required></div>
        <div><button type="submit">Login</button></div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#username').keyup(function() {
                var username = $(this).val();
                if(username.length > 2) {
                    $.ajax({
                        url: 'check_username.php',
                        type: 'POST',
                        data: {username: username},
                        success: function(response) {
                            if(response === 'available') {
                                $('#username-status').text('Username available').css('color', 'green');
                            } else {
                                $('#username-status').text('Username not available').css('color', 'red');
                            }
                        }
                    });
                } else {
                    $('#username-status').text('');
                }
            });
        });
    </script>
</html>
