	<style type="text/css">

		.heading_styles { height: 150px;overflow-y: auto;border:0.5px solid rgba(0,0,0,.125);}
		
		@media screen and (max-width: 600px) {
		  .box-blue-dark{
		  	 word-break: break-word!important;
		  	 word-break: break-all;
		  }
		  .box-green{
		  	word-break: break-all!important;
		  }
		  .box-red{
			word-break: break-all!important;
		  }
		  .mobile_view{
		  	left: 55px!important;
		  }
		}
	</style>
	<?php if($is_pdf == 0) : ?>
		<style>
			.table-responsive-vertical{max-height: 300px;overflow-y:auto;}
		</style>
	<?php endif; ?> 

	<?php 

		$hieght1 ='';
		$hieght2 ='';
		$hieght3 ='';
		$hieght3 ='';
		if($compare_report == 1 && $is_pdf == 0) {
			$hieght1 =  'style="height: 500px; overflow-y:auto;"';
			$hieght2 =  'style="height: 300px; overflow-y:auto;"';
			$hieght3 =  'style="height: 210px; overflow-y:auto;"';
			$hieght4 =  'style="height: 350px; overflow-y:auto;"';

		}
	?>

	<?php if($is_pdf == 1) : ?>
		<style type="text/css">
			*,body{margin:0;padding:0;box-sizing:border-box;background-color:#f4f6f9}
			.col-12{width:100%!important;}
			.list-group-item{list-style:none;}

			.table tbody tr td,.table tbody tr th,.table thead tr td,.table thead tr th{padding:5px 10px;text-align:center;}

			.is_pdf_table{font-weight:700;color:#191919;border:solid 1px #e1e1e1;padding:10px;background-color:#e1e1e1;list-style:none!important;margin-top:10px;font-style:italic;letter-spacing:1px}
			.well{margin-bottom:10px;background-color:#eee;border-color:#eee;color:#6c757d}
			.score_card div { color: #fff;text-align: center; }

			.item-header { text-transform: capitalize; }

			.pdf-heading li.active {background-color:#337ab7 !important;border-color: #337ab7 !important;color: #fff;}
			
			.pdf-heading li.active{color:#fff;padding:10px;font-weight:700;font-size: 14px !important;padding-left:14px !important;text-align: center;}
			.pdf-heading li { padding: 10px;border-bottom:.5px solid #dee2e6  }
		</style>
	<?php endif; ?>
	
	<?php if($compare_report == 0) { ?>
		<?php 
		if($load_css_js==1) 
		{
			$include_css_js=include("application/views/site/report_css_js.php");
			echo "<!DOCTYPE html><html><head>".$include_css_js."</head></style><body>";
		}
		$lead_config=$this->basic->get_data("lead_config",array("where"=>array("status"=>"1")));
		if(isset($lead_config[0])) $direct_download="0";
		else $direct_download="1";
		echo "<input type='hidden' value='".$site_info[0]["id"]."' id='hidden_id'/>";		
		?>

		<?php 
			if($load_css_js==1) 
			{
				$path = 'assets/images/logo.png';
				$type = pathinfo($path, PATHINFO_EXTENSION);
				$data = file_get_contents($path);
				$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
				echo "<img style='margin-left:242px;max-width:200px;' src='".$base64."' alt='".$this->config->item("institute_address1")."'>";
				echo "<h3 class='text-center'>".$this->config->item("institute_address1")."</h3>";
				if($this->config->item("institute_address2")!="")
				echo "<h6 class='text-center'>Address: ".$this->config->item("institute_address2")."</h6>";
				echo "<h6 class='text-center'>Contact: ".$this->config->item("institute_email");
				echo " | ".$this->config->item("institute_mobile");
				echo "</h6><h6 class='text-center'>Website: <a href=".site_url()." target='_BLANK'>".site_url()."</a></h6><br/>";
			}
		?>
	<?php } ?>



	<?php 
	if($load_css_js==1) 
	{
		$headline="<br>Health Report";
		$catch_line="";
		$searched_at="Examined at";
	}
	else
	{
		$headline=$this->lang->line("health report");
		$catch_line=$this->lang->line('follow recommendations of this health report to keep your site healthy');
		$searched_at=$this->lang->line('examined at');
	}
	?>
	<div class='full' style='position: relative'>
	<h2 id="" class="title text-center"><?php echo $headline; ?> : <a href="<?php echo $site_info[0]["domain_name"]; ?>"  target="_BLANK"><?php echo $site_info[0]["domain_name"]; ?></a></h2>
	<?php if($compare_report == 0) {?>
		<p class="text-center slogan"><?php echo $catch_line; ?></p>
		<p class="text-center slogan"> <?php echo $searched_at." : ".$site_info[0]["searched_at"]; ?></p>
	<hr>
	<?php } ?>


	<?php 
	
		$warning_count=$site_info[0]["warning_count"];
		$warning_class="success";
		if($warning_count>0) $warning_class="warning";
	?>

    

	<div class="<?php if($compare_report == 0) echo "container"; else echo "container-fluid"; ?>">

	
		<?php
		if($compare_report == 0) {

		 	if($load_css_js!=1) {?>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-lg-7 col-md-7 share-container text-center"><?php include("application/views/site/share_button.php");?></div>
					<div class="col-xs-12 col-sm-12 col-lg-3 col-md-3 share-sibing text-center"><a id="add_competutor" class="btn btn-lg btn-primary" href="<?php echo site_url("home/index/".$site_info[0]["id"]);?>">  <i class="fa fa-adjust"></i> <?php echo $this->lang->line("compare with competutor");?></a></div>
					<div class="col-xs-12 col-sm-12 col-lg-2 col-md-2 share-sibing text-center">
						<a id="download_list" class="btn btn-lg btn-success"> <i class="fa fa-cloud-download"></i> <?php echo $this->lang->line("download pdf");?></a>
					</div>
					<div class="col-xs-12">
						<div class="box box-green no_radius" id="subscribe_div" style="display:none;">
							<br>
							<div class="box-body chart-responsive minus">
								<div class="col-xs-12">
									<div id="success_msg"></div>
								</div>
								<div class="col-xs-12">
									<div class="alert alert-custom text-center" id="send_email_message"><?php echo $this->lang->line('the download link will be sent to your email'); ?></div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<input type="text" class="form-control" id="name" required placeholder="<?php echo $this->lang->line('your name'); ?> *">
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<input type="text" class="form-control" id="email" required placeholder="<?php echo $this->lang->line('your email'); ?> *">
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<a class="btn btn-success btn-lg" id="send_email"> <i class="fa fa-send"></i> <?php echo $this->lang->line('send report'); ?></a>
								</div>
							</div>
							<br>
						</div>
					</div>
				</div>
				<div class="space"></div>
		<?php 

			} 
		}

		?>

		<?php if($this->is_ad_enabled && $this->is_ad_enabled1 && $load_css_js!=1) : ?>	
		<div class="add-970-90 hidden-xs hidden-sm" style='text-align: center'><?php echo $this->ad_content1; ?></div>
		<div class="add-320-100 hidden-md hidden-lg" style='text-align: center'><?php echo $this->ad_content1_mobile; ?></div>		
		<div class="space"></div>
		<br>
		<?php endif; ?>	

		<?php echo "<div style='font-size:20px !important;' class='text-center alert alert-".$warning_class."'><b>".$this->config->item('product_short_name')."</b> ".$this->lang->line("found")." <b>".$warning_count."</b> ".$this->lang->line('major issues')."</div>"; ?>
		<div class="row">
			<div class="col-xs-12">		

				<?php if($load_css_js!=1) {?>
					<p style='text-align: center;position: relative'>
						<input type="text" class="dial knob" data-readonly="true" value="<?php echo $site_info[0]["overall_score"]; ?>" data-width="120" data-height="120" data-fgColor="#39CCCC" data-thickness=".1">
						<span style='position: absolute; top: 70px; right: 0; width: 100%; text-align: center; color: #39CCCC'><?php echo $this->lang->line('Score'); ?></span>
					</p> 
				<?php } else { ?>
				<div class="col-xs-12">
					<div style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;padding: 10px" class="info-box">
							<span class="info-box-text">Score</span>
							<span class="info-box-number"><?php echo $site_info[0]["overall_score"]; ?></span>
					</div>
				</div>
				<?php } ?>

				<!-- page title start-->
				<?php 
				$recommendation_word=$this->lang->line("Knowledge Base");
				$value=$site_info[0]["title"];
				$check=$this->site_check->title_check($value); 
				$item=$this->lang->line("Page Title");
				$long_recommendation=$this->lang->line('page_title_recommendation');
				if(strlen($value)==0) //error
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("Your site do not have any title.");
				}
				else if($check=="1") // warning
				{
					$class="yellow";
					$status="exclamation-circle";
					$short_recommendation=$this->lang->line("Your page title exceeds 60 characters. It's not good.");
				}
				else //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Your page title does not exceed 60 characters. It's fine.");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 500px; overflow-y:auto;"'?>>	
						<i class='fa fa-<?php echo $status;?>'></i> <b><?php echo $item; ?> :</b> <?php echo $value; ?>				
						<br/><br/><br/>
						<?php echo $short_recommendation; ?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  page title end-->
			</div>
		</div>





		<div class="row">
			<div class="col-xs-12">				
				<!-- meta description start-->
				<?php 
				$value=$site_info[0]["description"];
				$check=$this->site_check->description_check($value); 
				$item=$this->lang->line("Meta Description");
				$long_recommendation=$this->lang->line('description_recommendation');
				if(strlen($value)==0) // error
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("Your site do not have any meta description.");
				}
				else if($check=="1") //warning
				{
					$class="yellow";
					$status="exclamation-circle";
					$short_recommendation=$this->lang->line("Your meta description exceeds 150 characters. It's not good.");
				}
				else // ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Your meta description does not exceed 150 characters. It's fine.");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 450px; overflow-y:auto;"'?>>	
						<i class='fa fa-<?php echo $status;?>'></i> <b><?php echo $item; ?> :</b> <?php echo $value; ?>				
						<br/><br/><br/>
						<?php echo $short_recommendation; ?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  meta description end-->
			</div>
		</div>





		<div class="row">
			<div class="col-xs-12">				
				<!-- meta keyword start-->
				<?php 
				$value=$site_info[0]["meta_keyword"];
				$check=empty($value) ? 1 : 0;
				$item=$this->lang->line("Meta Keyword");
				$long_recommendation=$this->lang->line('meta_keyword_recommendation');
				if($check=="1") //error
				{
					$class="red";
					$status="remove";
					$short_recommendation="<br/><br/><br/>".$this->lang->line("Your site do not have any meta keyword.");
				}
				else //ok
				{
					$class="green";
					$status="check";
					$short_recommendation="";
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 300px; overflow-y:auto;"'?>>	
						<i class='fa fa-<?php echo $status;?>'></i> <b><?php echo $item; ?> :</b> <?php echo $value; ?>			
						
						<?php echo $short_recommendation; ?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  meta keyword end-->
			</div>
		</div>






		<div class="row">
			<?php 
			$one_phrase=json_decode($site_info[0]["keyword_one_phrase"],true); 
			$two_phrase=json_decode($site_info[0]["keyword_two_phrase"],true); 
			$three_phrase=json_decode($site_info[0]["keyword_three_phrase"],true); 
			$four_phrase=json_decode($site_info[0]["keyword_four_phrase"],true); 
			$total_words=empty($site_info[0]["total_words"]) ? 0 : $site_info[0]["total_words"];
			include("application/views/site/array_spam_keyword.php");
		
			$class="blue-dark";
			$status="info-circle";
		
			?>
			<div class="col-xs-12 col-sm-12 <?php if($compare_report == 0) echo "col-md-6 col-lg-6"; ?>">	
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $this->lang->line("Single Keywords"); ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus">	
						<div class="table-resposive" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 300px; overflow-y:auto;"'?>>
							<table class="table table-bordered table-bordered table-condensed table-striped">
								<tr>
									<th><?php echo $this->lang->line("Keyword"); ?></th>
									<th><?php echo $this->lang->line("Occurrence"); ?></th>
									<th><?php echo $this->lang->line("Density"); ?></th>
									<th><?php echo $this->lang->line("Possible Spam"); ?></th>
								</tr>
								<?php foreach ($one_phrase as $key => $value) : ?>
									<tr>
										<td><?php echo $key; ?></td>
										<td><?php echo $value; ?></td>
										<td><?php $occurence = ($value/$total_words)*100; echo round($occurence, 3)." %"; ?></td>
										<td><?php 
												if(in_array(strtolower($key), $array_spam_keyword)) echo "Yes";
												else echo 'No'; 
											?>
										</td>
									</tr>
								<?php endforeach; ?>
							</table>
						</div>
					</div>
				</div> 
			</div>

			<div class="col-xs-12 col-sm-12 <?php if($compare_report == 0) echo "col-md-6 col-lg-6"; ?>">	
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $this->lang->line("Two Word Keywords"); ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus">	
						<div class="table-resposive" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 300px; overflow-y:auto;"'?>>
							<table class="table table-bordered table-condensed table-striped">
								<tr>
									<th><?php echo $this->lang->line("Keyword"); ?></th>
									<th><?php echo $this->lang->line("Occurrence"); ?></th>
									<th><?php echo $this->lang->line("Density"); ?></th>
									<th><?php echo $this->lang->line("Possible Spam"); ?></th>
								</tr>
								<?php foreach ($two_phrase as $key => $value) : ?>
									<tr>
										<td><?php echo $key; ?></td>
										<td><?php echo $value; ?></td>
										<td><?php $occurence = $value/$total_words*100; echo round($occurence, 3)." %"; ?></td>
										<td><?php 
												if(in_array(strtolower($key), $array_spam_keyword)) echo "Yes";
												else echo 'No'; 
											?>
										</td>
									</tr>
								<?php endforeach; ?>
							</table>
						</div>
					</div>
				</div> 
			</div>

			<div class="col-xs-12 col-sm-12 <?php if($compare_report == 0) echo "col-md-6 col-lg-6"; ?>">	
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $this->lang->line("Three Word Keywords"); ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus">	
						<div class="table-resposive" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 300px; overflow-y:auto;"'?>>
							<table class="table table-bordered table-bordered table-condensed table-striped">
								<tr>
									<th><?php echo $this->lang->line("Keyword"); ?></th>
									<th><?php echo $this->lang->line("Occurrence"); ?></th>
									<th><?php echo $this->lang->line("Density"); ?></th>
									<th><?php echo $this->lang->line("Possible Spam"); ?></th>
								</tr>
								<?php foreach ($three_phrase as $key => $value) : ?>
									<tr>
										<td><?php echo $key; ?></td>
										<td><?php echo $value; ?></td>
										<td><?php $occurence = $value/$total_words*100; echo round($occurence, 3)." %"; ?></td>
										<td><?php 
												if(in_array(strtolower($key), $array_spam_keyword)) echo "Yes";
												else echo 'No'; 
											?>
										</td>
									</tr>
								<?php endforeach; ?>
							</table>
						</div>
					</div> 
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 <?php if($compare_report == 0) echo "col-md-6 col-lg-6"; ?>">	
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $this->lang->line("Four Word Keywords"); ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus">	
						<div class="table-resposive" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 300px; overflow-y:auto;"'?>>
							<table class="table table-bordered table-condensed table-striped">
								<tr>
									<th><?php echo $this->lang->line("Keyword"); ?></th>
									<th><?php echo $this->lang->line("Occurrence"); ?></th>
									<th><?php echo $this->lang->line("Density"); ?></th>
									<th><?php echo $this->lang->line("Possible Spam"); ?></th>
								</tr>
								<?php foreach ($four_phrase as $key => $value) : ?>
									<tr>
										<td><?php echo $key; ?></td>
										<td><?php echo $value; ?></td>
										<td><?php $occurence = $value/$total_words*100; echo round($occurence, 3)." %"; ?></td>
										<td><?php 
												if(in_array(strtolower($key), $array_spam_keyword)) echo "Yes";
												else echo 'No'; 
											?>
										</td>
									</tr>
								<?php endforeach; ?>
							</table>
						</div>
					</div> 
				</div>
			</div>

		</div> <!-- end of 1,2,3,4 keyword -->





		<div class="row">
			<div class="col-xs-12">				
				<!-- Key words usage start-->
				<?php 
				$value=$site_info[0]["meta_keyword"];
				$check=$this->site_check->keyword_usage_check($site_info[0]["meta_keyword"],array_keys($one_phrase),array_keys($two_phrase),array_keys($three_phrase),array_keys($four_phrase));
				$item=$this->lang->line("Keyword Usage");
				$long_recommendation=$this->lang->line('keyword_usage_recommendation');
				if($check=="1") //error
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("The most using keywords do not match with meta keywords.");
				}
				else //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("The most using keywords match with meta keywords.");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 250px; overflow-y:auto;"'?>>	
						<?php echo $short_recommendation; ?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  Key words usage end-->
			</div>
		</div>





		<div class="row">
			<div class="col-xs-12">				
				<!--total words start-->
				<?php 
				$value=$site_info[0]["total_words"];
				$item=$this->lang->line("Total Words");
				$long_recommendation=$this->lang->line('unique_stop_words_recommendation');
				$class="blue-dark";
				$status="info-circle";
				
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 350px; overflow-y:auto;"'?>>	
						<i class='fa fa-<?php echo $status;?>'></i> <b><?php echo $item; ?> :</b> <?php echo $value; ?>				
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  total words end-->
			</div>
		</div>



		<div class="row">
			<div class="col-xs-12">				
				<!-- text_to_html_ratiostart-->
				<?php 
				$check=round($site_info[0]["text_to_html_ratio"]); 
				$item=$this->lang->line("Text/HTML Ratio Test");
				$long_recommendation=$this->lang->line('text_to_html_ratio_recommendation');

				if($check<20) //error
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("Site failed text/HTML ratio test.");
				}
				else //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Site passed text/HTML ratio test.");
				}
				$short_recommendation.="<br/><br/><i class='fa fa-".$status."'></i> <b>".$item." : ".$check."%</b>";
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 250px; overflow-y:auto;"'?>>						
						<?php echo $short_recommendation; ?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  text_to_html_ratio end-->
			</div>
		</div>







		<div class="row">
			<?php 
				$h1=json_decode($site_info[0]["h1"],true); 
				$h2=json_decode($site_info[0]["h2"],true); 
				$h3=json_decode($site_info[0]["h3"],true); 
				$h4=json_decode($site_info[0]["h4"],true); 
				$h5=json_decode($site_info[0]["h5"],true); 
				$h6=json_decode($site_info[0]["h6"],true); 			
			?>
			<?php 
				$item=$this->lang->line("HTML Headings");
				$long_recommendation=$this->lang->line('heading_recommendation');
				$class="blue-dark";
				$status="info-circle";
			?>
			<div class="col-xs-12">
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 600px; overflow-y:auto;"'?>>
						<div class="row">
							<div class="col-xs-12  <?php if($compare_report == 0) echo "col-md-4 col-lg-4"; ?>">
								<h3 class="highlight_header">H1(<?php echo count($h1) ?>)</h3>
								<div class="highlight_header_content">
									<ul>
									<?php foreach($h1 as $key=>$value): ?>
										<li><?php echo $value; ?></li>
									<?php endforeach; ?>
									</ul>
								</div>
							</div>					
							<div class="col-xs-12  <?php if($compare_report == 0) echo "col-md-4 col-lg-4"; ?>">
								<h3 class="highlight_header">H2(<?php echo count($h2) ?>)</h3>
								<div class="highlight_header_content">
									<ul>
									<?php foreach($h2 as $key=>$value): ?>
										<li><?php echo $value; ?></li>
									<?php endforeach; ?>
									</ul>
								</div>
							</div>					
							<div class="col-xs-12  <?php if($compare_report == 0) echo "col-md-4 col-lg-4"; ?>">
								<h3 class="highlight_header">H3(<?php echo count($h3) ?>)</h3>
								<div class="highlight_header_content">
									<ul>
									<?php foreach($h3 as $key=>$value): ?>
										<li><?php echo $value; ?></li>
									<?php endforeach; ?>
									</ul>
								</div>
							</div>					
							<div class="col-xs-12 <?php if($compare_report == 0) echo "col-md-4 col-lg-4"; ?>">
								<h3 class="highlight_header">H4(<?php echo count($h4) ?>)</h3>
								<div class="highlight_header_content">
									<ul>
									<?php foreach($h4 as $key=>$value): ?>
										<li><?php echo $value; ?></li>
									<?php endforeach; ?>
									</ul>
								</div>
							</div>					
							<div class="col-xs-12  <?php if($compare_report == 0) echo "col-md-4 col-lg-4"; ?>">
								<h3 class="highlight_header">H5(<?php echo count($h5) ?>)</h3>
								<div class="highlight_header_content">
									<ul>
									<?php foreach($h5 as $key=>$value): ?>
										<li><?php echo $value; ?></li>
									<?php endforeach; ?>
									</ul>
								</div>
							</div>					
							<div class="col-xs-12  <?php if($compare_report == 0) echo "col-md-4 col-lg-4"; ?>">
								<h3 class="highlight_header">H6(<?php echo count($h6) ?>)</h3>
								<div class="highlight_header_content">
									<ul>
									<?php foreach($h6 as $key=>$value): ?>
										<li><?php echo $value; ?></li>
									<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
						<a class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>				
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>		
		</div>






		<div class="row">
			<div class="col-xs-12">				
				<!-- robot start-->
				<?php 
				$value=$site_info[0]["robot_txt_exist"];
				$check=$value;
				$item=$this->lang->line("robot.txt");
				$long_recommendation=$this->lang->line('robot_recommendation');
				if($check=="0") //warning
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("Your site does not have robot.txt.");
				}
				else //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Your site have robot.txt");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 600px; overflow-y:auto;"'?>>					
						<?php echo $short_recommendation; ?>
						<?php
							if($check=="1")
							{ ?>															
								<br><br>
								<h3 class="highlight_header"><?php echo $item;?> </h3>
								<div class="highlight_header_content">>
									<?php print_r($site_info[0]["robot_txt_content"]);?>
								</div>	
							<?php
							} ?>
						<br/><br/>
						<br/><br/>	
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  robot end-->
			</div>
		</div>






		<div class="row">
			<div class="col-xs-12">				
				<!-- sitemap start-->
				<?php 
				$value=$site_info[0]["sitemap_exist"];
				$check=$value;
				$item=$this->lang->line("Sitemap");
				$long_recommendation=$this->lang->line('sitemap_recommendation');
				if($check=="0") //warning
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("Your site does not have sitemap");
				}
				else //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Your site have sitemap");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 650px; overflow-y:auto;"'?>>
						<?php echo $short_recommendation; ?>
						<?php if($check=="1") echo "<br>Location: <a href='".$site_info[0]["sitemap_location"]."' target='_BLANK'>".$site_info[0]["sitemap_location"]."</a>";?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  sitemap end-->
			</div>
		</div>







		<div class="row">
			<div class="col-xs-12">				
				<!-- sitemap start-->
				<?php 
				$item=$this->lang->line("Internal Vs. External Links");				
				$class="blue-dark";
				$status="info-circle";
				
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus clearfix" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 650px; overflow-y:auto;overflow-x:hidden"'?>>

						<div class="row">
							
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="info-box" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text"><?php echo $this->lang->line("Total Internal Links?"); ?></span>
										<span class="info-box-number"><?php echo $site_info[0]["internal_link_count"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="info-box" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text"><?php echo $this->lang->line("Total External Links?"); ?></span>
										<span class="info-box-number"><?php echo $site_info[0]["external_link_count"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 <?php if($compare_report == 0) echo "col-md-6 col-lg-6"; ?>">								
								<h3 class="highlight_header"><?php echo $this->lang->line("Internal Links"); ?></h3>
								<div class="highlight_header_content" style="word-break: break-all;">
									<ul>
										<?php 
											$internal_link=json_decode($site_info[0]["internal_link"],true);											
											foreach ($internal_link as $value) 
											{
												echo "<li>".$value["link"]."</li>";
											}
										?>
									</ul>
								</div>						
							</div>

							<div class="col-xs-12 col-sm-12 <?php if($compare_report == 0) echo "col-md-6 col-lg-6"; ?>">								
								<h3 class="highlight_header"><?php echo $this->lang->line("External Links"); ?></h3>
								<div class="highlight_header_content" style="word-break: break-all;">
									<ul>
										<?php 
											$external_link=json_decode($site_info[0]["external_link"],true);
											foreach ($external_link as $value) 
											{
												echo "<li>".$value["link"]."</li>";
											}
										?>
									</ul>
								</div>						
							</div>
						</div>

					</div>
				</div> 
				<!--  sitemap end-->
			</div>
		</div>

		<!-- Alexa Rank -->

		<div class="row">
			<div class="col-xs-12">				
				<!-- sitemap start-->
				<?php 
				$item=$this->lang->line("Alexa Rank");				
				$class="blue-dark";
				$status="info-circle";	
				$alexa_rank_array = json_decode($site_info[0]['alexa_rank'], true);	
				?>

				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus clearfix" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 260px; overflow-y:auto;overflow-x:hidden"'?>>>

						<div class="row">

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="info-box" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text"><?php echo $this->lang->line('Traffic Rank'); ?></span>
										<span class="info-box-number"><?php echo $alexa_rank_array["traffic_rank"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="info-box" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text"><?php echo $this->lang->line('Reach Rank'); ?></span>
										<span class="info-box-number"><?php echo $alexa_rank_array["reach_rank"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="info-box" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text"><?php echo $this->lang->line('Top Country'); ?></span>
										<span class="info-box-number"><?php echo $alexa_rank_array["country"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="info-box" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text"><?php echo $this->lang->line('Top Country Rank'); ?></span>
										<span class="info-box-number"><?php echo $alexa_rank_array["country_rank"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

						</div>

					</div>
				</div> 
				<!--  sitemap end-->
			</div>
		</div>

		<!-- end Alexa Rank -->



		<!-- Domain IP Information -->

		<div class="row">
			<div class="col-xs-12">				
				<!-- sitemap start-->
				<?php 
				$item=$this->lang->line("Domain IP Information");				
				$class="blue-dark";
				$status="info-circle";	
				$domain_ip_info = json_decode($site_info[0]['domain_ip_info'], true);	
				?>

				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus clearfix" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 360px; overflow-y:auto;overflow-x:hidden"'?>>

						<div class="row">

							<div class="col-xs-12 col-sm-12 col-md-6 <?php if($compare_report==0) echo "col-lg-4"; ?>">
								<div class="info-box custom" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon custom bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text custom"><?php echo $this->lang->line('ISP'); ?></span>
										<span class="info-box-number custom"><?php echo $domain_ip_info["isp"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>
							
							<div class="col-xs-12 col-sm-12 col-md-6 <?php if($compare_report==0) echo "col-lg-4"; ?>">
								<div class="info-box custom" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon custom bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text custom"><?php echo $this->lang->line('IP'); ?></span>
										<span class="info-box-number custom"><?php echo $domain_ip_info["ip"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 <?php if($compare_report==0) echo "col-lg-4"; ?>">
								<div class="info-box custom" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon custom bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text custom"><?php echo $this->lang->line('Organization'); ?></span>
										<span class="info-box-number custom"><?php echo $domain_ip_info["organization"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 <?php if($compare_report==0) echo "col-lg-4"; ?>">
								<div class="info-box custom" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon custom bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text custom"><?php echo $this->lang->line('City'); ?></span>
										<span class="info-box-number custom"><?php echo $domain_ip_info["city"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 <?php if($compare_report==0) echo "col-lg-4"; ?>">
								<div class="info-box custom" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon custom bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text custom"><?php echo $this->lang->line('Country'); ?></span>
										<span class="info-box-number custom"><?php echo $domain_ip_info["country"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 <?php if($compare_report==0) echo "col-lg-4"; ?>">
								<div class="info-box custom" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon custom bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text custom"><?php echo $this->lang->line('Time Zone'); ?></span>
										<span class="info-box-number custom"><?php echo $domain_ip_info["time_zone"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 <?php if($compare_report==0) echo "col-lg-4"; ?>">
								<div class="info-box custom" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon custom bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text custom"><?php echo $this->lang->line('Longitude'); ?></span>
										<span class="info-box-number custom"><?php echo $domain_ip_info["longitude"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 <?php if($compare_report==0) echo "col-lg-4"; ?>">
								<div class="info-box custom" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon custom bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text custom"><?php echo $this->lang->line('Latitude'); ?></span>
										<span class="info-box-number custom"><?php echo $domain_ip_info["latitude"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

						</div>

					</div>
				</div> 
				<!--  sitemap end-->
			</div>
		</div>

		<!-- end Domain Ip Information -->




		

		<div class="row">
			<div class="col-xs-12">				
				<!-- sitemap start-->
				<?php 
				$item=$this->lang->line("NoIndex , NoFollow, DoDollow Links");
				$long_recommendation=$this->lang->line('no_do_follow_recommendation');
				
				$class="blue-dark";
				$status="info-circle";
				
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus clearfix" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 700px; overflow-y:auto;overflow-x:hidden"'?>>

						<div class="row">
							<div class="col-xs-12 col-sm-6 <?php if($compare_report==0) echo "col-md-4 col-lg-4"; ?>">
								<div class="info-box" style="border:1px solid #DD4B39;border-bottom:2px solid #DD4B39;">
									<span class="info-box-icon bg-red"><i class="fa fa-remove"></i></span>
									<div class="info-box-content">
										<span class="info-box-text"><?php echo $this->lang->line("Total NoIndex Links"); ?></span>
										<span class="info-box-number"><?php echo count(json_decode($site_info[0]["noindex_list"],true)); ?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 <?php if($compare_report==0) echo "col-md-4 col-lg-4"; ?>">
								<div class="info-box" style="border:1px solid #F39C12;border-bottom:2px solid #F39C12;">
									<span class="info-box-icon bg-yellow"><i class="fa fa-remove"></i></span>
									<div class="info-box-content">
										<span class="info-box-text"><?php echo $this->lang->line("Total NoFollow Links"); ?></span>
										<span class="info-box-number"><?php echo $site_info[0]["nofollow_link_count"]; ?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 <?php if($compare_report==0) echo "col-md-4 col-lg-4"; ?>">
								<div class="info-box" style="border:1px solid #00A65A;border-bottom:2px solid #00A65A;">
									<span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>
									<div class="info-box-content">
										<span class="info-box-text"><?php echo $this->lang->line("Total DoFollow Links"); ?></span>
										<span class="info-box-number"><?php echo $site_info[0]["dofollow_link_count"]; ?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>


							<div class="col-xs-12 col-sm-6 <?php if($compare_report==0) echo "col-md-4 col-lg-4"; ?>">
								<div class="info-box" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text"><?php echo $this->lang->line("NoIndex Enabled by Meta Robot?"); ?></span>
										<span class="info-box-number"><?php echo $site_info[0]["noindex_by_meta_robot"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<div class="col-xs-12 col-sm-6 <?php if($compare_report==0) echo "col-md-4 col-lg-4"; ?>">
								<div class="info-box" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon bg-blue"><i class="fa fa-question-circle"></i></span>
									<div class="info-box-content">
										<span class="info-box-text"><?php echo $this->lang->line("NoFollow Enabled by Meta Robot?"); ?></span>
										<span class="info-box-number"><?php echo $site_info[0]["nofollowed_by_meta_robot"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 <?php if($compare_report==0) echo "col-md-6 col-lg-6"; ?>">								
								<h3 class="highlight_header"><?php echo $this->lang->line("NoIndex Links"); ?></h3>
								<div class="highlight_header_content" style="word-break: break-all;">
									<ul>
										<?php 
											$noindex_list=json_decode($site_info[0]["noindex_list"],true);
											foreach ($noindex_list as $value) 
											{
												echo "<li>".$value."</li>";
											}
										?>
									</ul>
								</div>						
							</div>

							<div class="col-xs-12 col-sm-12 <?php if($compare_report==0) echo "col-md-6 col-lg-6"; ?>">								
								<h3 class="highlight_header"><?php echo $this->lang->line("NoFollow Links"); ?></h3>
								<div class="highlight_header_content" style="word-break: break-all;">
									<ul>
										<?php 
											$nofollow_links=json_decode($site_info[0]["nofollow_link_list"],true);
											foreach ($nofollow_links as $value) 
											{
												echo "<li>".$value."</li>";
											}
										?>
									</ul>
								</div>						
							</div>

						</div>
						

						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  sitemap end-->
			</div>
		</div>







		<div class="row">
			<div class="col-xs-12">				
				<!-- seo friendly link start-->
				<?php 
				$value=json_decode($site_info[0]["not_seo_friendly_link"],true);
				$check=count($value);
				$item=$this->lang->line("SEO Friendly Links");
				$long_recommendation=$this->lang->line('seo_friendly_recommendation');
				if($check==0) //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Links of your site are SEO friendly.");
				}
				else //error
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("Some links of your site are not SEO friendly.");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 500px; overflow-y:auto;overflow-x:hidden"'?>>
						<?php 
							echo $short_recommendation; 
							if($check>0)
							{ ?>															
								<br><br>
								<h3 class="highlight_header">Not SEO Friendly Links </h3>
								<div class="highlight_header_content" style="word-break: break-all;">
									<ul>
										<?php 
											foreach ($value as $val) 
											{
												echo "<li>".$val."</li>";
											}
										?>
									</ul>
								</div>	
							<?php
							}
						?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  seo friendly link end-->
			</div>
		</div>






		<div class="row">
			<div class="col-xs-12">				
				<!-- favicon start-->
				<?php 
				$check=$site_info[0]["is_favicon_found"];
				$item=$this->lang->line("Favicon");
				$long_recommendation="<a target='_BLANK' href='http://blog.woorank.com/2014/07/favicon-seo/'><i class='fa fa-hand-o-right'></i>  Learn more</a>";
				if($check=="0") //error
				{
					$class="yellow";
					$status="exclamation-circle";
					$short_recommendation=$this->lang->line("Your site does not have favicon.");
				}
				else //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Your site have favicon.");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 120px; overflow-y:auto;overflow-x:hidden"'?>>
						<?php 
							echo $short_recommendation; 
						?>
						<br/><br/>						
						<?php echo $long_recommendation; ?>

					</div>
				</div> 
				<!--  favicon end-->
			</div>
		</div>







		<div class="row">
			<div class="col-xs-12">				
				<!-- img alt start-->
				<?php 
				$value=json_decode($site_info[0]["image_not_alt_list"],true);
				$check=$site_info[0]["image_without_alt_count"];
				$item=$this->lang->line("Image 'alt' Test");
				$long_recommendation=$this->lang->line('img_alt_recommendation');
				if($check=="0") //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Your site does not have any image without alt text.");
				}
				else //warning
				{
					$class="yellow";
					$status="exclamation-circle";
					$short_recommendation=$this->lang->line("Your site have").$check.$this->lang->line("images without alt text.");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 300px; overflow-y:auto;overflow-x:hidden"'?>>
						<?php 
							echo $short_recommendation; 
							if($check>0)
							{ ?>															
								<br><br>
								<h3 class="highlight_header">Images Without alt </h3>
								<div class="highlight_header_content">
									<ul>
										<?php 
											foreach ($value as $val) 
											{
												echo "<li>".$val."</li>";
											}
										?>
									</ul>
								</div>	
							<?php
							}
						?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  img alt end-->
			</div>
		</div>




		<div class="row">
			<div class="col-xs-12">				
				<!-- page title start-->
				<?php 
				$value=$site_info[0]["doctype"];
				$check=$site_info[0]["doctype_is_exist"]; 
				$item=$this->lang->line("DOC Type");
				$long_recommendation=$this->lang->line('doc_type_recommendation');
				if($check=="0") //error
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("Page do not have doc type");
				}
				else //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Page have doc type.");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 300px; overflow-y:auto;overflow-x:hidden"'?>>	
						<i class='fa fa-<?php echo $status;?>'></i> <b><?php echo $item; ?> :</b> <?php echo $value; ?>				
						<br/><br/><br/>
						<?php echo $short_recommendation; ?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  page title end-->
			</div>
		</div>







		<div class="row">
			<div class="col-xs-12">				
				<!-- depreciate tag start-->
				<?php 
				$value=json_decode($site_info[0]["depreciated_html_tag"],true);
				$check=array_sum($value);
				$item=$this->lang->line("Depreciated HTML Tag");
				$long_recommendation=$this->lang->line('depreciated_html_recommendation');
				if($check==0) //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Your site does not have any depreciated HTML tag.");
				}
				else //warning
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("Your site have").$check.$this->lang->line("depreciated HTML tags.");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 300px; overflow-y:auto;overflow-x:hidden"'?>>
						<?php 
							echo $short_recommendation; 
							if($check>0)
							{ ?>															
								<br><br>
								<h3 class="highlight_header">Depreciated HTML Tags </h3>
								<div class="highlight_header_content">
									<ul>
										<?php 
											foreach ($value as $key=>$val) 
											{
												echo "<li>".$key." : ".$val."</li>";
											}
										?>
									</ul>
								</div>	
							<?php
							}
						?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  depreciate tag end-->
			</div>
		</div>






		<div class="row">
			<div class="col-xs-12">				
				<!-- html page size start-->
				<?php 
				$value=round($site_info[0]["total_page_size_general"])." KB";
				$check=$value; 
				$item=$this->lang->line("HTML Page Size");
				$long_recommendation=$this->lang->line('html_page_size_recommendation');
				if($check>100) // warning
				{
					$class="yellow";
					$status="exclamation-circle";
					$short_recommendation=$this->lang->line("HTML page size is > 100KB");
				}
				else // ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("HTML page size is <= 100KB");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 450px; overflow-y:auto;overflow-x:hidden"'?>>	
						<i class='fa fa-<?php echo $status;?>'></i> <b><?php echo $item; ?> :</b> <?php echo $value; ?>				
						<br/><br/><br/>
						<?php echo $short_recommendation; ?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  html page size end-->
			</div>
		</div>







		<div class="row">
			<div class="col-xs-12">				
				<!-- html page size start-->
				<?php 

				$value=round($site_info[0]["page_size_gzip"])." KB";
				$check=$site_info[0]["is_gzip_enable"]; 
				$item=$this->lang->line("GZIP Compression");
				$item2="GZIP Compressed Size";
				$long_recommendation=$this->lang->line('gzip_recommendation');
				if($check=="0") // warning
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("GZIP compression is disabled.");
				}
				else // ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("GZIP compression is enabled.");
					if(round($site_info[0]["page_size_gzip"]) > 33) 
					{
						$short_recommendation.=$this->lang->line("GZIP compressed size should be < 33KB");
						$class="red";
						$status="remove";
					}
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 450px; overflow-y:auto;overflow-x:hidden"'?>>	

						<?php if($check=="1") 
						{ ?>
							<i class='fa fa-<?php echo $status;?>'></i> <b><?php echo $item2; ?> :</b> <?php echo $value; ?>				
							<br/><br/><br/>
						<?php 
						} ?>

						<?php echo $short_recommendation; ?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  html page size end-->
			</div>
		</div>








		<div class="row">
			<div class="col-xs-12">				
				<!--  inline css start-->
				<?php 
				$value=json_decode($site_info[0]["inline_css"],true);
				$check=count($value);
				$item=$this->lang->line("Inline CSS");
				$long_recommendation=$this->lang->line('inline_css_recommendation');
				if($check==0) //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Your site does not have any inline css.");
				}
				else //warning
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("Your site have").$check.$this->lang->line("inline css.");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 400px; overflow-y:auto;overflow-x:hidden"'?>>
						<?php 
							echo $short_recommendation; 
							if($check>0)
							{ ?>															
								<br><br>
								<h3 class="highlight_header"><?php echo $this->lang->line("Inline CSS"); ?> </h3>
								<div class="highlight_header_content">
									<ul>
										<?php 
											foreach ($value as $val) 
											{
												echo "<li>".$val."</li>";
											}
										?>
									</ul>
								</div>	
							<?php
							}
						?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--   inline css end-->
			</div>
		</div>





		<div class="row">
			<div class="col-xs-12">				
				<!--  inline css start-->
				<?php 
				$value=json_decode($site_info[0]["internal_css"],true);
				$check=count($value);
				$item=$this->lang->line("Internal CSS");
				$long_recommendation=$this->lang->line('internal_css_recommendation');
				if($check==0) //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Your site does not have any internal css.");
				}
				else //warning
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("Your site have").$check.$this->lang->line("internal css.");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 250px; overflow-y:auto;overflow-x:hidden"'?>>						
						<?php echo $short_recommendation; ?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>
					</div>
				</div> 
				<!--   inline css end-->
			</div>
		</div>





		<div class="row">
			<div class="col-xs-12">				
				<!-- micro data schema start-->
				<?php 
				$value=json_decode($site_info[0]["micro_data_schema_list"],true);
				$check=count($value);
				$item=$this->lang->line("Micro Data Schema Test");
				$long_recommendation=$this->lang->line('micro_data_recommendation');
				if($check>0) //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Site passed micro data schema test.").$check.$this->lang->line("results found.");
				}
				else //error
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("Site failed micro data schema test.");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 500px; overflow-y:auto;overflow-x:hidden"'?>>
						<?php 
							echo $short_recommendation; 
							if($check>0)
							{ ?>															
								<br><br>
								<h3 class="highlight_header"><?php echo $this->lang->line("Micro data schema list"); ?></h3>
								<div class="highlight_header_content">
									<ul>
										<?php 
											foreach ($value as $val) 
											{
												echo "<li>".$val."</li>";
											}
										?>
									</ul>
								</div>	
							<?php
							}
						?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  micro data schema end-->
			</div>
		</div>






		<div class="row">
			<div class="col-xs-12">				
				<!-- ip dns start-->
				<?php 
				$item=$this->lang->line("IP & DNS Report");				
				$class="blue-dark";
				$status="info-circle";
				
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus clearfix">

						<div class="row">

							
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="info-box" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon bg-blue"><i class="fa fa-map-marker"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">IPv4</span>
										<span class="info-box-number"><?php echo $site_info[0]["ip"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="info-box" style="border:1px solid #0073B7;border-bottom:2px solid #0073B7;">
									<span class="info-box-icon bg-blue"><i class="fa fa-map-marker"></i></span>
									<div class="info-box-content">
										<span class="info-box-text">IPv6</span>
										<span class="info-box-number"><?php if($site_info[0]["is_ipv6_compatiable"]==0) echo "Not Compatiable "; else echo $site_info[0]["ipv6"];?></span>
									</div><!-- /.info-box-content -->
								</div>
							</div>

							<?php 
							$dns_report=json_decode($site_info[0]["dns_report"],true);
							if(count($dns_report)>0)
							{ ?>
								<div class="col-xs-12">								
									<h5>DNS Report </h5>
									<div class="highlight_header_content_large2 table-resposive no_padding table-responsive-vertical">
										<?php 										
											echo "<table class='table table-bordered table-striped table-hover'>";
											echo "<tr class='success'>";
												echo "<td>SL</td>";
												echo "<td>Host</td>";
												echo "<td>Class</td>";
												echo "<td>TTL</td>";
												echo "<td>Type</td>";
												echo "<td>PRI</td>";
												echo "<td>Target</td>";
												echo "<td>IP</td>";
											echo "</tr>";
											$sl=0;
											foreach ($dns_report as $value) 
											{
												$sl++;
												if(!isset($value["host"]))  $value["host"]="";
												if(!isset($value["class"])) $value["class"]="";
												if(!isset($value["ttl"]))   $value["ttl"]="";
												if(!isset($value["type"]))  $value["type"]="";
												if(!isset($value["pri"])) 	$value["pri"]="";
												if(!isset($value["target"]))$value["target"]="";
												if(!isset($value["ip"])) 	$value["ip"]="";
												if($value["type"]=="AAAA")
													$value["ip"]=$value["ipv6"];
										
												echo "<tr>";
													echo "<td>".$sl."</td>";
													echo "<td>".$value["host"]."</td>";
													echo "<td>".$value["class"]."</td>";
													echo "<td>".$value["ttl"]."</td>";
													echo "<td>".$value["type"]."</td>";
													echo "<td>".$value["pri"]."</td>";
													echo "<td>".$value["target"]."</td>";
													echo "<td>".$value["ip"]."</td>";
												echo "</tr>";
											}
											echo "</table>";
										?>
									</div>						
								</div>
							<?php } 
							else echo '<div class="col-xs-12"><h5 class=" alert alert-warning"> <i class="fa fa-remove"></i> No DNS report found</h5></div>';?>
						</div>
					</div>
				</div> 	<!--  ip dns end-->
			</div>
		</div>






		<div class="row">
			<div class="col-xs-12">				
				<!-- ip can start-->
				<?php 
				$check=$site_info[0]["is_ip_canonical"]; 
				$item=$this->lang->line("IP Canonicalization Test");
				$long_recommendation=$this->lang->line('ip_canonicalization_recommendation');
				if($check=="0") //error
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("Site failed IP canonicalization test.");
				}
				else //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Site passed IP canonicalization test.");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 250px; overflow-y:auto;overflow-x:hidden"'?>>
						<?php echo $short_recommendation; ?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  ip can end-->
			</div>
		</div>




		<div class="row">
			<div class="col-xs-12">				
				<!-- url can start-->
				<?php 
				$check=$site_info[0]["is_url_canonicalized"]; 
				$item=$this->lang->line("URL Canonicalization Test");
				$long_recommendation=$this->lang->line('url_canonicalization_recommendation');
				if($check=="0") //error
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("Site failed URL canonicalization test.");
				}
				else //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Site passed URL canonicalization test.");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 350px; overflow-y:auto;overflow-x:hidden"'?>>
						<?php echo $short_recommendation; ?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--  url can end-->
			</div>
		</div>





		<div class="row">
			<div class="col-xs-12">				
				<!--  plain email start-->
				<?php 
				$value=json_decode($site_info[0]["email_list"],true);
				$check=count($value);
				$item=$this->lang->line("Plain Text Email Test");
				$long_recommendation=$this->lang->line('plain_email_recommendation');
				if($check==0) //ok
				{
					$class="green";
					$status="check";
					$short_recommendation=$this->lang->line("Site passed plain text email test. No plain text email found.");
				}
				else //warning
				{
					$class="red";
					$status="remove";
					$short_recommendation=$this->lang->line("Site failed plain text email test.").$check.$this->lang->line("plain text email found.");
				}
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 400px; overflow-y:auto;overflow-x:hidden"'?>>
						<?php 
							echo $short_recommendation; 
							if($check>0)
							{ ?>															
								<br><br>
								<h3 class="highlight_header"><?php echo $this->lang->line("Plain Text Email List"); ?></h3>
								<div class="highlight_header_content">
									<ul>
										<?php 
											foreach ($value as $val) 
											{
												echo "<li>".$val."</li>";
											}
										?>
									</ul>
								</div>	
							<?php
							}
						?>
						<br/><br/>
						<a  class="recommendation_link" title="<?php echo $item; ?> : <?php echo $recommendation_word; ?>"> <i class="fa fa-book"></i> <b><?php echo $recommendation_word; ?></b></a>
						<div class="recommendation well"><?php echo $long_recommendation; ?></div>

					</div>
				</div> 
				<!--   plain email end-->
			</div>
		</div>





		<div class="row">
			<div class="col-xs-12">				
				<!-- sitemap start-->
				<?php 
				$item=$this->lang->line("cURL Response");				
				$class="blue-dark";
				$status="info-circle";
				
				?>
				<div class="box box-<?php echo $class;?>">
					<div class="box-header with-border">
						<h3 class="box-title <?php echo $class;?>"><i class="fa fa-<?php echo $status;?>"></i> <?php echo $item; ?></h3>
						<div class="box-tools pull-right">
							<i class="fa fa-minus minus"></i>
						</div>
					</div>
					<div class="box-body chart-responsive minus clearfix">

						<div class="row">
							<div class="col-xs-12 table-responsive" <?php if($compare_report == 1 && $is_pdf == 0) echo 'style="height: 500px; overflow-y:auto;overflow-x:hidden"'?>>
								<?php $curl_response=json_decode($site_info[0]["general_curl_response"],true) ?>
									<?php 										
										echo "<table class='table table-condensed table-striped table-bordered'>";
										$sl=0;
										foreach ($curl_response as $key=>$value) 
										{
											if(is_array($value)) $value=implode(",", $value);
											$sl++;
											if(($sl+1)%2==0)
											echo "<tr>";
												echo "<td><b>".str_replace("_"," ",$key)."</b></td>";
												echo "<td>".$value."</td>";
											if($sl%2==0)
											echo "</tr>";
										}
										echo "</table>";
									?>
							</div>

						</div>

					</div>
				</div> 
				<!--  sitemap end-->
			</div>
		</div>

			<div class="row">
				<div class="col-xs-12">
					<div class="box box-blue">
						<div class="box-header with-border">
							<h3 class="box-title blue-dark"><i class="fa fa-mobile"></i> <?php echo $this->lang->line('PageSpeed Insights (Mobile)'); ?></h3>
							<div class="box-tools pull-right">
								<i class="fa fa-minus minus"></i>
							</div>
						</div>

						<div class="box-body" id="mobile-collapse">
							<?php 							

							   $mobile_lighthouseresult_categories = json_decode($site_info[0]['mobile_lighthouseresult_categories'],true);

							   $mobile_lighthouseresult_configsettings = json_decode($site_info[0]['mobile_lighthouseresult_configsettings'],true);

							   $mobile_loadingexperience_metrics = json_decode($site_info[0]['mobile_loadingexperience_metrics'],true);					   	
							   $mobile_originloadingexperience_metrics = json_decode($site_info[0]['mobile_originloadingexperience_metrics'],true);	

							   $mobile_lighthouseresult_audits = json_decode($site_info[0]['mobile_lighthouseresult_audits'],true);

							   $first_meaningful_paint_mobile = isset($mobile_lighthouseresult_audits['first-meaningful-paint']['score']) ? $mobile_lighthouseresult_audits['first-meaningful-paint']['score'] : 0;
							   $speed_index_mobile = isset($mobile_lighthouseresult_audits['speed-index']['score']) ? $mobile_lighthouseresult_audits['speed-index']['score'] : 0;
							   $first_cpu_idle_mobile = isset($mobile_lighthouseresult_audits['first-cpu-idle']['score']) ? $mobile_lighthouseresult_audits['first-cpu-idle']['score'] : 0;
							   $first_contentful_paint_mobile = isset($mobile_lighthouseresult_audits['first-contentful-paint']['score']) ? $mobile_lighthouseresult_audits['first-contentful-paint']['score'] : 0;
							   $interactive_mobile = isset($mobile_lighthouseresult_audits['interactive']['score']) ? $mobile_lighthouseresult_audits['interactive']['score'] : 0;

							   $mobile_score = ($first_meaningful_paint_mobile*7)+($speed_index_mobile*27)+($first_cpu_idle_mobile*13)+($first_contentful_paint_mobile*20)+($interactive_mobile*33);  				   						   
							   	
							?>
							<?php if (empty($mobile_lighthouseresult_categories)): ?>
								<div class="alert alert-warning alert-dismissible">
								  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								    <h4><i class="icon fa fa-warning"></i> <?php echo $this->lang->line("Warning"); ?></h4>
								    <?php echo isset($site_info[0]['mobile_google_api_error']) ? $site_info[0]['mobile_google_api_error'] : ""; ?><br>
								    <a target='_BLANK' href="https://console.developers.google.com/apis/library"><?php echo $this->lang->line("Enable Google PageInsights API from here"); ?></a>

								</div>
							<?php else: ?>
								<div class="row">
									<div class="col-xs-12 col-md-6">						
										<p style="text-align: center;position: relative;">
										    <div style="display:inline;width:120px;height:120px;"><canvas width="120" height="120"></canvas><input type="text" class="dial knob" data-readonly="true" value="<?php echo $mobile_score; ?>" data-width="120" data-height="120" data-fgcolor="#6777ef" data-thickness=".1" readonly="readonly" style="width: 64px; height: 40px; position: absolute; vertical-align: middle; margin-top: 40px; margin-left: -92px; border: 0px; background: none; font: bold 24px Arial; text-align: center; color: rgb(103, 119, 239); padding: 0px; -webkit-appearance: none;"></div>
										</p>
										<h4 class="text-warning" style="margin-left: 21%"><?php echo $this->lang->line('Performance'); ?></h4>
									</div>
									<div class="col-xs-12 col-md-6">
										<ul class="list-group <?php if($is_pdf == 1) echo "pdf-heading";?>">
											<div class="<?php if($is_pdf == 1) echo "heading_styles";?>" <?php if($is_pdf == 1) echo "style='height:auto'"?>>
												<li class="list-group-item">
													<?php echo $this->lang->line("Emulated Form Factor"); ?>
													<span class="badge badge-primary badge-pill">
														<?php  

															if(isset($mobile_lighthouseresult_configsettings['emulatedFormFactor']))
																echo ucwords($mobile_lighthouseresult_configsettings['emulatedFormFactor']);
														?>
															
														</span>
												</li>
												<li class="list-group-item">
													<?php echo $this->lang->line("Locale") ?>
													<span class="badge badge-primary badge-pill">
														<?php 
															if(isset($mobile_lighthouseresult_configsettings['locale']))
																echo ucwords($mobile_lighthouseresult_configsettings['locale']);
														 ?>
													</span>
												</li>									
												<li class="list-group-item">
													<?php echo $this->lang->line("Category") ?>
													<span class="badge badge-primary badge-pill">
														<?php 
															if(isset($mobile_lighthouseresult_configsettings['onlyCategories'][0]))
																echo ucwords($mobile_lighthouseresult_configsettings['onlyCategories'][0]);
														 ?>
													</span>
												</li>
											</div>
										</ul>
									</div>
								</div>
								<div class="row mt-5">
									<div class="<?php if($compare_report == 1) echo "col-xs-12"; else echo "col-xs-12 col-md-8"; ?> ">
										<ul class="list-group pdf-heading" <?php if($is_pdf == 1) echo "style='padding: 20px;'"?>>
											<li class="list-group-item active"><?php echo $this->lang->line("Field Data"); ?>
												<i data-description="<h2 class='section-title'><?php echo $this->lang->line('Field Data'); ?></h2> <p style='font-size: 12px;'><?php echo $this->lang->line('Over the last 30 days, the field data shows that this page has an <b>Moderate</b> speed compared to other pages in the') ?> <b><a target='_BLANK' href='https://developers.google.com/web/tools/chrome-user-experience-report/'></b> <?php echo $this->lang->line('Chrome User Experience Report') ?></a>. <?php echo $this->lang->line('We are showing') ?> <b> <a target='_BLANK' href='https://developers.google.com/speed/docs/insights/v5/about#faq'><?php echo $this->lang->line('the 75th percentile of FCP') ?></b> <b></a> and <a target='_BLANK' href='https://developers.google.com/speed/docs/insights/v5/about#faq'><?php echo $this->lang->line('the 95th percentile of FID') ?></a></b></p>" class="fa fa-info-circle field_data_modal" style="color: #fff;"></i>
											</li>  
											<div class="heading_styles" style="height: auto;">
												<li class="list-group-item">
													<?php echo $this->lang->line('First Contentful Paint (FCP)'); ?>
													<span class="badge badge-primary badge-pill">
													   <?php 
													   if(isset($mobile_loadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['percentile']))
													       echo $mobile_loadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['percentile'].' ms';
													    ?>
													        
													</span>
												</li>
												<li class="list-group-item">
													<?php echo $this->lang->line('FCP Metric Category'); ?>
													<span class="badge badge-primary badge-pill">
													    <?php 
													    if(isset($mobile_loadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['category']))
													        echo $mobile_loadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['category'];
													     ?>    
													</span>
												</li>
												<li class="list-group-item">
													<?php echo $this->lang->line('First Input Delay (FID)'); ?>
													<span class="badge badge-primary badge-pill">
													   <?php 

													   if(isset($mobile_loadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['percentile']))
													       echo $mobile_loadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['percentile'].' ms';
													    ?>
													        
													</span>
												</li>
												<li class="list-group-item">
													<?php echo $this->lang->line('FID Metric Category'); ?>
													<span class="badge badge-primary badge-pill">
													   <?php 

													   if(isset($mobile_loadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['category']))
													       echo $mobile_loadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['category'];
													    ?>
													        
													</span>
												</li>
												<li class="list-group-item">
													<?php echo $this->lang->line('Overall Category'); ?>
													<span class="badge badge-primary badge-pill">
													    <?php 
													    if(isset($mobile_loadingexperience_metrics['overall_category']))
													        echo $mobile_loadingexperience_metrics['overall_category'];
													     ?>
													        
													</span>
												</li>
											</div>
										</ul>
									</div>
									<div class="<?php if($compare_report ==1) echo "col-xs-12 mt-5"; else echo "col-xs-12 col-md-4 pl-4"; ?> ">
										<div 
											<?php 
												$bgpos = '';
												if($is_pdf == 1) $bgpos = "background-position: top center;text-align:center;padding-left:0 !important;";

												if($compare_report ==1) echo 'style="padding-left:12px;height:530px;background: url('.base_url("assets/images/mobile.png").') no-repeat !important; '.$bgpos.'"'; 
												else echo 'style="padding-left:12px;height:530px;background: url('.base_url("assets/images/mobile.png").') no-repeat !important; '.$bgpos.'"'; 
											?> 
										>
											<?php 
																	
											if(isset($mobile_lighthouseresult_audits['final-screenshot']['details']['data']))
											{

												echo '<img src="'.$mobile_lighthouseresult_audits['final-screenshot']['details']['data'].'" width="225px" style="margin-top:52px;display: inline-block;">';
											} 

											?>
										</div>
									</div>
								</div>
								<div class="row mt-4">
									<div class="<?php if($compare_report ==1) echo "col-xs-12"; else echo "col-xs-12 col-md-6" ?>">
		                                <ul class="list-group <?php if($is_pdf == 1) echo "pdf-heading";?>" <?php if($is_pdf == 1) echo "style='padding: 20px;'"?>>
		                                    <li class="list-group-item active"> <?php echo $this->lang->line('Origin Summary'); ?> <i data-description="<h2 class='section-title'><?php echo $this->lang->line('Origin Summary Data'); ?></h2><p style='font-size: 12px;'> <?php echo $this->lang->line('All pages served from this origin have a <b>Slow</b> speed compared to other pages in the'); ?> <a target='_BLANK' href='https://developers.google.com/web/tools/chrome-user-experience-report/'><?php echo $this->lang->line('Chrome User Experience Report') ?></a> <?php echo $this->lang->line('over the last 30 days.To view suggestions tailored to each page, analyze individual page URLs.') ?></p>" class="fa fa-info-circle field_data_modal" style="color: #fff;"></i>
		                                    </li>
		                                    <div class="heading_styles" style="height: auto;">
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('First Contentful Paint (FCP)'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($mobile_originloadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['percentile']))
		                                    	            echo $mobile_originloadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['percentile'].' ms';
		                                    	         ?>
		                                    	            
		                                    	    </span>
		                                    	</li>
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('FCP Metric Category'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($mobile_originloadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['category']))
		                                    	            echo $mobile_originloadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['category'];
		                                    	         ?>  
		                                    	    </span>
		                                    	</li>
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('First Input Delay (FID)'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	       <?php 

		                                    	       if(isset($mobile_originloadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['percentile']))
		                                    	           echo $mobile_originloadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['percentile'].' ms';
		                                    	        ?>
		                                    	            
		                                    	    </span>
		                                    	</li>                                    
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('FID Metric Category'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	       <?php 
		                                    	       if(isset($mobile_originloadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['category']))
		                                    	           echo $mobile_originloadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['category'];
		                                    	        ?>
		                                    	            
		                                    	    </span>
		                                    	</li>                                    
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('Overall Category'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($mobile_originloadingexperience_metrics['overall_category']))
		                                    	            echo $mobile_originloadingexperience_metrics['overall_category'];
		                                    	         ?>
		                                    	            
		                                    	    </span>
		                                    	</li>
		                                    </div>
		                                </ul>

									</div>
									<div class="<?php if($compare_report ==1) echo "col-xs-12 mt-5"; else echo "col-xs-12 col-md-6" ?>">
		                                <ul class="list-group pdf-heading" <?php if($is_pdf == 1) echo "style='padding: 20px;'"?>>
		                                    <li class="list-group-item active"> <?php echo $this->lang->line('Lab Data'); ?> 
		                                    </li>
		                                    <div class="heading_styles" style="height:auto">
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('First Contentful Paint'); ?><i data-description="<h2 class='section-title'><?php echo $this->lang->line('First Contentful Paint'); ?></h2> <p style='font-size: 12px;line-height: initial;'><?php echo $this->lang->line('First Contentful Paint marks the time at which the first text or image is painted.'); ?> <b><a target='_BLANK' class='text-danger' href='https://web.dev/first-contentful-paint/?utm_source=lighthouse&utm_medium=unknown'><?php echo $this->lang->line('Learn more'); ?></a></b> </p>" class="fa fa-info-circle field_data_modal" style="margin-right: 282px;"></i>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($mobile_lighthouseresult_audits['first-contentful-paint']['displayValue']))
		                                    	            echo $mobile_lighthouseresult_audits['first-contentful-paint']['displayValue'];
		                                    	         ?>
		                                    	            
		                                    	    </span>
		                                    	</li>
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('First Meaningful Paint'); ?><i data-description="<h2 class='section-title'><?php echo $this->lang->line('First Meaningful Paint'); ?></h2>
		                                    	        <p style='font-size: 12px;line-height: initial;'><?php echo $this->lang->line('First Meaningful Paint measures when the primary content of a page is visible.'); ?> <b><a target='_BLANK' class='text-danger' href='https://web.dev/first-meaningful-paint?utm_source=lighthouse&utm_medium=unknown'><?php echo $this->lang->line('Learn more'); ?></a></b> </p>" class="fa fa-info-circle field_data_modal" style="margin-right: 282px;"></i>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($mobile_lighthouseresult_audits['first-meaningful-paint']['displayValue']))
		                                    	            echo $mobile_lighthouseresult_audits['first-meaningful-paint']['displayValue'];
		                                    	        ?>
		                                    	        
		                                    	    </span>
		                                    	</li>
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('Speed Index'); ?> <i data-description="<h2 class='section-title'><?php echo $this->lang->line('Speed Index'); ?></h2>
		                                    	    <p style='font-size: 12px;line-height: initial;'><?php echo $this->lang->line('Speed Index shows how quickly the contents of a page are visibly populated.'); ?> <b><a target='_BLANK' class='text-danger' href='https://web.dev/speed-index?utm_source=lighthouse&utm_medium=unknown'><?php echo $this->lang->line('Learn more'); ?></a></b> </p>" class="fa fa-info-circle field_data_modal" style="margin-right: 330px"></i>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	       <?php 

		                                    	       if(isset($mobile_lighthouseresult_audits['speed-index']['displayValue']))
		                                    	         echo $mobile_lighthouseresult_audits['speed-index']['displayValue'];
		                                    	        ?>
		                                    	            
		                                    	    </span>
		                                    	</li>                                    
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('First CPU Idle'); ?> <i data-description="<h2 class='section-title'><?php echo $this->lang->line('First CPU Idle'); ?></h2>
		                                    	    <p style='font-size: 12px;line-height: initial;'><?php echo $this->lang->line('First CPU Idle marks the first time at which the page main thread is quiet enough to handle input.'); ?> <b><a target='_BLANK' class='text-danger' href='https://web.dev/first-cpu-idle?utm_source=lighthouse&utm_medium=unknown'><?php echo $this->lang->line('Learn more'); ?></a></b> </p>" class="fa fa-info-circle field_data_modal" style="margin-right: 320"></i>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	       <?php 
		                                    	       if(isset($mobile_lighthouseresult_audits['first-cpu-idle']['displayValue']))
		                                    	           echo $mobile_lighthouseresult_audits['first-cpu-idle']['displayValue'];
		                                    	        ?>
		                                    	            
		                                    	    </span>
		                                    	</li>                                    
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('Time to Interactive'); ?> <i class="fa fa-info-circle field_data_modal" style="margin-right: 290px;" data-description="<h2 class='section-title'><?php echo $this->lang->line('Time to Interactive'); ?></h2>
		                                    	    <p style='font-size: 12px;line-height: initial;'><?php echo $this->lang->line('Time to interactive is the amount of time it takes for the page to become fully interactive.'); ?> <b><a target='_BLANK' class='text-danger' href='https://web.dev/interactive/?utm_source=lighthouse&utm_medium=unknown'><?php echo $this->lang->line('Learn more'); ?></a></b> </p>"></i>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($mobile_lighthouseresult_audits['interactive']['displayValue']))
		                                    	            echo $mobile_lighthouseresult_audits['interactive']['displayValue'];
		                                    	         ?>
		                                    	            
		                                    	    </span>
		                                    	</li>                                    

		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('Max Potential First Input Delay'); ?> <i class="fa fa-info-circle field_data_modal" style="margin-right: 200px;" data-description="<h2 class='section-title'><?php echo $this->lang->line('Max Potential First Input Delay'); ?></h2>
		                                    	        <p style='font-size: 12px;line-height: initial;'><?php echo $this->lang->line('The maximum potential First Input Delay that your users could experience is the duration, in milliseconds, of the longest task.'); ?> <b><a target='_BLANK' class='text-danger' href='https://web.dev/fid/'><?php echo $this->lang->line('Learn more'); ?></a></b> </p>"></i>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($mobile_lighthouseresult_audits['max-potential-fid']['displayValue']))
		                                    	            echo $mobile_lighthouseresult_audits['max-potential-fid']['displayValue'];
		                                    	         ?>
		                                    	            
		                                    	    </span>
		                                    	</li>
		                                    </div>
		                                </ul>
									</div>
								</div>
								<div class="row mt-5">
									<div class="col-xs-12">
									    <div class="box box-blue-dark">
									        <div class="box-header with-border">
									            <h3 class="box-title blue-dark" style="color: #6777ef!important;"><?php echo $this->lang->line("Audit Data") ?></h3>
									            <div class="box-tools pull-right"><i class="fa fa-minus minus"></i></div>
									        </div>

									          <div class="box-body chart-responsive minus">
												<div class="row mt-5">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['resource-summary']['title']))
																	    echo $mobile_lighthouseresult_audits['resource-summary']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['resource-summary']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['resource-summary']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['resource-summary']['description'])){

												                $resource_sum = explode('[',$mobile_lighthouseresult_audits['resource-summary']['description']);

												                echo '<p>'.$resource_sum[0].'<b><a class="text-danger" target="_BLANK" href="https://developers.google.com/web/tools/lighthouse/audits/budgets">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['time-to-first-byte']['title']))
																	    echo $mobile_lighthouseresult_audits['time-to-first-byte']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['time-to-first-byte']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['time-to-first-byte']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['time-to-first-byte']['description'])){

												                $time_to_first_byte = explode('[',$mobile_lighthouseresult_audits['time-to-first-byte']['description']);

												                echo '<p>'.$time_to_first_byte[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/time-to-first-byte">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['render-blocking-resources']['title']))
																	    echo $mobile_lighthouseresult_audits['render-blocking-resources']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['render-blocking-resources']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['render-blocking-resources']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['render-blocking-resources']['description'])){

												                $render_blocking = explode('[',$mobile_lighthouseresult_audits['render-blocking-resources']['description']);

												                echo '<p>'.$render_blocking[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/render-blocking-resources">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['uses-optimized-images']['title']))
																	    echo $mobile_lighthouseresult_audits['uses-optimized-images']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['uses-optimized-images']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['uses-optimized-images']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['uses-optimized-images']['description'])){

												                $render_blocking = explode('[',$mobile_lighthouseresult_audits['uses-optimized-images']['description']);

												                echo '<p>'.$render_blocking[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/uses-optimized-images">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['uses-text-compression']['title']))
																	    echo $mobile_lighthouseresult_audits['uses-text-compression']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['uses-text-compression']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['uses-text-compression']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['uses-text-compression']['description'])){

												                $text_compresseion = explode('[',$mobile_lighthouseresult_audits['uses-text-compression']['description']);

												                echo '<p>'.$text_compresseion[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/uses-text-compression">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['uses-long-cache-ttl']['title']))
																	    echo $mobile_lighthouseresult_audits['uses-long-cache-ttl']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['uses-long-cache-ttl']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['uses-long-cache-ttl']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['uses-long-cache-ttl']['description'])){

												                $uses_long_cache = explode('[',$mobile_lighthouseresult_audits['uses-long-cache-ttl']['description']);

												                echo '<p>'.$uses_long_cache[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/uses-long-cache-ttl">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['third-party-summary']['title']))
																	    echo $mobile_lighthouseresult_audits['third-party-summary']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['third-party-summary']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['third-party-summary']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['third-party-summary']['description'])){

												                $third_party_summary = explode('[',$mobile_lighthouseresult_audits['third-party-summary']['description']);

												                echo '<p>'.$third_party_summary[0].'<b><a class="text-danger" target="_BLANK" href="https://developers.google.com/web/fundamentals/performance/optimizing-content-efficiency/loading-third-party-javascript">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['estimated-input-latency']['title']))
																	    echo $mobile_lighthouseresult_audits['estimated-input-latency']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['estimated-input-latency']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['estimated-input-latency']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['estimated-input-latency']['description'])){

												                $third_party_summary = explode('[',$mobile_lighthouseresult_audits['estimated-input-latency']['description']);

												                echo '<p>'.$third_party_summary[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/estimated-input-latency">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['first-contentful-paint-3g']['title']))
																	    echo $mobile_lighthouseresult_audits['first-contentful-paint-3g']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['first-contentful-paint-3g']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['first-contentful-paint-3g']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['first-contentful-paint-3g']['description'])){

												                $fcp3g = explode('[',$mobile_lighthouseresult_audits['first-contentful-paint-3g']['description']);

												                echo '<p>'.$fcp3g[0].'<b><a class="text-danger" target="_BLANK" href="https://developers.google.com/web/tools/lighthouse/audits/first-contentful-paint">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['total-blocking-time']['title']))
																	    echo $mobile_lighthouseresult_audits['total-blocking-time']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['total-blocking-time']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['total-blocking-time']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['total-blocking-time']['description'])){

												                $total_blocking_time1 = explode('[',$mobile_lighthouseresult_audits['total-blocking-time']['description']);

												                echo '<p>'.$total_blocking_time1[0].'</p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['bootup-time']['title']))
																	    echo $mobile_lighthouseresult_audits['bootup-time']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['bootup-time']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['bootup-time']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['bootup-time']['description'])){

												                $boottime = explode('[',$mobile_lighthouseresult_audits['bootup-time']['description']);

												                echo '<p>'.$boottime[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/bootup-time">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>													
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['offscreen-images']['title']))
																	    echo $mobile_lighthouseresult_audits['offscreen-images']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['offscreen-images']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['offscreen-images']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['offscreen-images']['description'])){

												                $offscreen_des = explode('[',$mobile_lighthouseresult_audits['offscreen-images']['description']);

												                echo '<p>'.$offscreen_des[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/offscreen-images">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['network-server-latency']['title']))
																	    echo $mobile_lighthouseresult_audits['network-server-latency']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['network-server-latency']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['network-server-latency']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['network-server-latency']['description'])){

												                $network_server_lat = explode('[',$mobile_lighthouseresult_audits['network-server-latency']['description']);

												                echo '<p>'.$network_server_lat[0].'<b><a class="text-danger" target="_BLANK" href="https://hpbn.co/primer-on-web-performance/#analyzing-the-resource-waterfall">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['uses-responsive-images']['title']))
																	    echo $mobile_lighthouseresult_audits['uses-responsive-images']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['uses-responsive-images']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['uses-responsive-images']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['uses-responsive-images']['description'])){

												                $uses_responsive = explode('[',$mobile_lighthouseresult_audits['uses-responsive-images']['description']);

												                echo '<p>'.$uses_responsive[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/uses-responsive-images?utm_source=lighthouse&utm_medium=unknown">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['unused-css-rules']['title']))
																	    echo $mobile_lighthouseresult_audits['unused-css-rules']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['unused-css-rules']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['unused-css-rules']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['unused-css-rules']['description'])){

												                $unused_css = explode('[',$mobile_lighthouseresult_audits['unused-css-rules']['description']);

												                echo '<p>'.$unused_css[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/unused-css-rules">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>													
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['total-byte-weight']['title']))
																	    echo $mobile_lighthouseresult_audits['total-byte-weight']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['total-byte-weight']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['total-byte-weight']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['total-byte-weight']['description'])){

												                $total_byte = explode('[',$mobile_lighthouseresult_audits['total-byte-weight']['description']);

												                echo '<p>'.$total_byte[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/total-byte-weight">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>													
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['mainthread-work-breakdown']['title']))
																	    echo $mobile_lighthouseresult_audits['mainthread-work-breakdown']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['mainthread-work-breakdown']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['mainthread-work-breakdown']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['mainthread-work-breakdown']['description'])){

												                $mainthred_work = explode('[',$mobile_lighthouseresult_audits['mainthread-work-breakdown']['description']);

												                echo '<p>'.$mainthred_work[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/mainthread-work-breakdown">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>													
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['uses-webp-images']['title']))
																	    echo $mobile_lighthouseresult_audits['uses-webp-images']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['uses-webp-images']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['uses-webp-images']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['uses-webp-images']['description'])){

												                $uses_web_images = explode('[',$mobile_lighthouseresult_audits['uses-webp-images']['description']);

												                echo '<p>'.$uses_web_images[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/uses-webp-images">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>													
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['critical-request-chains']['title']))
																	    echo $mobile_lighthouseresult_audits['critical-request-chains']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['critical-request-chains']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['critical-request-chains']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['critical-request-chains']['description'])){

												                $critical_request_chains = explode('[',$mobile_lighthouseresult_audits['critical-request-chains']['description']);

												                echo '<p>'.$critical_request_chains[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/critical-request-chains">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>													
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['dom-size']['title']))
																	    echo $mobile_lighthouseresult_audits['dom-size']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['dom-size']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['dom-size']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['dom-size']['description'])){

												                $dom_size1 = explode('[',$mobile_lighthouseresult_audits['dom-size']['description']);

												                echo '<p>'.$dom_size1[0].'<b><a class="text-danger" target="_BLANK" href="https://developers.google.com/web/fundamentals/performance/rendering/reduce-the-scope-and-complexity-of-style-calculations">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['redirects']['title']))
																	    echo $mobile_lighthouseresult_audits['redirects']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['redirects']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['redirects']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['redirects']['description'])){

												                $redirects_des = explode('[',$mobile_lighthouseresult_audits['redirects']['description']);

												                echo '<p>'.$redirects_des[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/redirects">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>													
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['unminified-javascript']['title']))
																	    echo $mobile_lighthouseresult_audits['unminified-javascript']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['unminified-javascript']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['unminified-javascript']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['unminified-javascript']['description'])){

												                $unminified_js = explode('[',$mobile_lighthouseresult_audits['unminified-javascript']['description']);

												                echo '<p>'.$unminified_js[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/unminified-javascript">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>													
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['user-timings']['title']))
																	    echo $mobile_lighthouseresult_audits['user-timings']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['user-timings']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['user-timings']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['user-timings']['description'])){

												                $user_times = explode('[',$mobile_lighthouseresult_audits['user-timings']['description']);

												                echo '<p>'.$user_times[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/user-timings">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>													
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($mobile_lighthouseresult_audits['network-rtt']['title']))
																	    echo $mobile_lighthouseresult_audits['network-rtt']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($mobile_lighthouseresult_audits['network-rtt']['displayValue']))
												                		echo $mobile_lighthouseresult_audits['network-rtt']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($mobile_lighthouseresult_audits['network-rtt']['description'])){

												                $network_rtt = explode('[',$mobile_lighthouseresult_audits['network-rtt']['description']);

												                echo '<p>'.$network_rtt[0].'<b><a class="text-danger" target="_BLANK" href="https://hpbn.co/primer-on-latency-and-bandwidth/">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>	
									          </div>
									     </div>
									</div>
								</div>

							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>			
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-blue">
						<div class="box-header with-border">
							<h3 class="box-title blue-dark"><i class="fa fa-desktop"></i> <?php echo $this->lang->line('PageSpeed Insights (Desktop)'); ?></h3>
							<div class="box-tools pull-right">
								<i class="fa fa-minus minus"></i>
							</div>
						</div>

						<div class="box-body" id="mobile-collapse">
							<?php 							

							   $desktop_lighthouseresult_categories = json_decode($site_info[0]['desktop_lighthouseresult_categories'],true);

							   $desktop_lighthouseresult_configsettings = json_decode($site_info[0]['desktop_lighthouseresult_configsettings'],true);

							   $desktop_loadingexperience_metrics = json_decode($site_info[0]['desktop_loadingexperience_metrics'],true);					   	
							   $desktop_originloadingexperience_metrics = json_decode($site_info[0]['desktop_originloadingexperience_metrics'],true);	

							   $desktop_lighthouseresult_audits = json_decode($site_info[0]['desktop_lighthouseresult_audits'],true);

							   $first_meaningful_paint_desktop = isset($desktop_lighthouseresult_audits['first-meaningful-paint']['score']) ? $desktop_lighthouseresult_audits['first-meaningful-paint']['score'] : 0;
							   $speed_index_desktop = isset($desktop_lighthouseresult_audits['speed-index']['score']) ? $desktop_lighthouseresult_audits['speed-index']['score'] : 0;
							   $first_cpu_idle_desktop = isset($desktop_lighthouseresult_audits['first-cpu-idle']['score']) ? $desktop_lighthouseresult_audits['first-cpu-idle']['score'] : 0;
							   $first_contentful_paint_desktop = isset($desktop_lighthouseresult_audits['first-contentful-paint']['score']) ? $desktop_lighthouseresult_audits['first-contentful-paint']['score'] : 0;
							   $interactive_desktop = isset($desktop_lighthouseresult_audits['interactive']['score']) ? $desktop_lighthouseresult_audits['interactive']['score'] : 0;

							   $desktop_score = ($first_meaningful_paint_desktop*7)+($speed_index_desktop*27)+($first_cpu_idle_desktop*13)+($first_contentful_paint_desktop*20)+($interactive_desktop*33);  				   						   
							   	
							?>
							<?php if (empty($desktop_lighthouseresult_categories)): ?>
								<div class="alert alert-warning alert-dismissible">
								  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								    <h4 class="alert-title"><i class="icon fa fa-warning"></i><?php echo $this->lang->line("Warning"); ?></h4>
								    <?php echo isset($site_info[0]['desktop_google_api_error']) ? $site_info[0]['mobile_google_api_error'] : ""; ?><br>
								    <a target='_BLANK' href="https://console.developers.google.com/apis/library"><?php echo $this->lang->line("Enable Google PageInsights API from here"); ?></a>
								</div>
							<?php else: ?>
								<div class="row">
									<div class="col-xs-12 col-md-6">						
										<p style="text-align: center;position: relative;">
										    <div style="display:inline;width:120px;height:120px;"><canvas width="120" height="120"></canvas><input type="text" class="dial knob" data-readonly="true" value="<?php echo $desktop_score; ?>" data-width="120" data-height="120" data-fgcolor="#6777ef" data-thickness=".1" readonly="readonly" style="width: 64px; height: 40px; position: absolute; vertical-align: middle; margin-top: 40px; margin-left: -92px; border: 0px; background: none; font: bold 24px Arial; text-align: center; color: rgb(103, 119, 239); padding: 0px; -webkit-appearance: none;"></div>
										</p>
										<h4 class="text-warning" style="margin-left: 21%"><?php echo $this->lang->line('Performance'); ?></h4>
									</div>
									<div class="col-xs-12 col-md-6">
										<ul class="list-group pdf-heading">
											<div class="heading_styles">
												<li class="list-group-item">
													<?php echo $this->lang->line("Emulated Form Factor"); ?>
													<span class="badge badge-primary badge-pill">
														<?php  

															if(isset($desktop_lighthouseresult_configsettings['emulatedFormFactor']))
																echo ucwords($desktop_lighthouseresult_configsettings['emulatedFormFactor']);
														?>
															
														</span>
												</li>
												<li class="list-group-item">
													<?php echo $this->lang->line("Locale") ?>
													<span class="badge badge-primary badge-pill">
														<?php 
															if(isset($desktop_lighthouseresult_configsettings['locale']))
																echo ucwords($desktop_lighthouseresult_configsettings['locale']);
														 ?>
													</span>
												</li>									
												<li class="list-group-item">
													<?php echo $this->lang->line("Category") ?>
													<span class="badge badge-primary badge-pill">
														<?php 
															if(isset($desktop_lighthouseresult_configsettings['onlyCategories'][0]))
																echo ucwords($desktop_lighthouseresult_configsettings['onlyCategories'][0]);
														 ?>
													</span>
												</li>
											</div>
										</ul>
									</div>
								</div>
								<div class="row mt-5">
									<div class="col-xs-12 col-md-6">
		                                <ul class="list-group pdf-heading" <?php if($is_pdf == 1) echo "style='padding: 20px;'"?>>
		                                    <li class="list-group-item active"> <?php echo $this->lang->line('Field Data'); ?> <i data-description="<h2 class='section-title'><?php echo $this->lang->line('Field Data'); ?></h2> <p style='font-size: 12px;'><?php echo $this->lang->line('Over the last 30 days, the field data shows that this page has an <b>Moderate</b> speed compared to other pages in the') ?> <b><a target='_BLANK' href='https://developers.google.com/web/tools/chrome-user-experience-report/'></b> <?php echo $this->lang->line('Chrome User Experience Report') ?></a>. <?php echo $this->lang->line('We are showing') ?> <b> <a target='_BLANK' href='https://developers.google.com/speed/docs/insights/v5/about#faq'><?php echo $this->lang->line('the 75th percentile of FCP') ?></b> <b></a> and <a target='_BLANK' href='https://developers.google.com/speed/docs/insights/v5/about#faq'><?php echo $this->lang->line('the 95th percentile of FID') ?></a></b></p>" class="fa fa-info-circle field_data_modal" style="color: #fff;"></i>
		                                    </li>
		                                    <div class="heading_styles" style="height: auto;">
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('First Contentful Paint (FCP)'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	       <?php 
		                                    	       if(isset($desktop_loadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['percentile']))
		                                    	           echo $desktop_loadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['percentile'].' ms';
		                                    	        ?>
		                                    	            
		                                    	    </span>
		                                    	</li>
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('FCP Metric Category'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($desktop_loadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['category']))
		                                    	            echo $desktop_loadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['category'];
		                                    	         ?>    
		                                    	    </span>
		                                    	</li>
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('First Input Delay (FID)'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	       <?php 

		                                    	       if(isset($desktop_loadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['percentile']))
		                                    	           echo $desktop_loadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['percentile'].' ms';
		                                    	        ?>
		                                    	            
		                                    	    </span>
		                                    	</li>                                    
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('FID Metric Category'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	       <?php 

		                                    	       if(isset($desktop_loadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['category']))
		                                    	           echo $desktop_loadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['category'];
		                                    	        ?>
		                                    	            
		                                    	    </span>
		                                    	</li>                                    
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('Overall Category'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($desktop_loadingexperience_metrics['overall_category']))
		                                    	            echo $desktop_loadingexperience_metrics['overall_category'];
		                                    	         ?>
		                                    	            
		                                    	    </span>
		                                    	</li>
		                                    </div>
		                                </ul>
									</div>
									<div class="col-xs-12 col-md-6 pl-4">
										<?php 
																
										if(isset($desktop_lighthouseresult_audits['final-screenshot']['details']['data']))
										{

											echo '<img src="'.$desktop_lighthouseresult_audits['final-screenshot']['details']['data'].'" class="img-thumbnail">';
										} 

										?>
									</div>
								</div>
								<div class="row" style="margin-top: 10px;">
									<div class="<?php if($compare_report ==1) echo "col-xs-12"; else echo "col-xs-12 col-md-6" ?>">
		                                <ul class="list-group pdf-heading" <?php if($is_pdf == 1) echo "style='padding: 20px;'"?>>
		                                    <li class="list-group-item active"> <?php echo $this->lang->line('Origin Summary'); ?> <i data-description="<h2 class='section-title'><?php echo $this->lang->line('Origin Summary Data'); ?></h2><p style='font-size: 12px;'> <?php echo $this->lang->line('All pages served from this origin have a <b>Slow</b> speed compared to other pages in the'); ?> <a target='_BLANK' href='https://developers.google.com/web/tools/chrome-user-experience-report/'><?php echo $this->lang->line('Chrome User Experience Report') ?></a> <?php echo $this->lang->line('over the last 30 days.To view suggestions tailored to each page, analyze individual page URLs.') ?></p>" class="fa fa-info-circle field_data_modal" style="color: #fff;"></i>
		                                    </li>
		                                    <div class="heading_styles" style="height:auto;">
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('First Contentful Paint (FCP)'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($desktop_originloadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['percentile']))
		                                    	            echo $desktop_originloadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['percentile'].' ms';
		                                    	         ?>
		                                    	            
		                                    	    </span>
		                                    	</li>
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('FCP Metric Category'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($desktop_originloadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['category']))
		                                    	            echo $desktop_originloadingexperience_metrics['metrics']['FIRST_CONTENTFUL_PAINT_MS']['category'];
		                                    	         ?>  
		                                    	    </span>
		                                    	</li>
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('First Input Delay (FID)'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	       <?php 

		                                    	       if(isset($desktop_originloadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['percentile']))
		                                    	           echo $desktop_originloadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['percentile'].' ms';
		                                    	        ?>
		                                    	            
		                                    	    </span>
		                                    	</li>                                    
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('FID Metric Category'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	       <?php 
		                                    	       if(isset($desktop_originloadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['category']))
		                                    	           echo $desktop_originloadingexperience_metrics['metrics']['FIRST_INPUT_DELAY_MS']['category'];
		                                    	        ?>
		                                    	            
		                                    	    </span>
		                                    	</li>                                    
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('Overall Category'); ?>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($desktop_originloadingexperience_metrics['overall_category']))
		                                    	            echo $desktop_originloadingexperience_metrics['overall_category'];
		                                    	         ?>
		                                    	            
		                                    	    </span>
		                                    	</li>
		                                    </div>
		                                </ul>

									</div>
									<div class="<?php if($compare_report ==1) echo "col-xs-12 mt-5"; else echo "col-xs-12 col-md-6"; ?>">
		                                <ul class="list-group pdf-heading" <?php if($is_pdf == 1) echo "style='padding: 20px;'"?>>
		                                    <li class="list-group-item active"> <?php echo $this->lang->line('Lab Data'); ?> 
		                                    </li>
		                                    <div class="heading_styles" style="height:auto;">
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('First Contentful Paint'); ?><i data-description="<h2 class='section-title'><?php echo $this->lang->line('First Contentful Paint'); ?></h2> <p style='font-size: 12px;line-height: initial;'><?php echo $this->lang->line('First Contentful Paint marks the time at which the first text or image is painted.'); ?> <b><a target='_BLANK' class='text-danger' href='https://web.dev/first-contentful-paint/?utm_source=lighthouse&utm_medium=unknown'><?php echo $this->lang->line('Learn more'); ?></a></b> </p>" class="fa fa-info-circle field_data_modal" style="margin-right: 282px;"></i>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($desktop_lighthouseresult_audits['first-contentful-paint']['displayValue']))
		                                    	            echo $desktop_lighthouseresult_audits['first-contentful-paint']['displayValue'];
		                                    	         ?>
		                                    	            
		                                    	    </span>
		                                    	</li>
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('First Meaningful Paint'); ?><i data-description="<h2 class='section-title'><?php echo $this->lang->line('First Meaningful Paint'); ?></h2>
		                                    	        <p style='font-size: 12px;line-height: initial;'><?php echo $this->lang->line('First Meaningful Paint measures when the primary content of a page is visible.'); ?> <b><a target='_BLANK' class='text-danger' href='https://web.dev/first-meaningful-paint?utm_source=lighthouse&utm_medium=unknown'><?php echo $this->lang->line('Learn more'); ?></a></b> </p>" class="fa fa-info-circle field_data_modal" style="margin-right: 282px;"></i>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($desktop_lighthouseresult_audits['first-meaningful-paint']['displayValue']))
		                                    	            echo $desktop_lighthouseresult_audits['first-meaningful-paint']['displayValue'];
		                                    	        ?>
		                                    	        
		                                    	    </span>
		                                    	</li>
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('Speed Index'); ?> <i data-description="<h2 class='section-title'><?php echo $this->lang->line('Speed Index'); ?></h2>
		                                    	    <p style='font-size: 12px;line-height: initial;'><?php echo $this->lang->line('Speed Index shows how quickly the contents of a page are visibly populated.'); ?> <b><a target='_BLANK' class='text-danger' href='https://web.dev/speed-index?utm_source=lighthouse&utm_medium=unknown'><?php echo $this->lang->line('Learn more'); ?></a></b> </p>" class="fa fa-info-circle field_data_modal" style="margin-right: 330px"></i>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	       <?php 

		                                    	       if(isset($desktop_lighthouseresult_audits['speed-index']['displayValue']))
		                                    	         echo $desktop_lighthouseresult_audits['speed-index']['displayValue'];
		                                    	        ?>
		                                    	            
		                                    	    </span>
		                                    	</li>                                    
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('First CPU Idle'); ?> <i data-description="<h2 class='section-title'><?php echo $this->lang->line('First CPU Idle'); ?></h2>
		                                    	    <p style='font-size: 12px;line-height: initial;'><?php echo $this->lang->line('First CPU Idle marks the first time at which the page main thread is quiet enough to handle input.'); ?> <b><a target='_BLANK' class='text-danger' href='https://web.dev/first-cpu-idle?utm_source=lighthouse&utm_medium=unknown'><?php echo $this->lang->line('Learn more'); ?></a></b> </p>" class="fa fa-info-circle field_data_modal" style="margin-right: 320"></i>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	       <?php 
		                                    	       if(isset($desktop_lighthouseresult_audits['first-cpu-idle']['displayValue']))
		                                    	           echo $desktop_lighthouseresult_audits['first-cpu-idle']['displayValue'];
		                                    	        ?>
		                                    	            
		                                    	    </span>
		                                    	</li>                                    
		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('Time to Interactive'); ?> <i class="fa fa-info-circle field_data_modal" style="margin-right: 290px;" data-description="<h2 class='section-title'><?php echo $this->lang->line('Time to Interactive'); ?></h2>
		                                    	    <p style='font-size: 12px;line-height: initial;'><?php echo $this->lang->line('Time to interactive is the amount of time it takes for the page to become fully interactive.'); ?> <b><a target='_BLANK' class='text-danger' href='https://web.dev/interactive/?utm_source=lighthouse&utm_medium=unknown'><?php echo $this->lang->line('Learn more'); ?></a></b> </p>"></i>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($desktop_lighthouseresult_audits['interactive']['displayValue']))
		                                    	            echo $desktop_lighthouseresult_audits['interactive']['displayValue'];
		                                    	         ?>
		                                    	            
		                                    	    </span>
		                                    	</li>                                    

		                                    	<li class="list-group-item">
		                                    	    <?php echo $this->lang->line('Max Potential First Input Delay'); ?> <i class="fa fa-info-circle field_data_modal" style="margin-right: 200px;" data-description="<h2 class='section-title'><?php echo $this->lang->line('Max Potential First Input Delay'); ?></h2>
		                                    	        <p style='font-size: 12px;line-height: initial;'><?php echo $this->lang->line('The maximum potential First Input Delay that your users could experience is the duration, in milliseconds, of the longest task.'); ?> <b><a target='_BLANK' class='text-danger' href='https://web.dev/fid/'><?php echo $this->lang->line('Learn more'); ?></a></b> </p>"></i>
		                                    	    <span class="badge badge-primary badge-pill">
		                                    	        <?php 
		                                    	        if(isset($desktop_lighthouseresult_audits['max-potential-fid']['displayValue']))
		                                    	            echo $desktop_lighthouseresult_audits['max-potential-fid']['displayValue'];
		                                    	         ?>
		                                    	            
		                                    	    </span>
		                                    	</li>
		                                    </div>
		                                </ul>
									</div>
								</div>
								<div class="row mt-5">
									<div class="col-xs-12">
									    <div class="box box-blue-dark">
									        <div class="box-header with-border">
									            <h3 class="box-title blue-dark" style="color: #6777ef!important;"><?php echo $this->lang->line("Audit Data") ?></h3>
									            <div class="box-tools pull-right"><i class="fa fa-minus minus"></i></div>
									        </div>

									        <div class="box-body chart-responsive minus">
												<div class="row mt-5">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['resource-summary']['title']))
																	    echo $desktop_lighthouseresult_audits['resource-summary']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['resource-summary']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['resource-summary']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($desktop_lighthouseresult_audits['resource-summary']['description'])){

												                $resource_sum = explode('[',$desktop_lighthouseresult_audits['resource-summary']['description']);

												                echo '<p>'.$resource_sum[0].'<b><a class="text-danger" target="_BLANK" href="https://developers.google.com/web/tools/lighthouse/audits/budgets">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['time-to-first-byte']['title']))
																	    echo $desktop_lighthouseresult_audits['time-to-first-byte']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['time-to-first-byte']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['time-to-first-byte']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($desktop_lighthouseresult_audits['time-to-first-byte']['description'])){

												                $time_to_first_byte = explode('[',$desktop_lighthouseresult_audits['time-to-first-byte']['description']);

												                echo '<p>'.$time_to_first_byte[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/time-to-first-byte">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['render-blocking-resources']['title']))
																	    echo $desktop_lighthouseresult_audits['render-blocking-resources']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['render-blocking-resources']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['render-blocking-resources']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($desktop_lighthouseresult_audits['render-blocking-resources']['description'])){

												                $render_blocking = explode('[',$desktop_lighthouseresult_audits['render-blocking-resources']['description']);

												                echo '<p>'.$render_blocking[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/render-blocking-resources">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['uses-optimized-images']['title']))
																	    echo $desktop_lighthouseresult_audits['uses-optimized-images']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['uses-optimized-images']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['uses-optimized-images']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($desktop_lighthouseresult_audits['uses-optimized-images']['description'])){

												                $render_blocking = explode('[',$desktop_lighthouseresult_audits['uses-optimized-images']['description']);

												                echo '<p>'.$render_blocking[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/uses-optimized-images">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['uses-text-compression']['title']))
																	    echo $desktop_lighthouseresult_audits['uses-text-compression']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['uses-text-compression']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['uses-text-compression']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($desktop_lighthouseresult_audits['uses-text-compression']['description'])){

												                $text_compresseion = explode('[',$desktop_lighthouseresult_audits['uses-text-compression']['description']);

												                echo '<p>'.$text_compresseion[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/uses-text-compression">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['uses-long-cache-ttl']['title']))
																	    echo $desktop_lighthouseresult_audits['uses-long-cache-ttl']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['uses-long-cache-ttl']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['uses-long-cache-ttl']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($desktop_lighthouseresult_audits['uses-long-cache-ttl']['description'])){

												                $uses_long_cache = explode('[',$desktop_lighthouseresult_audits['uses-long-cache-ttl']['description']);

												                echo '<p>'.$uses_long_cache[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/uses-long-cache-ttl">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title box-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['third-party-summary']['title']))
																	    echo $desktop_lighthouseresult_audits['third-party-summary']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['third-party-summary']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['third-party-summary']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($desktop_lighthouseresult_audits['third-party-summary']['description'])){

												                $third_party_summary = explode('[',$desktop_lighthouseresult_audits['third-party-summary']['description']);

												                echo '<p>'.$third_party_summary[0].'<b><a class="text-danger" target="_BLANK" href="https://developers.google.com/web/fundamentals/performance/optimizing-content-efficiency/loading-third-party-javascript">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title box-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['estimated-input-latency']['title']))
																	    echo $desktop_lighthouseresult_audits['estimated-input-latency']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['estimated-input-latency']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['estimated-input-latency']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($desktop_lighthouseresult_audits['estimated-input-latency']['description'])){

												                $third_party_summary = explode('[',$desktop_lighthouseresult_audits['estimated-input-latency']['description']);

												                echo '<p>'.$third_party_summary[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/estimated-input-latency">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title box-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['first-contentful-paint-3g']['title']))
																	    echo $desktop_lighthouseresult_audits['first-contentful-paint-3g']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['first-contentful-paint-3g']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['first-contentful-paint-3g']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($desktop_lighthouseresult_audits['first-contentful-paint-3g']['description'])){

												                $fcp3g = explode('[',$desktop_lighthouseresult_audits['first-contentful-paint-3g']['description']);

												                echo '<p>'.$fcp3g[0].'<b><a class="text-danger" target="_BLANK" href="https://developers.google.com/web/tools/lighthouse/audits/first-contentful-paint">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['total-blocking-time']['title']))
																	    echo $desktop_lighthouseresult_audits['total-blocking-time']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['total-blocking-time']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['total-blocking-time']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
															  <?php

												                if(isset($desktop_lighthouseresult_audits['total-blocking-time']['description'])){

												                $total_blocking_time1 = explode('[',$desktop_lighthouseresult_audits['total-blocking-time']['description']);

												                echo '<p>'.$total_blocking_time1[0].'</p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>												
												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['bootup-time']['title']))
																	    echo $desktop_lighthouseresult_audits['bootup-time']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['bootup-time']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['bootup-time']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
												  			  <?php

												                  if(isset($desktop_lighthouseresult_audits['bootup-time']['description'])){

												                  $boottime = explode('[',$desktop_lighthouseresult_audits['bootup-time']['description']);

												                  echo '<p>'.$boottime[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/bootup-time">'.$this->lang->line("Learn More").'</a></b></p>';
												                  }

												                  ?>           
												            </div>
												        </div>
												    </div>
												</div>	

												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['offscreen-images']['title']))
																	    echo $desktop_lighthouseresult_audits['offscreen-images']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['offscreen-images']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['offscreen-images']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
									  			  			  <?php

									  			                  if(isset($desktop_lighthouseresult_audits['offscreen-images']['description'])){

									  			                  $offscreen_des = explode('[',$desktop_lighthouseresult_audits['offscreen-images']['description']);

									  			                  echo '<p>'.$offscreen_des[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/offscreen-images">'.$this->lang->line("Learn More").'</a></b></p>';
									  			                  }

									  			                  ?>           
												            </div>
												        </div>
												    </div>
												</div>

												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['network-server-latency']['title']))
																	    echo $desktop_lighthouseresult_audits['network-server-latency']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['network-server-latency']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['network-server-latency']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
						  			  			  			  <?php

						  			  			                  if(isset($desktop_lighthouseresult_audits['network-server-latency']['description'])){

						  			  			                  $network_server_lat = explode('[',$desktop_lighthouseresult_audits['network-server-latency']['description']);

						  			  			                  echo '<p>'.$network_server_lat[0].'<b><a class="text-danger" target="_BLANK" href="https://hpbn.co/primer-on-web-performance/#analyzing-the-resource-waterfall">'.$this->lang->line("Learn More").'</a></b></p>';
						  			  			                  }

						  			  			                  ?>         
												            </div>
												        </div>
												    </div>
												</div>

												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['uses-responsive-images']['title']))
																	    echo $desktop_lighthouseresult_audits['uses-responsive-images']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['uses-responsive-images']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['uses-responsive-images']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
			  			  			  			  			  <?php

			  			  			  			                  if(isset($desktop_lighthouseresult_audits['uses-responsive-images']['description'])){

			  			  			  			                  $uses_responsive = explode('[',$desktop_lighthouseresult_audits['uses-responsive-images']['description']);

			  			  			  			                  echo '<p>'.$uses_responsive[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/uses-responsive-images?utm_source=lighthouse&utm_medium=unknown">'.$this->lang->line("Learn More").'</a></b></p>';
			  			  			  			                  }

			  			  			  			                  ?>         
												            </div>
												        </div>
												    </div>
												</div>

												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['unused-css-rules']['title']))
																	    echo $desktop_lighthouseresult_audits['unused-css-rules']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['unused-css-rules']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['unused-css-rules']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
			  			  			  			  			  <?php

												                if(isset($desktop_lighthouseresult_audits['unused-css-rules']['description'])){

												                $unused_css = explode('[',$desktop_lighthouseresult_audits['unused-css-rules']['description']);

												                echo '<p>'.$unused_css[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/unused-css-rules">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>         
												            </div>
												        </div>
												    </div>
												</div>

												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['total-byte-weight']['title']))
																	    echo $desktop_lighthouseresult_audits['total-byte-weight']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['total-byte-weight']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['total-byte-weight']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
			  			  			  			  			  <?php

												                if(isset($desktop_lighthouseresult_audits['total-byte-weight']['description'])){

												                $total_byte = explode('[',$desktop_lighthouseresult_audits['total-byte-weight']['description']);

												                echo '<p>'.$total_byte[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/total-byte-weight">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>         
												            </div>
												        </div>
												    </div>
												</div>

												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['mainthread-work-breakdown']['title']))
																	    echo $desktop_lighthouseresult_audits['mainthread-work-breakdown']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['mainthread-work-breakdown']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['mainthread-work-breakdown']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
			  			  			  			  			  <?php

												                if(isset($desktop_lighthouseresult_audits['mainthread-work-breakdown']['description'])){

												                $mainthred_work = explode('[',$desktop_lighthouseresult_audits['mainthread-work-breakdown']['description']);

												                echo '<p>'.$mainthred_work[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/mainthread-work-breakdown">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>           
												            </div>
												        </div>
												    </div>
												</div>

												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['uses-webp-images']['title']))
																	    echo $desktop_lighthouseresult_audits['uses-webp-images']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['uses-webp-images']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['uses-webp-images']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
			  			  			  			  			  <?php

												                if(isset($desktop_lighthouseresult_audits['uses-webp-images']['description'])){

												                $uses_web_images = explode('[',$desktop_lighthouseresult_audits['uses-webp-images']['description']);

												                echo '<p>'.$uses_web_images[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/uses-webp-images">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>           
												            </div>
												        </div>
												    </div>
												</div>

												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['critical-request-chains']['title']))
																	    echo $desktop_lighthouseresult_audits['critical-request-chains']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['critical-request-chains']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['critical-request-chains']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
			  			  			  			  			  <?php

												                if(isset($desktop_lighthouseresult_audits['critical-request-chains']['description'])){

												                $critical_request_chains = explode('[',$desktop_lighthouseresult_audits['critical-request-chains']['description']);

												                echo '<p>'.$critical_request_chains[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/critical-request-chains">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>

												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['dom-size']['title']))
																	    echo $desktop_lighthouseresult_audits['dom-size']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['dom-size']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['dom-size']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
			  			  			  			  			  <?php

												                if(isset($desktop_lighthouseresult_audits['dom-size']['description'])){

												                $dom_size1 = explode('[',$desktop_lighthouseresult_audits['dom-size']['description']);

												                echo '<p>'.$dom_size1[0].'<b><a class="text-danger" target="_BLANK" href="https://developers.google.com/web/fundamentals/performance/rendering/reduce-the-scope-and-complexity-of-style-calculations">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>            
												            </div>
												        </div>
												    </div>
												</div>

												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['redirects']['title']))
																	    echo $desktop_lighthouseresult_audits['redirects']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['redirects']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['redirects']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
			  			  			  			  			   <?php

												                if(isset($desktop_lighthouseresult_audits['redirects']['description'])){

												                $redirects_des = explode('[',$desktop_lighthouseresult_audits['redirects']['description']);

												                echo '<p>'.$redirects_des[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/redirects">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>           
												            </div>
												        </div>
												    </div>
												</div>

												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['unminified-javascript']['title']))
																	    echo $desktop_lighthouseresult_audits['unminified-javascript']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['unminified-javascript']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['unminified-javascript']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
			  			  			  			  			   <?php

												                if(isset($desktop_lighthouseresult_audits['unminified-javascript']['description'])){

												                $unminified_js = explode('[',$desktop_lighthouseresult_audits['unminified-javascript']['description']);

												                echo '<p>'.$unminified_js[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/unminified-javascript">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>           
												            </div>
												        </div>
												    </div>
												</div>

												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['user-timings']['title']))
																	    echo $desktop_lighthouseresult_audits['user-timings']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['user-timings']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['user-timings']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
			  			  			  			  			   <?php

												                if(isset($desktop_lighthouseresult_audits['user-timings']['description'])){

												                $user_times = explode('[',$desktop_lighthouseresult_audits['user-timings']['description']);

												                echo '<p>'.$user_times[0].'<b><a class="text-danger" target="_BLANK" href="https://web.dev/user-timings">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>        
												            </div>
												        </div>
												    </div>
												</div>

												<div class="row mt-3">
												    <div class="col-xs-12">
												        <div class="box box-blue">
												            <div class="box-header with-border">
												                <h3 class="box-title blue-dark"><i class="fa fa-check"></i> 
																	<?php 
																	 if(isset($desktop_lighthouseresult_audits['network-rtt']['title']))
																	    echo $desktop_lighthouseresult_audits['network-rtt']['title']; 
																	 ?>
												                </h3>
												                <div class="box-tools pull-right">
												                	<code>
												                		<?php 
												                		if(isset($desktop_lighthouseresult_audits['network-rtt']['displayValue']))
												                		echo $desktop_lighthouseresult_audits['network-rtt']['displayValue'];
												                		 ?>
												                	</code>
												                </div>
												            </div>

												            <div class="box-body chart-responsive minus">
			  			  			  			  			   <?php

												                if(isset($desktop_lighthouseresult_audits['network-rtt']['description'])){

												                $network_rtt = explode('[',$desktop_lighthouseresult_audits['network-rtt']['description']);

												                echo '<p>'.$network_rtt[0].'<b><a class="text-danger" target="_BLANK" href="https://hpbn.co/primer-on-latency-and-bandwidth/">'.$this->lang->line("Learn More").'</a></b></p>';
												                }

												                ?>       
												            </div>
												        </div>
												    </div>
												</div>	
									        </div>
									     </div>
									</div>
								</div>

							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>




	</div>
</div>	

<script>
    $(function() {
        $(".dial").knob();
    });
</script>

<?php if($load_css_js!=1) { ?>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 

    $(".minus").click(function() {
    	$(this).parent().parent().next(".box-body").toggle();
	});
	$(".recommendation_link").click(function() {
    	$(this).next(".recommendation").toggle();
	});

	$(document).on('click','#download_list',function(){
		var direct_download="<?php echo $direct_download;?>";
		if(direct_download=="1") 
		{			
			$("#subscribe_div").html('<div class="box-body chart-responsive minus"><div class="col-xs-12"><div style="font-size:18px" class="alert text-center"><img class="center-block" src="<?php echo site_url();?>assets/pre-loader/Fading squares.gif" alt="Processing..."><br/><?php echo $this->lang->line("this may take a while to generate pdf"); ?> </div></div></div>');
			$("#subscribe_div").css("background","#f1f1f1");
			$("#subscribe_div").show();
			var hidden_id=$("#hidden_id").val();
			var base_url="<?php echo site_url();?>";
			$.ajax({
			url:base_url+'health_check/direct_download',
			type:'POST',
			data:{hidden_id:hidden_id},
			success:function(response){
				$("#subscribe_div").html(response);
			  }
		   });	
		}

		else $("#subscribe_div").css("display","block");
	});





	$(document).on('click','#send_email',function(){
		var email=$("#email").val();
		var name=$("#name").val();
		var hidden_id=$("#hidden_id").val();

		

		if(email=="" || name=="") 
		{
			alert("<?php echo $this->lang->line('something is missing'); ?>");
			return;
		}

		$("#send_email_message").removeClass('alert-success');
		$("#send_email_message").removeClass('alert-danger');
		$("#send_email_message").addClass('alert-custom');
		$("#send_email_message").html("<?php echo $this->lang->line('this may take a while to generate pdf and send email'); ?>");
		$('#send_email').addClass('disabled');


		$("#success_msg").html('<img class="center-block" src="<?php echo site_url();?>assets/pre-loader/custom.gif" alt="Processing..."><br/>');
		var base_url="<?php echo site_url();?>";
		$.ajax({
		url:base_url+'health_check/send_download_link',
		type:'POST',
		data:{email:email,name:name,hidden_id:hidden_id},
		success:function(response){
			$("#send_email_message").show();
			$("#success_msg").html("");	
			$('#send_email').removeClass('disabled');
			
			if(response=="")
			{
				$("#send_email_message").removeClass('alert-custom');
				$("#send_email_message").removeClass('alert-success');
				$("#send_email_message").addClass('alert-danger');
				$("#send_email_message").html("<?php echo $this->lang->line('something went wrong, please try again'); ?>");
			}

			else if(response=="0")
			{
				$("#send_email_message").removeClass('alert-custom');
				$("#send_email_message").removeClass('alert-success');
				$("#send_email_message").addClass('alert-danger');
				$("#send_email_message").html("<?php echo $this->lang->line('you can not download more result using this email, download quota is crossed'); ?>");
			}					
			else
			{
				$("#send_email_message").removeClass('alert-custom');
				$("#send_email_message").removeClass('alert-danger');
				$("#send_email_message").addClass('alert-success');
				$("#send_email_message").html("<?php echo $this->lang->line('a email has been sent to your email'); ?>");
			}
		}
	});
  });

});
</script>

<script type="text/javascript">
	var desktop_speed=$("#desktop_speed").val();
	$("#desktop_speed").myfunc({divFact:10,cusVal:desktop_speed});
	var mobile_speed=$("#mobile_speed").val();
	$("#mobile_speed").myfunc({divFact:10,cusVal:mobile_speed});
	var mobile_usability=$("#mobile_usability").val();
	$("#mobile_usability").myfunc({divFact:10,cusVal:mobile_usability});
</script>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php } ?>

<?php if($compare_report == 0 && $load_css_js==1) echo "</body></html>";?>
<script type="text/javascript">
  $("document").ready(function(){

    $(document).on('click','.field_data_modal',function(e){
        e.preventDefault();
        $("#field_data_modal").modal();
        var data_description = $(this).attr("data-description");
        $('.modal_value').html(data_description);
      });    
    
  });
</script>

<div class="modal" id="field_data_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #fff;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#000!important;">
          <span aria-hidden="true">×</span>
        </button>
        <h5 class="modal-title"> <i class="fa fa-google"></i> <?php echo $this->lang->line("Google PageSpeed Insights");?></h5>
      </div>

      <div class="modal-body">    
        <div class="section modal_value">                
            

        </div>
      </div>
      <div class="modal-footer">
              <a class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang->line("Close") ?></a>
      </div>
    </div>
  </div>
</div>