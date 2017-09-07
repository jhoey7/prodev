<?php if($tipe=="penilaian"){ ?>
<table class="tabelPopUp">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Proyek</th>
            <th>Tanggal Proyek</th>
            <th>Nilai Pekerjaan</th>
            <th>Nilai Attitude</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(count($data) > 0){
            $no = 1;
            foreach($data as $row){
                $TotRow = $TotRow + 1;
                $TotNilPekerjaan = $TotNilPekerjaan + $row['nilai_pekerjaan'];
                $TotNilPerilaku = $TotNilPerilaku + $row['nilai_perilaku'];
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $row['nama_proyek']; ?></td>
            <td><?php echo $row['tgl_proyek']; ?></td>
            <td><?php echo $row['nilai_pekerjaan']; ?></td>
            <td><?php echo $row['nilai_perilaku']; ?></td>
        </tr>
        <?php $no++; }  ?>
        <tr>
            <td colspan="3" align="center">Rata - Rata</td>
            <td><?php echo round($TotNilPekerjaan / $TotRow); ?></td>
            <td><?php echo round($TotNilPerilaku / $TotRow); ?></td>
        </tr>
        <?php }else{ ?>
        <tr>
            <td colspan="5" align="center">Data Tidak Ditemukan</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php }elseif($tipe=="pekerjaan"){ ?>
<table class="tabelPopUp">
    <thead>
        <tr>
            <th>No</th>
            <th>Fase</th>
            <th>Nama Pekerjaan</th>
            <th>PIC</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Akhir</th>
            <th>Tanggal Selesai</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(count($data) > 0){
            $no = 1;
            foreach($data as $row){
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $row['fase']; ?></td>
            <td><?php echo $row['deskripsi_pekerjaan']; ?></td>
            <td><?php echo $row['nama_karyawan']; ?></td>
            <td><?php echo $row['tgl_awal']; ?></td>
            <td><?php echo $row['tgl_akhir']; ?></td>
            <td><?php echo $row['tgl_selesai']; ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
        <?php $no++; } }else{ ?>
        <tr>
            <td colspan="8" align="center">Data Tidak Ditemukan</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } ?>