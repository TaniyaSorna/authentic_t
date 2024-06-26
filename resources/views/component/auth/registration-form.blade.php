<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name"
                                    name="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email"
                                    name="email" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                {{-- <div class="col-sm-6 mb-3 mb-sm-0"> --}}
                                <input type="password" class="form-control form-control-user" name="password"
                                    id="password" placeholder="Password">
                                {{-- </div> --}}
                            </div>

                            <button onclick="Register()" type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </div>
                        <hr>

                        <div class="text-center">
                            <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    async function Register() {
        let username = document.getElementById('name').value
        let email = document.getElementById('email').value
        let password = document.getElementById('password').value

        if (username.length === 0) {
            errorToast('Name is required')
        } else if (email.length === 0) {
            errorToast('Email is required')
        } else if (password.length === 0) {
            errorToast('Password is required')
        } else {
            let res = await axios.post('/registration', {
                name: username,
                email: email,
                password: password
            })
            if (res.data.status === 'success' && res.status === 200) {
                successToast(res.data.msg)
                window.location.href = 'login'
            } else {
                errorToast(res.data.msg)
            }
        }
    }
</script>
