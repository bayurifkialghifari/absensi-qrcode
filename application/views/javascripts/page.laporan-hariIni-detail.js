window.onload = () =>
{
    load()

    function load()
    {
        let html

        html        = '<option value="">--Pilih Mata Pelajaran</option>'
        $('#mata-pelajaran').html(html)

        window.apiClient.filter.mataPelajaran().done(function(res) 
        {
            $.each(res, function(value, key) 
            {
                $("#mata-pelajaran").append("<option value='"+key.matp_id+"'>"+key.matp_nama+"</option>")
            })
        }).fail(function($xhr) 
        {
            console.log($xhr)
        })
    }
}

function change(id)
{
    let siswa = $('#siswa').val()

    window.apiClient.laporan.hariInidetailMataPelajaranKeluar(id, siswa).done(function(res) {
            
        $('#izink').html(res.izin)
        $('#alpak').html(res.alpa)
        $('#hadirk').html(res.hadir)
        $('#sakitk').html(res.sakitk)

        let data7 = [
            { label: 'Izin', data: res.izin },
            { label: 'Hadir', data: res.hadir },
            { label: 'Alpa', data: res.alpa },
            { label: 'Sakit', data: res.sakit },
        ];

        let options7 = {
            series: {
                pie: {
                    show: true,
                    innerRadius: 0,
                    stroke: {
                        width: 0
                    },
                    label: {
                        show: true,
                        threshold: 0.05
                    }
                }
            },
            colors: ['#428bca','#5cb85c','#d9534f'],
            grid: {
                hoverable: true,
                clickable: true,
                borderWidth: 0,
                color: '#ccc'
            },
            tooltip: true,
            tooltipOpts: { content: '%s: %p.0%' }
        };

        var plot6 = $.plot($("#absen-keluar"), data7, options7);

    }).fail(function($xhr) {
        console.log($xhr)
    })

    window.apiClient.laporan.hariInidetailMataPelajaranMasuk(id, siswa).done((res) => {
        console.log(res)

        $('#hadir').html(res.hadir)
        $('#izin').html(res.izin)
        $('#alpa').html(res.alpa)
        $('#sakit').html(res.sakit)

        // Masuk
        let data6 = [
            { label: 'Izin', data: res.izin },
            { label: 'Hadir', data: res.hadir },
            { label: 'Alpa', data: res.alpa },
            { label: 'Sakit', data: res.sakit },
        ];

        let options6 = {
            series: {
                pie: {
                    show: true,
                    innerRadius: 0,
                    stroke: {
                        width: 0
                    },
                    label: {
                        show: true,
                        threshold: 0.05
                    }
                }
            },
            colors: ['#428bca','#5cb85c','#d9534f'],
            grid: {
                hoverable: true,
                clickable: true,
                borderWidth: 0,
                color: '#ccc'
            },
            tooltip: true,
            tooltipOpts: { content: '%s: %p.0%' }
        };

        var plot6 = $.plot($("#absen-masuk"), data6, options6);

    }).fail(function($xhr) {
        console.log($xhr)
    })
}

function detail(id)
{
    $('#siswa').val(id)

	window.apiClient.laporan.hariInidetail(id).done(function(res) {
	
		console.log(res)
		$('#myModalLabel').html('Detail Absen '+res.sisw_nama)
		$('#nis').val(res.sisw_nis)
		$('#nama').val(res.sisw_nama)
		$('#siswa').html(res.sisw_nama)


		window.apiClient.laporan.hariInidetailAbsenMasuk(id).done(function(res) {
			console.log(res)
			
			$('#hadir').html(res.hadir)
			$('#izin').html(res.izin)
            $('#alpa').html(res.alpa)
			$('#sakit').html(res.sakit)

			// Masuk
			let data6 = [
                { label: 'Izin', data: res.izin },
                { label: 'Hadir', data: res.hadir },
                { label: 'Alpa', data: res.alpa },
                { label: 'Sakit', data: res.sakit },
            ];

            let options6 = {
                series: {
                    pie: {
                        show: true,
                        innerRadius: 0,
                        stroke: {
                            width: 0
                        },
                        label: {
                            show: true,
                            threshold: 0.05
                        }
                    }
                },
                colors: ['#428bca','#5cb85c','#d9534f'],
                grid: {
                    hoverable: true,
                    clickable: true,
                    borderWidth: 0,
                    color: '#ccc'
                },
                tooltip: true,
                tooltipOpts: { content: '%s: %p.0%' }
            };

            var plot6 = $.plot($("#absen-masuk"), data6, options6);

        }).fail(function($xhr) {
            console.log($xhr)
        })

        window.apiClient.laporan.hariInidetailAbsenKeluar(id).done(function(res) {
            
            $('#izink').html(res.izin)
            $('#alpak').html(res.alpa)
            $('#hadirk').html(res.hadir)
            $('#sakitk').html(res.sakit)

            let data7 = [
                { label: 'Izin', data: res.izin },
                { label: 'Hadir', data: res.hadir },
                { label: 'Alpa', data: res.alpa },
                { label: 'Sakit', data: res.sakit },
            ];

            let options7 = {
                series: {
                    pie: {
                        show: true,
                        innerRadius: 0,
                        stroke: {
                            width: 0
                        },
                        label: {
                            show: true,
                            threshold: 0.05
                        }
                    }
                },
                colors: ['#428bca','#5cb85c','#d9534f'],
                grid: {
                    hoverable: true,
                    clickable: true,
                    borderWidth: 0,
                    color: '#ccc'
                },
                tooltip: true,
                tooltipOpts: { content: '%s: %p.0%' }
            };

            var plot6 = $.plot($("#absen-keluar"), data7, options7);

		}).fail(function($xhr) {
			console.log($xhr)
		})
	}).fail(function($xhr) {
		console.log($xhr)
	})
}