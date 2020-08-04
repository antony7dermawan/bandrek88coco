<?php
include('web_setting/db_connection.php');
session_start();

for($i=0;$i<20;$i++)
{
  $selected_header[$i]='';
}
$selected_header[0]=" class='active'";
$t_login_user_access=$_SESSION['t_login_user_access'];
$t_login_user_control=$_SESSION["t_login_user_control"];





$struck_row=0;

$text_for_user = $_SESSION['user_text'];
$button_for_user = $_SESSION['user_submit'];
$total_sum= $_SESSION['total_sum'];



#.................................diskon logic
  



if(isset($_POST['submit_discount']))
{
  $_SESSION['textbox_discount']=$_POST['textbox_discount'];
  $today=date('Y-m-d');

  $discount_percentage=0;
  $discount_price_limit=0;
  $discount_price=0;

  $textbox_discount=$_SESSION['textbox_discount'];

  $DB_TABLE_NAME = 'T_T_DISCOUNT';
  $select_db = "SELECT * FROM {$DB_TABLE_NAME} where(PROMO_NO='{$textbox_discount}' and EXPIRE_DATE>='{$today}' and DISCOUNT_QTY>='1')";
  $select_ex = $conn->query($select_db);
  if($select_ex->num_rows> 0)
  {
    while($select_db = $select_ex->fetch_assoc())
    {
      $discount_percentage= ($select_db['discount_percentage']);
      $discount_price= ($select_db['discount_price']);
      $discount_price_limit= ($select_db['discount_price_limit']);
      $discount_qty= ($select_db['discount_qty']);
      $expire_date= ($select_db['expire_date']);


      $_SESSION['discount_qty']=$discount_qty;
      $_SESSION['discount_price']=$discount_price;
      $_SESSION['discount_percentage']=$discount_percentage;
      $_SESSION['discount_price_limit']=$discount_price_limit;
    }      
  }
  if($select_ex->num_rows== 0)
  {

  }
}

$discount_qty=$_SESSION['discount_qty'];
$textbox_discount=$_SESSION['textbox_discount'];
$discount_price=$_SESSION['discount_price'];
$discount_percentage=$_SESSION['discount_percentage'];
$discount_price_limit=$_SESSION['discount_price_limit'];

  #....................................diskon login end



$DB_TABLE_NAME = 'T_T_STOCK';
$select_db = "SELECT * FROM {$DB_TABLE_NAME} where access='{$t_login_user_access}'";
$select_ex = $conn->query($select_db);
if($select_ex->num_rows> 0)
{
  while($select_db = $select_ex->fetch_assoc())
  {
    $id[]= (($select_db['id']));
    $id_barcode[]= (($select_db['id_barcode']));
    $id_name[]= (($select_db['id_name']));
    $qty[]= (($select_db['qty']));
    $input_date[]= (($select_db['input_date']));
    $buy_price[]= (($select_db['buy_price']));
    $sell_price[]= (($select_db['sell_price']));

  }      
}


foreach( array_keys($id) as $t_row ){}
$total_row=$t_row+1;






$id_transaction=0;
$qty_transaction=0;

for($i=0;$i<$total_row;$i++)
{
  if(isset($_POST['c_name_'.$i]))
  {
    $name_=$_POST['c_name_'.$i];
    $DB_TABLE_NAME = 'T_T_TRANSACTION';
    $select_db = "SELECT qty FROM {$DB_TABLE_NAME} where(ID_NAME='{$name_}' and access='{$t_login_user_access}')";
    $select_ex = $conn->query($select_db);
    if($select_ex->num_rows> 0)
    {
      while($select_db = $select_ex->fetch_assoc())
      {
        $qty_transaction= (($select_db['qty']));
      }      
    }
          $id_i=($id_transaction+1);
          $id_name_i=$_POST['c_name_'.$i];
          $qty_i=($qty_transaction+1);
          $sell_price_i=$sell_price[$i];
          $total_i=$qty_i*$sell_price_i;

         
    


    if ($qty[$i]>=$qty_i)
    {
      if($select_ex->num_rows== 0)
      {
            
              /*
              $DB_TABLE_NAME = 'T_T_TRANSACTION';
              $insert_db = "insert into {$DB_TABLE_NAME} values ('{$id_i}','{$id_name_i}','{$qty_i}','{$total_i}','{$sell_price_i}')";
              $insert_ex = $conn->prepare($insert_db);
              $insert_ex->execute();
              */

              $DB_TABLE_NAME = 'T_T_TRANSACTION';
              $insert_db = "insert into {$DB_TABLE_NAME} values ('0','{$id_name_i}','{$qty_i}','{$total_i}','{$sell_price_i}','{$t_login_user_access}')";
              $insert_ex = $conn->query($insert_db);


              #header("Location: home.php");

      }
      if($select_ex->num_rows> 0)
      {
              /*
              $DB_TABLE_NAME = 'T_T_TRANSACTION';
              $update_db = "update {$DB_TABLE_NAME}  set QTY= '{$qty_i}',TOTAL='{$total_i}',PRICE='{$sell_price_i}' where ID_NAME = '{$id_name_i}'";
              $update_ex = $conn->prepare($update_db);
              $update_ex->execute();
              */

              $DB_TABLE_NAME = 'T_T_TRANSACTION';
              $update_db = "update {$DB_TABLE_NAME}  set QTY= '{$qty_i}',TOTAL='{$total_i}',PRICE='{$sell_price_i}' where ID_NAME = '{$id_name_i}' and access='{$t_login_user_access}'";
              $update_ex = $conn->query($update_db);
              #header("Location: home.php");
      }
    }
  }
}





















