<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <div id="login-form">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="email"
                                            name="email" placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            id="password" placeholder="Password">
                                    </div>

                                    <button onclick="Login()" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('send-otp') }}">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('registration') }}">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<script>
    async function Login() {
        let email = document.getElementById('email').value
        let password = document.getElementById('password').value
        console.log(email);
        if (email.length === 0) {
            errorToast('Email is required')
        } else if (password.length === 0) {
            errorToast('Password is required')
        } else {
            // shoowLoader

            let res = await axios.post('/login', {
                email: email,
                password: password
            });
            // consol.log(res);
            // hideLoder
            if (res.data.status === 'success' && res.status === 200) {
                successToast('Login Success')
                window.location.href = '/profile'
            } else {
                errorToast('Faild')
            }
        }

    }
</script>
