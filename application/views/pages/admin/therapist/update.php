    <div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
                
				<!-- Start Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4><?php echo $pageTitle; ?></h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo base_url($this->uri->segment(1)); ?>">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="<?php echo base_url($pageCurrent); ?>"><?php echo $pageContent; ?></a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit</li>
								</ol>
							</nav>
						</div>
					</div>
                </div>
				<!-- End Page Header -->
                
				<!-- horizontal Basic Forms Start -->
				<div class="pd-20 card-box mb-30">

					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4"><?php echo $pageTitleSub; ?></h4>
							<p class="mb-30"><?php echo $pageDescription; ?></p>
						</div>
					</div>

					<?php echo form_open("");?>
						<h5 class="mb-15">1. Data Akun</h5>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group <?php echo form_error('user_name') ? "has-danger" : " "; ?>">
									<label>Username</label><span class='text-danger'> *</span>
									<input type="text" name="user_name" value="<?php echo set_value('user_name', $therapist[0]->user_name); ?>" class="form-control <?php echo form_error('user_name') ? "form-control-danger" : " "; ?>" placeholder="Masukkan Username">
									<?php echo form_error('user_name','<div class="form-control-feedback">','</div>'); ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group <?php echo form_error('user_email') ? "has-danger" : " "; ?>">
									<label>Email</label><span class='text-danger'> *</span>
									<input type="email" name="user_email" value="<?php echo set_value('user_email', $therapist[0]->user_email); ?>" class="form-control <?php echo form_error('user_email') ? "form-control-danger" : " "; ?>" placeholder="Masukkan Email">
									<?php echo form_error('user_email','<div class="form-control-feedback">','</div>'); ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group <?php echo form_error('user_password') ? "has-danger" : " "; ?>">
									<label>Password</label>
									<input type="password" name="user_password" value="<?php echo set_value('user_password'); ?>" class="form-control <?php echo form_error('user_password') ? "form-control-danger" : " "; ?>" placeholder="Masukkan Password">
									<?php echo form_error('user_password','<div class="form-control-feedback">','</div>'); ?>
									<small class="form-text text-muted">
									<i>Apabila tidak ingin mengganti password cukup kosongkan form <b>Password Baru</b> dan <b>Ulangi Password.</b></i>
									</small>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group <?php echo form_error('user_password_confirm') ? "has-danger" : " "; ?>">
									<label>Ulangi Password</label>
									<input type="password" name="user_password_confirm" value="<?php echo set_value('user_password_confirm'); ?>" class="form-control <?php echo form_error('user_password_confirm') ? "form-control-danger" : " "; ?>" placeholder="Masukkan Ulang Password">
									<?php echo form_error('user_password_confirm','<div class="form-control-feedback">','</div>'); ?>
								</div>
							</div>
						</div>
						<h5 class="mb-15">2. Data Anak</h5>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group <?php echo form_error('user_fullname') ? "has-danger" : " "; ?>">
									<label>Nama Lengkap</label><span class='text-danger'> *</span>
									<input type="text" name="user_fullname" value="<?php echo set_value('user_fullname', $therapist[0]->user_fullname); ?>" class="form-control <?php echo form_error('user_fullname') ? "form-control-danger" : " "; ?>" placeholder="Masukkan Nama Lengkap">
									<?php echo form_error('user_fullname','<div class="form-control-feedback">','</div>'); ?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Jenis Kelamin</label><span class='text-danger'> *</span>
									<select class="form-control" name="user_gender">
										<?php for ($i=0; $i < count($genders); $i++) { ?>
                                            <option value="<?php echo $i; ?>" <?php echo $therapist[0]->user_gender == $i ? "selected" : "" ?>><?php echo $genders[$i]; ?></option>
                                        <?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group <?php echo form_error('therapist_phone') ? "has-danger" : " "; ?>">
									<label>Nomor Handphone</label><span class='text-danger'> *</span>
									<input type="text" name="therapist_phone" value="<?php echo set_value('therapist_phone', $therapist[0]->therapist_phone); ?>" class="form-control <?php echo form_error('therapist_phone') ? "form-control-danger" : " "; ?>" placeholder="Masukkan Nomor Handphone">
									<?php echo form_error('therapist_phone','<div class="form-control-feedback">','</div>'); ?>
								</div>
							</div>
						</div>
						<div class="mt-15">
							<a href="javascript:window.history.go(-1);" class="btn btn-secondary">Kembali</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					<?php echo form_close(); ?>

				</div>
				<!-- horizontal Basic Forms End -->
				
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				siLiVip - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
			</div>
		</div>
	</div>