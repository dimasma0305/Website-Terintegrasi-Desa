<?php
if ($error = $this->session->flashdata('error')){
	?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<?=$error?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<?php
} else if ($message = $this->session->flashdata('message')){
	?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<?=$message?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<?php
}
?>
