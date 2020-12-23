
<?php
include_once('connectdb.php');
include_once('head.php');
error_reporting(0);
$resort_name = $_REQUEST['resort_name'];
// echo $_POST["hdnCount"];
for ($i = 0; $i <= (int)$_POST["hdnCount"]; $i++) {

	if (isset($_REQUEST['id_booking'])) {
		if ($_POST['id_booking'] != "" && $_POST["name$i"] != "" && $_POST["age$i"] != "") {
			// echo  "id_booking:=>" . $_POST['id_booking'] . "<br>";
			// echo "name" . $i . "=>" . $_POST["name$i"] . "<br>";
			// echo "age" . $i . "=>" . $_POST["age$i"] . "<br>";

			$sql = "INSERT INTO tb_voucher (id ,id_bookink, service_name, note ,status) 
								VALUES (NULL,'" . $_REQUEST['id_booking'] . "','" . $_POST["name$i"] . "','" . $_POST["age$i"] . "','9');";
			$query = mysqli_query($con, $sql);

			$in = " UPDATE `tb_report` SET `insurance` = '9'   WHERE `tb_report`.`id_booking` ='" . $_REQUEST['id_booking'] . "'";
			$in2 = " UPDATE `tb_report` SET `insurance` = '9'   WHERE `tb_report`.`noid_booking` ='" . $_REQUEST['id_booking'] . "'";
			$a = mysqli_query($con, $in);
			$a = mysqli_query($con, $in2);
		}
	}
}

// echo "<script> alert('ได้ทำการเพิ่มประกันเรียบร้อย!!');window.location.href='report.php?resort_name=$resort_name';</script>";
echo "<div><script>
			swal('สำเร็จ!','ได้ทำการเพิ่มประกันเรียบร้อย', 'success')
			.then(() => {
				setTimeout(function(){ 
					window.location.href='report.php'
				}, 1000);
			});</script></div>";
mysqli_close($con);


?>


