<?php REQUIRE_ONCE("includes/validation_engine.php"); ?>
<?php REQUIRE_ONCE("includes/datepicker.php"); ?>

<h1>
  <?php ECHO ISSET($club) ? $club->cname : "Új csapat felvétele"; ?>
</h1>
<!-- Űrlap -->
<?php $method = ISSET($club) ? "update" : "insert"; ?>
<?php ECHO form_open("club/add_update/".((ISSET($club)) ? $club->cid : ""), ARRAY("class" => "my_form {$method}", "id" => "form_club")); ?>
  <div class="left">
    <label for="inp_name" class="my_label">Csapat neve:</label><br>
    <label for="inp_foundation" class="my_label">Alapítás dátuma:</label><br>
  </div>
  <div class="left">
    <input type="text" id="inp_name" name="cname" class="my_input validate[required, maxSize[64]]" value="<?php ECHO ISSET($club) ? $club->cname : "" ?>"><br>
    <input type="text" id="inp_foundation" name="foundation" class="my_input date validate[required]" value="<?php ECHO ISSET($club) ? $club->foundation : "" ?>" readonly><br>
  </div>
  <div class="ls"></div>
  <div class="left controls">
    <input type="submit" class="NFButton NFh submit" value="<?php ECHO ISSET($club) ? "MÓDOSÍT" : "FELVESZ"; ?>">
    <input type="button" class="NFButton NFh cancel club" value="MÉGSE">
	<input type="hidden" name="e_id" value="<?php ECHO ISSET($club) ? $club->cid : ""; ?>">
  </div>
  <div class="error_box"></div>
</form>

