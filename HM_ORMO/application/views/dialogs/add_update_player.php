<?php REQUIRE_ONCE("includes/validation_engine.php"); ?>

<h1>
  <?php ECHO ISSET($player) ? $player->pname : "Új játékos felvétele"; ?>
</h1>
<!-- Űrlap -->
<?php $method = ISSET($player) ? "update" : "insert"; ?>
<?php ECHO form_open("player/add_update/".((ISSET($player)) ? $player->pid : ""), ARRAY("class" => "my_form {$method}", "id" => "form_player")); ?>
  <div class="left">
    <label for="inp_name" class="my_label">Játékos neve:</label><br>
    <label for="inp_nationality" class="my_label">Nemzetiség:</label><br>
	<label for="inp_age" class="my_label">Életkor:</label><br>
	<label for="inp_club" class="my_label">Csapat:</label><br>
  </div>
  <div class="left">
    <input type="text" id="inp_name" name="pname" class="my_input validate[required, maxSize[64]]" value="<?php ECHO ISSET($player) ? $player->pname : "" ?>"><br>
    <input type="text" id="inp_nationality" name="nationality" class="my_input validate[required, maxSize[64]]" value="<?php ECHO ISSET($player) ? $player->nationality : "" ?>"><br>
    <input type="text" id="inp_age" name="age" class="my_input validate[required, custom[number], min[10], max[60]]" value="<?php ECHO ISSET($player) ? $player->age : "" ?>"><br>
	<select id="inp_club" name="club" class="my_input validate[required]">
	  <option></option>
	  <?php FOREACH($clubs AS $club) : ?>
	    <option value="<?php ECHO $club->ID; ?>" <?php ECHO (ISSET($player) && $club->ID == $player->club) ? "selected" : ""; ?>>
		  <?php ECHO $club->NAME; ?>
		</option>
	  <?php ENDFOREACH; ?>
	</select>
  </div>
  <div class="ls"></div>
  <div class="left controls">
    <input type="submit" class="NFButton NFh submit" value="<?php ECHO ISSET($player) ? "MÓDOSÍT" : "FELVESZ"; ?>">
    <input type="button" class="NFButton NFh cancel player" value="MÉGSE">
	<p class="player hidden" id="p_<?php ECHO ISSET($player) ? $player->pid : ""; ?>"></p>
  </div>
  <div class="error_box"></div>
</form>

