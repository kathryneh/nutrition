<?php
  include("templates/header.php");
  require_once("utils/dbconnect.php");
  require_once("utils/api.php");
  require_once("templates/display_labels.php");
  require_once("utils/authenticate.php");
  require_once("utils/verification.php");
  $db=getdb();
  $auth = new authenticate();

  if ($_FILES[csv][size] > 0) { 

    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
    $row = 1;
     
    //loop through the csv file and insert into database 
    do { 
        if ($row == 1) {$row++; continue; }
        else{
            if ($data[0]) { 
                $db->query("INSERT INTO new_label (upc, servsize ,servunit ,volquantity, 
                								volunit, servcontainer, calories, caloriesfat, 
                								totalfatg, totalfatdv, saturatedfatg, saturatedfatdv, 
                								transfatg, polyunsatfat, monounsatfat, cholesterolmg, 
                								cholesteroldv, sodiummg, sodiumdv, potassiummg, 
                								potassiumdv, totalcarbg, totalcarbdv, dietaryfiberg, 
                								dietaryfiberdv, sugarsg, sugarsalcoholg, othercarbg, 
                								proteing, calciumdv, irondv, vitaminadv, vitamincdv, 
                								vitaminddv, vitaminedv, vitaminb6dv, vitaminb12dv, 
                								thiamindv, riboflavindv, otherinfo, extrainfo) VALUES 
                    ( 
                        '".addslashes($data[0])."',  
                        '".addslashes($data[1])."',
                        '".addslashes($data[2])."',  
                        '".addslashes($data[3])."',
                        '".addslashes($data[4])."',  
                        '".addslashes($data[5])."',
                        '".addslashes($data[6])."',
                        '".addslashes($data[7])."',  
                        '".addslashes($data[8])."',
                        '".addslashes($data[9])."',
                        '".addslashes($data[10])."',  
                        '".addslashes($data[11])."',
                        '".addslashes($data[12])."',  
                        '".addslashes($data[13])."',
                        '".addslashes($data[14])."',  
                        '".addslashes($data[15])."',
                        '".addslashes($data[16])."',
                        '".addslashes($data[17])."',  
                        '".addslashes($data[18])."',
                        '".addslashes($data[19])."',
                        '".addslashes($data[20])."',  
                        '".addslashes($data[21])."',
                        '".addslashes($data[22])."',  
                        '".addslashes($data[23])."',
                        '".addslashes($data[24])."',  
                        '".addslashes($data[25])."',
                        '".addslashes($data[26])."',
                        '".addslashes($data[27])."',  
                        '".addslashes($data[28])."',
                        '".addslashes($data[29])."',
                        '".addslashes($data[30])."',  
                        '".addslashes($data[31])."',
                        '".addslashes($data[32])."',  
                        '".addslashes($data[33])."',
                        '".addslashes($data[34])."',  
                        '".addslashes($data[35])."',
                        '".addslashes($data[36])."',
                        '".addslashes($data[37])."',  
                        '".addslashes($data[38])."',
                        '".addslashes($data[39])."',      
                        '".addslashes($data[40])."' 
                    ) 
                "); 
            } 
        }
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //redirect 
    header('Location: settings.php?success=1'); die; 

	} 
  ?>
  <div class="row">
    <div class="large-6 large-offset-3 columns" style="min-height: 700px">
      <h3> User Settings </h3>
      <form method="POST" action = "ajax/createUser.php" id = "userSignup">
        <label for="username">Username</label>
        <input type="text" id="username" name = "username" disabled=true>
        <label for="first">First Name</label>
        <input type="text" id="first" name = "first">
        <label for="last">Last Name</label>
        <input type="text" id="last" name = "last">
        <label for="email">Email Address</label>
        <input type="text" id="email" name = "email">
        <label for="password">Password</label>
        <input type="password" name = "password" id="password">
        <label for="confirm_password">Confirm Password</label>
        <input type="text" name = "confirm_password" id="confirm_password">
        <input type="submit" id="login" value="Sign Up" class="button">
      </form>
    <h3> Admin Settings </h3>
    <h5> Add a new CSV file of nutrition label information </h5>
      <?php if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> 
    
	<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
	  Select your .csv file with the heading line removed <br/> 
	  <input name="csv" type="file" id="csv" class="button secondary" /> <br />
	  <input type="submit" class="button" name="Submit" value="Submit" /> 
	</form> 
    <form onsubmit="return changeVerification();" name="numVerifications" id="numVerifications">
    <h5> Number of verifications before label completion: </h5>
        <input type="text" id="count" name = "count" value='<?php echo get_verification_number($db); ?>'>
        <input type="submit" class="button"/> 
    </form>
    
    <h5> Retrieve Completed Labels</h5>
    <form action="utils/getCompleteCSV.php">
        <input type="submit" class="button" name="Submit" value="Download Completed Labels" /> 
    </form>
    </div>
    <div class="large-3 columns"></div>
  </div>

  <?php 
  

  include("templates/footer.php");  
?>
