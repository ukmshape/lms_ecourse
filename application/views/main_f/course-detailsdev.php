<style>
table {
	color:#666;
	font-size:11pt;
	background:#eaebec;
	border:#ccc 1px solid;

	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;

	-moz-box-shadow: 0 1px 2px #d1d1d1;
	-webkit-box-shadow: 0 1px 2px #d1d1d1;
	box-shadow: 0 1px 2px #d1d1d1;
}
table td:first-child {
	border-top:1px solid #fafafa;
	border-bottom:1px solid #e0e0e0;
width: 250px;
	background: #ededed;
	background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb));
	background: -moz-linear-gradient(top,  #ededed,  #ebebeb);
}
table th:first-child {
	text-align: left;
	padding-left:20px;
}
table tr:first-child td:first-child {
	-moz-border-radius-topleft:3px;
	-webkit-border-top-left-radius:3px;
	border-top-left-radius:3px;
}
table tr:first-child td:last-child {
	-moz-border-radius-topright:3px;
	-webkit-border-top-right-radius:3px;
	border-top-right-radius:3px;
}
table tr {
	/*text-align: center;*/
	padding-left:20px;
}
table td:first-child {
	text-align: left;
	padding-left:20px;
	border-left: 0;
}
table td {
	border-top: 1px solid #ffffff;
	border-bottom:1px solid #e0e0e0;
	border-left: 1px solid #e0e0e0;

	background: #fafafa;
	background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
	background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
}
table tr.even td {
	background: #f6f6f6;
	background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
	background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
}
table tr:last-child td {
	border-bottom:0;
}
table tr:last-child td:first-child {
	-moz-border-radius-bottomleft:3px;
	-webkit-border-bottom-left-radius:3px;
	border-bottom-left-radius:3px;
}
table tr:last-child td:last-child {
	-moz-border-radius-bottomright:3px;
	-webkit-border-bottom-right-radius:3px;
	border-bottom-right-radius:3px;
}

</style>
<?php $this->load->view('templates/layout_utama_menu'); ?>

<?php
// image //
$imgfile = $this->main_m->get_course_preview_img($mdl_courselist[0]->cid);

if($imgfile) {
	$host_url = LMSPATH;
	$filepath = $host_url.'/pluginfile.php/'.$imgfile[0]->contextid.'/'.$imgfile[0]->component.'/'.$imgfile[0]->filearea.'/'.$imgfile[0]->filename;
}

$type = '';

if($mdl_courselist[0]->idnumber) {
	$type = strstr($mdl_courselist[0]->idnumber, '-', true);
}

function getAmount($money)
{
    $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
    $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);

    $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

    $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
    $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '',  $stringWithCommaOrDot);

    return (float) str_replace(',', '.', $removedThousandSeparator);
}

