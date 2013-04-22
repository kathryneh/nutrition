<?php

	require_once("utils/dbconnect.php");
	$db = getdb();

	$selected=$_GET["q"];
	$numSub = 0;
	$numberSubmitted =0;
	function findSubmitted($id, $db)
	{
		$submitted = mysqli_query($db, "SELECT * FROM submission");
		while ($subInfo = mysqli_fetch_array($submitted))
		{
		    if($subInfo['user_id'] == $id)
		    {
		        $numSub++;
		    }
		}
		return $numSub/38;
	}
	//echo $numberSubmitted;
	//$finalarray = array($submitted, $id, $numSub, $admin);

	echo "<table border='1'>
                    <tr>
                    <th>Username</th>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Number of Submissions</th>
                    <th>Date Joined</th>
                    <th>Admin</th>
                    </tr>";
    $users = mysqli_query($db, "SELECT * FROM user WHERE username = '".$selected."'");
    //$result = mysql_query($users);
    while($usersInfo = mysqli_fetch_array($users))
  	{
  	  $numberSubmitted = findSubmitted($usersInfo['user_id'], $db);
	  echo "<tr>";
	  echo "<td>" . $usersInfo['username'] . "</td>";
	  echo "<td>" . $usersInfo['user_id'] . "</td>";
	  echo "<td>" . $usersInfo['first'] . "</td>";
	  echo "<td>" . $usersInfo['last'] . "</td>";
	  echo "<td>" . $numberSubmitted . "</td>";
	  echo "<td>" . $usersInfo['date_created'] . "</td>";
	  if ($usersInfo['admin'] == 0)
	  {
	  	echo "<td>No</td>";
	  	echo '<td><form onsubmit="return updateAdminInfo();" name="updateAdmin" id="updateAdmin">
	  		  <input type = "text" id="userid" name = "userid" value = "'. $usersInfo['user_id'].'" style="visibility:hidden">
	  		  <input type="submit" class="button" value="Make Admin"/> 
              </form></td>';
	  }
	  else
	  {
	  	echo "<td>Yes</td>";
	  }
	  echo "</tr>";
  	}
	echo "</table>";
?>