<!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">
                <?php if($this->session->userdata('data')['level'] == 'Administrator'):?>
                    <div class="page page-dashboard">
                <?php else: ?>
                    <div class="page page-dashboard">
                <?php endif; ?>

                    <div class="pageheader">

                        <h2>Dashboard <span></span></h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href=""><i class="fa fa-home"></i> Absensi QR-Code</a>
                                </li>
                                <li>
                                    <a href="">Dashboard</a>
                                </li>
                            </ul>

                            <div class="page-toolbar">
                                <!-- <a role="button" tabindex="0" class="btn btn-lightred no-border pickDate"> -->
                                    <!-- <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span></span>&nbsp;&nbsp;<i class="fa fa-angle-down"></i> -->
                                <!-- </a> -->
                            </div>

                        </div>

                    </div>

                    <!-- cards row -->
                    <div class="row">
                        <?php if($this->session->userdata('data')['level'] == 'Administrator'):?>
                            <!-- col -->
                            <div class="card-container col-lg-4 col-sm-6 col-sm-12">
                                <div class="card">
                                    <div class="front bg-lightred">

                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <i class="fa fa-users fa-4x"></i>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-xs-8">
                                                <p class="text-elg text-strong mb-0"><?= $siswa['siswa'] ?></p>
                                                <span>Total Siswa</span>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->

                                    </div>
                                    <div class="back bg-lightred">

                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-xs-12">
                                                <a href=#><i class="fa fa-users fa-2x"></i><?= $siswa['siswa'] ?></a>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->

                                    </div>
                                </div>
                            </div>
                            <!-- /col -->

                            <!-- col -->
                            <div class="card-container col-lg-4 col-sm-6 col-sm-12">
                                <div class="card">
                                    <div class="front bg-blue">

                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <i class="fa fa-graduation-cap fa-4x"></i>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-xs-8">
                                                <p class="text-elg text-strong mb-0"><?= $guru['guru'] ?></p>
                                                <span>Total Guru</span>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->

                                    </div>
                                    <div class="back bg-blue">

                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-xs-12">
                                                <a href=#><i class="fa fa-graduation-cap fa-2x"></i> <?= $guru['guru'] ?></a>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->

                                    </div>
                                </div>
                            </div>
                            <!-- /col -->

                            <!-- col -->
                            <div class="card-container col-lg-4 col-sm-6 col-sm-12">
                                <div class="card">
                                    <div class="front bg-slategray">

                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <i class="fa fa-university fa-4x"></i>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-xs-8">
                                                <p class="text-elg text-strong mb-0"><?= $kelas['kelas'] ?></p>
                                                <span>Total Kelas</span>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->

                                    </div>
                                    <div class="back bg-slategray">

                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-xs-12">
                                                <a href=#><i class="fa fa-university fa-2x"></i> <?= $kelas['kelas'] ?></a>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->

                                    </div>
                                </div>
                            </div>
                            <!-- /col -->

                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Kahadiran Siswa </strong>Hari Ini</h1>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="tile-body">

                                            <div id="hari-ini" style="height: 250px"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="tile-body">

                                            <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-default panel-transparent">
                                                    <div class="panel-heading" role="tab" id="headingOne">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                <span><i class="fa fa-minus text-sm mr-5"></i> Absen</span>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="panel-body">
                                                            <table class="table table-no-border m-0">
                                                                <tbody>
                                                                <tr>
                                                                    <td>Hadir</td>
                                                                    <td>:</td>
                                                                    <td id="hadir"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Sakit</td>
                                                                    <td>:</td>
                                                                    <td id="sakit"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Izin</td>
                                                                    <td>:</td>
                                                                    <td id="izin"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Alpa</td>
                                                                    <td>:</td>
                                                                    <td id="alpa"></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- /tile body -->

                            </section>

                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Kahadiran Siswa </strong>Minggu Ini</h1>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="tile-body">

                                            <div id="minggu-ini" style="height: 250px"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="tile-body">

                                            <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-default panel-transparent">
                                                    <div class="panel-heading" role="tab" id="headingOne">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                <span><i class="fa fa-minus text-sm mr-5"></i> Absen</span>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="panel-body">
                                                            <table class="table table-no-border m-0">
                                                                <tbody>
                                                                <tr>
                                                                    <td>Hadir</td>
                                                                    <td>:</td>
                                                                    <td id="hadir-minggu"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Sakit</td>
                                                                    <td>:</td>
                                                                    <td id="sakit-minggu"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Izin</td>
                                                                    <td>:</td>
                                                                    <td id="izin-minggu"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Alpa</td>
                                                                    <td>:</td>
                                                                    <td id="alpa-minggu"></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- /tile body -->

                            </section>

                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Kahadiran Siswa </strong>Bulan Ini</h1>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="tile-body">

                                            <div id="bulan-ini" style="height: 250px"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="tile-body">

                                            <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-default panel-transparent">
                                                    <div class="panel-heading" role="tab" id="headingOne">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                <span><i class="fa fa-minus text-sm mr-5"></i> Absen</span>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="panel-body">
                                                            <table class="table table-no-border m-0">
                                                                <tbody>
                                                                <tr>
                                                                    <td>Hadir</td>
                                                                    <td>:</td>
                                                                    <td id="hadir-bulan"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Sakit</td>
                                                                    <td>:</td>
                                                                    <td id="sakit-bulan"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Izin</td>
                                                                    <td>:</td>
                                                                    <td id="izin-bulan"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Alpa</td>
                                                                    <td>:</td>
                                                                    <td id="alpa-bulan"></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- /tile body -->

                            </section>

                        <?php elseif($this->session->userdata('data')['level'] == 'Guru'):?>

                            <!-- col -->
                            <div class="pagecontent">
                                <center>
                                    <div class="container">
                                        <div class="card-container col-md-6">
                                            <div class="card">
                                                <div class="front bg-lightred">

                                                    <!-- row -->
                                                    <div class="row">
                                                        <!-- col -->
                                                        <div class="col-xs-4">
                                                            <i class="fa fa-users fa-4x"></i>
                                                        </div>
                                                        <!-- /col -->
                                                        <!-- col -->
                                                        <div class="col-xs-8">
                                                            <p class="text-elg text-strong mb-0"><?= $siswa['siswa'] ?></p>
                                                            <span>Total Siswa</span>
                                                        </div>
                                                        <!-- /col -->
                                                    </div>
                                                    <!-- /row -->

                                                </div>
                                                <div class="back bg-lightred">

                                                    <!-- row -->
                                                    <div class="row">
                                                        <!-- col -->
                                                        <div class="col-xs-12">
                                                            <a href=#><i class="fa fa-users fa-2x"></i><?= $siswa['siswa'] ?></a>
                                                        </div>
                                                        <!-- /col -->
                                                    </div>
                                                    <!-- /row -->

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-container col-md-6">
                                            <div class="card">
                                                <div class="front bg-slategray">

                                                    <!-- row -->
                                                    <div class="row">
                                                        <!-- col -->
                                                        <div class="col-xs-4">
                                                            <i class="fa fa-university fa-4x"></i>
                                                        </div>
                                                        <!-- /col -->
                                                        <!-- col -->
                                                        <div class="col-xs-8">
                                                            <p class="text-elg text-strong mb-0"><?= $kelas['kelas'] ?></p>
                                                            <span>Total Kelas</span>
                                                        </div>
                                                        <!-- /col -->
                                                    </div>
                                                    <!-- /row -->

                                                </div>
                                                <div class="back bg-slategray">

                                                    <!-- row -->
                                                    <div class="row">
                                                        <!-- col -->
                                                        <div class="col-xs-12">
                                                            <a href=#><i class="fa fa-university fa-2x"></i> <?= $kelas['kelas'] ?></a>
                                                        </div>
                                                        <!-- /col -->
                                                    </div>
                                                    <!-- /row -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- row -->
                                    <div class="row container">

                                        <section class="tile">

                                            <!-- tile header -->
                                            <div class="tile-header dvd dvd-btm">
                                                <h1 class="custom-font"><strong>Kahadiran Siswa </strong>Hari Ini</h1>
                                            </div>
                                            <!-- /tile header -->

                                            <!-- tile body -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="tile-body">

                                                        <div id="hari-ini" style="height: 250px"></div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="tile-body">

                                                        <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                                                            <div class="panel panel-default panel-transparent">
                                                                <div class="panel-heading" role="tab" id="headingOne">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                            <span><i class="fa fa-minus text-sm mr-5"></i> Absen</span>
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                                    <div class="panel-body">
                                                                        <table class="table table-no-border m-0">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td>Hadir</td>
                                                                                <td>:</td>
                                                                                <td id="hadir"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Sakit</td>
                                                                                <td>:</td>
                                                                                <td id="sakit"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Izin</td>
                                                                                <td>:</td>
                                                                                <td id="izin"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Alpa</td>
                                                                                <td>:</td>
                                                                                <td id="alpa"></td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /tile body -->

                                        </section>

                                        <section class="tile">

                                            <!-- tile header -->
                                            <div class="tile-header dvd dvd-btm">
                                                <h1 class="custom-font"><strong>Kahadiran Siswa </strong>Minggu Ini</h1>
                                            </div>
                                            <!-- /tile header -->

                                            <!-- tile body -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="tile-body">

                                                        <div id="minggu-ini" style="height: 250px"></div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="tile-body">

                                                        <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                                                            <div class="panel panel-default panel-transparent">
                                                                <div class="panel-heading" role="tab" id="headingOne">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                            <span><i class="fa fa-minus text-sm mr-5"></i> Absen</span>
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                                    <div class="panel-body">
                                                                        <table class="table table-no-border m-0">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td>Hadir</td>
                                                                                <td>:</td>
                                                                                <td id="hadir-minggu"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Sakit</td>
                                                                                <td>:</td>
                                                                                <td id="sakit-minggu"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Izin</td>
                                                                                <td>:</td>
                                                                                <td id="izin-minggu"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Alpa</td>
                                                                                <td>:</td>
                                                                                <td id="alpa-minggu"></td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /tile body -->

                                        </section>

                                        <section class="tile">

                                            <!-- tile header -->
                                            <div class="tile-header dvd dvd-btm">
                                                <h1 class="custom-font"><strong>Kahadiran Siswa </strong>Bulan Ini</h1>
                                            </div>
                                            <!-- /tile header -->

                                            <!-- tile body -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="tile-body">

                                                        <div id="bulan-ini" style="height: 250px"></div>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="tile-body">

                                                        <div class="panel-group icon-plus" id="accordion" role="tablist" aria-multiselectable="true">
                                                            <div class="panel panel-default panel-transparent">
                                                                <div class="panel-heading" role="tab" id="headingOne">
                                                                    <h4 class="panel-title">
                                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                            <span><i class="fa fa-minus text-sm mr-5"></i> Absen</span>
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                                    <div class="panel-body">
                                                                        <table class="table table-no-border m-0">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td>Hadir</td>
                                                                                <td>:</td>
                                                                                <td id="hadir-bulan"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Sakit</td>
                                                                                <td>:</td>
                                                                                <td id="sakit-bulan"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Izin</td>
                                                                                <td>:</td>
                                                                                <td id="izin-bulan"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Alpa</td>
                                                                                <td>:</td>
                                                                                <td id="alpa-bulan"></td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /tile body -->

                                        </section>

                                    </div>
                                    <!-- /row -->
                                </center>
                            </div>
                            
                        <?php endif;?>
                    </div>
                    <!-- /row -->



                </div>

                
            </section>
            <!--/ CONTENT -->
