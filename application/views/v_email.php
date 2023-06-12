<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Register Akun</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		@media screen {
			@font-face {
				font-family: 'Source Sans Pro';
				font-style: normal;
				font-weight: 400;
				src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
			}

			@font-face {
				font-family: 'Source Sans Pro';
				font-style: normal;
				font-weight: 700;
				src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
			}
		}

		body,
		table,
		td,
		a {
			-ms-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
		}

		table,
		td {
			mso-table-rspace: 0pt;
			mso-table-lspace: 0pt;
		}

		img {
			-ms-interpolation-mode: bicubic;
		}

		a[x-apple-data-detectors] {
			font-family: inherit !important;
			font-size: inherit !important;
			font-weight: inherit !important;
			line-height: inherit !important;
			color: inherit !important;
			text-decoration: none !important;
		}

		div[style*="margin: 16px 0;"] {
			margin: 0 !important;
		}

		body {
			width: 100% !important;
			height: 100% !important;
			padding: 0 !important;
			margin: 0 !important;
		}

		table {
			border-collapse: collapse !important;
		}

		a {
			color: #1a82e2;
		}

		img {
			height: auto;
			line-height: 100%;
			text-decoration: none;
			border: 0;
			outline: none;
		}
	</style>

</head>

<body style="background-color: #e9ecef;">

	<div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
		Informasi Register Akun
	</div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="center" bgcolor="#e9ecef">
				<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
					<tr>
						<td align="center" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
							<h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
								Pick Up Service</h1>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center" bgcolor="#e9ecef">
				<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
					<tr>
						<td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
							<table class="table table-hover-color">
								<tr>
									<td width="160">Terima kasih sudah mendaftar,</td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>Level</td>
									<td>: User</td>
								</tr>
								<tr>
									<td>Name</td>
									<td>: <?= $name ?></td>
								</tr>
								<tr>
									<td>Username / Email</td>
									<td>: <?= $username ?></td>
								</tr>
								<tr>
									<td>Password</td>
									<td>: <?= $password; ?></td>
								</tr>
							</table>
							<h4 style="text-align: justify; color: #000;">Silahkan klik link dibawah ini untuk aktifasi akun Anda</h4>
							<p>
								<a href="<?= $urlFrontEnd . $id; ?>">Aktifasi Akun</a>
							</p>
						</td>
					</tr>
					<tr>
						<td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf">
							<p style="margin: 0;">Admin,<br> Pick Up Service</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center" bgcolor="#e9ecef" style="padding: 24px;">
			</td>
		</tr>
	</table>

</body>

</html>