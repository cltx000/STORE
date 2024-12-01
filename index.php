<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "technopreneurs";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

$alert = "";
if ($conn->connect_error) {
    $alert = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Database connection failed: " . $conn->connect_error . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
} else {
    $alert = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Connected to the database successfully.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
}

$message = "";
// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                          Login successful. Welcome, " . htmlspecialchars($user['email']) . "!
                          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
            
            // Redirect to landing.php
            header("Location: landing.php");
            exit; // Ensure no further code is executed after the redirect
        } else {
            $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                          Invalid email or password.
                          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
        }
    } else {
        $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                      Invalid email or password.
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
    }
    

    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/TECHNOENTREP/fonts/fonts.css">

    <title>Login | PureGuard</title>
    <style>
        :root {
            --primary-color: #4CC9FE;
            --primary-hover: #1B98E0;
            --text-color: #ffffff;
            --card-bg: #ffffff;
            --card-shadow: rgba(0, 0, 0, 0.2);
            --card-border-radius: 10px;
            --font-family: 'SF-Pro-Text-Regular', sans-serif;
            --letter-spacing: -0.4px;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
            min-height: 100vh;
            overflow: hidden;
            font-family: var(--font-family);
            letter-spacing: var(--letter-spacing);
            display: flex;
        }

        #particles-js {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 50vh;
        }

        .left {
            flex: 1;
            text-align: center;
            padding: 20px;
        }

        .left img {
            width: 80%;
            max-width: 300px;
        }

        .right {
            flex: 1;
            padding: 20px;
        }

        .card .right h3{
            font-family: 'SF-Pro-Text-Bold';
            font-size: 32px;
            letter-spacing: -0.9px;
            margin-bottom: 29px;

        }
        p {
            font-family: 'SF-Pro-Display-Semibold';
            font-size: 15px;
            letter-spacing: 0.9px;
            color: #595959;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: var(--card-border-radius);
            box-shadow: 0px 4px 20px var(--card-shadow);
            display: flex;
            justify-content: center;
            align-content: flex-start;
            flex-wrap: nowrap;
            flex-direction: row;
            align-items: center;
            width: 90%;
        
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .text-center {
            text-align: center !important;
        }
    </style>
</head>
<body>
    <div id="particles-js"></div>

    <!-- Alert Container -->
    <div class="alert-container">
        <?php echo $alert; ?>
        <?php echo $message; ?>
    </div>

    <!-- Main Container -->
    <div class="container">
        <div class="card">
            <!-- Left Section -->
            <div class="left">
                <img src="img/pureguard.png" alt="PureGuard Logo" class="mb-4">
                <p>Your sanitation partner for safe living.</p>
            </div>

            <!-- Right Section -->
            <div class="right">
                <div class="card-body">
                    <h3>Login to PureGuard</h3>
                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                        </div>
                        <button class="btn btn-primary w-100 mt-4" type="submit">Login</button>
                    </form>
                    <small class="text-center d-block mt-3">
                        Don't have an account? <a href="signup.php">Sign Up</a>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <script>
        particlesJS('particles-js', {
            "particles": {
                "number": { "value": 80, "density": { "enable": true, "value_area": 800 } },
                "color": { "value": "#ffffff" },
                "shape": { "type": "circle" },
                "opacity": { "value": 0.6 },
                "size": { "value": 3, "random": true },
                "line_linked": { "enable": true, "distance": 150, "color": "#ffffff", "opacity": 0.4, "width": 1 },
                "move": { "enable": true, "speed": 6, "direction": "none", "out_mode": "out" }
            },
            "interactivity": {
                "events": {
                    "onhover": { "enable": true, "mode": "push" },
                    "onclick": { "enable": true, "mode": "grab" }
                }
            },
            "retina_detect": true
        });
    </script>
</body>
</html>
