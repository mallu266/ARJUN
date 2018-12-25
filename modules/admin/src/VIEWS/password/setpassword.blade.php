@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12 m_top_50">
            <div class="panel">
                <div class="panel-body">
                    <h3 class="text-center">
                        <b class="themeColor">Set Password</b>
                    </h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('password/setpassword') }}" name="setPasswordForm">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-5">
                                <input id="email" type="email" class="form-control" readonly="" name="email" value="{{ $email or old('email') }}" placeholder="Enter E-Mail Address" required>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Temp Password</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="oldpassword" placeholder="Enter Temporary Password" required autofocus>
                                @if ($errors->has('oldpassword'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('oldpassword') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-5">
                                <input id="password" type="password" class="form-control" onkeyup='check();' name="password" placeholder="Enter New Password" pattern="^(?=(.*[a-zA-Z].*){2,})(?=.*\d.*)(?=.*\W.*)[a-zA-Z0-9\S]{8,15}$" title="Must contain at least one number, one letter, one special and at least 8 and not more than 16 characters" required>
                                <div id="message">
                                    <span>Requires Atleast :</span>
                                    <span id="letter" class="invalid">1 Letter,</span>
                                    <span id="number" class="invalid">1 Number,</span>
                                    <span id="special" class="invalid">1 Special,</span>
                                    <span id="length" class="invalid">8 - 16 chars</span>
                                </div>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-5">
                                <input id="password-confirm" type="password" class="form-control" onkeyup='check();' placeholder="Enter Confirm Password" name="password_confirmation" required>
                                <label id='matchPass'></label>
                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success" onclick="checkform()">
                                    Set Password
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var myInput = document.getElementById("password");
    var letter = document.getElementById("letter");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    var special = document.getElementById("special");
// When the user starts to type something inside the password field
    myInput.onkeyup = function () {
        // Validate letters
        var letters = /[A-Za-z]/g;
        if (myInput.value.match(letters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }
        // Validate numbers
        var numbers = /[0-9]/g;
        if (myInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }
        // Validate length
        if (myInput.value.length >= 8 && myInput.value.length <= 16) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
        // Validate Special
        var specials = /[!@#$%^&*(),.?":{}|<>]/g;
        if (myInput.value.match(specials)) {
            special.classList.remove("invalid");
            special.classList.add("valid");
        } else {
            special.classList.remove("valid");
            special.classList.add("invalid");
        }
    }
// Validate Password Match
    var check = function () {
        if (document.getElementById('password').value ==
                document.getElementById('password-confirm').value) {
            document.getElementById('matchPass').style.color = 'green';
            document.getElementById('matchPass').innerHTML = 'Password is matched';
        } else {
            document.getElementById('matchPass').style.color = 'red';
            document.getElementById('matchPass').innerHTML = 'Password is not matching';
        }
    }


    function checkform() {
        if (document.setPasswordForm.myInput.value == "") {
            alert("please enter start_date");
            return false;
        } else {
            document.setPasswordForm.submit();
        }
    }
</script>
@endsection
