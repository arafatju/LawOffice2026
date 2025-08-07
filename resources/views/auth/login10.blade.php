<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ডিজিটাল স্টোর ম্যানেজমেন্ট সিস্টেম</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'SolaimanLipi', 'Kalpurush', Arial, sans-serif;
            background: linear-gradient(135deg, #4a4e96 0%, #8B5A96 50%, #D63384 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .main-container {
            width: 100%;
            max-width: 1200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            min-height: 600px;
        }

        .left-section {
            flex: 1;
            background: linear-gradient(135deg, #4a4e96 0%, #6B46C1 100%);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .left-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1));
            transform: skewX(-15deg);
        }

        .government-header {
            text-align: center;
            color: white;
            z-index: 2;
        }

        .govt-logo {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 24px;
            color: #4a4e96;
            font-weight: bold;
        }

        .govt-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .govt-subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 5px;
        }

        .govt-department {
            font-size: 16px;
            font-weight: 500;
            color: #FFD700;
        }

        .warehouse-illustration {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            z-index: 2;
        }

        .warehouse-scene {
            position: relative;
            width: 300px;
            height: 200px;
        }

        .warehouse-building {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 80px;
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .warehouse-roof {
            position: absolute;
            top: -20px;
            left: -10px;
            width: 220px;
            height: 25px;
            background: #dc3545;
            border-radius: 4px;
            transform: perspective(100px) rotateX(15deg);
        }

        .warehouse-door {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 50px;
            background: #495057;
            border-radius: 4px 4px 0 0;
        }

        .boxes {
            position: absolute;
            bottom: 0;
            left: 20px;
        }

        .box {
            width: 25px;
            height: 25px;
            background: #ffc107;
            border: 2px solid #ff8c00;
            border-radius: 3px;
            position: absolute;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .box:nth-child(1) { bottom: 0; left: 0; }
        .box:nth-child(2) { bottom: 0; left: 30px; background: #28a745; border-color: #20c997; }
        .box:nth-child(3) { bottom: 30px; left: 0; background: #17a2b8; border-color: #20c997; }
        .box:nth-child(4) { bottom: 0; right: -80px; background: #e83e8c; border-color: #fd7e14; }

        .forklift {
            position: absolute;
            bottom: 10px;
            right: 50px;
            width: 40px;
            height: 30px;
            background: #ff6b35;
            border-radius: 4px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .system-title {
            text-align: right;
            color: white;
            font-size: 28px;
            font-weight: bold;
            line-height: 1.3;
            z-index: 2;
        }

        .right-section {
            flex: 1;
            background: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
            border: 1px solid #e9ecef;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo {
            width: 50px;
            height: 50px;
            background: #4a4e96;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 20px;
        }

        .login-title {
            font-size: 16px;
            color: #4a4e96;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .login-subtitle {
            font-size: 12px;
            color: #6c757d;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-input:focus {
            outline: none;
            border-color: #4a4e96;
            background: white;
            box-shadow: 0 0 0 3px rgba(74, 78, 150, 0.1);
        }

        .form-input::placeholder {
            color: #adb5bd;
            font-size: 13px;
        }

        .password-toggle {
            position: relative;
        }

        .toggle-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            font-size: 16px;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 12px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            color: #6c757d;
        }

        .remember-me input {
            margin-right: 6px;
        }

        .forgot-link {
            color: #4a4e96;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .login-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-login {
            background: #dc3545;
            color: white;
        }

        .btn-login:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .btn-register {
            background: #28a745;
            color: white;
        }

        .btn-register:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
                margin: 10px;
            }
            
            .left-section, .right-section {
                padding: 30px 20px;
            }
            
            .warehouse-scene {
                width: 250px;
                height: 150px;
            }
            
            .warehouse-building {
                width: 150px;
                height: 60px;
            }
            
            .warehouse-roof {
                width: 170px;
                left: -10px;
            }
            
            .system-title {
                font-size: 22px;
                text-align: center;
                margin-top: 20px;
            }
        }

        @media (max-width: 480px) {
            .left-section {
                padding: 20px;
            }
            
            .right-section {
                padding: 20px;
            }
            
            .login-card {
                padding: 20px;
            }
            
            .govt-title {
                font-size: 16px;
            }
            
            .system-title {
                font-size: 18px;
            }
        }

        /* Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .forklift {
            animation: float 3s ease-in-out infinite;
        }

        .box:nth-child(odd) {
            animation: float 4s ease-in-out infinite;
            animation-delay: 0.5s;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Left Section -->
        <div class="left-section">
            <div class="government-header">
                <div class="govt-logo">🇧🇩</div>
                <div class="govt-title"> আইন, বিচার ও  সংসদ বিষয়ক  মন্ত্রণালয়</div>
                <div class="govt-subtitle"> আইন ও বিচার বিভাগ  </div>
                <div class="govt-department">বাংলাদেশ সচিবালয় , ঢাকা </div>
            </div>
            
            <div class="warehouse-illustration">
                <div class="warehouse-scene">
                    <div class="warehouse-building">
                        <div class="warehouse-roof"></div>
                        <div class="warehouse-door"></div>
                    </div>
                    <div class="boxes">
                        <div class="box"></div>
                        <div class="box"></div>
                        <div class="box"></div>
                        <div class="box"></div>
                    </div>
                    <div class="forklift"></div>
                </div>
            </div>
            
            <div class="system-title">
                ডিজিটাল স্টোর<br>
                ম্যানেজমেন্ট সিস্টেম
            </div>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <div class="login-card">
                <div class="login-header">
                    <div class="login-logo">🇧🇩</div>
                    <div class="login-title">ডিজিটাল স্টোর</div>
                    <div class="login-subtitle">ম্যানেজমেন্ট সিস্টেম</div>
                </div>
                
                <form method="POST" action="{{ route('login.custom') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-input" placeholder="Write Your Email" required>
                    </div>
                    
                    <div class="form-group password-toggle">
                        <input type="password" id="password" class="form-input" placeholder="Password" required>
                        <button type="button" class="toggle-btn" onclick="togglePassword()">👁</button>
                    </div>
                    
                    <div class="form-options">
                         
                        <a href="{{route('registration')}}" class="forgot-link">Registration</a>
                    </div>
                    
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-login">লগইন করুন</button>
                         
                    </div>
                </form>
            </div>
        </div>
        
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.querySelector('.toggle-btn');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleBtn.textContent = '👁';
            }
        }

        

        // Add floating animation to elements
        document.addEventListener('DOMContentLoaded', function() {
            const boxes = document.querySelectorAll('.box');
            boxes.forEach((box, index) => {
                box.style.animationDelay = (index * 0.2) + 's';
            });
        });
    </script>
</body>
</html>
