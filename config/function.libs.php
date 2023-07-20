<?php
function tanggal($tgl){
    $bulan = array('','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des');
    
    // 2022-07-17
    // 012345678
    $tg = substr($tgl, 8, 2);
    $bl = intval(substr($tgl, 5, 2)); // Mengubah string bulan menjadi integer
    $th = substr($tgl, 0, 4);

    return $tg.' '.$bulan[$bl].' '.$th;
}
