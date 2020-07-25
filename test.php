<?php

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
    }      
  }
}

   

  #....................................diskon login end



$textbox_discount=$_SESSION['textbox_discount'];
$struck_row=0;

$text_for_user = $_SESSION['user_text'];
$button_for_user = $_SESSION['user_submit'];









/*


if($_SESSION['remain_logic']==0)
{

  $total_sum=0;

  
  $DB_TABLE_NAME='T_T_TRANSACTION';
  $total_sum_db = "SELECT  SUM(TOTAL) TOTAL_SUM from {$DB_TABLE_NAME}";
  $total_sum_ex = $conn->prepare($total_sum_db);
  $total_sum_ex->execute();
  $total_sum_s = $total_sum_ex->fetchAll(PDO::FETCH_BOTH);
    if($total_sum_s != NULL)
  {
  foreach($total_sum_s as $total_sum_got){
  $total_sum_get= (($total_sum_got['TOTAL_SUM']));
  $total_sum_a=$total_sum_get-$discount_price;
  }
  


    $DB_TABLE_NAME = 'T_T_TRANSACTION';
    $select_db = "SELECT  SUM(total) total_sum from {$DB_TABLE_NAME}";
    $select_ex = $conn->query($select_db);
    if($select_ex->num_rows> 0)
    {
      while($select_db = $select_ex->fetch_assoc())
      {
        $total_sum_get= (($select_db['total_sum']));
        $total_sum_a=$total_sum_get-$discount_price;
      }      
    }



  $discount_in_percentage=(($total_sum_a*$discount_percentage)/100);
  if($discount_in_percentage<=$discount_price_limit)
  {
    $total_sum=$total_sum_a-$discount_in_percentage;
  }
  if($discount_in_percentage>$discount_price_limit)
  {
    $total_sum=$total_sum_a-$discount_price_limit;
  }

  
  $_SESSION['receipt_discount']=$total_sum_get-$total_sum;
}

if($_SESSION['remain_logic']==1)
{
  $total_sum= $_SESSION['total_sum'];

}



*/

/*
$DB_TABLE_NAME ='T_T_STOCK';
$stock_db = "SELECT * FROM {$DB_TABLE_NAME}";
$stock_ex = $conn->prepare($stock_db);
$stock_ex->execute();
$stock_get = $stock_ex->fetchAll(PDO::FETCH_BOTH);
foreach($stock_get as $got_stock_s)
{
  $id[]= ($got_stock_s['ID']);
}

foreach($stock_get as $got_stock_s)
{
  $id_barcode[]= ($got_stock_s['ID_BARCODE']);
}
foreach($stock_get as $got_stock_s)
{
  $id_name[]= ($got_stock_s['ID_NAME']);
}
foreach($stock_get as $got_stock_s)
{
  $qty[]= ($got_stock_s['QTY']);
}
foreach($stock_get as $got_stock_s)
{
  $input_date[]= ($got_stock_s['INPUT_DATE']);
}
foreach($stock_get as $got_stock_s)
{
  $buy_price[]= ($got_stock_s['BUY_PRICE']);
}
foreach($stock_get as $got_stock_s)
{
  $sell_price[]= ($got_stock_s['SELL_PRICE']);
}

*/

$DB_TABLE_NAME = 'T_T_STOCK';
$select_db = "SELECT * FROM {$DB_TABLE_NAME}";
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










/*
$stock_db = "SELECT top 1 ID FROM {$DB_TABLE_NAME} order by ID desc";
$stock_ex = $conn->prepare($stock_db);
$stock_ex->execute();
$stock_get = $stock_ex->fetchAll(PDO::FETCH_BOTH);
foreach($stock_get as $got_stock_s)
{
  $last_id= intval($got_stock_s['ID'])+1;
}

*/

    $DB_TABLE_NAME = 'T_T_STOCK';
    $select_db = "SELECT top 1 id FROM {$DB_TABLE_NAME} order by id desc";
    $select_ex = $conn->query($select_db);
    if($select_ex->num_rows> 0)
    {
      while($select_db = $select_ex->fetch_assoc())
      {
        $last_id= (intval($select_db['id']))+1;
      }      
    }


