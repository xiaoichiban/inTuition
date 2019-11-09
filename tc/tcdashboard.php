<?php
include ('./layout/layout.php');
?>

<head>
<title>Dashboard</title>
</head>







    <section class="buckets">
      <ul>
        <li>
          <div class="bucket">
            <h3 class="bucket-title">Grid is great</h3>
            <p>CSS Grid is a <br/> 2-D layout tool. </p>
          </div><!-- .bucket -->
        </li>
        <li>
          <div class="bucket">
            <h3 class="bucket-title">Grid is great</h3>
            <p>CSS Grid is a <br/> 2-D layout tool. </p>
          </div><!-- .bucket -->
        </li>
      </ul>
    </section><!-- .buckets -->














<section class='splash'>
<div class='splash-content'>
<h2 class='content-title'>Magical content restructuring with CSS Grid stacks</h2>
<div class='splash-text'>


<?php
echo "Logged in As:<br/>";
echo "user_id=".$_SESSION['user_id']."<br/>";
echo "username=".$_SESSION['username']."<br/>";
echo "login_user=".$_SESSION['login_user']."<br/>";
?>


<!-- SideBar + Footers -->

<?php
echo"</div><!-- .splash-text --></div><!-- .splash-content --></section><!-- .splash -->";
include('./layout/layout2.php');

?>
