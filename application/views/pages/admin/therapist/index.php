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
									<li class="breadcrumb-item active" aria-current="page"><?php echo $pageContent; ?></li>
								</ol>
							</nav>
						</div>
					</div>
                </div>
				<!-- End Page Header -->
                
				<!-- Start Datatable -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4"><?php echo $pageTitleSub; ?></h4>
							<p><?php echo $pageDescription; ?></p>
						</div>
						<div class="pull-right">
							<a href="<?php echo base_url($pageCurrent.'/create'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
						</div>
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama Terapis</th>
									<th>Jenis Kelamin</th>
									<th>Username</th>
									<th>Email</th>
									<th>Nomor Handphone</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>

								<?php if ($therapists) { $no = 1; foreach ($therapists as $therapist) { ?>
									<tr id="<?php echo $therapist->therapist_id; ?>">
										<td class="table-plus"><?php echo $no; ?></td>
										<td><?php echo $therapist->user_fullname; ?></td>
										<td>
											<span class="badge badge-<?php echo $genders[$therapist->user_gender]['label']; ?>"><?php echo $genders[$therapist->user_gender]['name']; ?></span>
                                        </td>
										<td><?php echo $therapist->user_name; ?></td>
										<td><?php echo $therapist->user_email; ?></td>
										<td><?php echo $therapist->therapist_phone; ?></td>
										<td>
											<div class="dropdown">
												<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
													<i class="dw dw-more"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
													<a href="javascript:;" class="dropdown-item btn-block btn-modal-view" data-id="<?php echo $therapist->therapist_id; ?>" data-paths="<?php echo $pagePaths; ?>"><i class="dw dw-eye"></i> Detail</a>
													<button type="button" class="dropdown-item" onclick="location.href='<?php echo base_url($pageCurrent.'/update/'.$therapist->therapist_id); ?>'"><i class="dw dw-edit2"></i> Edit</button>
													<button type="button" class="dropdown-item btn-delete"><i class="dw dw-delete-3"></i> Hapus</button>
												</div>
											</div>
										</td>
									</tr>
								<?php $no++; } } else { ?>
									<tr>
                                        <td colspan="7" class="text-center">Data Kosong</td>
                                    </tr>
								<?php } ?>

							<div class="modal fade bs-example-modal-lg" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Detail</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<h5 class="mb-15">1. Data Akun</h5>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Username</label>
														<input type="text" name="user_name" class="form-control" readonly>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Email</label>
														<input type="email" name="user_email"class="form-control" readonly>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<input type="password" name="user_password" class="form-control" readonly>
													</div>
												</div>
											</div>
											<h5 class="mb-15">2. Data Terapis</h5>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>Nama Lengkap</label>
														<input type="text" name="user_fullname"class="form-control" readonly>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Jenis Kelamin</label>
														<select class="form-control" id="user_gender" disabled>
															<option value="0">Laki-laki</option>
															<option value="1">Perempuan</option>
														</select>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>Nomor Handphone</label>
														<input type="text" name="therapist_phone"class="form-control" readonly>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
								
							</tbody>
						</table>
					</div>
				</div>
				<!-- End Datatable -->
				
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				siLiVip - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
			</div>
		</div>
	</div>