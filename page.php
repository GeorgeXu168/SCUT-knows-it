//翻页功能




<div class="peger">共<?php echo $pager['count'];?>条记录&nbsp;当前<?php echo $pager['page'];?>/<?php echo $pager['page_count'];?>页&nbsp;

<?php if($pager['first']) { ?>
<a href="<?php echo $pager['first'];?>">第一页  </a>
<?php } else { ?>第一页  <?php } ?>

<?php if($pager['prev']) { ?>
<a href="<?php echo $pager['prev'];?>">上一页  </a>
<?php } else { ?>上一页  <?php } ?>

<?php if($pager['next']) { ?>
<a href="<?php echo $pager['next'];?>">下一页  </a>
<?php } else { ?>下一页  <?php } ?>

<?php if($pager['last']) { ?>
<a href="<?php echo $pager['last'];?>">最后页  </a>
<?php } else { ?>最后页  <?php } ?>

</div>
