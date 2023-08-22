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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
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
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
<script>
  


    $(document).ready(function() {
        // Initialize Bootstrap components
        $('[data-bs-toggle="collapse"]').collapse();
    });
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
  
ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
            console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    function validateDescription(element){
        value = element.value;
        if(value == ""){
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

</script>


</html>
