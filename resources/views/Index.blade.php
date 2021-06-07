<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class='container'>
        <div class='row jumbotron'>

            <div class='col-md-6'>
                <h3 class='text-center'>Login Now</h3>

                @if(\Session::has('loginErr'))
                <div class='alert alert-danger alert-dismissible'>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {!! \Session::get('loginErr') !!}
                </div>
                @endif

                <form method="post" action="login">
                    {{@csrf_field()}}
                    <div class='form-group'>
                        <label for='email'>Email</label>
                        <input type='email' name="email" class='form-control' id='email' placeholder="Enter your Email" required>
                    </div>
                    <div class='form-group'>
                        <label for='password'>Password</label>
                        <input type="password" name="password" class='form-control' id="password" placeholder="Enter your Password" required>
                    </div>
                    <input type="submit" class='btn btn-warning' value='Login'>
                    <span style='margin-left:190px; font-weight:bold; font-size:12px'><a href='#' style='text-decoration:none' data-toggle='modal' data-target='#forgotPassword'>Forgot password... click me</a></span>
                </form>

            </div>

            <div class="modal" id='forgotPassword'>
                <div class="modal-dialog">
                    <div class="modal-content">
                         <div class="modal-header">
                             <span>Set your new Password</span>

                         </div>
                         <div class="modal-body">
                              <form method='post' action='forgotPassword'>
                                  <?php  echo csrf_field(); ?>
                                  <div class="form-group">
                                      <label>Email</label>
                                      <input type='email' name='email' class="form-control" placeholder='Give your correct Email' required>
                                  </div>
                                  <div class="form-group">
                                      <label>password</label>
                                      <input type='password' name='password' class="form-control" placeholder='Set your new password' required>
                                  </div>
                                  <input type='submit' class='btn btn-primary btn-sm' value='Update'>
                              </form>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                         </div>

                    </div>
                </div>
            </div>

            <div class='col-md-6'>
                <h3 class='text-center'>SignUp Now</h3>

                @if(\Session::has('signUpSuccess'))
                <div class='alert alert-success alert-dismissible'>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {!! \Session::get('signUpSuccess') !!}
                </div>
                @endif

                @if(\Session::has('emailUse'))
                <div class='alert alert-danger alert-dismissible'>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {!! \Session::get('emailUse') !!}
                </div>
                @endif

                <form method="post" action="signup">
                    {{@csrf_field()}}
                    <div class='form-group'>
                        <label for='fname'>First Name</label>
                        <input type='text' name="fname" class='form-control' placeholder="Enter your First Name" id="fname" required>
                    </div>
                    @error('fname')
                    <div class='alert alert-danger alert-dismissible'>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{$message}}
                    </div>
                    @enderror
                    <div class='form-group'>
                        <label for='lname'>Last Name</label>
                        <input type="text" name="lname" class='form-control' placeholder="Enter your Last Name" id="lname" required>
                    </div>

                    @error('lname')
                    <div class='alert alert-danger alert-dismissible'>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{$message}}
                    </div>
                    @enderror

                    <div class='form-group'>
                        <label for='semail'>Email</label>
                        <input type="email" name="email" class='form-control' placeholder="Enter your Email" id="semail" required>
                    </div>

                    @error('email')
                    <div class='alert alert-danger alert-dismissible'>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{$message}}
                    </div>
                    @enderror

                    <div class='form-group'>
                        <label for='spassword'>Password</label>
                        <input type="password" name="password" class='form-control' placeholder="Enter your Password" id="spassword" required>
                    </div>

                    @error('password')
                    <div class='alert alert-danger alert-dismissible'>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{$message}}
                    </div>
                    @enderror

                    <div class='form-group'>
                        <label for='cpassword'>ConfirmPassword</label>
                        <input type="password" name='cpassword' class='form-control' placeholder="Enter your Confirm Password" id="cpassword" required>
                    </div>
                    

                    @error('cpassword')
                    <div class='alert alert-danger alert-dismissible'>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{$message}}
                    </div>
                    @enderror

                    @if(\Session::has('passwordNotMatch'))
                    <div class='alert alert-danger alert-dismissible'>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {!! \Session::get('passwordNotMatch') !!}
                    </div>
                    @endif

                    <input type="hidden" class='form-control' value='a.jpg' name='image'>

                    <input type="submit" class='btn btn-danger' value='SignUp'>

                </form>

            </div>
        </div>
    </div>
</body>

</html>