<?php

include('web_setting/db_connection.php');
session_start();
date_default_timezone_set('Asia/Jakarta');
$username= $_SESSION['USERNAME'];
$password= $_SESSION['PASSWORD'];
$today = date('Y-m-d');

for($i=0;$i<20;$i++)
{
  $selected_header[$i]='';
}
$selected_header[0]=" class='active'";


#...............................................go to page by menu



if(isset($_POST['return_logo']))
{
	header("Location: home.php");
}





#read SPK NUMBER

$DB_TABLE_NAME = 'T_T_F_SPK';
$select_db = "SELECT top (1) SPK_ID FROM {$DB_TABLE_NAME} order by ID desc";
$select_ex = $conn->prepare($select_db);
$select_ex->execute();
$select_db = $select_ex->fetchAll(PDO::FETCH_BOTH);
if($select_db != NULL)
{
    foreach($select_db as $select_db_a)
    {
        $spk_id = ($select_db_a['SPK_ID']);
    }
}

if($select_db == NULL)
{
    $spk_id = 0;
}

$spk_id = $spk_id+1;

#read SPK NUMBER end


#plat mobil


if(isset($_POST['polisi_id']))
{
    $_SESSION['polisi_id']=$_POST['polisi_id'];
}

$polisi_id=$_SESSION['polisi_id'];
$DB_TABLE_NAME = 'T_M_F_NO_POLISI';
$select_db = "SELECT * FROM {$DB_TABLE_NAME} order by POLISI_NAME asc";
$select_ex = $conn->prepare($select_db);
$select_ex->execute();
$select_db = $select_ex->fetchAll(PDO::FETCH_BOTH);
if($select_db != NULL)
{
    foreach($select_db as $select_db_a)
    {
        $select_polisi_id[] = ($select_db_a['POLISI_ID']);
        $select_polisi_name[] = ($select_db_a['POLISI_NAME']);
        $select_no_unit[] = ($select_db_a['NO_UNIT']);
    }

}
if($select_db == NULL)
{
    $select_polisi_id[0]='';
    $select_polisi_name[0]='';
}
foreach( array_keys($select_polisi_id) as $total_polisi_id){}

$no_unit = '';
for($i=0;$i<=$total_polisi_id;$i++)
{
    if($polisi_id==$select_polisi_id[$i])
    {
        $selected_polisi_id[$i]='selected';
        $no_unit = $select_no_unit[$i];
    }
    if($polisi_id!=$select_polisi_id[$i])
    {
        $selected_polisi_id[$i]='';
    }
}


#plat mobil end



#read supir
$supir_id=$_SESSION['supir_id'];
$DB_TABLE_NAME = 'T_M_F_NAMA_SUPIR';
$select_db = "SELECT * FROM {$DB_TABLE_NAME} order by SUPIR_NAME asc";
$select_ex = $conn->prepare($select_db);
$select_ex->execute();
$select_db = $select_ex->fetchAll(PDO::FETCH_BOTH);
if($select_db != NULL)
{
    foreach($select_db as $select_db_a)
    {
        $select_supir_id[] = ($select_db_a['SUPIR_ID']);
        $select_supir_name[] = ($select_db_a['SUPIR_NAME']);
    }

}
if($select_db == NULL)
{
    $select_supir_id[0]='';
    $select_supir_name[0]='';
}
foreach( array_keys($select_supir_id) as $total_select_supir_id){}


#read supir end


#read mekanik id


$mekanik_id=$_SESSION['mekanik_id'];
$DB_TABLE_NAME = 'T_M_F_NAMA_MEKANIK';
$select_db = "SELECT * FROM {$DB_TABLE_NAME} order by MEKANIK_NAME asc";
$select_ex = $conn->prepare($select_db);
$select_ex->execute();
$select_db = $select_ex->fetchAll(PDO::FETCH_BOTH);
if($select_db != NULL)
{
    foreach($select_db as $select_db_a)
    {
        $select_mekanik_id[] = ($select_db_a['MEKANIK_ID']);
        $select_mekanik_name[] = ($select_db_a['MEKANIK_NAME']);
    }

}
if($select_db == NULL)
{
    $select_mekanik_id[0]='';
    $select_mekanik_name[0]='';
}
foreach( array_keys($select_mekanik_id) as $total_select_mekanik_id){}

#read mekanik id end









$check_reload='submit';
$confirm_button='';



#create form SPK



