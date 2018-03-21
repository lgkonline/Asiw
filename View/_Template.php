<?php

function r()
{
	echo \Asiw\Config::$RootUrl;
}

function v()
{
	echo \Asiw\App::$Version;
}

$account = \Asiw\App::GetCurrentAccount();

?>

<!DOCTYPE html>
<html data-root-url="<?php r();?>">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<title><?php echo \Asiw\Config::$Title;?></title>
		<link rel="stylesheet" href="<?php r();?>Content/App/Style/main.min.css?v=<?php v();?>">
	</head>

	<body>
		<nav class="navbar navbar-light bg-faded">
			<button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapsingNavbar"
				aria-controls="collapsingNavbar" aria-expanded="false">
				&#9776;
			</button>
			<div class="collapse navbar-toggleable-xs" id="collapsingNavbar">
				<div class="container">
					<a class="navbar-brand" href="<?php r();?>"><?php echo \Asiw\Config::$Title;?></a>
					
					<div class="nav navbar-nav">
						<a class="nav-item nav-link <?php if ($this->ControllerName == 'Home') echo 'active';?>" href="<?php r();?>Home">
							Home
						</a>						
						<?php if ($this->CanAccountEdit()):?>
							<a class="nav-item nav-link <?php if ($this->ControllerName == 'Backend') echo 'active';?>" href="<?php r();?>Backend">
								Backend
							</a>
						<?php endif;?>
					</div>

					<div class="nav navbar-nav pull-xs-right">
						<div class="nav-item nav-link">
							<?php if ($account === null):?>
								<?php $this->T("YOU_ARENT_SIGNED_IN"); ?>
							<?php else:?>
							<?php $this->T("YOU_ARE_SIGNED_IN_AS"); ?> <?php echo $account->Email;?>
							<?php endif;?>
						</div>
						<?php if ($account !== null):?>
							<a class="nav-item nav-link" href="<?php r();?>Account/SignOut">
								<?php $this->T("SIGN_OUT"); ?>
							</a>
						<?php else:?>
							<a class="nav-item nav-link" href="javascript:void(0)" data-toggle="area" data-target="#sign-area">
								Register/Sign in
							</a>
						<?php endif;?>
					</div>
				</div>
			</div>
		</nav>

		<section class="area" id="sign-area">
			<div class="container">
				<ul class="nav nav-pills" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" href="#tab-register" data-toggle="tab">Register</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#tab-sign-in" data-toggle="tab">Sign In</a>
					</li>
				</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="tab-register" role="tabpanel">
						<h1 class="display-4">Register</h1>
						<form id="register-form">
							<div class="form-group">
								<label for="register-email">Email</label>
								<input class="form-control" type="email" id="register-email">
							</div>

							<div class="form-group">
								<label for="register-password">Password</label>
								<input class="form-control" type="password" id="register-password">
							</div>

							<button class="btn btn-primary" type="submit">Submit</button>
						</form>
					</div>

					<div class="tab-pane" id="tab-sign-in" role="tabpanel">
						<h1 class="display-4">Sign In</h1>
						<form id="sign-in-form">
							<div class="form-group">
								<label for="sign-in-email">Email</label>
								<input class="form-control" type="email" id="sign-in-email">
							</div>

							<div class="form-group">
								<label for="sign-in-password">Password</label>
								<input class="form-control" type="password" id="sign-in-password">
							</div>

							<button class="btn btn-primary" type="submit">Submit</button>
						</form>	
					</div>	
				</div><!--/.tab-content-->
			</div><!--/.container-->
		</section>

		<?php include $view;?>

		<script src="<?php r();?>Content/App/Script/main.min.js?v=<?php v();?>"></script>
		<?php if ($this->ControllerName == "Backend"):?>
			<script src="<?php r();?>Content/App/Script/backend.min.js?v=<?php v();?>"></script>
		<?php endif;?>
	</body>
</html>