if($_POST==true)
{
  
  

  $id_struck_w=$_SESSION['id_struck'];
  $struck_row_w=$_SESSION['struck_row'];
  $_SESSION['user_cash']=$_POST['textbox_total'];
  $_SESSION['cash']=$_POST['textbox_total'];


  if(isset($_POST['button_transaction']) and $_SESSION['user_text']=='REMAIN=')
  {
    
    $_SESSION['user_text']='TOTAL=';
    $_SESSION['user_submit']='SUBMIT';
    $_SESSION['remain_logic']=0;

    /*
    $DB_TABLE_NAME='T_T_TRANSACTION';
    $delete_db = "delete from {$DB_TABLE_NAME}";
    $delete_ex = $conn->prepare($delete_db);
    $delete_ex->execute();

    */

    $DB_TABLE_NAME = 'T_T_TRANSACTION';
    $delete_db = "delete from {$DB_TABLE_NAME}";
    $delete_ex = $conn->query($delete_db);


    $_SESSION['textbox_discount']='';
    header("Location: home.php");
    goto next_case;
  }

  
  if(isset($_POST['button_transaction']) and $_SESSION['user_text']!='REMAIN=' and $_SESSION['total_order']!=0 and $_SESSION['user_cash']!=0)
  {
    #.............. update qty promo minus 1
    if($select_get_discount!=null)
    {
      $discount_qty_after_used=$discount_qty-1;

      /*
      $DB_TABLE_NAME='T_T_DISCOUNT';
      $update_db = "update {$DB_TABLE_NAME} set DISCOUNT_QTY='{$discount_qty_after_used}' where(PROMO_NO='{$textbox_discount}')";
      $update_ex = $conn->prepare($update_db);
      $update_ex->execute();
      */

      $DB_TABLE_NAME = 'T_T_DISCOUNT';
      $update_db = "update {$DB_TABLE_NAME} set DISCOUNT_QTY='{$discount_qty_after_used}' where(PROMO_NO='{$textbox_discount}')";
      $update_ex = $conn->query($update_db);


      
      
    }
    
    #....................update qty promo minus 1 end



    $_SESSION['total_sum']=$_SESSION['user_cash']-$_SESSION['total_order'];


    /*
    $DB_TABLE_NAME='T_T_TRANSACTION';
    $select_db = "SELECT ID_NAME,QTY FROM {$DB_TABLE_NAME}";
    $select_ex = $conn->prepare($select_db);
    $select_ex->execute();
    $select_get = $select_ex->fetchAll(PDO::FETCH_BOTH);
    if($select_get!=null)
    {
    foreach($select_get as $got_stock_s)
    {
      $name_for_update[]= ($got_stock_s['ID_NAME']);
    }
    foreach($select_get as $got_stock_s)
    {
      $qty_from_db_transaction[]= ($got_stock_s['QTY']);
    }
    }

    */


    $DB_TABLE_NAME = 'T_T_TRANSACTION';
    $select_db = "SELECT ID_NAME,QTY FROM {$DB_TABLE_NAME}";
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
      /*
      $DB_TABLE_NAME ='T_T_STOCK';
      $stock_db = "SELECT QTY,BUY_PRICE,SELL_PRICE FROM {$DB_TABLE_NAME} where(ID_NAME='{$name_for_update[$i]}')" ;
      $stock_ex = $conn->prepare($stock_db);
      $stock_ex->execute();
      $stock_get = $stock_ex->fetchAll(PDO::FETCH_BOTH);

      foreach($stock_get as $got_stock_s)
      {
        $qty_before_update= ($got_stock_s['QTY']);
      }
      foreach($stock_get as $got_stock_s)
      {
        $report_buy_price= ($got_stock_s['BUY_PRICE']);
      }
      foreach($stock_get as $got_stock_s)
      {
        $report_sell_price= ($got_stock_s['SELL_PRICE']);
      }
      */

      $DB_TABLE_NAME = 'T_T_STOCK';
      $select_db = "SELECT qty,buy_price,sell_price FROM {$DB_TABLE_NAME} where(id_name='{$name_for_update[$i]}')" ;
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

      /*
      $DB_TABLE_NAME='T_T_STOCK';
      $update_db = "update {$DB_TABLE_NAME}  set QTY= '{$qty_for_update}' where ID_NAME = '{$name_for_update[$i]}'";
      $update_ex = $conn->prepare($update_db);
      $update_ex->execute();
      */

      $DB_TABLE_NAME = 'T_T_STOCK';
      $update_db = "update {$DB_TABLE_NAME}  set QTY= '{$qty_for_update}' where ID_NAME = '{$name_for_update[$i]}'";
      $update_ex = $conn->query($update_db);
#................................................DISINI UNTUK INSERT TABLE REPORT


     
      
      $get_pc_date_time= getdate();
      $report_id_date_time = $get_pc_date_time['year'].'-'.$get_pc_date_time['mon'].'-'.$get_pc_date_time['mday'].' '.$get_pc_date_time['hours'].':'.$get_pc_date_time['minutes'].':'.$get_pc_date_time['seconds'].'.'.$i;
      $report_id_date= $get_pc_date_time['year'].'-'.$get_pc_date_time['mon'].'-'.$get_pc_date_time['mday'];
      $report_id_name= $name_for_update[$i];
      $report_qty = $qty_from_db_transaction[$i];
      $report_profit=($report_sell_price-$report_buy_price)*$report_qty;
      $report_total_cash=$report_sell_price*$report_qty;

      /*
      $DB_TABLE_NAME = 'T_T_REPORT';
      $insert_db = "insert into {$DB_TABLE_NAME} values ('{$report_id_date_time}','{$report_id_name}','{$report_qty}','{$report_profit}','{$report_total_cash}','{$report_id_date}')";
      $insert_ex = $conn->prepare($insert_db);
      $insert_ex->execute();
      */

      $DB_TABLE_NAME = 'T_T_REPORT';
      $insert_db = "insert into {$DB_TABLE_NAME} values ({$report_id_date_time}','{$report_id_name}','{$report_qty}','{$report_profit}','{$report_total_cash}','{$report_id_date}')";
      $insert_ex = $conn->query($insert_db);

    }

    $_SESSION['user_text'] = 'REMAIN=';
    $_SESSION['user_submit']='CLEAR';
    $_SESSION['remain_logic']=1;



    header("Location: home.php");
  }