if(isset($_POST['submit']))
{
    $is_spk_id = $spk_id;
    $is_supir_id = $_POST['supir_id'];
    $is_tanggal_masuk = date('Y-m-d');
    $is_status_id = $_POST['status'];
    $is_target_selesai = $_POST['target_selesai'];
    $is_mekanik_id = $_POST['mekanik_id'];
    $is_nomor_unit_kendaraan_id = $polisi_id;
    $is_perlengkapan_stnk = $_POST['PERLENGKAPAN_STNK'];
    $is_perlengkapan_kiur = $_POST['PERLENGKAPAN_KIUR'];
    $is_perlengkapan_dongkrak_stik = $_POST['PERLENGKAPAN_DONGKRAK_STIK'];
    $is_perlengkapan_kunci_roda_stik = $_POST['PERLENGKAPAN_KUNCI_RODA_STIK'];
    $is_perlengkapan_ban_serap = $_POST['PERLENGKAPAN_BAN_SERAP'];
    $is_perlengkapan_rantai_cw_hook = $_POST['PERLENGKAPAN_RANTAI_CW_HOOK'];
    $is_perlengkapan_lasing = $_POST['PERLENGKAPAN_LASING'];
    $is_perlengkapan_bomak = $_POST['PERLENGKAPAN_BOMAK'];
    $is_perlengkapan_bbm = $_POST['PERLENGKAPAN_BBM'];
    $is_perlengkapan_lain_lain = $_POST['PERLENGKAPAN_LAIN_LAIN'];



    $DB_TABLE_NAME = 'T_T_F_SPK';
    $insert_db = "insert into {$DB_TABLE_NAME} values ('{$is_spk_id}','{$is_supir_id}','{$is_tanggal_masuk}','{$is_status_id}','{$is_target_selesai}','{$is_mekanik_id}','{$is_nomor_unit_kendaraan_id}','{$is_perlengkapan_stnk}','{$is_perlengkapan_kiur}','{$is_perlengkapan_dongkrak_stik}','{$is_perlengkapan_kunci_roda_stik}','{$is_perlengkapan_ban_serap}','{$is_perlengkapan_rantai_cw_hook}','{$is_perlengkapan_lasing}','{$is_perlengkapan_bomak}','{$is_perlengkapan_bbm}','{$is_perlengkapan_lain_lain}','{$is_supir_id}','0','0')";
    $insert_ex = $conn->prepare($insert_db);
    $insert_ex->execute();
    $_SESSION['spk_id']=$spk_id;


    $DB_TABLE_NAME='T_T_F_RINCIAN_PEKERJAAN';
    $insert_db = "insert into {$DB_TABLE_NAME} values ('{$spk_id}','','','')";
    $insert_ex = $conn->prepare($insert_db);
    $insert_ex->execute();
    header("Location: rincian_pekerjaan.php");
}


#create_form_SPK end



$target_selesai_text="<input type='text' name='harga_barang_value_4' value ='' autocomplete='off'>";;




