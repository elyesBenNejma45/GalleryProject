<?php include("includes/header.php"); ?>
<?php 
    if(!$session->is_signed_in()){
        redirect("login.php");
    }

 ?>


<?php 
$message = "";
if (isset($_POST["submit"])) {
    # code...
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->set_file($_FILES['file_upload']);

    if ($photo->save()) {
             # code...
        $message = "photo uploaded succesfully";
         } else {
            $message = join('<br>',$photo->error);
         }

}

 ?>





        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            

            <?php
                    include("includes/top_nav.php") 
             ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                        <!-- /.navbar-collapse -->


            <?php 
                    include("includes/side_nav.php")
             ?>            
        </nav>

        <div id="page-wrapper">

            <!-- /.container-fluid -->
                        <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Uploads
                            <small>Subheading</small>
                        </h1>
                        <div class="col-md-6">
                            <?php 
                            echo $message; ?>
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="file" name="file_upload">
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="submit">
                                </div>                        


                            </form>

                        </div>
                    </div>
                <!-- /.row -->

                </div>


        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>