if(isset($_POST['delete_all']))
{
  $DB_TABLE_NAME = 'T_T_TRANSACTION';
  $delete_db = "delete from {$DB_TABLE_NAME} where access='{$t_login_user_access}'";
  $delete_ex = $conn->query($delete_db);
}



$total_belanja = 0;


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
  if($total_belanja>=$discount_price)
  {
    if($total_belanja>=$discount_price_limit)
    {
        $total_belanja = $total_belanja-$discount_price_limit;
    }
    else
    {
      $total_belanja = intval($total_belanja-(($total_belanja*$discount_percentage)/100));
    }
    
  }
  foreach( array_keys($id_struck) as $struck_row ){}
  $_SESSION['struck_row']=$struck_row;
  $_SESSION['id_struck']=$id_struck;  
}

if($select_ex->num_rows== 0)
{
  $id_struck[0]=0;
  $id_name_struck[0]=0;
  $id_qty_struck[0]=0;
  $id_price_struck[0]=0;
  $id_total_struck[0]=0;
}

for($i=0;$i<=$struck_row;$i++)
{
  if(isset($_POST['delete_'.$i]))
  {
    $DB_TABLE_NAME = 'T_T_TRANSACTION';
    $delete_db = "delete from {$DB_TABLE_NAME} where (id='{$id_struck[$i]}' and access='{$t_login_user_access}')";
    $delete_ex = $conn->query($delete_db);
    header("Location: home.php");
  }
}



if(isset($_POST['button_transaction']) and $_SESSION['user_submit']=='CLEAR')
{
  $DB_TABLE_NAME = 'T_T_TRANSACTION';
  $delete_db = "delete from {$DB_TABLE_NAME} where access='{$t_login_user_access}'";
  $delete_ex = $conn->query($delete_db);

  $discount_qty=$discount_qty-1;
  if($discount_qty>0)
  {
      $DB_TABLE_NAME = 'T_T_DISCOUNT';
      $update_db = "update {$DB_TABLE_NAME}  set discount_qty= '{$discount_qty}' where(PROMO_NO='{$textbox_discount}')";
      $update_ex = $conn->query($update_db);
  }
  if($discount_qty==0)
  {
      $DB_TABLE_NAME = 'T_T_DISCOUNT';
      $delete_db = "delete from {$DB_TABLE_NAME} where(PROMO_NO='{$textbox_discount}')";
      $delete_ex = $conn->query($delete_db);
  }
  

  


  $_SESSION['user_submit']='SUBMIT';
  $_SESSION['discount_price']=0;
  $_SESSION['discount_percentage']=0;
  $_SESSION['discount_price_limit']=0;
  $_SESSION['textbox_discount']='';
  header("Location: home.php");
}
$button_transaction='button_transaction';

if(isset($_POST['button_transaction']) and $_SESSION['user_submit']=='SUBMIT' and $_POST['textbox_total']>=$total_belanja)
{
  $text_for_user='Kembali=';
  $uang_diterima = $_POST['textbox_total'];
  $total_belanja = $uang_diterima-$total_belanja;
  $_SESSION['user_submit']='CLEAR';

  $DB_TABLE_NAME = 'T_T_TRANSACTION';
    $select_db = "SELECT ID_NAME,QTY FROM {$DB_TABLE_NAME} where access='{$t_login_user_access}'";
    $select_ex = $conn->query($select_db);
    if($select_ex->num_rows> 0)
    {
      while($select_db = $select_ex->fetch_assoc())
      {
        $name_for_update[]= (($select_db['ID_NAME']));
        $qty_from_db_transaction[]= (($select_db['QTY']));
      }      
    }



    foreach( array_keys($name_for_update) as $struck_row ){}
    for($i=0;$i<=$struck_row;$i++)
    {
      

      $DB_TABLE_NAME = 'T_T_STOCK';
      $select_db = "SELECT qty,buy_price,sell_price FROM {$DB_TABLE_NAME} where(id_name='{$name_for_update[$i]}' and access='{$t_login_user_access}')" ;
      $select_ex = $conn->query($select_db);
      if($select_ex->num_rows> 0)
      {
        while($select_db = $select_ex->fetch_assoc())
        {
          $qty_before_update= (($select_db['qty']));
          $report_buy_price= (($select_db['buy_price']));
          $report_sell_price= (($select_db['sell_price']));
        }      
      }


      $qty_for_update=$qty_before_update-$qty_from_db_transaction[$i];


      $DB_TABLE_NAME = 'T_T_STOCK';
      $update_db = "update {$DB_TABLE_NAME}  set QTY= '{$qty_for_update}' where ID_NAME = '{$name_for_update[$i]}' and access='{$t_login_user_access}'";
      $update_ex = $conn->query($update_db);
#................................................DISINI UNTUK INSERT TABLE REPORT


     
      
      $get_pc_date_time= getdate();
      $report_id_date_time = $get_pc_date_time['year'].'-'.$get_pc_date_time['mon'].'-'.$get_pc_date_time['mday'].' '.$get_pc_date_time['hours'].':'.$get_pc_date_time['minutes'].':'.$get_pc_date_time['seconds'].'.'.$i;
      $report_id_date= $get_pc_date_time['year'].'-'.$get_pc_date_time['mon'].'-'.$get_pc_date_time['mday'];
      $report_id_name= $name_for_update[$i];
      $report_qty = $qty_from_db_transaction[$i];
      $report_profit=($report_sell_price-$report_buy_price)*$report_qty;
      $report_total_cash=$report_sell_price*$report_qty;


      $DB_TABLE_NAME = 'T_T_REPORT';
      $insert_db = "insert into {$DB_TABLE_NAME} values ('{$report_id_date_time}','{$report_id_name}','{$report_qty}','{$report_profit}','{$report_total_cash}','{$report_id_date}','{$t_login_user_access}')";
      $insert_ex = $conn->query($insert_db);

    }
}


