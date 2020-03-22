            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                        <?php 
                       // $sql = "SELECT * from users WHERE id =1";
                        //$result = $database->query($sql);
                        //$user_found = mysqli_fetch_array($result);
                        //echo $user_found["username"];

                        
                        //$result = User::find_all_users();
                        //while($row = mysqli_fetch_array($result)){
//                            echo $row["username"]."<br>".$row["last_name"]."<br>".$row["first_name"]."<br>"; 
                             //}
                       $res = User::find_by_id(1);
                         
                            $user = User::instantiate($res);
                                echo  $user->first_name;  
                        
                      $users = User::find_all();
                        foreach ($users as $user) {
                            # code...
                            echo $user->username."<br>";
                        }
                        $photos = Photo::find_all();
                        foreach ($photos as $photo) {
                            # code...
                            echo $photo->title."<br>";
                        }

                        $phot = Photo::find_by_id(1);
                        
                         $phot->title = "yala";
                         $phot->save();
                         ?>

                         <?php 
/*                   $photo = new Photo();
                         $photo->title = "elyes";
                         $photo->description = "it is a photo";
                         $photo->filename = "ely.png";
                         $photo->type = "png";
                          $photo->size = 20;

                         $photo->create();
*/
/*                        $user2 = User::find_by_id(7);
                        $user2->first_name ="Myriam";
                        $user2->username ="baby";
                         $user2->last_name ="jaz";
                         $user2->update();*/

/*                        $user3 = User::find_user_by_id(2);

                        $user3->username = "el Hich";
                        $user3->save(); */

/*                        $user77 = new User();

                        $user77->username = "lou";
                        $user77->save(); 
*/                       // $user7->delete();
                        echo SITE_ROOT;
                          ?>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
