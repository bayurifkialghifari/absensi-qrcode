 $(function() {

	//initialize responsive datatable
	function stateChange(iColumn, bVisible) {
		console.log('The column', iColumn, ' has changed its status to', bVisible);
	}

	var table4 = $('#advanced-usage').DataTable({
		"ajax": {
			"url": "<?= base_url()?>absen/data/ajax_data/",
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
		      		 		+'<a href="<?= base_url() ?>absen/detail/siswa/'+full.kkdj_id+'" onclick="status('+full.kkdj_id+')" class="btn btn-warning">Absen</a>'
		      		 		+'</div>'
		      	} 
	      	},
			// {
				// "data": "kkdj_id", render: function(data, type, full, meta)
				// {
					// return '<div class="pull-right">'
										// +'<button class="btn btn-sm btn-primary btn-ef btn-ef-5 btn-ef-5b edit-button" data-toggle="modal" data-target="#splash" data-options="splash-2 splash-ef-14" value="'+full.kkdj_id+'|'+full.kkdj_kela_id+'|'+full.kkdj_kede_id+'|'+full.kkdj_juru_id+'|'+full.kkdj_angk_id+'"><i class="fa fa-edit"></i> <span>Ubah</span></button>'
										// +'<button class="btn btn-sm btn-danger btn-ef btn-ef-5 btn-ef-5b delete-button" value="'+data+'"><i class="fa fa-trash"></i> <span>Hapus</span></button>'
									// +'</div>';
				// }
			// }
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
});

 function status(id)
 {
 	window.apiClient.absen.ChangeStatus(id)
 }