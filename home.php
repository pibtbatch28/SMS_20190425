<?php require_once('DB_CONNECTION/DB_Connection.php'); ?>
<?php  session_start();?>
<?php if (!isset($_SESSION["curuser"])|| !isset($_SESSION["cracid"])){
header('Location: index.php');
}?>
 <?php if(isset($_POST['sign_out'])){
          //Clearing all session variables
          session_unset();
          Header('Location: index.php');
          
         
        }?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0">
	        <meta http-equiv="x-UA-Compatible" content="id=edge">
	<title>Admin</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="admin.css">
</head>
<body>
	<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
		<a href="#" class="navbar-brand col-sm-3 col-md-2 mr-0 p-3 "><h2>STUDENT MANAGEMENT SYSTEM</h2></a>
		<!-- <input type="text" class="form-control form-control-dark w-100" placeholder="search" aria-lable="Search"> -->
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
<?php echo  '<div class="navbar-brand col-sm-3 col-md-2 mr-0 p-3 "><h6>WELCOME '.$_SESSION["curuser"].' ! <h6/><div/>';?>
				<!--<a href="index.php" class="nav-link">Sign out</a>-->
        <form action="home.php" method="post">
        <!--<a action="home.php" method="post" name="so" class="nav-link">Sign out</a>--->
        <button  type="submit" name="sign_out" onmouseover="this.style.color='rgba(255, 255, 255, 0.75)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.5)'" style="color: rgba(255, 255, 255, 0.5); background-color: transparent; border: none; " >SIGN OUT</button>
      </form>
       
			</li>
		</ul>
		</nav>

		<div class="container-fluid">
			<div class="row">
				<nav class="col-md-2 d-none d-md-block bg-dark sidebar">
					<div class="sidebar-sticky">
						<ul class="nav flex-column">
							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="home"></span>
									Dashboard<span class="sr-only ">(current</span>
								</a>
							</li>
  <form action="home.php" method="post">
              <?php 
              //this is occur for create autherized buttons(Left side menu buttons)
              //fetching acc_id
              $ACC_ID = $_SESSION["cracid"];
              //Fetching function id for acc_id
              $sqlq = "SELECT FUNC_ID FROM ACC_ACCESS WHERE ACC_ID=?";
              $para = array($ACC_ID);
              $stmt = sqlsrv_query($con,$sqlq,$para);
          //    $res = sqlsrv_execute($stmt);
              if($stmt){
                while($rec = sqlsrv_fetch_array($stmt)){
                   $FUNC_ID = $rec['FUNC_ID'];
                   //Getting link and info for FUNC_ID
                   $sqlac = "SELECT PAGE_LINK,INFO,IMG FROM ACC_ACCESS_DEF WHERE FUNC_ID=?";
                   $paraac = array($FUNC_ID);
                   $stmtac = sqlsrv_prepare($con,$sqlac,$paraac);
                   $res1 = sqlsrv_execute($stmtac);
                   while ($recl = sqlsrv_fetch_array($stmtac)) {
                     # code...
                    //Output with new line and new link
               /* echo '<li class="nav-item">
                <a href="'.$recl['PAGE_LINK'].'" class="nav-link text-white mt-5">
                  <span data-feather="file"></span>'
                  .$recl['INFO'].
                  '
                </a>
              </li>';*/

              echo '<li >
                <button type="submit" name="'.$recl['PAGE_LINK'].'"  class="nav-link text-white mt-5" style="background-color: transparent; border: none;">'.$recl['IMG'].'

                  <span data-feather="file"></span>'
                  .$recl['INFO'].
                  '
                </button>
              </li>';
                   }

//$sql = "UPDATE Table_1 SET data = ? WHERE id = ?";

//$params = array("updated data", 1);

//$stmt = sqlsrv_query( $conn, $sql, $params);


                }
              }else{
                $acc_er = "You have no any access! Please contact system adimn..";
              }
              ?>
</form>

							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file"></span>
									Orders
								</a>
							</li>

							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="Shopping-cart"></span>
									Product
								</a>
							</li>

							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file"></span>
									Custmers
								</a>
							</li>

							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file"></span>
									Reportes
								</a>
							</li>

							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file"></span>
									Integration
								</a>
							</li>
						</ul>

						<h6 class="sidebar-haeding d-flex justify-content-between align-items-center px-3 mt-4 mb-1 texxt-muted">
							<span class="nav-link text-white mt-5">Saved reports</span>
							<a href="#" class="d-flex align-items-center text-muted">
								<span data-feather="plus-circle"></span>
							</a>
						</h6>
						<ul class="nav flex-column mb-2 ">
							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file-text"></span>Current month
								</a>
							</li>
							
							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file-text"></span>Last quarter
								</a>
							</li>

							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file-text"></span>Social engagement
								</a>
							</li>

							<li class="nav-item">
								<a href="#" class="nav-link text-white mt-5">
									<span data-feather="file-text"></span>Year-end sale
								</a>
							</li>
						</ul>
						
					</div>
					
				</nav>

				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
					<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

					<!--	<h1 class="h2 mt-5">Dashboard</h1>-->
                       <!--   <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                             <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                            </div>
                            --> <!--<button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                             <span data-feather="calendar"></span>
                            This week
                               </button>
                              </div>
						 -->
					</div>

				<!--	<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>--->
<?php 
function mkhead($shed){
$newhed = '<h1 class="h2 mt-5">'.$shed.'</h1><hr/><div class="mb-2 mb-md-0">';
return $newhed;
}
/*function exsql($q,$para){
//  $result = array();
  $stmt = sqlsrv_prepare($con,$q,$para);
  $exe = sqlsrv_execute($stmt);
  return $stmt;

}*/

//when click create new user on user mangement
if(isset($_POST['crt_user'])){
  echo '<form action="home.php" method="post">';

  echo mkhead('Create User');

  
  echo ' <input name="user_id_crt" type="text" id="inputEmail" class="form-control rd" placeholder="User Id" required autofocus><br>
   <input name="pwd_crt" type="Password" id="inputEmail" class="form-control rd" placeholder="Password" required><br>';
   //*********************************
 //  echo '<label id="inputEmail" class="rd">Password</label>';
          echo '<SELECT class="form-control" name="selected_acc_lvl">';
  $sqlac_lvl = "SELECT ACC_ID,INFO FROM ACC_LEVEL_DEF";
  $stmtac_lvl = sqlsrv_prepare($con,$sqlac_lvl,null);
  $res0 = sqlsrv_execute($stmtac_lvl);
  while ($recac_lvl = sqlsrv_fetch_array($stmtac_lvl)) {
    # code...
    echo '<option value="'.$recac_lvl['ACC_ID'].'">'.$recac_lvl['INFO'].'</option>';

  }
  echo '</SELECT></br>';
  //**********************************************






   echo '<input name="fnme_crt" type="text" id="inputEmail" class="form-control rd" placeholder="First Name" required ><br>
     <input name="lnme_crt" type="text" id="inputEmail" class="form-control rd" placeholder="Last Name" required ><br>
      <input name="phnn_crt" type="text" id="inputEmail" class="form-control rd" placeholder="Phone Number"  ><br>
       <input name="email_crt" type="text" id="inputEmail" class="form-control rd" placeholder="Email" required ><br/>
      <button type="submit" name="crt_user_save" class="btn btn-primary btn-block" style=" border: none;">
  Save</button> ';
   







  echo '</form></div>';

}
//when clicking save on create user
if(isset($_POST['crt_user_save'])){
  echo mkhead('Create User');
$sql_crt = "INSERT INTO USER_ACC VALUES(?,?,?,?,?,?,?)";
$hashed_pass=password_hash($_POST['pwd_crt'], PASSWORD_DEFAULT);
$sql_crt_para = array($_POST['user_id_crt'],$hashed_pass,$_POST['fnme_crt'],$_POST['lnme_crt'],$_POST['phnn_crt'],$_POST['email_crt'],$_POST['selected_acc_lvl']);
$stmt_crt = sqlsrv_query($con,$sql_crt,$sql_crt_para);
if($stmt_crt){
  echo 'saved';
}else{
  echo 'Fail'.$stmt_crt;
}







  
}
//when click User user management on side menu
if(isset($_POST['user_mng'])){//
  echo mkhead('Users');
  $user_list='';

  echo '<div class="table-responsive"><table class="table table-striped table-sm"><thead><th>User ID</th><th>Access Level</th><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Email</th>';
  $sqlq = 'SELECT * FROM USER_ACC';
  $stmt = sqlsrv_query($con,$sqlq,null);
  while ($rec = sqlsrv_fetch_array($stmt)) {
    # code...
    $user_list .='<tr>';
    $user_list .='<td>'.$rec['USER_ID'].'</td>';
    $ssql = 'SELECT INFO FROM ACC_LEVEL_DEF WHERE ACC_ID=?';
        $sspara =array($rec['ACC_ID']);
        $ssprep = sqlsrv_prepare($con,$ssql,$sspara);
        $ssexe = sqlsrv_execute($ssprep);
        while($srec = sqlsrv_fetch_array($ssprep)){
          $user_list .='<td>'.$srec['INFO'].'</td>';
        }
    $user_list .='<td>'.$rec['FNAME'].'</td>';
    $user_list .='<td>'.$rec['LNAME'].'</td>';
    $user_list .='<td>'.$rec['PHONE_NUMBER'].'</td>';
    $user_list .='<td>'.$rec['EMAIL'].'</td>';
  }
  echo $user_list;
  echo '</thead></table></div></div>';
   echo '<form action="home.php" method="post">';
    echo '<div class="btn-group mr-2" style="float:right">
                            <button name="crt_user" type="submit" class="btn btn-sm btn-outline-secondary">Create new User</button>
                            
                            </div></form>';
}

/****************
function lvls(){
   
  $sqlac_lvl = "SELECT ACC_ID,INFO FROM ACC_LEVEL_DEF";
  $stmtac_lvl = sqlsrv_prepare($con,$sqlac_lvl,null);
  $res0 = sqlsrv_execute($stmtac_lvl);
  while ($recac_lvl = sqlsrv_fetch_array($stmtac_lvl)) {
    # code...
    $ACC_LEVELS[] = '<option value="'.$recac_lvl['ACC_ID'].'">'.$recac_lvl['INFO'].'</option>';

  }

}***************/

//***************When click Create Access Level on side menu
if(isset($_POST['acc_lvl'])){
//  echo '<h1 class="h2 mt-5">Create Access Level</h1><hr/><div class="mb-2 mb-md-0">';
   echo mkhead('Access Levels');
  echo '<form action="home.php" method="post"><SELECT name="selected_acc_lvl" class="form-control">';
 /* lvls();
  echo $ACC_LEVELS;
 foreach ($ACC_LEVELS as $ACC_LEVEL) {
   # code...
  echo $ACC_LEVEL;

 }*/
  $sqlac_lvl = "SELECT ACC_ID,INFO FROM ACC_LEVEL_DEF";
  $stmtac_lvl = sqlsrv_query($con,$sqlac_lvl,null);
  while ($recac_lvl = sqlsrv_fetch_array($stmtac_lvl)) {
    # code...
    echo '<option value="'.$recac_lvl['ACC_ID'].'">'.$recac_lvl['INFO'].'</option>';

  }
  echo '</SELECT><br/><button type="submit" name="def_acc" class="btn btn-primary btn-block" style=" border: none;">
  Find</button></form></div>';
//$curlevl=$_POST['selected_acc_lvl'];
}
//selected_acc_lvl is drop down value, for find button in user access level,when submit setted value to this select variable
if(isset($_POST['selected_acc_lvl'])){
  //print_r($_POST);
echo mkhead('Access Levels');
  /*********************************************************/
    //echo '<h1 class="h2 mt-5">Create Access Level</h1><hr/><div class="mb-2 mb-md-0">';
  echo '<form action="home.php" method="post"><SELECT name="selected_acc_lvl" class="form-control">';
  $sqlac_lvl = "SELECT ACC_ID,INFO FROM ACC_LEVEL_DEF";
  $stmtac_lvl = sqlsrv_query($con,$sqlac_lvl,null);
  while ($recac_lvl = sqlsrv_fetch_array($stmtac_lvl)) {
    # code...
    echo '<option value="'.$recac_lvl['ACC_ID'].'">'.$recac_lvl['INFO'].'</option>';

  }
  echo '</SELECT><br/><button type="submit" name="def_acc" class="btn btn-primary btn-block" style=" border: none;">
  Find</button></form>';
  /*************************************************************/
  echo '<div class="table-responsive"><table class="table table-striped table-sm"><thead><tr><th>Function ID</th><th>Description</th></tr>';
  $sqlac_acc= "SELECT FUNC_ID FROM ACC_ACCESS WHERE ACC_ID=?";
  $paraac_acc=array($_POST['selected_acc_lvl']);
  $stmtac_acc=sqlsrv_query($con,$sqlac_acc,$paraac_acc);
  while ($recac_acc = sqlsrv_fetch_array($stmtac_acc)) {
    # code...
    $FUNC_ID_func = array($recac_acc['FUNC_ID']);
    $sqlfunc = "SELECT INFO FROM ACC_ACCESS_DEF WHERE FUNC_ID=?";
    $stmtac_func = sqlsrv_prepare($con,$sqlfunc,$FUNC_ID_func);
    $res_FUNC = sqlsrv_execute($stmtac_func);
    while ($rec_acc_func = sqlsrv_fetch_array($stmtac_func)) {
      # code...
      echo '<tr><td>'.$recac_acc['FUNC_ID'].'</td><td>'.$rec_acc_func['INFO'].'</td></tr>';
    }
  }
  echo '</thead></table></div></div>';

}
function pro_mng($con){
  echo mkhead('Programs');
    echo '<div class="table-responsive"><table class="table table-striped table-sm"><thead><tr><th>Programe ID</th><th>Description</th><th>Allocated Course ID</th><th>Allocated Course Description</th></tr>';
  $sqlq = 'SELECT PROGRAME_TITLE AS P_ID, INFO, CRSE_ID FROM PROGRAMS_DEF';
  $stmt = sqlsrv_query($con,$sqlq,null);
  while($rec = sqlsrv_fetch_array($stmt)){
      echo '<tr><td>'.$rec['P_ID'].'</td><td>'.$rec['INFO'].'</td>';
      $ssql = 'SELECT TITLE,INFO FROM COURSES_DEF WHERE CRSE_ID=?';
      $spara = array($rec['CRSE_ID']);
      $sprep = sqlsrv_prepare($con,$ssql,$spara);
      $sres = sqlsrv_execute($sprep);
      while($srec = sqlsrv_fetch_array($sprep)){
        echo '<td>'.$srec['TITLE'].'</td><td>'.$srec['INFO'].'</td></tr>';
      }

  }

   echo '</thead></table></div></div>';
    echo '<form action="home.php" method="post"><div class="btn-group mr-2" style="float:right">
                              <button name="vw_subs" type="submit" class="btn btn-sm btn-outline-secondary">Subjects</button>
                              <button name="vw_crses" type="submit" class="btn btn-sm btn-outline-secondary">Courses</button>
                            <button name="crt_prog" type="submit" class="btn btn-sm btn-outline-secondary">New programe</button>
                            
                            </div></form>';

}
//when click Programe Management on side menu
if(isset($_POST['pro_mng'])){
pro_mng($con);
/*echo mkhead('Programs');
    echo '<div class="table-responsive"><table class="table table-striped table-sm"><thead><tr><th>Programe ID</th><th>Description</th><th>Allocated Course ID</th><th>Allocated Course Description</th></tr>';
  $sqlq = 'SELECT PROGRAME_TITLE AS P_ID, INFO, CRSE_ID FROM PROGRAMS_DEF';
  $stmt = sqlsrv_query($con,$sqlq,null);
  while($rec = sqlsrv_fetch_array($stmt)){
      echo '<tr><td>'.$rec['P_ID'].'</td><td>'.$rec['INFO'].'</td>';
      $ssql = 'SELECT TITLE,INFO FROM COURSES_DEF WHERE CRSE_ID=?';
      $spara = array($rec['CRSE_ID']);
      $sprep = sqlsrv_prepare($con,$ssql,$spara);
      $sres = sqlsrv_execute($sprep);
      while($srec = sqlsrv_fetch_array($sprep)){
        echo '<td>'.$srec['TITLE'].'</td><td>'.$srec['INFO'].'</td></tr>';
      }

  }

   echo '</thead></table></div></div>';
    echo '<div class="btn-group mr-2" style="float:right"><form action="home.php" method="post">
                              <button name="vw_subs" type="submit" class="btn btn-sm btn-outline-secondary">Subjects</button>
                              <button name="vw_crses" type="submit" class="btn btn-sm btn-outline-secondary">Courses</button>
                            <button name="crt_prog" type="submit" class="btn btn-sm btn-outline-secondary">New programe</button>
                            
                            </form></div>';**/
}
//Subjects on programe management
if(isset($_POST['vw_subs'])){
  pro_mng($con);
   echo mkhead('Subjects');

  $sub_sql = 'SELECT SUB_ID AS NUM,TITLE AS SUB_ID,INFO FROM SUBJECTS_DEF';
  $sub_qu = sqlsrv_query($con,$sub_sql,null);
  echo '<div class="table-responsive"><table class="table table-striped table-sm"><thead><tr><th>#</th><th>Subject ID</th><th>Description</th></tr>';
  while($sub_rec = sqlsrv_fetch_array($sub_qu)){
    echo '<tr><td>'.$sub_rec['NUM'].'</td><td>'.$sub_rec['SUB_ID'].'</td><td>'.$sub_rec['INFO'].'</td></tr>';
  }
  echo '</table></div>';
 echo '<div class="btn-group mr-2"><form action="home.php" method="post">
                              <button name="new_subs" type="submit" class="btn btn-sm btn-outline-secondary">Add Subject</button>
                            </form></div>';
}
//Courses on programe management
if(isset($_POST['vw_crses'])){
   pro_mng($con);
   echo mkhead('Courses');
  $crse_sql = 'SELECT CRSE_ID,TITLE,INFO FROM COURSES_DEF';
  $crse_stm = sqlsrv_query($con,$crse_sql,null);
    echo '<div class="table-responsive"><table class="table table-striped table-sm"><thead><tr><th>#</th><th>Course ID</th><th>Description</th></tr>';
  while ($crse_rec = sqlsrv_fetch_array($crse_stm)) {
    echo '<tr><td>'.$crse_rec['CRSE_ID'].'</td><td>'.$crse_rec['TITLE'].'</td><td>'.$crse_rec['INFO'].'</td></tr>';
    # code...
  }
  echo '</table></div>';
   echo '<div class="btn-group mr-2"><form action="home.php" method="post">
                              <button name="new_crse" type="submit" class="btn btn-sm btn-outline-secondary">Add Course</button>
                            </form></div>';
}
//Add Subject on programe mng->sujects
if(isset($_POST['new_subs'])){

}
?>


					<h2>Section title</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Header</th>
              <th>Header</th>
              <th>Header</th>
              <th>Header</th>
            </tr>
            <tr>
              <td>1,001</td>
              <td>Lorem</td>
              <td>ipsum</td>
              <td>dolor</td>
              <td>sit</td>
            </tr>
            <tr>
              <td>1,002</td>
              <td>amet</td>
              <td>consectetur</td>
              <td>adipiscing</td>
              <td>elit</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>Integer</td>
              <td>nec</td>
              <td>odio</td>
              <td>Praesent</td>
            </tr>
            <tr>
              <td>1,003</td>
              <td>libero</td>
              <td>Sed</td>
              <td>cursus</td>
              <td>ante</td>
            </tr>
            <tr>
              <td>1,004</td>
              <td>dapibus</td>
              <td>diam</td>
              <td>Sed</td>
              <td>nisi</td>
            </tr>
            <tr>
              <td>1,005</td>
              <td>Nulla</td>
              <td>quis</td>
              <td>sem</td>
              <td>at</td>
            </tr>
            <tr>
              <td>1,006</td>
              <td>nibh</td>
              <td>elementum</td>
              <td>imperdiet</td>
              <td>Duis</td>
            </tr>
            <tr>
              <td>1,007</td>
              <td>sagittis</td>
              <td>ipsum</td>
              <td>Praesent</td>
              <td>mauris</td>
            </tr>
            <tr>
              <td>1,008</td>
              <td>Fusce</td>
              <td>nec</td>
              <td>tellus</td>
              <td>sed</td>
            </tr>
            <tr>
              <td>1,009</td>
              <td>augue</td>
              <td>semper</td>
              <td>porta</td>
              <td>Mauris</td>
            </tr>
            <tr>
              <td>1,010</td>
              <td>massa</td>
              <td>Vestibulum</td>
              <td>lacinia</td>
              <td>arcu</td>
            </tr>
            <tr>
              <td>1,011</td>
              <td>eget</td>
              <td>nulla</td>
              <td>Class</td>
              <td>aptent</td>
            </tr>
            <tr>
              <td>1,012</td>
              <td>taciti</td>
              <td>sociosqu</td>
              <td>ad</td>
              <td>litora</td>
            </tr>
            <tr>
              <td>1,013</td>
              <td>torquent</td>
              <td>per</td>
              <td>conubia</td>
              <td>nostra</td>
            </tr>
            <tr>
              <td>1,014</td>
              <td>per</td>
              <td>inceptos</td>
              <td>himenaeos</td>
              <td>Curabitur</td>
            </tr>
            <tr>
              <td>1,015</td>
              <td>sodales</td>
              <td>ligula</td>
              <td>in</td>
              <td>libero</td>
            </tr>
          </thead>
          <tbody>
					
				</main>
			</div>
		</div>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
<?php sqlsrv_close($con);?>