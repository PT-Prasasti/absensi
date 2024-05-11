<?php
    include '../koneksi.php';

    $query = "SELECT * FROM karyawan";
    $hasil = mysqli_query($koneksi, $query);
    $karyawan = array();
    $kerja = array();
    if(isset($_GET['start']) && isset($_GET['end'])) {
        $weekdays = get_weekdays($_GET['start'], $_GET['end']);
    } else{
        $weekdays = get_weekdays();
    }
    if(mysqli_num_rows($hasil) > 0) {
        while($data = mysqli_fetch_array($hasil)) {
            $karyawan[] = $data['nama']; 
            $nip = $data['nip'];
            $waktu = 0;
            $standar = count($weekdays) * 8;
            foreach($weekdays as $item) {
                $query1 = "SELECT * FROM absen WHERE nip='$nip' AND tgl='$item' AND waktu_out IS NOT NULL";
                $hasil1 = mysqli_query($koneksi, $query1);
                if(mysqli_num_rows($hasil1) > 0) {
                    $waktu += 8;
                }
            }
            $kerja[] = $standar - $waktu;
        }
    }

    $return = array(
        'karyawan' => $karyawan,
        'kerja' => $kerja
    );

    echo json_encode($return);

    function get_weekdays($start = NULL, $end = NULL)
    {
        if($start == NULL) {
            $startDate = new DateTime('first day of this month');
            $endDate = new DateTime('last day of this month');
        } else {
            $startDate = new DateTime($start);
            $endDate = new DateTime($end);
        }

        // Create an empty array to store the weekdays
        $weekdays = [];

        // Iterate through each date
        while ($startDate <= $endDate) {
            // Check if the current day is a weekday (Monday to Friday)
            if ($startDate->format('N') <= 5) {
                // Add the weekday to the array
                $weekdays[] = $startDate->format('Y-m-d');
            }
            // Move to the next day
            $startDate->modify('+1 day');
        }

        return $weekdays;
    }

?>