</div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer" style="position:fixed;">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js" integrity="sha256-S/HO+Ru8zrLDmcjzwxjl18BQYDCvFDD7mPrwJclX6U8=" crossorigin="anonymous"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script>
const searchParams = new URLSearchParams(window.location.search);
if(searchParams.has('pnf')){
  if(searchParams.get('pnf') == "true"){
    alertify.error('Post Not Found!!!');
  }
}
if(searchParams.has('na')){
  if(searchParams.get('na') == "true"){
    alertify.error('Not Allowed!!!');
  }
}


if(searchParams.has('success')){
  if(searchParams.get('success') == "true"){
    if(searchParams.has('post')){
      alertify.success('Editted Successfully');

    }else{

      alertify.success('Created Successfully');
    }
  }
}

//Category Alert
$(document).ready(function() {
  $('#search-form').validate({
    rules:{
      query:{
        required: true,
        minlength: 4,
      }
    },
    messages:{
      query:{
        required: "please enter your query",
        minlength: "search query should be of minimum 4 characters",
      }
  },errorElement: 'div',
  errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-floating').append(error);
  },
  highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
  },
  unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
  },submitHandler: function (form) {
                    var formData = $(form).serializeArray();
                    var dataObject = {};

                    formData.forEach(function (element) {
                        dataObject[element.name] = element.value;
                    });
                    console.log(dataObject);
                    $.post("../search/get-data.php", dataObject, function (data) {
                        $("#all-data").empty();
                        data.forEach(element => {
                          console.log(element);
                        });

                    }, "json");
                }
})
  


  $("#edit-form").validate({
    rules: {
          name: {
              required: true
          },
          email: {
              required: true,
              email: true
          },
          role: {
              required: true,
          }
      },
      messages: {
          name: {
              required: "Please enter a name"
          },
          email: {
              required: "Please enter an email address",
              email: "Please enter a valid email address"
          },
          role: {
              required: "Please select a role",
          }
      },
      errorElement: 'div',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-floating').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (form) {
                    var formData = $(form).serializeArray();
                    var dataObject = {};

                    formData.forEach(function (element) {
                        dataObject[element.name] = element.value;
                    });

                    $.post("edit-user-details.php", dataObject, function (data) {
                      console.log("i am here");
                        if (data.status) {
                            alertify.success(data.message);
                            setTimeout(()=>{
                                window.location.replace("../user/list-users.php");
                            },1000)
                        } else {
                            alertify.error(data.message);
                        }
                    }, "json");
                }
  })


  $('#create-category').on('submit', function(event) {
    event.preventDefault(); 
    if(searchParams.has('id')){
          confirmEdit().then(function(shouldSubmit) {
              if (shouldSubmit) {
                $('#create-category')[0].submit(); 
              }
          });
        }else{
          $('#create-category')[0].submit();
        }
    });
    $('#create-post').on('submit', function(event) {
        event.preventDefault(); 
        if(searchParams.has('id')){
          confirmEdit().then(function(shouldSubmit) {
          if (shouldSubmit) {
            $('#create-post')[0].submit(); 
              }
          });
        }else{
          $('#create-post')[0].submit();
        }
    });


    <?php if ($_SERVER['PHP_SELF'] == '/blogs/posts/create-post.php'): ?>
      CKEDITOR.replace( 'editor' );
    const editor = CKEDITOR.instances.editor;
    editor.on('key',function(event){
      
      value = editor.getData();
      if(value == ""){
            document.getElementById("editor-div").classList.add("border-danger")
            document.getElementById("error-content").style.display = "block";
        }else{
            document.getElementById("editor-div").classList.remove("border-danger")
            document.getElementById("editor-div").classList.add("border-success")
            document.getElementById("error-content").style.display = "none";
        }
    })
    <?php endif; ?>

});


//Delete Alert

  function alertDelete(e){
    href = e.href;
    e.href = "#";
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
        setTimeout(() => {
          window.location = href;
        }, 1000);
      }
    })
  }

  function confirmEdit() {
    return new Promise(function(resolve) {
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
        }).then(function(result) {
            if (result.isConfirmed) {
                Swal.fire('Saved!', '', 'success');
                setTimeout(function() {
                    resolve(true);
                }, 1000);
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info');
                resolve(false);
            }
        });
    });
}

  function validateCategoryName(e){
    if(e.value == ""){
      e.classList.add("border-danger");
      document.getElementById("error-category").style.display = "block";
    }else{
      e.classList.remove("border-danger");
      e.classList.add("border-success")
      document.getElementById("error-category").style.display = "none";
    }
  }

  const isDeleteChecked = (e) =>{
    
    var deleteID = document.getElementsByClassName("category-delete");
    if(e.checked){
      for(i = 0 ; i < deleteID.length ;i++){
        deleteID[i].style.display = "block";
      }
    }
    if(!e.checked){
      for(i = 0 ; i < deleteID.length ;i++){
        deleteID[i].style.display = "none";
      }
    }
    
  }

  const isEditChecked = (e) =>{
    var editID =  document.getElementsByClassName("category-edit");
    if(e.checked){
      for(i = 0 ; i < editID.length ;i++){
        editID[i].style.display = "block";
      }
    }
    if(!e.checked){
      for(i = 0 ; i < editID.length ;i++){
        editID[i].style.display = "none";
      }
    }
  }
  
 


    function validateDescription(element){
        value = element.value;
        if(value == "" || value.length > 500){
            element.classList.add("border-danger")
            document.getElementById("error-description").style.display = "block";
        }else{
            element.classList.remove("border-danger")
            element.classList.add("border-success")
            document.getElementById("error-description").style.display = "none";
        }
    }
    function validateTitle(element){
        value = element.value;
        if(value == ""){
            element.classList.add("border-danger")
            document.getElementById("error-title").style.display = "block";
        }else{
            element.classList.remove("border-danger")
            element.classList.add("border-success")
            document.getElementById("error-title").style.display = "none";
            document.getElementById("category-div").classList.remove("border-danger");
            document.getElementById("editor-div").classList.remove("border-danger");
            if(document.getElementById("error-content") != null){
                document.getElementById("error-content").style.display = "none"; 
            }
            if(document.getElementById("error-category") != null){
                document.getElementById("error-category").style.display = "none"; 
            }
            element.classList.remove("border-danger");
            element.classList.add("border-success");
            document.getElementById("error-title").style.display = "none";
        }
    }

    
    
</script>




</html>
