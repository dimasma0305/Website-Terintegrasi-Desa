<?php
if ($error = $this->session->flashdata('error')){
	?>
	<div class="alert-danger"><?=$error?></div>
	<?php
}
?>