next_case:
  if($_POST['delete_all']==true and $_SESSION['user_text']!='REMAIN=')
  {
    /*
    $DB_TABLE_NAME='T_T_TRANSACTION';
    $delete_db = "delete from {$DB_TABLE_NAME}";
    $delete_ex = $conn->prepare($delete_db);
    $delete_ex->execute();
    */

    $DB_TABLE_NAME = 'T_T_TRANSACTION';
    $delete_db = "delete from {$DB_TABLE_NAME}";
    $delete_ex = $conn->query($delete_db);

    header("Location: home.php");
  }
  for($i=0;$i<=$struck_row_w;$i++)
  {
    if($_POST['delete_'.$i]==true and $_SESSION['user_text']!='REMAIN=')
      {
        /*
        $DB_TABLE_NAME='T_T_TRANSACTION';
        $delete_db = "delete  {$DB_TABLE_NAME} where(ID={$id_struck_w[$i]})";
        $delete_ex = $conn->prepare($delete_db);
        $delete_ex->execute();
        */

        $DB_TABLE_NAME = 'T_T_TRANSACTION';
        $delete_db = "delete  {$DB_TABLE_NAME} where(ID={$id_struck_w[$i]})";
        $delete_ex = $conn->query($delete_db);
        header("Location: home.php");
      }
  }
    for($u=0;$u<$total_row;$u++)
    {


      if($_POST['c_name_'.$u]  and $_SESSION['user_text']!='REMAIN=')
      {
            $name_=$_POST['c_name_'.$u];
            echo $name_;

            /*
            $DB_TABLE_NAME='T_T_STOCK';
            $select_db = "SELECT QTY,SELL_PRICE FROM {$DB_TABLE_NAME} where(ID_NAME='{$name_}')";
            $select_ex = $conn->prepare($select_db);
            $select_ex->execute();
            $select_get = $select_ex->fetchAll(PDO::FETCH_BOTH);
            foreach($select_get as $got_stock_s)
            {
              $price_selected= ($got_stock_s['SELL_PRICE']);
            }
            foreach($select_get as $got_stock_s)
            {
              $qty_from_db= ($got_stock_s['QTY']);
            }
            */

            $DB_TABLE_NAME = 'T_T_STOCK';
            $select_db = "SELECT qty,sell_price FROM {$DB_TABLE_NAME} where(id_name='{$name_}')";
            $select_ex = $conn->query($select_db);
            if($select_ex->num_rows> 0)
            {
              while($select_db = $select_ex->fetch_assoc())
              {
                $price_selected= (($select_db['sell_price']));
                $qty_from_db= (($select_db['qty']));
              }      
            }

            $id_transaction=0;
            $qty_transaction=0;

            /*
            $DB_TABLE_NAME='T_T_TRANSACTION';
            $select_db = "SELECT TOP 1 ID FROM {$DB_TABLE_NAME} order by ID desc";
            $select_ex = $conn->prepare($select_db);
            $select_ex->execute();
            $select_get = $select_ex->fetchAll(PDO::FETCH_BOTH);
            if($select_get!=null)
            {
              foreach($select_get as $got_stock_s)
              {
                $id_transaction= ($got_stock_s['ID']);
              }
            }
            */

            $DB_TABLE_NAME = 'T_T_TRANSACTION';
            $select_db = "SELECT TOP 1 id FROM {$DB_TABLE_NAME} order by id desc";
            $select_ex = $conn->query($select_db);
            if($select_ex->num_rows> 0)
            {
              while($select_db = $select_ex->fetch_assoc())
              {
                $id_transaction= (($select_db['id']));
              }      
            }

        /*
        $DB_TABLE_NAME = 'T_T_TRANSACTION';
        $select_db = "SELECT * FROM {$DB_TABLE_NAME} where(ID_NAME='{$name_}')";
        $select_ex = $conn->prepare($select_db);
        $select_ex->execute();
        $select_get = $select_ex->fetchAll(PDO::FETCH_BOTH);
        if($select_get!=null)
        {
          foreach($select_get as $got_stock_s)
          {
            $qty_transaction= ($got_stock_s['QTY']);
          }
        }
        */

            $DB_TABLE_NAME = 'T_T_TRANSACTION';
            $select_db = "SELECT qty FROM {$DB_TABLE_NAME} where(ID_NAME='{$name_}')";
            $select_ex = $conn->query($select_db);
            if($select_ex->num_rows> 0)
            {
              while($select_db = $select_ex->fetch_assoc())
              {
                $qty_transaction= (($select_db['qty']));
              }      
            }



          $id_i=($id_transaction+1);
          $id_name_i=$_POST['c_name_'.$u];
          $qty_i=($qty_transaction+1);
          $sell_price_i=$price_selected;
          $total_i=$qty_i*$sell_price_i;

          #ini wrong
          if ($qty_from_db>=$qty_i)
          {
            if($select_ex->num_rows> 0)
            {
            
              /*
              $DB_TABLE_NAME = 'T_T_TRANSACTION';
              $insert_db = "insert into {$DB_TABLE_NAME} values ('{$id_i}','{$id_name_i}','{$qty_i}','{$total_i}','{$sell_price_i}')";
              $insert_ex = $conn->prepare($insert_db);
              $insert_ex->execute();
              */

              $DB_TABLE_NAME = 'T_T_TRANSACTION';
              $insert_db = "insert into {$DB_TABLE_NAME} values ('{$id_i}','{$id_name_i}','{$qty_i}','{$total_i}','{$sell_price_i}')";
              $insert_ex = $conn->query($insert_db);


              header("Location: home.php");

            }
            if($select_ex->num_rows== 0)
            {
              /*
              $DB_TABLE_NAME = 'T_T_TRANSACTION';
              $update_db = "update {$DB_TABLE_NAME}  set QTY= '{$qty_i}',TOTAL='{$total_i}',PRICE='{$sell_price_i}' where ID_NAME = '{$id_name_i}'";
              $update_ex = $conn->prepare($update_db);
              $update_ex->execute();
              */

              $DB_TABLE_NAME = 'T_T_TRANSACTION';
              $update_db = "update {$DB_TABLE_NAME}  set QTY= '{$qty_i}',TOTAL='{$total_i}',PRICE='{$sell_price_i}' where ID_NAME = '{$id_name_i}'";
              $update_ex = $conn->query($update_db);
              header("Location: home.php");
            }
          }




      }
    }
