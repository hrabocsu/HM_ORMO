<div id="back" class="menuitem <?php ECHO $aspect == "player" ? "b_player" : "b_club" ?>">Csapat</div>

<!-- Játékos átigazolásai -->
<table id="rounded-corner" class="datatable tbl_transfer <?php ECHO $aspect == "player" ? "player_transfers" : ""; ?>">
  <thead>
    <th>
	  <h2>Átigazolások</h2>
	</th>
	<th></th>
	<th class="toclub"></th>
	<th class="amount"></th>
	<th></th>
	<th class="t_controls"></th>
  </thead>
  <tbody>
    <?php FOREACH($transfers AS $transfer) : ?>
	  <tr>
	    <td>
		  <p id="<?php ECHO $aspect == "player" ? "tc_" . $transfer->toclub : "p_" . $transfer->player; ?>" class="<?php ECHO $aspect == "player" ? "club" : "player"; ?>">
		    <?php ECHO $aspect == "player" ? $transfer->tcname : $transfer->pname; ?>
		  </p>
		</td>
		<td>
		  <div class="<?php ECHO $aspect == "player" ? "transfer" : ($transfer->toclub == $club) ? "transfer" : "transfer_2"; ?>">
		</td>
		<td>
		  <p id="<?php ECHO $aspect == "player" ? "fc_" . $transfer->fromclub : ($transfer->toclub == $club) ? "fc_" . $transfer->fromclub : "tc_" . $transfer->toclub; ?>" class="club">
		    <?php ECHO $aspect == "player" ? $transfer->fcname : ($transfer->toclub == $club) ? $transfer->fcname : $transfer->tcname; ?>
		  </p>
		</td>
		<td>
		  <p>
		    <?php ECHO NUMBER_FORMAT($transfer->amount) . " &euro;"; ?>
		  </p>
		</td>
	    <td>
		  <p>
		    <?php ECHO DATE_FORMAT(DATE_CREATE($transfer->NAME), "Y. m. d."); ?> <!-- Átigazolás időpontja -->
		  </p>
		</td>
		<td <?php ECHO $aspect == "club" ? "id='t_p_" . $transfer->player . "'" : ""; ?>>
		  <div id="del_<?php ECHO $transfer->ID; ?>" class="transfer_control poshytip delete t_<?php ECHO $aspect; ?>" title="Törlés"></div>
		  <div id="edt_<?php ECHO $transfer->ID; ?>" class="transfer_control poshytip edit t_<?php ECHO $aspect; ?>" title="Módosítás"></div>
		</td>
	  </tr>
	<?php ENDFOREACH; ?>
  </tbody>
</table>