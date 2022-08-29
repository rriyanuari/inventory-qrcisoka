<?php  
$connect = mysqli_connect("localhost", "root", "", "undian");

$post_scan = substr(@mysqli_real_escape_string($connect, $_GET["scan"]),0,9);

if($post_scan != ""){
	$sql = mysqli_query($connect, "SELECT * FROM kategori2 WHERE kode = '$post_scan'") or die ($connect->error);
	$cek = mysqli_num_rows($sql);
	if($cek > 0) {
		echo "gagal";
	} else {
		$sql_per_id = mysqli_query($connect, "SELECT id FROM kategori2") or die ($connect->error);
	    $s = 1;
	    if(mysqli_num_rows($sql_per_id) > 0) {
		    while($d_kode = mysqli_fetch_array($sql_per_id)){
			    $data_id['$s'] = $d_kode['id'];
			    $s++;
			    $id = $data_id['$s'] + 1;
			}
		} else {
	        $data_id['$s'] = 1 ;
	        $id = $data_id['$s'];
	    }
    	mysqli_query($connect, "INSERT INTO kategori2(id, kode) VALUES ('$id','$post_scan')");
    	echo "sukses";
	}
} else {
	echo "gagal";
}
?>