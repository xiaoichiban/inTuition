<?php

include('session.php');

?>



<link rel="stylesheet" type="text/css" href="grid.css">



<div class="site">
  <a class="skip-link screen-reader-text" href="#content">Skip to content</a>

  <header class="masthead">
    <div class="logo">GRID PILE</div>
    <h2 class="site-title">Stacked CSS Grid Effect</h2>
  </header><!-- .masthead -->

  <main id="content" class="main-area">
    
	
	<figure class="feature">
      <img src="https://source.unsplash.com/w3lQVmuK8fw/1200x600" alt="Fox.">
    </figure>
	
	
	
	
	
    <section class="splash">
      <div class="splash-content">
        <h2 class="content-title">Magical content restructuring with CSS Grid stacks</h2>
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
          <p>A detailed breakdown of this demo explaining the approach
		  and how everything fits together can be found on 
		  <a href="https://www.linkedin.com/pulse/grid-pile-stacking-css-grids-impossible-layouts-rand-hendriksen">
		  LinkedIn Pulse</a>.</p>
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
  
  
  
  
  
  
  