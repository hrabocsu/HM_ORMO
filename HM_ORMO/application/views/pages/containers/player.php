<h1 id="p_h">
  <?php ECHO $player->pname; ?>
</h1>
<div id="player_stats">
  <b>Életkor:</b> 
  <?php ECHO $player->age . " év"; ?><br>
  <b>Nemzetiség:</b> 
  <?php ECHO $player->nationality; ?><br>
</div>

<!-- Törlés, módosítás, átigazolás -->
<div id="trs_<?php ECHO $player->pid; ?>" class="transfer player poshytip" title="Átigazolás"></div>
<div id="edt_<?php ECHO $player->pid; ?>" class="edit player poshytip" title="Módosítás"></div>
<div id="del_<?php ECHO $player->pid; ?>" class="delete player poshytip" title="Törlés"></div>

<!-- Játékos azonosítószáma a kliens oldal számára -->
<input type="hidden" id="p_id" value="<?php ECHO $player->pid; ?>">