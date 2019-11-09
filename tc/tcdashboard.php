<?php
include ('./layout/layout.php');
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
	
	
	

    <section class="buckets">
      <ul>
        <li>
          <img src="https://source.unsplash.com/KUfkX6gVwBU/600x400" alt="Fog over Oslo.">
          <div class="bucket">
            <h3 class="bucket-title">Grid is great</h3>
            <p>CSS Grid is a two-dimensional layout tool. 
			It is great for layout out content in a grid, 
			and for laying out content in two dimensions.</p>
          </div><!-- .bucket -->
        </li>
        <li>
          <img src="https://source.unsplash.com/1jKjJjGgDG8/600x400" alt="Sunset over the Oslo fjord.">
          <div class="bucket">
            <h3 class="bucket-title">Flex is great too</h3>
            <p>Grid is not always the right option for layuts. 
			If for example you need to lay out a series of identical boxes like those you see here, 
			Flex may be a better option.</p>
          </div><!-- .bucket -->
        </li>
      </ul>
    </section><!-- .buckets -->
	
	
	
	

    <section class="more">
      <div class="more-content">
        <h2 class="content-title">Subgrid could be nice here</h2>
        <p>The solution provided here is limited by the lack of support for subgrids. 
		If subgrids were available, the solution would be more refined. 
		That said, the lack of subgrid was what brought me to this solution, 
		and it has practical applications well outside of the current demo. 
		So maybe not having subgrid has opened the door to other more interesting opportunities?<p>
      </div><!-- .more-content -->
    </section><!-- .more -->

  </main>
<!-- END OF MAIN -->
  
  
  
  
  
  
  







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

</div><!-- .splash-text -->
</div><!-- .splash-content -->
</section><!-- .splash -->

<?php
include('./layout/layout2.php');
?>
