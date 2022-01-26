 $(function() {

 	value_filter_pengajarYangDiajar()
 	value_filter_guru()
 	value_filter_mataPelajaran()
 	value_filter_jurusan()

 	function value_filter_guru()
 	{
		$('#guru').html('')
		$('#guru').html('<option value="">--Pilih Guru--</option>')
		window.apiClient.filter.guru().done(function(res) {
				$.each(res, function(value, key) {
					$("#guru").append("<option value='"+key.user_id+"'>"+key.user_name+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	function value_filter_mataPelajaran()
 	{
		$('#mataPelajaran').html('')
		$('#mataPelajaran').html('<option value="">--Pilih Mata Pelajaran--</option>')
		window.apiClient.filter.mataPelajaran().done(function(res) {
				$.each(res, function(value, key) {
					$("#mataPelajaran").append("<option value='"+key.matp_id+"'>"+key.matp_nama+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	function value_filter_pengajarYangDiajar()
 	{
		$('#kelas').html('')
		$('#kelas').html('<option value="">--Pilih Kelas--</option>')
		window.apiClient.filter.kelasYangDiajar().done(function(res) {
				$.each(res, function(value, key) {
					$("#kelas").append("<option value='"+key.kkdj_id+"'>"+key.kela_nama+'&nbsp;'+key.juru_nama+'&nbsp;'+key.kede_detail+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	function value_filter_jurusan(){
		$('#jurusan').html('')
		$('#jurusan').html('<option value="">--Pilih Jurusan--</option>')
		window.apiClient.filter.jurusan().done(function(res) {
				$.each(res, function(value, key) {
					$("#jurusan").append("<option value='"+key.juru_id+"'>"+key.juru_nama+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>pengajar/data/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "user_name"},
	      	{ "data": "matp_nama" },
	      	{ "data": "juru_nama" },
	      	{ "data": "kkdj_id", render(data, type, full, meta)
		      	{
		      		return '<div class="text-center">'
		      				+full.kela_nama+'&nbsp;'+full.juru_nama+'&nbsp;'+full.kede_detail
		      				+'</div>'
		      	} 
	      	},
			{
				"data": "pena_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.pena_id+'|'+full.pena_user_id+'|'+full.pena_matp_id+'|'+full.pena_juru_id+'|'+full.pena_kkdj_id+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
				"url": "<?= base_url()?>pengajar/data/ajax_data/",
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "user_name"},
		      	{ "data": "matp_nama" },
		      	{ "data": "juru_nama" },
		      	{ "data": "kkdj_id", render(data, type, full, meta)
			      	{
			      		return '<div class="text-center">'
			      				+full.kela_nama+'&nbsp;'+full.juru_nama+'&nbsp;'+full.kede_detail
			      				+'</div>'
			      	} 
		      	},
				{
					"data": "pena_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
											+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.pena_id+'|'+full.pena_user_id+'|'+full.pena_matp_id+'|'+full.pena_juru_id+'|'+full.pena_kkdj_id+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
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
		let guru = $('#guru').val();
		let mataPelajaran = $('#mataPelajaran').val();
		let kelas = $('#kelas').val();
		let jurusan = $('#jurusan').val();
		
		let ajax = null;
		if(id == 0) {
			ajax = window.apiClient.pengajarData.insert(guru, mataPelajaran, kelas, jurusan)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','pengajar','success');
				dynamic();
				value_filter_pengajarYangDiajar()
			 	value_filter_guru()
			 	value_filter_mataPelajaran()
			 	value_filter_jurusan()
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','pengajar','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
		else {
			ajax = window.apiClient.pengajarData.update(id, guru, mataPelajaran, kelas, jurusan)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','pengajar','success');
				dynamic();
				$('#form input[name=id]').val('')
				value_filter_pengajarYangDiajar()
			 	value_filter_guru()
			 	value_filter_mataPelajaran()
			 	value_filter_jurusan()
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','pengajar','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
	});

	
	// fungsi ubah
	$('#advanced-usage tbody').on('click', '.edit-button', function(ev) {
		ev.preventDefault();
		$('#myModalLabel').html('Ubah Data pengajar');
		var ids = $(this).val();
		$('#form input[name=id]').val(ids);
		var res = ids.split("|");
		$('#id').val(res[0]);
		$('#guru').val(res[1]);
		$('#mataPelajaran').val(res[2]);
		$('#jurusan').val(res[3]);
		$('#kelas').val(res[4]);

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
		ajax = window.apiClient.pengajarData.delete(id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','pengajar','success');
				dynamic();
				
			})
			.fail(function($xhr) {
				$.message('Gagal dihapus.','pengajar','error');
			}).
			always(function() {
				$('#myModal3').modal('toggle');
			});
	});
});