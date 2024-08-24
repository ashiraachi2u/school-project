<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-Frame-Options" content="DENY" />
    <meta http-equiv="Content-Security-Policy" content="frame-ancestors 'self'" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo.ico') }}" type="image/x-icon" />

    <!-- Polyfills and jQuery -->
    <script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?version=3.111.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Custom JS -->
    <script type="module" src="{{ asset('js/signin.js') }}" defer></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/signin.css') }}" />

    <script>
        if (top !== self) {
            top.location = self.location;
        }
        if (window !== top) {
            top.location = window.location;
        }
    </script>
</head>

<body>
    <!-- Body content -->
    <main class="resizer-js">
        <div class="logo">
            <img src="{{ asset('images/logo.svg') }}" alt="" />
            <h2>Scintillate Project</h2>
        </div>
        <section class="left-wrapper">
            <img src="{{ asset('images/banner-mobile.svg') }}" class="left-bg" alt="" hidden />
            <div class="heading-wrapper">
                <h2 class="header">Sign in</h2>
                <p>Welcome back! Please sign in to continue.</p>
            </div>
            <form class="sign-in-form" autocomplete="off">
                <div class="input-wrapper">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" />
                    <p class="email-err">Enter a valid email address</p>
                </div>
                <div class="password-wrapper">
                    <div class="input-wrapper">
                        <label for="password">Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" name="password" id="password" autocomplete="current-password" />
                            <!-- Password visibility toggles -->
                            <svg class="show-password-btn" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <title>Show password</title>
                                <path fill="currentColor"
                                    d="M12 9.005a4 4 0 1 1 0 8a4 4 0 0 1 0-8Zm0 1.5a2.5 2.5 0 1 0 0 5a2.5 2.5 0 0 0 0-5ZM12 5.5c4.613 0 8.596 3.15 9.701 7.564a.75.75 0 1 1-1.455.365a8.504 8.504 0 0 0-16.493.004a.75.75 0 0 1-1.456-.363A10.003 10.003 0 0 1 12 5.5Z" />
                            </svg>
                            <svg class="hide-password-btn" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <title>Hide password</title>
                                <path fill="currentColor"
                                    d="M2.22 2.22a.75.75 0 0 0-.073.976l.073.084l4.034 4.035a9.986 9.986 0 0 0-3.955 5.75a.75.75 0 0 0 1.455.364a8.49 8.49 0 0 1 3.58-5.034l1.81 1.81A4 4 0 0 0 14.8 15.86l5.919 5.92a.75.75 0 0 0 1.133-.977l-.073-.084l-6.113-6.114l.001-.002l-1.2-1.198l-2.87-2.87h.002l-2.88-2.877l.001-.002l-1.133-1.13L3.28 2.22a.75.75 0 0 0-1.06 0Zm7.984 9.045l3.535 3.536a2.5 2.5 0 0 1-3.535-3.535ZM12 5.5c-1 0-1.97.148-2.889.425l1.237 1.236a8.503 8.503 0 0 1 9.899 6.272a.75.75 0 0 0 1.455-.363A10.003 10.003 0 0 0 12 5.5Zm.195 3.51l3.801 3.8a4.003 4.003 0 0 0-3.801-3.8Z" />
                            </svg>
                        </div>
                        <p class="password-err">Password should be 8 characters long</p>
                        <p class="common-err">Incorrect email or password</p>
                        <p class="disable-err">
                            This account has been disabled. Please reach out to the
                            administrator for further assistance.
                        </p>
                    </div>
                </div>
                <button id="sign-in" type="submit">Sign in</button>
                <div class="lds-ellipsis loader-js">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </form>
            <div class="signup-wrapper">
                <span>Don't have an account?</span>
                <a href="{{ route('signup') }}" rel="noopener noreferrer" class="signup-anchor">Sign up</a>
            </div>
        </section>
        <section class="right-wrapper"></section>
    </main>
</body>

</html>