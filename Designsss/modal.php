 <!-- /.modal -->
                     <div id="add-admin" class="modal fade" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                        <form action="admin.php" method="POST"role="form">
                           <div class="modal-content">

                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                 <h4 class="modal-title">Add Administrator</h4>
                              </div>
                              <div class="modal-body">
                                 <div class="container">
                                 		
                                 		<div class="form-group">
                                 			<p>
                                      <div class="input-icon">
                                        <i class="icon-user"></i>
                                      <input type="text" name="username" class="form-control" placeholder="Username" required/>
                                        
                                        </div>
                                      </p>
                                      </div>
                                <div class="form-group">
                                 			<p>
                                      <div class="input-icon">
                                        <i class="icon-lock"></i>
                                      <input type="password" name="password" class="form-control" placeholder="Password" required/>
                                      </p>
                                 		   </div>
                                    </div>
                                 		
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" data-dismiss="modal" class="btn default">Close</button>
                                 <button type="submit" class="btn green">Save</button>
                              </div></form>
                           </div>
                        </div>
                     </div>

                      <div id="delete-admin" class="modal fade" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-wide">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                 <h4 class="modal-title">Delete Administrator</h4>
                              </div>
                              <div class="modal-body">
                                 <div class="container">
                                 <div class="row">
                        <div class="col-md-12">
                           <!-- BEGIN EXAMPLE TABLE PORTLET-->
                           <div class="portlet box blue">
                              <div class="portlet-title">
                                 <div class="caption"><i class="icon-edit"></i>Update Users</div>
                                 <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="javascript:;" class="reload"></a>
                                 </div>
                              </div>
                              <div class="portlet-body">
                               <?php
                                      $query = "SELECT * FROM tbl_admin";
                                      $table = tbl_admin;
                                      $result = mysql_query($query);
                                      if (!$result) {
                                        die("Something went wrong!").mysql_error();
                                      }

                                      $num = mysql_num_rows($result);
                                      
                                      echo "<div id='status'></div><table border='1' class='table table-hover' id='del'><tr>";
                                      echo "<th>#</th><th>Username</th><th>Password</th><th>Options</th>";  
                                      echo "</tr>";
                                      for ($i=1; $i < $num ; $i++) { 
                                        echo "<tr>";
                                        $usernames = mysql_result($result,$i, 'username');
                                        $passwords = mysql_result($result,$i,'password');
                                        $user_id = mysql_result($result,$i, 'user_id');
                                        
                                        echo "<td>$user_id</td>
                                            <td id='$user_id'>$usernames</td>
                                            <td id='$user_id'>$passwords</td>
                                            <td id='$user_id'><button type='button' onclick='deletes($user_id,$table)'>Delete</button></td>
                                            </tr>";
                                      }
                                      echo "</table>";
                                    ?>
                                 
                              </div>
                           </div>
                           <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                     </div>
                                 		
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" data-dismiss="modal" class="btn default">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                      <div id="update-admin" class="modal fade" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-wide">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                 <h4 class="modal-title">Update Administrator</h4>
                              </div>
                              <div class="modal-body">
                                 <div class="container">
						         <div class="row">
						            <div class="col-md-12">
						               <!-- BEGIN EXAMPLE TABLE PORTLET-->
						               <div class="portlet box blue">
						                  <div class="portlet-title">
						                     <div class="caption"><i class="icon-edit"></i>Update Users</div>
						                     <div class="tools">
						                        <a href="javascript:;" class="collapse"></a>
						                        <a href="javascript:;" class="reload"></a>
						                     </div>
						                  </div>
						                  <div class="portlet-body">
						                   <?php
                                 			$query = "SELECT * FROM tbl_admin";
                                 			$result = mysql_query($query);
                                 			if (!$result) {
                                 				die("Something went wrong!").mysql_error();
                                 			}

                                 			$num = mysql_num_rows($result);
                                 			
                                 			echo "<div id='status'></div><table border='1' class='table table-hover'><tr>";
                                 			echo "<th>#</th><th>Username</th><th>Password</th>";	
                                 			echo "</tr>";
                                      for ($i=0; $i < $num ; $i++) { 
                                        echo "<tr>";
                                        $usernames = mysql_result($result,$i, 'username');
                                        $passwords = mysql_result($result,$i,'password');
                                        $user_id = mysql_result($result,$i, 'user_id');
                                        
                                        echo "<td>$user_id</td>
                                            <td id='username:$user_id' contenteditable='true'>$usernames</td>
                                            <td id='password:$user_id' contenteditable='true'>$passwords</td>
                                            </tr>";
                                      }
                                 			echo "</table>";
                                 		?>
						                     
						                  </div>
						               </div>
						               <!-- END EXAMPLE TABLE PORTLET-->
						            </div>
						         </div>
						         <!-- END PAGE CONTENT -->
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" data-dismiss="modal" class="btn default">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div id="add-trees" class="modal fade" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="admin.php" method="POST" role="form">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                 <h4 class="modal-title">Add Trees</h4>
                              </div>
                              <div class="modal-body">
                                 <div class="container">
                                  <div class="form-group">
                                      <p>
                                      <input type="text" name="tree" value="<?php echo $tree; ?>" class="form-control" placeholder="Treename" required/>
                                       </p>
                                      </div>
                                <div class="form-group">
                                      <p>
                                      <label>Select color: </label>
                                      <input type="color" name="color" value="#" required onchange="checkColor(color.value)" />
                                      </p>
                                      <p>
                                        <div> <label id="colorValue"></label> </div>
                                      </p>
                                 		
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" data-dismiss="modal" class="btn default">Close</button>
                                 <button type="submit" class="btn green">Save</button>
                              </div></div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div id="update-trees" class="modal fade" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-wide">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                 <h4 class="modal-title">Update Trees</h4>
                              </div>
                              <div class="modal-body">
                                 <div class="container">
                                 		<h1>Table with update button Unsaon mani ni?? hehehe</h1>
                                    
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" data-dismiss="modal" class="btn default">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="delete-trees" class="modal fade" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                 <h4 class="modal-title">Delete Trees</h4>
                              </div>
                              <div class="modal-body">
                                 <div class="container">
                                <?php
                                      $query = "SELECT * FROM tbl_trees";
                                      $table = tbl_trees;
                                      $result = mysql_query($query);
                                      if (!$result) {
                                        die("Something went wrong!").mysql_error();
                                      }

                                      $num = mysql_num_rows($result);
                                      
                                      echo "<table border='1' class='table table-hover' id='del'><tr>";
                                      echo "<th>#</th><th>Tree name</th><th>Tree color</th><th>Options</th>";  
                                      echo "</tr>";
                                      for ($i=0; $i < $num ; $i++) { 
                                        echo "<tr>";
                                        $tree_name = mysql_result($result,$i,'tree_name');
                                        $color = mysql_result($result,$i,'color');
                                        $tree_id = mysql_result($result,$i, 'tree_id');
                                        
                                        echo "<td>$tree_id</td>
                                            <td id='$tree_id'>$tree_name</td>
                                            <td id='$tree_id'>$color</td>
                                            <td id='$tree_id'><button type='button' onclick='deletes($tree_id,$table)'>Delete</button></td>
                                            </tr>";
                                      }
                                      echo "</table>";
                                    ?>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" data-dismiss="modal" class="btn default">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     