 $(function() {

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>siswa/data/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "sisw_nis" },
			{ "data": "sisw_nisn" },
			{ "data": "sisw_nama" },
			{ "data": "sisw_no_hp" },
			{ "data": "sisw_email" },
			{ "data": "sisw_asal_sekolah" },
			{ 
				"data": "sisw_id", render: function(data, type, full, meta)
				{
					return '<button class="btn btn-sm btn-warning btn-ef btn-ef-5 btn-ef-5b qr-code-siswa" data-toggle="modal" data-target="#splash2" data-options="splash-2 splash-ef-14" onclick="detail(`'+full.sisw_qrcode+'`)"><i class="fa fa-search"></i><span>Lihat QR Code</span></button>'
				} 
			},
			{
				"data": "sisw_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.sisw_id+'|'+full.sisw_nis+'|'+full.sisw_nisn+'|'+full.sisw_nama+'|'+full.sisw_no_hp+'|'+full.sisw_email+'|'+full.sisw_asal_sekolah+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
										+'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
									+'</div>';
				}
			}
		],
		"aoColumnDefs": [
		  { 'bSortable': false, 'aTargets': [ "no-sort" ] }
		]
	});


	var colvis = new $.fn.dataTable.ColVis(table4);

	$(colvis.button()).insertAfter('#colVis');
	$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button');

	var tt = new $.fn.dataTable.TableTools(table4, {
		sRowSelect: 'single',
		"aButtons": [

			'copy',
			'print', {
				'sExtends': 'collection',
				'sButtonText': 'Save',
				'aButtons': ['csv', 'xls', 'pdf']
			}
		],
		"sSwfPath": "<?php echo base_url();?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
	});

	$(tt.fnContainer()).insertAfter('#tableTools');
	//*initialize responsive datatable

	function dynamic(){
		//initialize responsive datatable
	
		var table4 = $('#advanced-usage').DataTable({
			"ajax": {
				"url": "<?= base_url()?>siswa/data/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "sisw_nis" },
				{ "data": "sisw_nisn" },
				{ "data": "sisw_nama" },
				{ "data": "sisw_no_hp" },
				{ "data": "sisw_email" },
				{ "data": "sisw_asal_sekolah" },
				{ 
					"data": "sisw_id", render: function(data, type, full, meta)
					{
						return '<button class="btn btn-sm btn-warning btn-ef btn-ef-5 btn-ef-5b qr-code-siswa" data-toggle="modal" data-target="#splash2" data-options="splash-2 splash-ef-14" onclick="detail(`'+full.sisw_qrcode+'`)"><i class="fa fa-search"></i><span>Lihat QR Code</span></button>'
					} 
				},
				{
					"data": "sisw_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
											+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.sisw_id+'|'+full.sisw_nis+'|'+full.sisw_nisn+'|'+full.sisw_nama+'|'+full.sisw_no_hp+'|'+full.sisw_email+'|'+full.sisw_asal_sekolah+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
											+'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
										+'</div>';
					}
				}
			],
			"aoColumnDefs": [
			  { 'bSortable': false, 'aTargets': [ "no-sort" ] }
			]
		});


		var colvis = new $.fn.dataTable.ColVis(table4);

		$(colvis.button()).insertAfter('#colVis');
		$(colvis.button()).find('button').addClass('btn btn-default').removeClass('ColVis_Button');

		var tt = new $.fn.dataTable.TableTools(table4, {
			sRowSelect: 'single',
			"aButtons": [
				'copy',
				'print', {
					'sExtends': 'collection',
					'sButtonText': 'Save',
					'aButtons': ['csv', 'xls', 'pdf']
				}
			],
			"sSwfPath": "<?php echo base_url();?>assets/admin/non-angular/assets/js/vendor/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
		});

		$(tt.fnContainer()).insertAfter('#tableTools');
	}

	// fungsi simpan 
	$('#form').submit(function(ev) {
		ev.preventDefault();

		let id = $('#form input[name=id]').val();
		console.log(id);
		let nis = $('#nis').val();
		let nisn = $('#nisn').val();
		let nama = $('#nama').val();
		let no_hp = $('#no_hp').val();
		let email = $('#email').val();
		let asal_sekolah = $('#asal_sekolah').val();

		let ajax = null;
		if(id == 0) {
			ajax = window.apiClient.siswaData.insert(nis, nisn, nama, no_hp, email, asal_sekolah)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','siswa','success');
				dynamic();
				$('#nis').val('');
				$('#nisn').val('');
				$('#nama').val('');
				$('#no_hp').val('');
				$('#email').val('');
				$('#asal_sekolah').val('');
				
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','siswa','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
		else {
			ajax = window.apiClient.siswaData.update(id, nis, nisn, nama, no_hp, email, asal_sekolah)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','siswa','success');
				dynamic();
				$('#nis').val('');
				$('#nisn').val('');
				$('#nama').val('');
				$('#no_hp').val('');
				$('#email').val('');
				$('#asal_sekolah').val('');
				
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','siswa','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
	});

	
	// fungsi ubah
	$('#advanced-usage tbody').on('click', '.edit-button', function(ev) {
		ev.preventDefault();
		var ids = $(this).val();
		console.log(ids);
		var res = ids.split("|");
		$('#form input[name=id]').val(res[0]);
		$('#myModalLabel').html('Ubah data siswa');
		$('#id').val(res[0]);
		$('#nis').val(res[1]);
		$('#nisn').val(res[2]);
		$('#nama').val(res[3]);
		$('#no_hp').val(res[4]);
		$('#email').val(res[5]);
		$('#asal_sekolah').val(res[6]);
	});

	// fungsi hapus
	$('#advanced-usage tbody').on('click', '.delete-button', function(ev) {
		var ids = $(this).val();
		$("#idHapus").val(ids);
		$("#labelHapus").text('Form Hapus');
		$("#contentHapus").text('Apakah anda yakin akan menghapus data ini?');
		$('#myModal3').modal('toggle');
	});

	// fungsi hapus jika ya
	$('#clickHapus').click(function() {
		let id = $("#idHapus").val();
		ajax = window.apiClient.siswaData.delete(id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','siswa','success');
				dynamic();
				
			})
			.fail(function($xhr) {
				$.message('Gagal dihapus.','siswa','error');
			}).
			always(function() {
				$('#myModal3').modal('toggle');
			});
	});

});

 function detail(qrcode)
 {
 	$('#qr-code-ku').attr('src', '<?= base_url() ?>gambar/qr-code-siswa/'+qrcode)
 	$('#download').attr('href', '<?= base_url() ?>gambar/qr-code-siswa/'+qrcode)
 }