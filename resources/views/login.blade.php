<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CLMS | Secure Login</title>
    
    <style>
        :root {
            --maroon: #800000;
            --maroon-hover: #5a0000;
            --cream: #FFF8E1;
            --cream-dark: #F3E5AB;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--maroon);
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Branding Side */
        .brand-side {
            flex: 1;
            display: none; /* Hidden on mobile */
            background-color: var(--maroon);
            color: var(--cream);
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
        }

        /* Login Side */
        .login-side {
            flex: 1;
            background-color: var(--cream);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        @media (min-width: 768px) {
            .brand-side { display: flex; }
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        h1 { color: var(--maroon); margin-bottom: 10px; font-size: 24px; }
        p.subtitle { color: #666; margin-bottom: 30px; font-size: 14px; }

        .form-group { margin-bottom: 20px; }
        
        label {
            display: block;
            font-weight: 600;
            color: var(--maroon);
            margin-bottom: 8px;
            font-size: 13px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--cream-dark);
            border-radius: 8px;
            box-sizing: border-box;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--maroon);
            box-shadow: 0 0 0 3px rgba(128, 0, 0, 0.1);
        }

        .error-text {
            color: #d32f2f;
            font-size: 12px;
            margin-top: 5px;
            font-weight: bold;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background-color: var(--maroon);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover { background-color: var(--maroon-hover); }

        .footer-links {
            margin-top: 25px;
            text-align: center;
            font-size: 13px;
        }

        .footer-links a { color: var(--maroon); text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>

    <div class="brand-side">
        <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
            <line x1="8" y1="21" x2="16" y2="21"></line>
            <line x1="12" y1="17" x2="12" y2="21"></line>
        </svg>
        <h1 style="color: var(--cream); margin-top: 20px;">CLMS Portal</h1>
        <p>Efficiently managing computer laboratories since heian era.</p>
    </div>

    <div class="login-side">
        <div class="login-box">
            <h1>Welcome Back</h1>
            <p class="subtitle">Please enter your lab credentials to continue.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Student / Faculty Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn-login">SIGN IN TO SYSTEM</button>

                <div class="footer-links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

</body>
</html>