 $(function() {

 	value_filter_kelas()
 	value_filter_kelas_detail()
 	value_filter_jurusan()
 	value_filter_angkatan()

 	function value_filter_kelas(){
		$('#kela').html('')
		$('#kela').html('<option value="">--Pilih Kelas--</option>')
		window.apiClient.filter.kelas().done(function(res) {
				$.each(res, function(value, key) {
					$("#kela").append("<option value='"+key.kela_id+"'>"+key.kela_nama+"</option>");
			  })
		}).fail(function($xhr) {
			console.log($xhr);
		});
	}

	function value_filter_kelas_detail(){
		$('#kede').html('')
		$('#kede').html('<option value="">--Pilih Kelas Detail--</option>')
		window.apiClient.filter.kelasDetail().done(function(res) {
				$.each(res, function(value, key) {
					$("#kede").append("<option value='"+key.kede_id+"'>"+key.kede_detail+"</option>");
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

	function value_filter_angkatan(){
		$('#angkatan').html('')
		$('#angkatan').html('<option value="">--Pilih Angkatan--</option>')
		window.apiClient.filter.angkatan().done(function(res) {
				$.each(res, function(value, key) {
					$("#angkatan").append("<option value='"+key.angk_id+"'>"+key.angk_nama+"</option>");
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
			"url": "<?= base_url()?>kelas/data/ajax_data/",
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ 
				"data": "kkdj_id", render(data, type, full, meta)
				{
					return '<div class="text-center">'
							+full.kela_nama + '&nbsp;' + full.juru_nama + '&nbsp' + full.kede_detail
							+'</div>'
				} 
			},
	      	{ "data": "angk_nama" },
	      	{ "data": "kkdj_id", render(data, type, full, meta)
		      	{
		      		return '<div class="text-center">'
		      		 		+'<a href="<?= base_url() ?>kelas/detail/siswa/'+full.kkdj_id+'" class="btn btn-warning">Detail</a>'
		      		 		+'</div>'
		      	} 
	      	},
			{
				"data": "kkdj_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
										+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.kkdj_id+'|'+full.kkdj_kela_id+'|'+full.kkdj_kede_id+'|'+full.kkdj_juru_id+'|'+full.kkdj_angk_id+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
										// +'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
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
					"url": "<?= base_url()?>kelas/data/ajax_data/",
					"data": null,
					"type": 'POST'
				},
				"columns": [
					{ 
						"data": "kkdj_id", render(data, type, full, meta)
						{
							return '<div class="text-center">'
									+full.kela_nama + '&nbsp;' + full.juru_nama + '&nbsp' + full.kede_detail
									+'</div>'
						} 
					},
			      	{ "data": "angk_nama" },
			      	{ "data": "kkdj_id", render(data, type, full, meta)
				      	{
				      		return '<div class="text-center">'
				      		 		+'<a href="<?= base_url() ?>kelas/detail/siswa/'+full.kkdj_id+'" class="btn btn-warning">Detail</a>'
				      		 		+'</div>'
				      	} 
			      	},
					{
						"data": "kkdj_id", render: function(data, type, full, meta)
						{
							return '<div class="pull-right">'
												+'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.kkdj_id+'|'+full.kkdj_kela_id+'|'+full.kkdj_kede_id+'|'+full.kkdj_juru_id+'|'+full.kkdj_angk_id+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
												// +'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
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
		let kela = $('#kela').val();
		let kede = $('#kede').val();
		let jurusan = $('#jurusan').val();
		let angkatan = $('#angkatan').val();
		
		let ajax = null;
		if(id == 0) {
			ajax = window.apiClient.kelasData.insert(kela, kede, jurusan, angkatan)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','Kelas','success');
				dynamic();
				value_filter_kelas()
				value_filter_kelas()
				value_filter_angkatan()
				value_filter_jurusan()
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','Kelas','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
		else {
			ajax = window.apiClient.kelasData.update(id, kela, kede, jurusan, angkatan)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil diubah.','Kelas','success');
				dynamic();
				$('#form input[name=id]').val('')
				value_filter_kelas()
				value_filter_kelas()
				value_filter_angkatan()
				value_filter_jurusan()
			})
			.fail(function($xhr) {
				$.message('Gagal diubah.','Kelas','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
	});

	
	// fungsi ubah
	$('#advanced-usage tbody').on('click', '.edit-button', function(ev) {
		ev.preventDefault();
		$('#myModalLabel').html('Ubah Data Kelas');
		var ids = $(this).val();
		$('#form input[name=id]').val(ids);
		var res = ids.split("|");
		$('#id').val(res[0]);
		$('#kela').val(res[1]);
		$('#kede').val(res[2]);
		$('#angkatan').val(res[3]);
		$('#jurusan').val(res[4]);

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
		ajax = window.apiClient.kelasData.delete(id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil dihapus.','Kelas','success');
				dynamic();
				
			})
			.fail(function($xhr) {
				$.message('Gagal dihapus.','Kelas','error');
			}).
			always(function() {
				$('#myModal3').modal('toggle');
			});
	});
});