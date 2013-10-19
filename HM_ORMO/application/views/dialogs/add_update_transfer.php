<?php REQUIRE_ONCE("includes/validation_engine.php"); ?>
<?php REQUIRE_ONCE("includes/datepicker.php"); ?>

<h1 id="t_h">
  <?php ECHO $player->pname . " <br><span>átigazolás</span>"; ?>
</h1>
<!-- Űrlap -->
<?php $method = ISSET($transfer) ? "update" : "insert"; ?>
<?php ECHO form_open("transfer/add_update/" . ((ISSET($transfer)) ? $transfer->tid : ""), ARRAY("class" => "my_form {$method}", "id" => "form_transfer")); ?>
  <div class="left">
    
	<?php IF(ISSET($transfer)) : ?>
	  <label for="inp_fromclub" class="my_label">Csapat:</label><br>
	<?php ENDIF; ?>
    
	<label for="inp_toclub" class="my_label">Új csapat:</label><br>
    <label for="inp_amount" class="my_label">Összeg:</label><br>
	
	<?php IF(ISSET($transfer)) : ?>
	  <label for="inp_date" class="my_label">Dátum:</label><br>
	<?php ENDIF; ?>
  </div>
  <div class="left">
	
	<?php IF(ISSET($transfer)) : ?>
	  <select id="inp_fromclub" name="fromclub" class="my_input transfer_select validate[required]">
	    <option></option>
	    <?php FOREACH($clubs AS $club) : ?>
	      <option value="<?php ECHO $club->ID; ?>" <?php ECHO $club->ID == $transfer->fromclub ? "selected" : ""; ?>>
		    <?php ECHO $club->NAME; ?>
		  </option>
	    <?php ENDFOREACH; ?>
	  </select><br>
	<?php ELSE: ?>
	  <input type="hidden" name="fromclub" value="<?php ECHO $player->club; ?>">
	<?php ENDIF; ?>
    
	<select id="inp_toclub" name="toclub" class="my_input transfer_select validate[required]">
	  <option></option>
	  <?php FOREACH($clubs AS $club) : ?>
	    <?php IF((ISSET($transfer)) || (!ISSET($transfer) && $club->ID != $player->club)) : ?>
	      <option value="<?php ECHO $club->ID; ?>" <?php ECHO (ISSET($transfer) && $club->ID == $transfer->toclub) ? "selected" : ""; ?>>
		    <?php ECHO $club->NAME; ?>
		  </option>
		<?php ENDIF; ?>
	  <?php ENDFOREACH; ?>
	</select><br>
    
	<input type="text" id="inp_amount" name="amount" class="my_input validate[required, custom[number], min[1000], max[100000000]]" value="<?php ECHO ISSET($transfer) ? $transfer->amount : "" ?>"><br>
	
	<?php IF(ISSET($transfer)) : ?>
	  <input type="text" id="inp_tdate" name="tdate" class="my_input date" value="<?php ECHO $transfer->tdate; ?>" readonly><br>
	<?php ELSE : ?>
	  <input type="hidden" name="tdate" value="<?php ECHO DATE("Y-m-d"); ?>">
	<?php ENDIF; ?>
	
	<input type="hidden" name="player" value="<?php ECHO $player->pid; ?>">
  </div>
  <div class="ls"></div>
  <div class="left controls">
    <input type="submit" class="NFButton NFh submit" value="<?php ECHO ISSET($transfer) ? "MÓDOSÍT" : "ÁTIGAZOL"; ?>">
    <input type="button" class="NFButton NFh cancel player" value="MÉGSE">
	<p class="player hidden" id="p_<?php ECHO $player->pid; ?>"></p>
  </div>
  <div class="error_box"></div>
</form>