header("Location: home.php");
}




/*
$DB_TABLE_NAME='T_T_TRANSACTION';
$select_db = "SELECT * FROM {$DB_TABLE_NAME}";
$select_ex = $conn->prepare($select_db);
$select_ex->execute();
$select_get = $select_ex->fetchAll(PDO::FETCH_BOTH);
if($select_get!=null)
{
foreach($select_get as $got_stock_s)
{
  $id_struck[]= ($got_stock_s['ID']);
}
foreach($select_get as $got_stock_s)
{
  $id_name_struck[]= ($got_stock_s['ID_NAME']);
}
foreach($select_get as $got_stock_s)
{
  $id_qty_struck[]= ($got_stock_s['QTY']);
}
foreach($select_get as $got_stock_s)
{
  $id_price_struck[]= ($got_stock_s['PRICE']);
}
foreach($select_get as $got_stock_s)
{
  $id_total_struck[]= ($got_stock_s['TOTAL']);
}

if($select_get==null)
{
$id_struck[0]=0;
$id_name_struck[0]=0;
$id_qty_struck[0]=0;
$id_price_struck[0]=0;
$id_total_struck[0]=0;
}
*/
$DB_TABLE_NAME = 'T_T_TRANSACTION';
$select_db = "SELECT * FROM {$DB_TABLE_NAME}";
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








if($button_for_user=='SUBMIT')
{
  $print_ready = "setTimeout(printlayer,0)";
}

$discount=0;
$discount_limit=0;



?>