?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Input Penjualan</title>
 	<link href="style.css" rel = "stylesheet" type="text/css">
 </head>
 <body>

  <div class="main">
  	<form method = "POST" class="return_logo" action = "">
          <input type="submit" name="return_logo" value ="">
    </form>
   	<a>Create Form SPK</a>
		<br><br><br>
		<?php

		


		?>

    	<form method = "POST" class="body_area" action = "">
          
          
	    <table>
	    	<tr>
	    		<th name='colom_1'>Tanggal</th>
	    		<th name='colom_2'>:
			        <?php echo $today;?>
	    		</th>
	    	</tr>
	    	<tr>
	    		<th name='colom_1'>Nomor SPK</th>
	    		<th name='colom_2'>:		
	    			<?php echo $spk_id;?>
	    		</th>
	    		<th name='colom_1'>Plat Mobil</th>
	    		<th name='colom_2'>:
	    			<select name="no_polisi" onchange='this.form.submit();'>
				    <?php
				    for($i=0;$i<=$total_polisi_id;$i++)
				    {
				    	echo "<option value='".$select_polisi_id[$i]."' ".$selected_polisi_id[$i].">".$select_polisi_name[$i]."</option>";
				    }
					?>
					</select>
					/
					<?php echo $no_unit;?>
	    		</th>
	    		
	    			
	    	</tr>

	    	<tr>
	    		<th name='colom_1'>
	    			Nama Supir
	    			</th>
	    			<th name='colom_2'>:
	    			<select name="supir_id" >
				    <?php
				    for($i=0;$i<=$total_select_supir_id;$i++)
				    {
				    	echo "<option value='".$select_supir_id[$i]."' ".$selected_supir_id[$i].">".$select_supir_name[$i]."</option>";
				    }
					?>
					</select>
	    			
	    			</th>
	    			<th name='colom_1'>
	    			<input type="checkbox" id="vehicle1" name="PERLENGKAPAN_STNK" value="1">
	    			STNK
	    			</th>
	    			<th name='colom_2'>
	    			<input type="checkbox" id="vehicle1" name="PERLENGKAPAN_RANTAI_CW_HOOK" value="1">
	    			Rantai CW/Hook
	    			</th>
	    			
	    			
	    		</th>
	    	</tr>
	    	<tr>
	    		<th name='colom_1'>
	    			Status
	    			</th>
	    			<th name='colom_2'>:
	    			<select name="status" >
	    				<option value="0">Kosong</option>
	    				<option value="1">Berisi</option>
	    			</select>
	    			
	    			</th>
	    			<th name='colom_1'>
	    			<input type="checkbox" id="vehicle1" name="PERLENGKAPAN_KIUR" value="1">
	    			KIUR (Speksi)
	    			</th>
	    			<th name='colom_2'>
	    			<input type="checkbox" id="vehicle1" name="PERLENGKAPAN_LASING" value="1">
	    			Lasing
	    			</th>
	    			
	    			
	    		</th>
	    	</tr>
	    	<tr>
	    		<th name='colom_1'>
	    			Target Selesai
	    			</th>
	    			<th name='colom_2'>:
	    			<?php echo $target_selesai_text;?>
	    			
	    			</th>
	    			<th name='colom_1'>
	    			<input type="checkbox" id="vehicle1" name="PERLENGKAPAN_DONGKRAK_STIK" value="1">
	    			Dongkrak & Stik
	    			</th>
	    			<th name='colom_2'>
	    			<input type="checkbox" id="vehicle1" name="PERLENGKAPAN_BOMAK" value="1">
	    			Bomak
	    			</th>
	    			
	    			
	    		</th>
	    	</tr>
	    	<tr>
	    		<th name='colom_1'>
	    			Nama Mekanik
	    		</th>
	    		<th name='colom_2'>:
	    			<select name="mekanik_id" >
				    	<?php
				    	for($i=0;$i<=$total_select_mekanik_id;$i++)
				    	{
				    		echo "<option value='".$select_mekanik_id[$i]."' ".$selected_mekanik_id[$i].">".$select_mekanik_name[$i]."</option>";
				    	}
						?>
					</select>
	    			
	    		</th>
	    		<th name='colom_1'>
	    			
	    			<input type="checkbox" id="vehicle1" name="PERLENGKAPAN_KUNCI_RODA_STIK" value="1">
	    			Kunci Roda & Stik
	    		</th>
	    		<th name='colom_2'>
	    			<input type="checkbox" id="vehicle1" name="PERLENGKAPAN_BBM" value="1">
	    			BBM (Solar/Ltr)
	    		</th>

	    	</tr>
	    	<tr>
	    		<th name='colom_1'>
	    		</th>
	    		<th name='colom_2'>
	    		</th>
	    		<th name='colom_1'>
	    			
	    			<input type="checkbox" id="vehicle1" name="PERLENGKAPAN_BAN_SERAP" value="1">
	    			Ban Serap
	    		</th>
	    		<th name='colom_2'>
	    		</th>

	    	</tr>
	    	
	    	<tr>
	    		<th name='colom_1'>
	    			<input type="submit" name="<?php echo $check_reload;?>" value ="<?php echo $check_reload;?>" onclick ="if(!confirm('Confirm Changes?')){return false;}">
	    			<?php echo $confirm_button;?>
	    		</th>
	    		<th name='colom_2'>
	    		</th>
	    		<th name='colom_1'>
	    			Lain-Lain(Sebutkan)
	    		</th>
	    		<th name='colom_2'>:
	    			<input type="text"  name="PERLENGKAPAN_LAIN_LAIN" >
	    		</th>

	    	</tr>

	    	<tr>
	    		<th>
	    			
	    		</th>
	    	</tr>
	    	
	    	
	    	
	    </table>
	</form>

  </div>
    
  <?php
  include('header.php');
  ?>
</body>
</html>

<style type="text/css">

.select_type
{
	margin-top: -30px;
	margin-left: 105px;
	position: absolute;
}
.body_area table tr th[name='colom_1']
{
	width: 230px;
	height: 50px;
	text-align: left;

}
.body_area table tr th[name='colom_2']
{
	width: 300px;
	height: 50px;
	text-align: left;

}
.body_area table
{
	margin-top: 0px;

}
.body_area table tr th input[type="text"]
{
	border:none;
	border-bottom: 1px solid lightblue;
	background: transparent;
	outline: none;
	color: black;
	font-size: 16px;
	width: 75%;
}

.body_area
{
	margin-left: 100px;
	margin-top: -50px;
}
.return_logo input
{
  width: 50px;
  height: 51px;
    background-size: 100%;
    background: url(image/return_logo.png);
  background-size: 100%;
  border-radius: 20px;
  float: left;
  margin-top: 10px;
}

.body_area input[type="submit"]
{
	border:none;
	outline: none;
	height:30px;
	background: lightblue;
	color:black;
	font-size:14px;
	border-radius:10px;

}

.body_area input[type="submit"]:hover
{
	cursor:pointer;
	background: navy;
	color: white;

}
.main table
{
	margin-top: 20px;
}
.main a
{
	font-size: 26px;
	margin-left: 50px;
	font-weight: bold;
}
.main
{
  margin-top:310px;
  width:100%;
  height: 500px;
  background: white;
  
  
  left:50%;
  position: absolute;
  transform: translate(-50%,-50%);
  
  box-sizing:border-box;
  padding :10px 30px;
  opacity: 0.9;
  filter: alpha(opacity=100);
}

</style>

