<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f8fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            padding: 40px;
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .form-header h1 {
            color: #2d3748;
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        
        .form-header p {
            color: #718096;
            margin-top: 10px;
            font-size: 16px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #4a5568;
            font-weight: 500;
        }
        
        input, select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 16px;
            color: #2d3748;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }
        
        input:focus, select:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-top: 25px;
        }
        
        .checkbox-group input {
            width: auto;
            margin-right: 10px;
        }
        
        .checkbox-group label {
            margin-bottom: 0;
            font-weight: normal;
        }
        
        button {
            background-color: #4299e1;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 14px 24px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #3182ce;
        }
        
        .alternate-action {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #718096;
        }
        
        .alternate-action a {
            color: #4299e1;
            text-decoration: none;
            font-weight: 600;
        }
        
        .alternate-action a:hover {
            text-decoration: underline;
        }
        
        .form-divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
        }
        
        .form-divider hr {
            flex-grow: 1;
            border: none;
            height: 1px;
            background-color: #e2e8f0;
        }
        
        .form-divider span {
            padding: 0 15px;
            color: #a0aec0;
            font-size: 14px;
        }
        
        .social-buttons {
            display: flex;
            gap: 15px;
        }
        
        .social-button {
            flex: 1;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background-color: white;
            font-size: 14px;
            font-weight: 500;
            color: #4a5568;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
        }
        
        .social-button:hover {
            background-color: #f7fafc;
        }
    </style>
     <script>
        function togglePasswordVisibility(inputId, toggleIcon) {
            const inputField = document.getElementById(inputId);
            const icon = toggleIcon.querySelector('i');
            if (inputField.type === "password") {
                inputField.type = "text";
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                inputField.type = "password";
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h1>Create Account</h1>
            <p>Sign up to get started with our service</p>
        </div>
        
        <form method="POST" action="{{ route('register.custom') }}">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter your full name" required>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="text" id="mobile" class="form-control @error('mobile') is-invalid @enderror" name="mobile" placeholder="Enter your Mobile Number" required>
                @error('mobile')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter your email" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password"  class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Create a password" required>
                <span class="position-absolute end-0 top-50 translate-middle-y me-4" onclick="togglePasswordVisibility('password', this)" style="cursor: pointer;">
                    <i class="bi bi-eye"></i> <!-- Bootstrap eye icon -->
                </span>
                                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                                     @enderror
            </div>
            <div class="form-group">
                <label for="password-confirm">Password</label>
                <input type="password" id="password-confirm"  class="form-control @error('password-confirm') is-invalid @enderror" name="password-confirm" placeholder="Confirm password" required>
                <span class="position-absolute end-0 top-50 translate-middle-y me-4" onclick="togglePasswordVisibility('password-confirm', this)" style="cursor: pointer;">
                    <i class="bi bi-eye"></i> <!-- Bootstrap eye icon -->
                </span>
                                        @error('password-confirm')
                            <span class="text-danger">{{ $message }}</span>
                                     @enderror
            </div>
             
            
            <div class="checkbox-group">
                <input type="checkbox" id="terms" required>
                <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
            </div>
            
            <button type="submit">Sign Up</button>
            
            
            
            <div class="alternate-action">
                Already have an account? <a href="{{ route('login') }}">Log In</a>
            </div>
        </form>
    </div>
</body>
</html>
