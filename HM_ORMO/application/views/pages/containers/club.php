<h1>
  <?php ECHO $club->cname; ?>
</h1>
<div id="team_foundation">
  <b>Alapítva:</b> 
  <?php ECHO DATE_FORMAT(DATE_CREATE($club->foundation), "Y. m. d."); ?>
</div>

<!-- Törlés, módosítás -->
<div id="edi_<?php ECHO $club->cid; ?>" class="edit club poshytip" title="Módosítás"></div>
<div id="del_<?php ECHO $club->cid; ?>" class="delete club poshytip" title="Törlés"></div>

<input type="hidden" id="c_id" value="<?php ECHO $club->cid; ?>">