//price //
$price = 0;
$pricedisplay = 0;
$kredit = '';
$html_table = $mdl_courselist[0]->csummary;
if($html_table) {
$html = str_get_html($html_table); // Parse the HTML, stored as a string in $string

$rows = $html->find('tr'); // Find all rows in the table
if($rows) {

	//Loop through each row
	foreach ($rows as $row) {
		//Loop through each child (cell) of the row
		$i = 0;
		$checkkredit = false;
		$nett = "";
		foreach ($row->children() as $cell) {

					$string = $cell->plaintext;
					
					$regex = "/(RM|MYR|RM |MYR )+\d+[\d,.]*/i";

					preg_match($regex, $string, $match);

					if(preg_match($regex, $string, $match)) {

						$price = str_replace('RM','',$match[0]);

						$price = getAmount($price);
						
						if($price <= 0) {
							$pricedisplay = "FREE";
						} else {
							$display = str_replace($match[0],'',$string);
							if(preg_match("/\/?Nett/i", $display, $match2)) {
								$display = str_replace($match2[0],'',$display);
								$nett = "/Nett";
							} else {
								//dbug("23333");
							}
							if(strpos($display, '/nett') !== false) {
								$display = str_replace('/nett','',$display);
							}
							$pricedisplay = "RM".$price."<small style='font-size: 11pt;line-height: 0px;'>".$nett."</small><br><small style='font-size: 11pt;line-height: 0px;'>".$display."</small>";
						}

						break 2;
					} else {
						$price = 0;
						$pricedisplay = "FREE";
					}
			// if(strpos($cell->plaintext, 'RM') !== false) {
					// 	//
					// 	// $str = '';
					// 	// $str = strstr($cell->plaintext, 'RM', true);
					// 	// if($str) {
					// 	// 	$price = str_replace($str.'RM','',floatval($cell->plaintext));
					// 	// 	$price = strstr($price, '/', true);
					// 	// 	$pricedisplay = $price; //str_replace($str.'RM','',$cell->plaintext);
					// 	// } else {
					// 	// 	$pricedisplay = str_replace('RM','',$cell->plaintext);
					// 	// 	$price = str_replace('RM','',$cell->plaintext);
					// 	// }
					//
			// } else if(strpos($cell->plaintext, 'MYR') !== false) {
					// 	$string = $cell->plaintext;
					// 	$regex = "/[M,Y,R]+\d+[\d,.]*/";
					// 	preg_match($regex, $string, $match);
					// 	$pricedisplay = $match[0];
					// 	$price = str_replace('RM','',$pricedisplay);
					// 	dbug($pricedisplay);
					// 	dbug($price);
					// 	break 2;
					// 	// $str = '';
					// 	// $str = strstr($cell->plaintext, 'MYR', true);
					// 	// if($str) {
					// 	// 	$price = str_replace($str.'MYR','',floatval($cell->plaintext));
					// 	// 	$price = strstr($price, '/', true);
					// 	// 	$pricedisplay = $price; //str_replace($str.'MYR','',$cell->plaintext);
					// 	// } else {
					// 	// 	$pricedisplay = str_replace('MYR','',$cell->plaintext);
					// 	// 	$price = str_replace('MYR','',$cell->plaintext);
					// 	//
					// 	// }
					//
			// }

				}

		foreach ($row->children() as $cell) {

			if(($cell->plaintext == 'Credit' || $cell->plaintext == 'Kredit' || $cell->plaintext == 'Credits') && $checkkredit == false) {
			$checkkredit = true;
			}
			if($checkkredit == true) {
			if($i == 2) {
							$kredit = str_replace('Credit','',$cell->plaintext);
							$kredit = str_replace('Kredit','',$kredit);
							$kredit = str_replace('Credits','',$kredit);
			}
			}

			$i++;
			// Display the contents of each cell - this is the value you want to extract
		}
	}
}
}

?>

<!-- Content -->
<div class="page-content bg-white">
	<!-- inner page banner -->
	<div class="page-banner ovbl-dark" style="background-image:url('<?=$filepath;?>');">
		<div class="container">
			<div class="page-banner-entry">
				<h1 class="text-white"><?=$mdl_courselist[0]->cname;?></h1>
	</div>
		</div>
	</div>
<!-- Breadcrumb row -->
<div class="breadcrumb-row">
<div class="container">
	<ul class="list-inline">
	<li><a href="<?=base_url('/');?>">Dashboard</a></li>
			<li><a href="<?=base_url('/'.$type);?>"><?php if($type == 'SP') { echo 'Professional Certificate'; } else if($type == 'MC') { echo 'Micro-Credential'; } ?></a></li>
	<li><?=$mdl_courselist[0]->category;?></li><!--<li><a href="<?=base_url('/main/'.$this->encryption->encrypt($mdl_courselist[0]->cateid).'/');?>"><?=$mdl_courselist[0]->category;?></a></li>-->
	<li><?=$mdl_courselist[0]->cname;?></li>
	</ul>
</div>
</div>
<!-- Breadcrumb row END -->
	<!-- inner page banner END -->
<div class="content-block">
		<!-- About Us -->

<?php
	//if(isset($mdl_courselist)) {
?>
<div class="section-area section-sp1">
	<div class="container">
	<div class="row d-flex flex-row-reverse">
		<div class="col-lg-3 col-md-4 col-sm-12 m-b30">
		<div class="course-detail-bx">


			<div class="course-price">
							<?php if($pricedisplay != 0) {
								$pricedisplay1 = 'RM'.$pricedisplay;
							} else {
								$pricedisplay1 = 'FREE';
							} ?>
			<h4 class="price"><?=$pricedisplay;?></h4>
			</div>

<?php

// Create form and send values in 'shopping/add' function.
$nokp = '';
if($this->session->userdata('session_student')) {
$nokp = $this->session->userdata('session_student')['nokp'];
}

if($type == 'SP') {
	echo form_open('SP/carts/checkout', 'id="myform"');
} else if($type == 'MC') {
	echo form_open('MC/carts/add_cart', 'id="myform"');
}

echo form_hidden('nokp', $nokp);
echo form_hidden('kursusid', $mdl_courselist[0]->cid);
echo form_hidden('kodkursus', $mdl_courselist[0]->idnumber);
echo form_hidden('nmkursus', $mdl_courselist[0]->cname);
echo form_hidden('tarikhmula', $mdl_courselist[0]->startdate);
echo form_hidden('tarikhtamat', $mdl_courselist[0]->enddate);
echo form_hidden('kredit', $kredit);
echo form_hidden('price', $price);

