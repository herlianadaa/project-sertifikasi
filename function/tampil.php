<?php
// tampil data
function tampilsurat()
{
    include 'include/koneksi.php';

    $query = 'SELECT surat.id as idsur,surat.nosurat, surat.judulsurat, surat.kategori, surat.file , surat.tglarsip ,kategori.nama as namakat, kategori.id    
                                      FROM surat , kategori WHERE surat.kategori = kategori.id';
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die('SQL Error: ' . mysqli_error($koneksi));
    }



    echo '
        <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important;">											
            <thead>
                <tr>
                    <th>No Surat</th>
                    <th>Kategori</th>
                    <th>Judul Surat</th>
                    <th>Waktu Pengarsipan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>';
    while ($row = mysqli_fetch_array($result)) {
        echo '				
            <tr>
                <td>' . $row['nosurat'] . '</td>
                <td>' . $row['namakat'] . '</td>
                <td>' . $row['judulsurat'] . '</td>
                <td>' . $row['tglarsip'] . '</td>
                <td><a href="/E-Arsip/assets/arsip/' . $row['file'] . '" class="btn btn-sm btn-clean btn-icon" title="unduh Data">
                <i class="la la-download"></i></a>
                <a  id="deleteData"  data-id ="' . $row['idsur'] . '" class="btn btn-sm btn-clean btn-icon" title="Hapus Data">								
                <i class="la la-trash"></i></a>
                <a href="" id="lihatsurat" class="btn btn-sm btn-clean btn-icon" 
                data-id ="' . $row['idsur'] . '" data-judul ="' . $row['judulsurat'] . '" 
                data-nosur ="' . $row['nosurat'] . '" data-tgl ="' . $row['tglarsip'] . '" 
                data-file ="' . $row['file'] . '"   data-kategori ="' . $row['namakat'] . '"  
                data-toggle="modal" data-target="#ModalLihat" title="Lihat Data">								
                <i class="la la-eye"></i></a>
                </td>							
            </tr>';
    }
    echo '
            </tbody>
        </table>';
}
