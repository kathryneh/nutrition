<?php
  include("templates/header.php");
  require_once("utils/dbconnect.php");
  require_once("utils/api.php");
  require_once("templates/display_labels.php");
  require_once("utils/authenticate.php");
  $db=getdb();

  //TODO add images to walk users through this process. 
?> 

  <div class="row">
    <div class="large-3 columns" style="min-height: 700px"></div>
    <div class="large-6 columns" style="margin-top: 100px">
      <h3> How to use this site </h3> 
      <ol>
        <li>Sign up for an account.</li>
        <li>Log in or use the site as a guest.</li>
        <li>Compare user values in the table to the images of a nutrition label.<br>
          <ul>
            <li>If the value is correct and matches the image of a nutrition label, click the "correct" checkbox.</li>
            <li>If the value is not correct, edit the value in the input box.</li>
            <li>If a value is zero, by default it isn't added to the nutrition label table. </li>
            <li>If a value is missing from the nutrition label input data, but is present in the image, click to add it.</li>
          </ul>
        <li>Continue down the nutrition label, and submit it at the end.</li>
        <li>Repeat! Thank you for participating in NuTRUtion!</li>
      </ol>
    </div>
    <div class="large-3 columns"></div>
  </div>

<?php 
  include("templates/footer.php");
?>