<?php include '../layout/header.php'; ?>
            
    <div class="main-content container-fluid">
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Approval Cuti Karyawan</h4>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <table class="table mb-0" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">NIP</th>
                                            <th class="text-center">Nama Karyawan</th>
                                            <th class="text-center">Tanggal Mulai</th>
                                            <th class="text-center">Tanggal Akhir</th>
                                            <th class="text-center">Lama Cuti</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query ="select * from cuti join karyawan on cuti.`nip`= karyawan.`nip` WHERE cuti.`status`='On Progress'";
                                        $hasil = mysqli_query($koneksi, $query);
                                        $status = array('On Progress', 'Approve','Declined');
                                        while($data = mysqli_fetch_array($hasil))
                                        {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $data['nip']; ?></td>
                                            <td><?= $data['nama']; ?></td>
                                            <td class="text-center"><?= Date('d-m-Y', strtotime($data['tanggal_mulai'])) ?></td>
                                            <td class="text-center"><?= Date('d-m-Y', strtotime($data['tanggal_akhir'])) ?></td>
                                            <td class="text-center"><?php echo $data['lama'] ?> Hari</td>
                                            <?php
                                                if($data['status'] == 'On Progress'){
                                                    echo '<td class="text-center">
                                                            <span class="badge bg-warning">
                                                                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter">
                                                                    <b>On Progress</b>
                                                                </button>
                                                            </span>
                                                        </td>';
                                                } else if($data['status'] == 'Approve'){
                                                    echo '<td class="text-center"><span class="badge bg-success">Approve</span></td>';
                                                } else if($data['status'] == 'Declined'){
                                                    echo '<td class="text-center"><span class="badge bg-danger">Declined</span></td>';
                                                } 
                                            ?>
                                        </tr>

                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <form method="post" action="query_edit.php" enctype="multipart/form-data">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Approval Status Cuti</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="text" class="form-control" name="kode_cuti" value="<?php echo $data['kode_cuti']; ?>" hidden>
                                                            
                                                            <label for="" class="form-label">Select Status</label>
                                                            <fieldset class="form-group">
                                                                <select class="form-select" id="basicSelect" name="status">
                                                                <?php
                                                                    foreach ($status as $k){
                                                                        echo "<option value='$k' ";
                                                                        echo $data['status']==$k?'selected="selected"':'';
                                                                        echo ">$k</option>";
                                                                    }
                                                                ?>
                                                                </select>
                                                            </fieldset>
                                                            <label for="" class="form-label mt-3">Keterangan</label>
                                                            <textarea class="form-control" name="keterangan" rows="3" readonly><?php echo $data['keterangan'];?></textarea>
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