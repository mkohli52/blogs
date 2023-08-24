
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js" integrity="sha256-S/HO+Ru8zrLDmcjzwxjl18BQYDCvFDD7mPrwJclX6U8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">

    </script>
    <script>
        $(document).ready(function() {
    $("#register-form").submit(function(e) {
        e.preventDefault();

        var result = $(this).serializeArray();
        var formData = {};

        result.forEach(function(element) {
            formData[element.name] = element.value;
        });

        $.post("create-user.php", {
            name: formData["name"],
            email: formData["email"],
            password: formData["password"]
        }, function(data) {
            
            if (data.status) {
                Swal.fire({
                    icon: 'success',
                    title: data.message,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                });
            }
        }, "json");
    });

           
            $("#register-form").validate({
                rules:{
                    name:{
                        required:true
                    },
                    email:{
                        required:true,
                        email:true
                    },
                    password:{
                        required:true,
                        minlength:8
                    }
                },
                messages:{
                    name:{
                        required: "please enter a name"
                    },
                    email:{
                        required: "please enter a email address",
                        email: "please enter a valid email address"
                    },
                    password:{
                        required: "please enter a password",
                        minlength: "password should be more then 8 characters"
                    }
                },
                errorElement:'span',
                errorPlacement:function(error,element){
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }
            });
            $("#login-form").submit(function(e) {
            e.preventDefault();

            var result = $(this).serializeArray();
            var formData = {};

            result.forEach(function(element) {
                formData[element.name] = element.value;
            });
            console.log(formData);

            $.post("verify-user.php", {
                email: formData["email"],
                password: formData["password"]
            }, function(data) {
                if (data.status) {
                Swal.fire({
                    icon: 'success',
                    title: data.message,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                });
            }
            }, "json");
        });



            $("#login-form").validate({
                rules:{
                    email:{
                        required:true,
                        email:true
                    },
                    password:{
                        required:true,
                        minlength:8
                    }
                },
                messages:{
                    email:{
                        required: "please enter a email address",
                        email: "please enter a valid email address"
                    },
                    password:{
                        required: "please enter a password",
                        minlength: "password should be more then 8 characters"
                    }
                },
                errorElement:'span',
                errorPlacement:function(error,element){
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>

</html>