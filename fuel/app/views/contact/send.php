<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('contact/index','Index');?></li>
	<li class='<?php echo Arr::get($subnav, "confirm" ); ?>'><?php echo Html::anchor('contact/confirm','Confirm');?></li>
	<li class='<?php echo Arr::get($subnav, "send" ); ?>'><?php echo Html::anchor('contact/send','Send');?></li>

</ul>
<p>Send</p>