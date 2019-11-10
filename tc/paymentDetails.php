<?php
include('./layout/layout.php');

// Get Session Username
$thisusername = $_SESSION['username'];
// echo $thisusername;


// SQL PART
$sqlSTRING = "SELECT * FROM tc WHERE username = '$thisusername' ";
$result = mysqli_query($db,$sqlSTRING);
$row = mysqli_fetch_assoc($result);
//$active = $row['active'];
$count = mysqli_num_rows($result);

$credit_card_num = $row['credit_card_num'];
$valid_till = $row['valid_till'];
$credit_card_name = $row['credit_card_name'];
$cvv = $row['cvv'];
?>

	<figure class="feature">
      <img src="./layout/banner.jpg" 
	  alt="Fox.">
    </figure>
	
	

	
    <section class="splash">
      <div class="splash-content">
        <h2 class="content-title">Title</h2>
        <div class="splash-text">
          <p>This example demonstrates how to reposition content
		  in a view by stacking multiple grids on top of one another.
		  The goal of the example is to retain a logical markup structure
		  while still allowing content to be split up and positioned on the grid.
		  Case in point: From a HTML semantics standpoint, the main area should come
		  before the sidebar area, and both should live on the same level without extra wrappers.
		  This demo shows how stacking two grids allows the sidebar items to appear as if they are
		  placed on the same grid as the main content while they are in reality placed in a separate
		  grid positioned within and superimposed on top of the original grid.</p>
        </div><!-- .splash-text -->
      </div><!-- .splash-content -->
    </section><!-- .splash -->


	
    <section class="splash">
      <div class="splash-content">
        <h2 class="content-title">Title</h2>
        <div class="splash-text">
          <p>
		  
		  <?php
			echo "  ".$credit_card_num;
			echo "  ".$valid_till;
			echo "  ".$credit_card_name;
			echo "  ".$cvv;
		  ?>
		  
		  
		  </p>
        </div><!-- .splash-text -->
      </div><!-- .splash-content -->
    </section><!-- .splash -->
	
	
	
<?php
include('./layout/layout2.php');
?>
