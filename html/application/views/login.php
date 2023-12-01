<main class='container'>
	<div>
		<h1>Login</h1>
		<form action="<?= base_url("index/login") ?>" method="post" class="d-flex flex-column gap-2">
			<input type="text" name="username" placeholder="username">
			<input type="password" name="password" placeholder="password">
			<input type="hidden" name="redirect" value="<?= isset($_GET['r']) ? html_escape($_GET['r']) : '' ?>">
			<?php $this->load->view('partials/flash_block') ?>
			<button type="submit">submit</button>
		</form>
	</div>
</main>