?>
<div class="course-buy-now text-center">
<?php

if($type == 'SP') {
	$btnvalue = 'Register Now';
} else if($type == 'MC') {
	$btnvalue = 'Add to Cart';
}

$btn = array(
'id' => 'myform',
'class' => 'btn radius-xl text-uppercase',
'value' => $btnvalue,
'name' => 'action'
);

// Submit Button.
echo form_submit($btn);
echo form_close();
?>
</div>
						<?php
						$role_assignments = $this->main_m->get_mdl_role_assignments($mdl_courselist[0]->cid);
						if($role_assignments) {
						?>
			<div class="teacher-bx">
			<div class="teacher-info">
				<div class="teacher-name align-center">
									<?php

										$role_assignments = $this->main_m->get_mdl_role_assignments($mdl_courselist[0]->cid);
											foreach ($role_assignments as $teacher) { ?>

										<h5><?=$teacher->firstname;?> <?=$teacher->lastname;?></h5>
										<span>Teacher</span>

										<?php	}
									?>
				</div>
			</div>
			</div>
					<?php } ?>

			<div class="course-info-list <?php if(!$role_assignments) { echo 'mt-3'; } ?>" style="padding: 8px 20px;<?php if(!$role_assignments) { echo 'border-top: 1px solid #e6e6e6;'; } ?>border-bottom: 1px solid #e6e6e6;">
			<span style="font-size:12px;">Categories</span>
			<h5 class="text-primary" style="font-size:16px;font-weight: 400;"><?=$mdl_courselist[0]->category;?></h5>
			</div>
			<div class="course-info-list" style="margin-bottom: -20px;">
			<div style="padding: 8px 20px;"><h5>Course Features</h5></div>
			<style>
			/*.value {
				float: right;
			}*/
							.label {
								font-weight: bold;
							}
							.course-info-list ul li {
								display: flex;
								}

								.course-features li:last-child {
								border-bottom: unset;

								}
						</style>

							<ul class="course-features">
							<?php

							$coursefeature = $this->main_m->get_mdl_block_instances_coursefeature($mdl_courselist[0]->cid);

							if($coursefeature) {

								$script = unserialize(base64_decode($coursefeature[0]->configdata));
								if(isset($script->slidesnumber)) {
									$row = $script->slidesnumber;
									for($i=1; $i <= $row; $i++) {
										$title = 'item_title'.$i;
										$subtitle = 'item_subtitle'.$i;
										$icon = '';
										if($title == 'Assessment') {
											$icon = 'ti-check-box';
										} else if($title == 'Lectures') {
											$icon = 'ti-blackboard';
										} else if($title == 'Videos') {
											$icon = 'ti-video-clapper';
										} else if($title == 'Final Exam') {
											$icon = 'ti-ruler-pencil';
										} else if($title == 'Certificates') {
											$icon = 'ti-medall';
										}
										?>
										<li><i class="<?=$icon;?>"></i> <span class="label"><?=$script->$title;?></span> <span class="value"><?=$script->$subtitle;?></span></li>
										<?php
									}
								} else {
									foreach ($script as $key => $value) {
										if($key != 'title' && $key != 'ccn_margin_top' && $key != 'ccn_margin_bottom' && $key != 'ccn_css_class') {
											$key = preg_replace('/[0-9\@\.\;\" "_]+/', ' ', $key);
									?>
										<li><i class="ti-check-box"></i><span class="label"><?=ucfirst($key);?></span> <span class="value"><?=$value;?></span></li>
								<?php } }
								}
							}
							?>
				</ul>

			</div>
		</div>
		</div>

		<div class="col-lg-9 col-md-8 col-sm-12">
		<div class="courses-post">
			<div class="ttr-post-media media-effect">
							<?php
							$coursefeature = $this->main_m->get_mdl_block_instances_course_intro($mdl_courselist[0]->cid);
							if($coursefeature) {

								$script = unserialize(base64_decode($coursefeature[0]->configdata));
								$video = $script->video_url;
								if(strpos($video, 'https://youtu.be/') !== false) {
									$video = str_replace('https://youtu.be/','https://www.youtube.com/embed/',$video);
								}

							?>
							<center><object data="<?=$video;?>" width="820" height="460"></object></center>

						<?php } else { ?>
							<a href="#"><img src="<?=$filepath;?>" alt=""></a>
							<?php } ?>

			</div>
						<div class="ttr-post-info">
	<!--<div class="ttr-post-title ">
		<h2 class="post-title">Course Details</h2>
	</div>-->
	<div class="ttr-post-text" style="margin-top: 45px;margin-bottom: 0px;">
		<?php

		$stringhtml = "";

		if(strpos($html_table,'<td>:</td>') !== false) {
			$stringhtml = (str_replace('<td>:</td>','',$html_table));
			if(strpos($stringhtml,'<td style="vertical-align: top;">:</td>') !== false) {
				$stringhtml = (str_replace('<td style="vertical-align: top;">:</td>','',$stringhtml));
			}
			if(strpos($stringhtml,'<td style="text-align: center;">:</td>') !== false) {
				$stringhtml = (str_replace('<td style="text-align: center;">:</td>','',$stringhtml));
			}
			if(strpos($stringhtml,'<td style="vertical-align: top;"></td>') !== false) {
				$stringhtml = (str_replace('<td style="vertical-align: top;"></td>','',$stringhtml));
			}
			if(strpos($stringhtml,'<td style="text-align: center; vertical-align: top;">:</td>') !== false) {
			$stringhtml = (str_replace('<td style="text-align: center; vertical-align: top;">:</td>','',$stringhtml));
			}
			if(strpos($stringhtml,'<td><strong>:</strong></td>') !== false) {
			$stringhtml = (str_replace('<td><strong>:</strong></td>','',$stringhtml));
			}

		} else if(strpos($html_table,'<td style="vertical-align: top;">:</td>') !== false) {
			$stringhtml = (str_replace('<td style="vertical-align: top;">:</td>','',$html_table));
			if(strpos($stringhtml,'<td style="vertical-align: top;"></td>') !== false) {
				$stringhtml = (str_replace('<td style="vertical-align: top;"></td>','',$stringhtml));
			}
			if(strpos($stringhtml,'<td style="text-align: center;">:</td>') !== false) {
				$stringhtml = (str_replace('<td style="text-align: center;">:</td>','',$stringhtml));
			}
			if(strpos($stringhtml,'<td style="text-align: center; vertical-align: top;">:</td>') !== false) {
			$stringhtml = (str_replace('<td style="text-align: center; vertical-align: top;">:</td>','',$stringhtml));
			}
			if(strpos($stringhtml,'<td><strong>:</strong></td>') !== false) {
			$stringhtml = (str_replace('<td><strong>:</strong></td>','',$stringhtml));
			}

		} else if(strpos($html_table,'<td style="text-align: center;">:</td>') !== false) {
			$stringhtml = (str_replace('<td style="text-align: center;">:</td>','',$html_table));
			if(strpos($stringhtml,'<td style="text-align: center; vertical-align: top;">:</td>') !== false) {
			$stringhtml = (str_replace('<td style="text-align: center; vertical-align: top;">:</td>','',$stringhtml));
			}
			if(strpos($stringhtml,'<td><strong>:</strong></td>') !== false) {
			$stringhtml = (str_replace('<td><strong>:</strong></td>','',$stringhtml));
			}

		} else if(strpos($html_table,'<td style="text-align: center; vertical-align: top;">:</td>') !== false) {
			$stringhtml = (str_replace('<td style="text-align: center; vertical-align: top;">:</td>','',$html_table));
			if(strpos($stringhtml,'<td><strong>:</strong></td>') !== false) {
			$stringhtml = (str_replace('<td><strong>:</strong></td>','',$stringhtml));
			}

		} else if(strpos($html_table,'<td><strong>:</strong></td>') !== false) {
			$stringhtml = (str_replace('<td><strong>:</strong></td>','',$html_table));

			if(strpos($stringhtml,'<td style="vertical-align:top;"><strong>:</strong></td>') !== false) {
				$stringhtml = (str_replace('<td style="vertical-align:top;"><strong>:</strong></td>','',$stringhtml));
			}

		} else if(strpos($html_table,'<td style="vertical-align:top;"><strong>:</strong></td>') !== false) {
			$stringhtml = (str_replace('<td style="vertical-align:top;"><strong>:</strong></td>','',$html_table));

		} else {
			$stringhtml = $html_table;
		}

		echo $stringhtml;

			//echo (str_replace('<td>:</td>','',$html_table)); //(str_replace('>:</td>','',$html_table));
		?>
		<?php

		?>
		<!-- <table>
		<?php
		if($rows) {
			foreach ($rows as $row) {
					//Loop through each child (cell) of the row
					echo "<tr>";
					for($i = 0; $i < count($row->children()); $i++) {
						if($i != 1)
							echo '<td>'.$row->children()[$i]->plaintext.'</td>';
					}
					echo "</tr>";
			}
		}
		?>
	</table>-->
	</div>
</div>
</div>


</div>

</div>
</div>

</div>
<?php //} ?>

</div>
<!-- contact area END -->


</div>
<!-- Content END-->

<?php $this->load->view('templates/layout_footer'); ?>
