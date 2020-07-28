<?php

  include("../libs/config.php");
  $message = '';
  /* on form submission */
  if(isset($_POST['do_submit']))  {
    /* split the value of the sortation */
    $ids = explode(',',$_POST['sort_order']);
    /* run the update query for each id */
    foreach($ids as $index=>$id) {
      $id = (int) $id;
      if($id != '') {
        $query = 'UPDATE test_table SET sort_order = '.($index + 1).' WHERE id = '.$id;
        $result = mysql_query($query) or die(mysql_error().': '.$query);
      }
    }
    
    /* now what? */
    if($_POST['byajax']) { die(); } else { $message = 'Sortation has been saved.'; }
  }
  $query = 'SELECT id, title FROM test_table ORDER BY sort_order ASC';
  $result = mysql_query($query) or die(mysql_error().': '.$query);
  if(mysql_num_rows($result)) {
  
?>
<style type="text/css">
  #sortable-list    { padding:0; }
#sortable-list li { padding:4px 8px; color:#000; cursor:move; list-style:none; width:500px; background:#ddd; margin:10px 0; border:1px solid #999; }
#message-box    { background:#fffea1; border:2px solid #fc0; padding:4px 8px; margin:0 0 14px 0; width:500px; }
</style>
<p>Drag and drop the elements below.  The database gets updated on every drop.</p>

<div id="message-box"><?php echo $message; ?> Waiting for sortation submission...</div>

<form id="dd-form" action="sortexample" method="post">
<p>
  <input type="checkbox" value="1" name="autoSubmit" id="autoSubmit" <?php if(isset($_POST['autoSubmit'])) { echo 'checked="checked"'; }?> />
  <label for="autoSubmit">Automatically submit on drop event</label>
</p>

<ul id="sortable-list">
  <?php 
    $order = array();
    while($item = mysql_fetch_assoc($result)) {
      echo '<li title="',$item['id'],'">',$item['title'],'</li>';
      $order[] = $item['id'];
    }
  ?>
</ul>
<br />
<input type="hidden" name="sort_order" id="sort_order" value="<?php echo implode(',',$order); ?>" />
<input type="submit" name="do_submit" value="Submit Sortation" class="button" />
</form>
<?php } else { ?>
  
  <p>Sorry!  There are no items in the system.</p>
  
<?php } ?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
/* when the DOM is ready */
jQuery(document).ready(function() {
  /* grab important elements */
  var sortInput = jQuery('#sort_order');
  var submit = jQuery('#autoSubmit');
  var messageBox = jQuery('#message-box');
  var list = jQuery('#sortable-list');
  /* create requesting function to avoid duplicate code */
  var request = function() {
    jQuery.ajax({
      beforeSend: function() {
        messageBox.text('Updating the sort order in the database.');
      },
      complete: function() {
        messageBox.text('Database has been updated.');
      },
      data: 'sort_order=' + sortInput[0].value + '&ajax=' + submit[0].checked + '&do_submit=1&byajax=1', //need [0]?
      type: 'post',
      url: 'sortexample.php'
    });
  };
  /* worker function */
  var fnSubmit = function(save) {
    var sortOrder = [];
    list.children('li').each(function(){
      sortOrder.push(jQuery(this).data('id'));
    });
    sortInput.val(sortOrder.join(','));
    console.log(sortInput.val());
    if(save) {
      request();
    }
  };
  /* store values */
  list.children('li').each(function() {
    var li = jQuery(this);
    li.data('id',li.attr('title')).attr('title','');
  });
  /* sortables */
  list.sortable({
    opacity: 0.7,
    update: function() {
      fnSubmit(submit[0].checked);
    }
  });
  list.disableSelection();
  /* ajax form submission */
  jQuery('#dd-form').bind('submit',function(e) {
    if(e) e.preventDefault();
    fnSubmit(true);
  });
});
</script>