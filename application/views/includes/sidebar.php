    <div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.html">
				<img src="<?php echo base_url(); ?>assets/image/logo-light.png" alt="" class="dark-logo">
				<img src="<?php echo base_url(); ?>assets/image/logo-dark.png" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
                    <li>
						<a href="<?php echo base_url('admin'); ?>" class="dropdown-toggle no-arrow <?php if($this->uri->segment(2)==''){ echo "active"; }; ?>">
							<span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
						</a>
					</li>
                    <li>
						<a href="<?php echo base_url('admin/childs'); ?>" class="dropdown-toggle no-arrow <?php if($this->uri->segment(2)=='childs'){ echo "active"; }; ?>">
							<span class="micon dw dw-user-2"></span><span class="mtext">Anak</span>
						</a>
					</li>
                    <li>
						<a href="<?php echo base_url('admin/therapists'); ?>" class="dropdown-toggle no-arrow <?php if($this->uri->segment(2)=='therapists'){ echo "active"; }; ?>">
							<span class="micon dw dw-user-3"></span><span class="mtext">Terapis</span>
						</a>
					</li>
                    <li>
						<a href="javascript:;" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-video-player"></span><span class="mtext">Upload Media</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="mobile-menu-overlay"></div>