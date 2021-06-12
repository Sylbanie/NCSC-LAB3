<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Shirt</title>
		<link rel="stylesheet" href="assets/css/styles.css" />
	</head>
	<body>
		<div id="container">
			<!-- HEAD BOARD -->
			<header id="header">
				<div id="logo">
					<img src="assets/img/ shirt.png" alt=" shirt Logo" />
					<a href="index.php">
						Shirt
					</a>
				</div>
			</header>

			<!-- MENU -->
			<nav id="menu">
				<ul>
					<li>
						<a href="#">Start</a>
					</li>
				</ul>
			</nav>

			<div id="content">

				<!-- SIDE BAR -->
				<aside id="lateral">

					<div id="login" class="block_aside">
						<h3>Enter website</h3>
						<form action="#" method="post">
							<label for="email">Email</label>
							<input type="email" name="email" />
							<label for="password">Password</label>
							<input type="password" name="password" />
							<input type="submit" value="Envyr" />
						</form>
						
						<ul>
							<li><a href="#">My order</a></li>
							<li><a href="#">Manage order</a></li>
							<li><a href="#">Manage categories</a></li>
						</ul>
					</div>

				</aside>

				<!-- CENTRAL CONTENT -->
				<div id="central">
					<h1>Product feature</h1>
					
					<div class="product">
						<img src="assets/img/ shirt.png" />
						<h2> shirt A</h2>
						<p>300k</p>
						<a href="" class="button">Buy</a>
					</div>

					<div class="product">
						<img src="assets/img/ shirt.png" />
						<h2> shirt B</h2>
						<p>400k</p>
						<a href="" class="button">Buy</a>
					</div>

					<div class="product">
						<img src="assets/img/ shirt.png" />
						<h2> shirt C</h2>
						<p>500k</p>
						<a href="" class="button">Buy</a>
					</div>

				</div>
			</div>

			<!-- FOOTER -->
			<footer id="footer">
				<p>Developed by me &copy; <?= date('Y') ?></p>
			</footer>
		</div>
	</body>
</html>