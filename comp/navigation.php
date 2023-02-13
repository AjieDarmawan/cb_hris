<style>
	.navbar-brand {
		font: normal normal bold 20px Open Sans;
		letter-spacing: 0px;
		text-shadow: 0px 3px 6px #00000029;
	}

	.navbar .btn-primary {
		font: normal normal 600 12px Open Sans;
		box-shadow: 0px 3px 6px #00000029;
		letter-spacing: 0px;
		color: #fff !important;
	}

	.navbar .btn-outline-primary {
		background: transparent;
		box-shadow: 0px 3px 6px #00000029;
		border: 1px solid #003049;
		font: normal normal 600 12px Open Sans;
		letter-spacing: 0px;
		color: #003049 !important;
	}

	.navbar .btn-outline-primary:hover {
		background: #003049 0% 0% no-repeat padding-box;
		box-shadow: 0px 3px 6px #00000029;
		border: 1px solid #003049;
		font: normal normal 600 12px Open Sans;
		letter-spacing: 0px;
		color: #fff !important;
	}

	.navbar .btn {
		margin-top: 6px;
		padding: 4px 24px !important;
	}

	.navbar .nav-link:hover {
		color: #fff !important;
	}
</style>

<?php
$stylenavbar = '';
$divpadding = '';
if (isset($arr_urinya[2]) && $arr_urinya[2] != 'login' && $arr_urinya[2] != 'register') {
	$stylenavbar = 'oren';
	$divpadding = '<div style="margin-top:48px;"></div>';
}
?>
<?php echo $divpadding; ?>
<nav class="navbar navbar-custom <?php echo $stylenavbar; ?> fixed-top navbar-expand-lg">
	<div class="container">
		<a class="navbar-brand fw-bold text-white" href="<?php echo $inc_; ?>">
			Edunovasi.<span class="text-primary">com</span></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<div class="fas fa-bars"></div>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ms-auto">
				<li class="nav-item">
					<a class="nav-link" aria-current="page" href="<?php echo $inc_; ?>#">Beranda</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" aria-current="page" href="<?php echo $inc_; ?>#tryout">Try Out</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" aria-current="page" href="<?php echo $inc_; ?>#keunggulan">Keunggulan</a>
				</li>
				<?php
				if (isset($_SESSION['userdata'])) {
					echo '
					
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
									<img src="' . $inc_ . '/assets/img/blank-profile.jpg" width="25" height="25" class="rounded-circle">
									' . $sesi['nama'] . '
								</a>

								<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<li><a class="dropdown-item" href="' . $inc_ . '/dashboard/event/history">Dashboard</a></li>
									<li><a class="dropdown-item" href="' . $inc_ . '/logout">Logout</a></li>
								</ul>
							</li>
						';
				} else {
					echo '
							<li class="nav-item">
								<a class="nav-link btn btn-sm btn-primary px-4 py-2" aria-current="page" href="' . $inc_ . '/register">Registrasi</a>
							</li>
						';
					if (isset($arr_urinya[2]) && $arr_urinya[2] == 'login') {
					} else {
						echo '
						<li class="nav-item">
							<a class="nav-link btn btn-sm btn-outline-primary px-4 py-2" aria-current="page" href="' . $inc_ . '/login">Login</a>
						</li>
						';
					}
				}
				?>
			</ul>
		</div>
	</div>
</nav>