<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->config->item('product_name'); if(isset($page_title) && $page_title!="") echo " | ".$page_title;?></title>

        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $share_cover_image=base_url("assets/images/share_cover.png"); ?>
        <!--For Google -->
        <meta name="description" content="<?php echo $seo_meta_description; ?>" />
        <meta name="keywords" content="<?php echo $seo_meta_keyword; ?>" />
        <meta name="author" content="<?php echo $this->config->item('institute_address1');?>" />
        <meta name="copyright" content="<?php echo $this->config->item('product_short_name');?>" />
        <meta name="application-name" content="<?php echo $this->config->item('product_short_name');?>" />

        <!-- for Facebook -->          
        <meta property="og:title" content="<?php echo $this->config->item('product_short_name')." | ".$page_title;?>" />
        <meta property="og:type" content="article" />
        <meta property="og:image" content="<?php echo $share_cover_image; ?>" />
        <meta property="og:url" content="<?php echo current_url(); ?>" />
        <meta property="og:description" content="<?php echo $seo_meta_description; ?>" />
        <meta property="fb:app_id" content="" />

        <!-- for Twitter -->          
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="<?php echo $this->config->item('product_short_name')." | ".$page_title;?>" />
        <meta name="twitter:description" content="<?php echo $seo_meta_description; ?>" />
        <meta name="twitter:image" content="<?php echo $share_cover_image; ?>" />

        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

        <?php echo $this->load->view("site/css_include_site.php"); ?>
        <?php echo $this->load->view("site/js_include_site.php"); ?>
        <style type="text/css">
            @media screen and (max-width: 600px) {
                #search {
                    max-inline-size: min-content;
                }
                .fa-search{display: none;}
                #header_search p.search input{
                    padding-right:0px;
                }
            }
        </style>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-JGJNLFMCNG"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-JGJNLFMCNG');
        </script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div id='wrapper' class='full'>

        	<?php
        		if($body == 'site/index') :
        			$header_height = '735px';
                    $padding_bottom = '30px';
        		else :
        			$header_height = '110px';
                    $padding_bottom = '0px';
        		endif;
        	?>

            <div id='header' class='full' style="min-height: <?php echo $header_height; ?>; padding-bottom: <?php echo $padding_bottom; ?>">
                <div id="header_top_full" class='full'>
                    <div id='header_top' class='container' style='width: 95%'>
                        <div id='logo' class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
                            <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url();?>assets/images/logo.png" alt="<?php echo $this->config->item('product_name');?>"/></a>
                        </div>

                        <div id='top_nav' class='col-xs-12 col-sm-5 col-md-5 col-lg-6 scrollspy smooth-scroll'>
                            <ul id="menu">
                                <?php 
                                    $segment=$this->uri->segment(1);
                                    if($segment=="home" || $segment=="")
                                    {
                                        $site_val_home="#header";
                                        $site_val_latest_search_report="#latest_search_report";
                                        $site_val_contact="#footer";
                                    }
                                    else
                                    {
                                        
                                        $site_val_home=site_url();
                                        $site_val_latest_search_report=site_url('#latest_search_report');
                                        $site_val_contact=site_url('#footer');
                                    }
                                ?>
                                <li class="active"><a href="<?php echo $site_val_home;?>"><?php echo $this->lang->line("home"); ?></a></li>
                                <li><a href="<?php echo $site_val_latest_search_report;?>"><?php echo $this->lang->line("recent"); ?></a></li>  
                                <li><a href="<?php echo $site_val_contact;?>"><?php echo $this->lang->line("contact"); ?></a></li>
                                <li><a href="<?php echo site_url('seo');?>">SEO</a></li>
                                <li><a href="<?php echo site_url('whiteinternet');?>">White Internet</a></li>
                                <li><a href="<?php echo site_url('about');?>">About</a></li>
                            </ul>
                        </div>

                        <div id='login_area' class='col-xs-12 col-sm-4 col-md-4 col-lg-3'>
                            <ul>
                                <li>
                                    <!--<a href=''><i class='fa fa-globe'></i></a> <span>EN</span> -->

                                    <?php 
                                        $select_lan=$this->language;
                                        $select_id="countries";
                                    ?>
                                    <?php //include("application/views/site/language.php"); ?>
                                </li>
                                <li class='signup'><a href="<?php echo site_url('home/login');?>" class='btn btn-success'><?php echo $this->lang->line("login"); ?></a></li>
                            </ul>
                        </div>
                    </div> <!-- end header_top -->
                </div>    

                <?php if($body == 'site/index') : ?>
	                <div id='header_search' class='container'>
	                    <h3><?php echo $this->config->item('product_name');?></h3>
	                    <p class='subtitle'>
	                        <?php echo $this->lang->line("catch line"); ?></p>
	                    </p>
	                    <p class='search'>
	                        <?php 
	                        if($compare==1) 
	                        {
	                        	$search_lang=$this->lang->line('type competutor web address');
	                        }
	                        else 
	                        {
	                        	$search_lang=$this->lang->line('type web address');
	                        }?>

	                        <input id="page_search" type="text" name="page_search" placeholder="<?php echo $search_lang; ?>..."/>
	                        <button id="search" type="submit"><i class='fa fa-search'></i> <?php echo $this->lang->line('Health Check'); ?></button>
	                    </p>
 
	                </div> <!-- end header_search -->
            	<?php endif; ?>
            </div> <!-- end header -->