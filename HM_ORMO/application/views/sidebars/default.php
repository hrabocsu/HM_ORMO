<!-- Oldalmenü elemei közti keresésre szolgáló mező -->
<div class="sidebar_search">
  <form>
    <input type="text" name="" class="search_input" value="" placeholder="Szűrés...">
    <input type="image" class="search_submit" src="<?php ECHO base_url().APPPATH."third_party/in-admin-panel/images/search.png"; ?>">
  </form>            
</div>
<!-- Oldalmenü elemek listázása -->
<?php FOREACH($values AS $value) : ?>
  <div id="c_<?php ECHO $value->ID; ?>" class="menuitem menuitem_f <?php ECHO (!ISSET($selected) && $value->ID == $values[0]->ID) || (ISSET($selected) && $value->ID == $selected) ? "active" : ""; ?>">
    <?php ECHO $value->NAME; ?>
  </div>
<?php ENDFOREACH; ?>