<?php
  require_once("utils/dbconnect.php");
  require_once("utils/api.php");
  $selected=$_GET["q"];
  $db=getdb();

	$submitted = mysqli_query($db, "SELECT * FROM submissions");
	while ($subInfo = mysqli_fetch_array($submitted))
	{
	    if($submitted['id'] == $id)
	    {
	        $numSub++;
	    }
	}
	$numberSubmitted = $numSub/18;
	//$numSub = $numSub/18;
	//$finalarray = array($submitted, $id, $numSub, $admin);

	echo "<table border='1'>
                    <tr>
                    <th>Username</th>
                    <th>User ID</th>
                    <th>Number of Submissions</th>
                    <th>Date Joined</th>
                    <th>Admin</th>
                    </tr>";
    $users = mysqli_query($db, "SELECT * FROM user WHERE username = '".$selected"'");
    $result = mysql_query($users);
    while($row = mysql_fetch_array($result))
  	{
	  echo "<tr>";
	  echo "<td>" . $row['username'] . "</td>";
	  echo "<td>" . $row['user_id'] . "</td>";
	  echo "<td>" . $numberSubmitted . "</td>";
	  echo "<td>" . $row['date_created'] . "</td>";
	  echo "<td>" . $row['admin'] . "</td>";
	  echo "</tr>";
  	}
	echo "</table>";
?>