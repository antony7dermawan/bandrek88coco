<?php
require('fpdf17/fpdf.php');


$discount_percentage=20;
$discount_price=10000;
$discount_price_limit=1000;
$discount_qty=1;



$today=date('Y-m-d');
$date = strtotime($today);
$date = strtotime("+7 day", $date);
$expire_date= date('Y-m-d', $date);








include('web_setting/db_connection.php');
session_start();
date_default_timezone_set('Asia/Jakarta');

$get_pc_date_time= getdate();
$report_id_date_time = $get_pc_date_time['mday'].'-'.$get_pc_date_time['mon'].'-'.$get_pc_date_time['year'].' '.$get_pc_date_time['hours'].':'.$get_pc_date_time['minutes'].':'.$get_pc_date_time['seconds'];


$t_login_user_access=$_SESSION['t_login_user_access'];
$t_login_user_control=$_SESSION["t_login_user_control"];
$queue_id = $_SESSION['queue_id'];

$discount_receipt=$_SESSION['discount_receipt'];


$total_belanja=0;
$DB_TABLE_NAME = 'T_T_TRANSACTION';
$select_db = "SELECT * FROM {$DB_TABLE_NAME} where access='{$t_login_user_access}'";
$select_ex = $conn->query($select_db);
if($select_ex->num_rows> 0)
{
  while($select_db = $select_ex->fetch_assoc())
  {
    $id_struck[]= (($select_db['id']));
    $id_name_struck[]= (($select_db['id_name']));
    $id_qty_struck[]= (($select_db['qty']));
    $id_price_struck[]= (($select_db['price']));
    $id_total_struck[]= (($select_db['total']));

    $total_belanja=$total_belanja+ intval(($select_db['total']));
    

  }
  
}

if($select_ex->num_rows== 0)
{
  $id_struck[0]=0;
  $id_name_struck[0]=0;
  $id_qty_struck[0]=0;
  $id_price_struck[0]=0;
  $id_total_struck[0]=0;
}

foreach( array_keys($id_struck) as $struck_row ){}
$_SESSION['struck_row']=$struck_row;
$_SESSION['id_struck']=$id_struck;  




$paper_height = intval(80+($struck_row*10));







//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm
#$image1 = "image/logo_bandrek.png";




































#$pdf = new FPDF('P','mm','A4');
$pdf = new FPDF('P','mm',array(58,$paper_height));
$pdf->SetMargins(2, 2);

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )
#$this->Cell( 40, 40, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );

$pdf->Cell(45	,6,'Bandrek 88 Coco',0,0);
$pdf->Cell(59	,6,'',0,1);//end of line
$pdf->SetFont('Arial','',8);
$pdf->Cell(45	,4,'Cabang: Jl. Pemuda depan Kerta Arja',0,1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(40	,2,'------------------------------------',0,1);
$pdf->SetFont('Arial','',8);
$pdf->Cell(59	,3,$report_id_date_time,0,1);//end of line
$pdf->SetFont('Arial','',12);
$pdf->Cell(40	,5,'Nomor Antrian:',0,0);
$pdf->Cell(59	,5,$queue_id,0,1);//end of line


$pdf->Cell(40	,2,'------------------------------------',0,1);
//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',10);

for($i=0;$i<=$struck_row;$i++)
{
	$pdf->Cell(40	,5,$id_name_struck[$i],0,1);
	$pdf->Cell(5	,5,$id_qty_struck[$i],0,0);
	$pdf->Cell(5	,5,'x',0,0);
	$pdf->Cell(15	,5,number_format($id_price_struck[$i]),0,0);
	$pdf->Cell(20	,5,number_format($id_total_struck[$i]),0,1,'R');
}
$pdf->Cell(40	,2,'------------------------------------',0,1);
$pdf->Cell(25	,5,'Sub Total',0,0);
$pdf->Cell(20	,5,number_format($total_belanja),0,1,'R');







#create promo
$promo_no=0;
if($total_belanja>=$discount_price)
{
  $promo_no=(rand(1000,9999));
  $DB_TABLE_NAME = 't_t_discount';
  $insert_db = "insert into {$DB_TABLE_NAME} values ('0','{$promo_no}','{$discount_percentage}','{$discount_price}','{$discount_price_limit}','{$discount_qty}','{$expire_date}','{$t_login_user_access}')";
  $insert_ex = $conn->query($insert_db);
}




#create promo end



















$pdf->Cell(25	,5,'Discount',0,0);
$pdf->Cell(20	,5,number_format($discount_receipt),0,1,'R');


$total_belanja=$total_belanja-$discount_receipt;
$pdf->Cell(25	,5,'Total',0,0);
$pdf->Cell(20	,5,number_format($total_belanja),0,1,'R');


$pdf->Cell(40	,2,'------------------------------------',0,1);

if($promo_no!=0)
{
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25 ,5,'Kode Promo =',0,0);
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(25 ,5,$promo_no,0,1);

  $expire_date= date('d-m-Y', strtotime($expire_date));


  $pdf->SetFont('Arial','',8);
  $pdf->Cell(25 ,3,'Dapatkan diskon '.$discount_percentage.' persen',0,1);
  $pdf->Cell(25 ,3,'max Rp'.number_format($discount_price_limit).' di pembelian selanjutnya',0,1);
  $pdf->Cell(25 ,3,'Berlaku sampai '.$expire_date,0,1);
}

if($promo_no==0)
{
  $pdf->SetFont('Arial','',8);
  $pdf->Cell(25 ,3,'Dapatkan kode promo',0,1);
  $pdf->Cell(25 ,5,'setiap pembelanjaan minimal Rp10,000',0,1);
}


$pdf->SetFont('Arial','B',10);
$pdf->Cell(25	,5,'Terima Kasih',0,1);
$pdf->SetFont('Arial','',8);
$pdf->Cell(25	,3,'Kunjungi Instagram kita:',0,1);
$pdf->Cell(25	,3,'bandrek88coco',0,1);




















$pdf->Output();
?>



<script type="text/javascript">

 	printlayer('print_this');
    function printlayer(layer)
    {
     var restorepage = document.body.innerHTML;
     var printcontent = document.getElementById(layer).innerHTML;
     document.body.innerHTML = printcontent;
     
     var css = '@page { size: portrait; }',
    head = document.head || document.getElementsByTagName('head')[0],
    style = document.createElement('style');

	style.type = 'text/css';
	style.media = 'print';

	if (style.styleSheet){
	  style.styleSheet.cssText = css;
	} else {
	  style.appendChild(document.createTextNode(css));
	}

	head.appendChild(style);

	window.print();
     //window.close();

    }
  </script>
