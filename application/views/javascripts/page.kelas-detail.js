 $(function() {
	
	let url = window.location.pathname
	let id 	= url.split('/')
	
	id 		= id[5]

	$('#kksi_kkdj_id').val(id)

 	value_filter_siswa() 	

	function value_filter_siswa(){
		$("#siswa").html("");
		$("#siswa").html("<option value=''>--Pilih Siswa--</option>");

		window.apiClient.filter.siswa().done(function(res) {
			$.each(res, function(value, key) {
				$("#siswa").append("<option value='"+key.sisw_id+"'>"+key.sisw_nama+"</option>");
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
			"url": "<?= base_url()?>kelas/detail/ajax_data/"+id,
			"data": null,
			"type": 'POST'
		},
		"columns": [
			{ "data": "sisw_nis" },
			{ "data": "sisw_nama" },
			{
				"data": "kksi_id", render: function(data, type, full, meta)
				{
					return '<div class="pull-right">'
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
				"url": "<?= base_url()?>kelas/detail/ajax_data/"+id,
				"data": null,
				"type": 'POST'
			},
			"columns": [
				{ "data": "sisw_nis" },
				{ "data": "sisw_nama" },
				{
					"data": "kksi_id", render: function(data, type, full, meta)
					{
						return '<div class="pull-right">'
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

		let siswa = $('#siswa').val();
		let kksi_kkdj_id = $('#kksi_kkdj_id').val();

		let ajax = null;
		if(id == 0) {
			ajax = window.apiClient.kelasDetail.insert(siswa, kksi_kkdj_id)
			.done(function(data) {
				$("#advanced-usage").dataTable().fnDestroy();
				$.message('Berhasil ditambahkan.','siswa','success');
				dynamic();
				$('#nama').val('');
				$('#keterangan').val('');
				
			})
			.fail(function($xhr) {
				$.message('Gagal ditambahkan.','siswa','error');
			}).
			always(function() {
				$('#splash').modal('toggle');
			});
		}
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
		ajax = window.apiClient.kelasDetail.delete(id)
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