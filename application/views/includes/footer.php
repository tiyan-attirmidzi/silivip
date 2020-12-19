    <script src="<?php echo base_url(); ?>assets/vendors/scripts/core.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/scripts/script.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/scripts/process.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/scripts/layout-settings.js"></script>
	<script src="<?php echo base_url(); ?>assets/src/plugins/apexcharts/apexcharts.min.js"></script>
	<!-- <script src="<?php echo base_url(); ?>assets/vendors/scripts/dashboard3.js"></script>	 -->
	<?php if ($this->uri->segment(2) == 'childs' || $this->uri->segment(2) == 'therapists') { ?>
		<script src="<?php echo base_url(); ?>assets/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/vendors/scripts/datatable-setting.js"></script>
		<script>
			$(function () {
				$('.btn-modal-view').click(function (e) {
					e.preventDefault();
					$('#modal-view').modal({ backdrop: 'static', show: true });
					id = $(this).data('id');
					paths = $(this).data('paths');
					$.ajax({
						url: paths + '/selectData/' + id,
						success: function (data) {
							data = data['select'][0];
							if (paths == 'childs') {
								$("input[name='user_name']").val(data.user_name);
								$("input[name='user_email']").val(data.user_email);
								$("input[name='user_password']").val(data.user_password);
								$("input[name='child_name']").val(data.user_fullname);
								$("#user_gender [value='"+data.user_gender+"']").prop("selected", true);
								$("input[name='child_pob']").val(data.child_pob);
								$("input[name='child_dob']").val(data.child_dob);
								$("input[name='parent_father_name']").val(data.parent_father_name);
								$("input[name='parent_mother_name']").val(data.parent_mother_name);
								$("input[name='parent_phone']").val(data.parent_phone);
							}
							if (paths == 'therapists') {
								$("input[name='user_name']").val(data.user_name);
								$("input[name='user_email']").val(data.user_email);
								$("input[name='user_password']").val(data.user_password);
								$("input[name='user_fullname']").val(data.user_fullname);
								$("#user_gender [value='"+data.user_gender+"']").prop("selected", true);
								$("input[name='therapist_phone']").val(data.therapist_phone);
							}
						}
					});
				});
				$('.btn-delete').click(function(e){
                    // e.preventDefault();
                    let id = $(this).parents("tr").attr("id");
                    swal({
                        title: 'Anda yakin menghapus?',
                        text: 'Data ini akan dihapus secara permanen',
                        icon: 'warning',
                        buttons: ["Batal", "Ya"],
                    }).then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "<?php echo base_url($pageCurrent."/delete/"); ?>" + id,
                                success: function (data) {
                                    location.reload();
                                },
                                error: function (e) {
                                    console.log(e);
                                }
                            });
                        }
                    });
                });
			});
		</script>
	<?php } ?>
	<!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
        if($this->session->flashdata('alertSweet')) {
            echo $this->session->flashdata('alertSweet');
        }
    ?>

</body>
</html>