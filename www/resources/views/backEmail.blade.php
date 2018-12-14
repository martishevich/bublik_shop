<!doctype html>
<head>
	<!-- Place favicon.ico in the root directory -->
	<link rel = "shortcut icon"
	      type = "image/x-icon"
	      href = "images/favicon.ico">
	<link rel = "apple-touch-icon"
	      href = "apple-touch-icon.png">
	<link rel = "stylesheet"
	      href = "bootstrap-4.1.3/bootstrap.min.css">
</head>
<body>
	<div class = "container">
		<h1 style = "text-align: center">
			Hello, <?= $order->fullname?>!
			<br>
		</h1>
		<p> Your order № <?= $order->id?> is accepted for processing. If you have questions or have noticed an error in
		    the order, please contact us. Our
		    phone: <a href = "tel:+375297000000">+375(29)700-00-00</a>,
		    email: <a href = "mailto:info@bublik.com">info@bublik.com</a>.
			<br>
		    We are pleased to introduce our company to you! Bublik company has been selling computers and components for
		    them for more than 15 years. Any of our employees will be happy to help you solve any problem related to the
		    purchase of a computer and accessories.
		</p>
	</div>
</body>