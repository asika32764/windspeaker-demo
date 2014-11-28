<?php
$app = \Windwalker\Ioc::getApplication();

$uri = new \Windwalker\Registry\Registry($app->initUri());

/** @var \Exception $exception */
$exception = $data->exception;
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Windspeaker | <?php echo $exception->getCode() ? : 500; ?> Error</title>

	<link href="<?php echo $uri['media.path'] ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $uri['media.path'] ?>font-awesome/css/font-awesome.css" rel="stylesheet">

	<link href="<?php echo $uri['media.path'] ?>css/animate.css" rel="stylesheet">
	<link href="<?php echo $uri['media.path'] ?>css/style.css" rel="stylesheet">
</head>

<body class="gray-bg">

<div class="middle-box text-center animated fadeInDown">
<?php if ($exception->getCode() == 404): ?>
	<h1>404</h1>
	<h3 class="font-bold">Page Not Found</h3>

	<div class="error-desc">
		<p>
			Sorry, but the page you are looking for has note been found.
		</p>
		<p>
			<a href="<?php echo $uri['base.full'] ?>" class="btn btn-primary m-t">Back to Home</a>
		</p>
	</div>
<?php else: ?>
	<h1>500</h1>
	<h3 class="font-bold">Internal Server Error</h3>

	<div class="error-desc">
		The server encountered something unexpected that didn't allow it to complete the request. We apologize.<br/>
		<a href="<?php echo $uri['base.full'] ?>" class="btn btn-primary m-t">Back to Home</a>
	</div>
<?php endif; ?>
</div>

</body>

</html>
