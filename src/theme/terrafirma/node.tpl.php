<div class="post">
	<div class="header">
		<h3><?php print $node['title']; ?></h3>
		<div class="date"><?php print date('M. d, Y', $node['created']); ?></div>
	</div>
	<div class="content">
		<!--img src="/<?php print $basePath; ?>images/pic1.jpg" class="picA floatleft" alt="" /-->
		<div class="deck" style="font-size: 14pt; font-weight: bolder; line-height: 1.2em; margin-bottom: 15px;">
		  <?php print $node['nodewords']['description']; ?>
		</div>
		
		<?php print $node['body']; ?>
		<p></p>
	</div>			
	<div class="footer">
		<ul>
			<li class="printerfriendly"><a href="#">Printer Friendly</a></li>
			<li class="comments"><a href="#">Comments (18)</a></li>
			<li class="readmore"><a href="#">Read more</a></li>
		</ul>
	</div>
</div>