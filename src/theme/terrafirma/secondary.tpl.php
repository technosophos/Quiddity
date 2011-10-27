<h3>About the Author</h3>
<div class="content">
	<img src="/<?php print $basePath; ?>images/pic2.jpg" class="picB" alt="" />
	<p><?php print $node['field_author_override'][0]['value']; ?></p>
</div>

<div class="content">
  <?php //print $node['field_right_ad'][0]['value']; ?>
</div>

<h3>Related Topics</h3>
<div class="content">
	<ul class="linklist">
	  
	  <?php
	  $isFirst = TRUE;
	  foreach ($node['taxonomy'] as $tid => $data) {
	  ?>
	  
		<li class="<?php print $isFirst ? 'first tag' : 'tag'; ?>"><a 
		  href="<?php print '/term/' . $tid; ?>"><?php print $data['name'];?> (32)</a></li>
		
		<?php
		  if ($isFirst) $isFirst = FALSE;
		}
		?>
	</ul>
</div>