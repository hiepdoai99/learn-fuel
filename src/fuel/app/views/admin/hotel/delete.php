<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('hotel/index','Index');?></li>
	<li class='<?php echo Arr::get($subnav, "view" ); ?>'><?php echo Html::anchor('hotel/view','View');?></li>
	<li class='<?php echo Arr::get($subnav, "create" ); ?>'><?php echo Html::anchor('hotel/create','Create');?></li>
	<li class='<?php echo Arr::get($subnav, "edit" ); ?>'><?php echo Html::anchor('hotel/edit','Edit');?></li>
	<li class='<?php echo Arr::get($subnav, "delete" ); ?>'><?php echo Html::anchor('hotel/delete','Delete');?></li>

</ul>
<p>Delete</p>