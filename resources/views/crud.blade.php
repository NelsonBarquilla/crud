<!DOCTYPE html>

<html>

<head>
    <title>Exam Number 11</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div class="container">
        <h2>Exam Number 11</h2>

        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>

        <form>

            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Full Name">
            </div>

            <div class="form-group">
                <strong>Mobile Number:</strong>
                <input type="number" name="mobile" class="form-control" placeholder="Mobile Number">
            </div>

            <div class="form-group">
                <strong>Email:</strong>
                <input type="text" name="email" class="form-control" placeholder="Email">
            </div>

            <div class="form-group">
                <strong>Birthday:</strong>
                <input type="date" id="birthday" name="birthday" class="form-control" placeholder="Birthday">
            </div>

            <div class="form-group">
                <strong>Age:</strong>
                <input type="number" id="age" name="age" class="form-control" value="0" disabled>
            </div>

            <div class="form-group ">
                <select class="form-control" name="gender">
                    <option hidden selected>Gender</option>
                    <option>Female</option>
                    <option>Male</option>
                </select>
            </div>


            <div class="form-group">
                <button class="btn btn-success btn-submit">Submit</button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {

        $(".btn-submit").click(function(e) {
            e.preventDefault();
            var name = $("input[name='name']").val();
            var mobile = $("input[name='mobile']").val();
            var email = $("input[name='email']").val();
            var birthday = $("input[name='birthday']").val();
            var age = $("input[name='age']").val();
            var gender = $("select[name='gender']").val();

            $.ajax({
                url: "{{ url('crud') }}",
                type: 'POST',
                data: {
                    name: name,
                    mobile: mobile,
                    email: email,
                    birthday: birthday,
                    age: age,
                    gender: gender
                },

                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        alert(data.success);
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });
        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    });
    </script>

    <script type="text/javascript">
    $("#birthday").change(function() {
        var today = new Date();
        var birthDate = new Date($('#birthday').val());
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        $('#age').val(age);
    });
    </script>

</body>

</html>