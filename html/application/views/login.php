<main class='container'>
	<div>
		<h1>Login</h1>
		<form action="<?=base_url("cindex/login")?>" method="post" class="d-flex flex-column gap-2">
			<input type="text" name="username" placeholder="username">
			<input type="password" name="password" placeholder="password">
			<?php $this->load->view('partials/flash_block')?>
			<button type="submit">submit</button>
		</form>
	</div>
</main>

