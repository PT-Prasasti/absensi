<?php include '../layout/header.php'; ?>
            
    <div class="main-content container-fluid">
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Approval Absen Karyawan Bulan Februari</h4>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <table class="table mb-0" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">NIP</th>
                                            <th class="text-center">Nama Karyawan</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Jam Masuk</th>
                                            <th class="text-center">Jam Pulang</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query ="SELECT absen.`id`,absen.`nip`,karyawan.`nama`,absen.`tgl`,absen.`keterangan`,absen.`waktu_in`,absen.`waktu_out`,absen.`status`,absen.waktu_in AS masuk,absen.waktu_out AS keluar from absen join karyawan on absen.`nip`=karyawan.`nip` WHERE MONTH(absen.tgl)=MONTH(CURRENT_DATE) AND absen.`status`='Waiting for Approval'";
                                            $hasil = mysqli_query($koneksi, $query);
                                            $status = array('Waiting for Approval', 'Approve','Declined');
                                            while($dt=mysqli_fetch_array($hasil)){
                                                $jam = 0;
                                                $telat=0;
                                                $start = strtotime($dt['masuk']);
                                                $end = strtotime($dt['keluar']);
                                                $hours = ($end - $start) / 3600;
                                                if ($hours - floor($hours) >= 0.5) {
                                                    $jam += ceil($hours);
                                                } else {
                                                    $jam += round($hours);
                                                }
                                                $tgl=$dt['tgl'];
                                                $strt= strtotime($tgl . ' 08:00:00');
                                                $en = strtotime($dt['masuk']);
                                                $menit = ($en - $strt) / 60;
                                                if ($menit - floor($menit) >= 0.5) {
                                                    $telat += ceil($menit);
                                                } else {
                                                    $telat += round($menit);
                                                }
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $dt['nip']; ?></td>
                                            <td><?= $dt['nama']; ?></td>
                                            <td class="text-center"><?= Date('d/m/Y', strtotime($dt['tgl'])) ?></td>
                                            <td class="text-center"><?= Date('H:i', $start) ?></td>
                                            <td class="text-center"><?= isset($dt['keluar']) ? Date('H:i', $end) : '-' ?></td>
                                            <?php
                                                if($dt['status'] == 'Waiting for Approval'){
                                                    echo '<td class="text-center">
                                                            <span class="badge bg-warning">
                                                                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter">
                                                                    <b>Waiting for Approval</b>
                                                                </button>
                                                            </span>
                                                        </td>';
                                                } else if($dt['status'] == 'Approve'){
                                                    echo '<td class="text-center"><span class="badge bg-success">Approve</span></td>';
                                                } else if($dt['status'] == 'Declined'){
                                                    echo '<td class="text-center"><span class="badge bg-danger">Declined</span></td>';
                                                } else if($dt['status'] == ''){
                                                    echo '<td class="text-center"><span class="badge bg-info">Expired</span></td>';
                                                } 
                                            ?>
                                        </tr>

                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <form method="post" action="query_edit.php" enctype="multipart/form-data">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Approval Status Absen</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="text" class="form-control" name="id" value="<?php echo $dt['id']; ?>" hidden>
                                                            
                                                            <label for="" class="form-label">Select Status</label>
                                                            <fieldset class="form-group">
                                                                <select class="form-select" id="basicSelect" name="status">
                                                                <?php
                                                                    foreach ($status as $k){
                                                                        echo "<option value='$k' ";
                                                                        echo $dt['status']==$k?'selected="selected"':'';
                                                                        echo ">$k</option>";
                                                                    }
                                                                ?>
                                                                </select>
                                                            </fieldset>
                                                            <label for="" class="form-label mt-3">Keterangan</label>
                                                            <textarea class="form-control" name="keterangan" rows="3"><?php echo $dt['keterangan'];?></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <button type="submit" class="btn btn-primary ml-1">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Accept</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>

                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php include '../layout/footer.php'; ?>