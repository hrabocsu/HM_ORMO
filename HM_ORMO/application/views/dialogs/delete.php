<h1>Törlés megerősítés</h1>
<!-- Űrlap -->
<?php ECHO form_open($controller . "/delete/". $del_id, ARRAY("class" => "my_form", "id" => "form_delete")); ?>
  <div class="left prompt">Biztosan törli?</div>
  <div class="ls"></div>
  <div class="left controls">
    <input type="submit" class="NFButton NFh submit" value="TÖRÖL">
    <input type="button" class="NFButton NFh cancel club" value="MÉGSE">
	<input type="hidden" id="e_type" value="<?php ECHO $controller; ?>">
	<input type="hidden" id="parent" value="<?php ECHO $parent; ?>">
	<?php IF($player != NULL) : ?>
	  <p class="player" id="p_<?php ECHO $player; ?>">
	<?php ENDIF; ?>
  </div>
</form>

