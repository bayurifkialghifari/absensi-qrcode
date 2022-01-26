$(window).load(function(){
               
	getDataKehadiran()
	getDataKehadiranMinggu()
	getDataKehadiranBulan()
	
    //Initialize mini calendar datepicker
    // $('#mini-calendar').datetimepicker({
    //     inline: true
    // })
    //*Initialize mini calendar datepicker

    function getDataKehadiran()
    {
	    window.apiClient.dashboard.getDataKehadiran().done(function(res) {
			$('#hadir').html(res.hadir)
			$('#izin').html(res.izin)
			$('#sakit').html(res.sakit)
			$('#alpa').html(res.alpa)
			// Masuk
			let data6 = [
	            { label: 'Izin', data: res.izin },
	            { label: 'Hadir', data: res.hadir },
	            { label: 'Alpa', data: res.alpa },
	            { label: 'Sakit', data: res.sakit },
	        ]

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
	        }

	        var plot6 = $.plot($("#hari-ini"), data6, options6)

		}).fail(function($xhr) {
			console.log($xhr)
		})
	}

	function getDataKehadiranMinggu()
    {
	    window.apiClient.dashboard.getDataKehadiranMinggu().done(function(res) {
			$('#hadir-minggu').html(res.hadir)
			$('#izin-minggu').html(res.izin)
			$('#sakit-minggu').html(res.sakit)
			$('#alpa-minggu').html(res.alpa)
			// Masuk
			let data6 = [
	            { label: 'Izin', data: res.izin },
	            { label: 'Hadir', data: res.hadir },
	            { label: 'Alpa', data: res.alpa },
	            { label: 'Sakit', data: res.sakit },
	        ]

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
	        }

	        var plot6 = $.plot($("#minggu-ini"), data6, options6)

		}).fail(function($xhr) {
			console.log($xhr)
		})
	}

	function getDataKehadiranBulan()
    {
	    window.apiClient.dashboard.getDataKehadiranBulan().done(function(res) {
			$('#hadir-bulan').html(res.hadir)
			$('#izin-bulan').html(res.izin)
			$('#alpa-bulan').html(res.alpa)
			$('#sakit-bulan').html(res.sakit)
			// Masuk
			let data6 = [
	            { label: 'Izin', data: res.izin },
	            { label: 'Hadir', data: res.hadir },
	            { label: 'Alpa', data: res.alpa },
	            { label: 'Sakit', data: res.sakit },
	        ]

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
	        }

	        var plot6 = $.plot($("#bulan-ini"), data6, options6)

		}).fail(function($xhr) {
			console.log($xhr)
		})
	}
})