$button_for_user = $_SESSION['user_submit'];


?>





<style type="text/css">
  .promo
  {
    margin-top: 55px;
    margin-left: 50px;
    position: absolute;
  }
  
</style>








 <!DOCTYPE html>
 <html>
 <head>
  <title>Cashier Bandrek 88 Coco</title>
  <link href="style_index.css" rel = "stylesheet" type="text/css">



 </head>
 <body>

  <div class="promo">
    <form method = "POST" action = "">
      <a>Promo Code:</a>
      <input type='text' name='textbox_discount' placeholder='enter promo code here' value = '<?php echo $textbox_discount; ?>'>
      <input type='submit' name='submit_discount' value='Check Promo'>
      <a><?php echo "Minimal Rp".number_format($discount_price)."/ Diskon ".$discount_percentage."% Maksimal Rp".number_format($discount_price_limit);?></a>
    </form>
  </div>
  <div class="main_transaction">


    <br>
    <form method = "POST" action = "">
    <table>
    <?php
    $total_colom=2;
    $a=$total_row/$total_colom;
    for($i=0;$i<$total_row;$i++)
    {
      $rmd=(float)($i/$total_colom);
      $rmd=($rmd-(int)$rmd)*$total_colom;
      $zero_qty= "";
      if($qty[$i]==0)
      {
        $zero_qty= " class ='red'";
      }
      if($i==0 or ($i>=$total_colom and $rmd==0))
      {
        echo "<tr>";
      }
        echo "<th><input".$zero_qty." type='submit' name='c_name_".$i."' value='".$id_name[$i]."'></th>";
      if($rmd==($total_colom-1))
      {
        echo "<tr>";
      }
    }


    ?>


    </table>
    </form>

  </div>

  <div class="main_transaction_struck" >


    <form method = "POST" action = "">

    <div id="print_table">  <!-- ini bataasss edit struk -->
     

        <table class="transaction_table">
          <thead>
            <tr><th>NO</th><th>NAME</th><th>QTY</th><th>PRICE</th><th>TOTAL</th></tr>
          </thead>
          <tbody>
            <form method = "POST" action = "">
            <?php

            for($i=0;$i<=$struck_row;$i++)
            {#delete_
              $h=$i+1;

                echo "<tr><th>".$h."</th><th>".$id_name_struck[$i]."</th><th>".$id_qty_struck[$i]."</th><th>Rp ".number_format($id_price_struck[$i])."</th><th>Rp ".number_format($id_total_struck[$i])."</th><th><input type='submit' name='delete_".$i."' value='-'></th></tr></tr>";

            }
            ?>
          </form>
            </tbody>

        </table>
      </div>  <!-- ini bataasss edit struk -->


    <input type='submit' name='delete_all' value='DELETE ALL'>
    </form>
  </div>
    <div class="total_sum">
      <a><?php echo $text_for_user;?></a>
      <form method = "POST" action = "">

      <input type='text' name='textbox_total' placeholder='<?php echo 'Rp '.number_format($total_belanja);?>' value = ''>

      <input type='submit' name='<?php echo $button_transaction;?>' value= '<?php echo $button_for_user;?>' onclick="<?php echo $print_ready;?>">
    </form>
    </div>
    <?php
     include('header.php');
    ?>
</body>

</html>

<?php
//

$_SESSION['total_order']=$total_sum;
?>


<script>

 function printlayer(layer)
    {
      window.open('print_receipt.php');
    }
  


</script>