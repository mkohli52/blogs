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
<script src="../dist/js/adminlte.min.js"></script>
<script>


$(document).ready(function() {
    
    console.log("Inside document ready");
    <?php if($_SERVER["PHP_SELF"] == "/blogs/posts/create-post.php"): ?>
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
