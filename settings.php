<?php
  include("templates/header.php");
  require_once("utils/dbconnect.php");
  require_once("utils/api.php");
  require_once("templates/display_labels.php");
  require_once("utils/authenticate.php");
  require_once("utils/verification.php");
  $db=getdb();
  $auth = new authenticate();
  session_start();

  // must be logged in to see this page
  if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
  }

  $user = get_all_current_user_details($db, $_SESSION['user_id']);

  if ($_FILES[csv][size] > 0) { 

    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database if the user has posted 
    //this is only called if someone has uploaded a new CSV file.
    do {
        if (is_numeric($data[0])) { 
            echo $data[0];
            echo $data[1];
            echo $data[2];
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
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //redirect 
    header('Location: settings.php?success=1'); die; 

	} 
  ?>
  <div class="row">
    <div class="large-6 large-offset-1" style="min-height: 700px">
      <h3> User Settings </h3>
        <form onsubmit="return updateUserInfo();" name="updateUser" id="updateUser">
        <div class="row">
            <div class="large-2 columns">
                <label for="username" class="right">Username</label>
            </div>
            <div class="large-5 columns">
            <input type="text" id="user_name" name = "user_name" value=<?php echo $user['username']; ?> disabled=true>
            </div>
            <div class="large-5 columns">
            </div>
        </div>
        <input type="hidden" id="username" name = "username" value=<?php echo $user['username']; ?>>
        <input type="hidden" id="userid" name = "userid" value=<?php echo $user['user_id']; ?>>
        <br>
        <div class="row">
            <div class="large-2 columns">
                <label for="first" class="right">First Name</label>
            </div>
            <div class="large-4 columns">
                <input type="text" id="first" name = "first" value=<?php echo $user['first']; ?>>
            </div>
            <div class="large-2 columns">
                <label for="first" class="right">Last Name</label>
            </div>
            <div class="large-4 columns">
                <input type="text" id="last" name = "last" value=<?php echo $user['last']; ?>>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="large-2 columns">
                <label for="email" class="right">Email Address</label>
            </div>
            <div class="large-5 columns"> 
                <input type="text" id="email" name = "email" value=<?php echo $user['email']; ?>>   
            </div>
            <div class="large-5 columns">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="large-2 columns">
                <label for="password" class="right">Password</label>
            </div>
            <div class="large-5 columns"> 
                <input type="text" id="password" name = "password">   
            </div>
            <div class="large-5 columns">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="large-2 columns">
                <label for="confirm_password" class="right">Confirm Password</label>
            </div>
            <div class="large-5 columns"> 
                <input type="text" id="confirm_password" name = "confirm_password">   
            </div>
            <div class="large-5 columns">
            </div>
        </div>
        <br>
        <input type="submit" id="login" value="Save Profile Changes" class="button large-offset-2">
        <p id="userProfileUpdated" style="visibility:hidden" class="large-offset-1 columns"> User Profile successfully updated! </p>
     
      </form>

      <div class="row admin-only">
        <h3> Admin Settings </h3>
        <h5> Add a new CSV file of nutrition label information </h5>
        <?php if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> 
    
	    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
	      <input name="csv" type="file" id="csv" class="button secondary" />
	      <input type="submit" class="button" name="Submit" value="Add New CSV" /> 
	    </form> 
      </div>
      <div class="row admin-only">
        <h5>Update Verification Settings</h5>
        <form onsubmit="return changeVerification();" name="numVerifications" id="numVerifications">
        <div class="large-7 columns">
            <label for="count" class="right">Number of verifications before label completion:</label>
        </div>
        <div class="large-2 columns"> 
            <input type="text" id="count" name = "count" value='<?php echo get_verification_number($db); ?>'>
        </div>
        <br>
        <div class="large-3 columns">
        </div>
            <input type="submit" class="button" value="Update number of Verifications"/> 
        </form>
    </div>
    <div class="row admin-only">
      <h5> Retrieve Completed Labels</h5>
      <p> This downloads a CSV file to your computer </p>
        <form action="utils/getCompleteCSV.php">
          <input type="submit" class="button" name="Submit" value="Download Completed Labels" /> 
        </form>
    </div>
    <div class="row admin-only">
        <h5>Manage Users</h5>
        <script>
        function showUser(str)
        {
        if (str=="")
          {
          document.getElementById("txtHint").innerHTML="";
          return;
          } 
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
        }
        </script>
        <?php 
            $numSub = 0;
            function generateSelect($name = '', $options = array()) 
            {
                $html = '<form> <select name="'.$name.'" onchange="showUser(this.value)">';
                foreach ($options as $option => $value) {
                    $html .= '<option value='.$value.'>'.$value.'</option>';
                }
                $html .= '</select></form>
                <br>
                <div id="txtHint"><b>Person info will be listed here.</b></div>';
                return $html;
            }
            $users = mysqli_query($db, "SELECT * FROM user");
            while ($userInfo = mysqli_fetch_array($users))
            {
                $userstable[] = $userInfo['username'];
            }
            $html = generateSelect('usernames', $userstable);
            echo $html;
        ?>
    </div>
    <div class="large-3 columns"></div>
  </div>
</div>

<?php 
  if($auth->isAdmin($_SESSION['user_id'])===false) {
    echo 
        '<script type="text/javascript">
            $(".admin-only").hide();
        </script>';
  }

    include("templates/footer.php");  
?>


