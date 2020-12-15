<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Page Info -->
    <meta charset="UTF-8">
    <title>SILIVIP</title>

    <!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/vendors/images/favicon-16x16.png">
    
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    
    <script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
    </script>
    
</head>
<body>

    <!-- Start Loader 
    <div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo">
                <img src="vendors/images/deskapp-logo.svg" alt="">
            </div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Memuat...
			</div>
		</div>
    </div>
    End Loader -->

    <!-- Start Header -->
	<div class="header">
		<div class="header-left"></div>
		<div class="header-right">
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="<?php echo base_url(); ?>assets/vendors/images/photo1.jpg" alt="">
						</span>
						<span class="user-name">Ross C. Lopez</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
						<a class="dropdown-item" href="login.html"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- End Header -->