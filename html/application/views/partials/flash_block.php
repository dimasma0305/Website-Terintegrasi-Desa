<?php
if ($error = $this->session->flashdata('error')){
	?>
	<div class="alert-danger"><?=$error?></div>
	<?php
} else if ($message = $this->session->flashdata('message')){
	?>
	<div class="alert-success"><?=$message?></div>
	<?php
}
?>
