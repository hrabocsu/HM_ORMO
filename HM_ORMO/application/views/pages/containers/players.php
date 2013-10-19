<div id="transfers" class="menuitem">Átigazolások</div>
  
  <!-- Csapat játékosai -->
  <table id="rounded-corner" class="datatable">
    <thead>
      <th>
	    <h2>Játékosok</h2>
	  </th>
    </thead>
    <tbody>
      <?php FOREACH($players AS $player) : ?>
	    <tr>
	      <td>
		    <p id="p_<?php ECHO $player->ID; ?>" class="player">
		      <?php ECHO $player->NAME; ?>
		    </p>
		  </td>
	    </tr>
	  <?php ENDFOREACH; ?>
    </tbody>
  </table>