            <?php 
                if($body == 'site/index') :
                    $margin_top = '-50px';
                else :
                    $margin_top = '50px';
                endif;
            ?>
            <div id='footer' class='full' style="margin-top: <?php echo $margin_top; ?>">
                <div class='container'style='width: 95%'>
                    <div class='row'>
                        <div id='about-us' class='col-xs-12 col-sm-6 col-md-6 right-border'>
                            <div id='left-footer-about' class='full'>
                                <?php 
                                if($this->session->userdata('mail_sent') == 1) {
                                    echo "<div class='alert alert-success text-center'>".$this->lang->line("we have received your email. we will contact you through email as soon as possible")."</div>";
                                    $this->session->unset_userdata('mail_sent');
                                }
                                ?>
                                <form role="form" method="post" id="footer-form" action="<?php echo site_url("home/email_contact"); ?>">
                                    <div class="form-group has-feedback">
                                        <label class="sr-only" for="email"><?php echo $this->lang->line("email");?>* </label>
                                        <input type="email" class="form-control" required id="email" <?php echo set_value("email"); ?> placeholder="<?php echo $this->lang->line("email");?>" name="email">
                                        <i class="fa fa-envelope form-control-feedback"></i>
                                        <span class="red"><?php echo form_error("email") ?></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label class="sr-only" for="subject"><?php echo $this->lang->line("message subject");?>* </label>
                                        <input type="text" class="form-control" required id="subject" <?php echo set_value("subject"); ?> placeholder="<?php echo $this->lang->line("message subject");?>" name="subject">
                                        <i class="fa fa-tag form-control-feedback"></i>
                                        <span class="red"><?php echo form_error("subject") ?></span>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label class="sr-only" for="message"><?php echo $this->lang->line("message");?>* </label>
                                        <textarea class="form-control" rows="3" required id="message" <?php echo set_value("message"); ?> placeholder="<?php echo $this->lang->line("message");?>" name="message"></textarea>
                                        <i class="fa fa-pencil form-control-feedback"></i>
                                        <span class="red"><?php echo form_error("message") ?></span>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <label  class="sr-only" for="captcha"><?php echo $this->lang->line("captcha");?> *  </label>
                                        <input type="text" class="form-control" step="1" required id="captcha" <?php echo set_value("captcha"); ?> placeholder="<?php echo $contact_num1. "+". $contact_num2." = ?"; ?>" name="captcha">
                                        <i class="fa fa-android form-control-feedback"></i>
                                        <span class="red">
                                            <?php 
                                            if(form_error('captcha')) 
                                                echo form_error('captcha'); 
                                            else  
                                            { 
                                                echo $this->session->userdata("contact_captcha_error"); 
                                                $this->session->unset_userdata("contact_captcha_error"); 
                                            } 
                                            ?>
                                        </span>
                                    </div>

                                    <input type="submit" value="<?php echo $this->lang->line("send");?>" class="btn btn-primary">
                                </form>
                            </div>   
                        </div>
                        <div id='contact-us' class='col-xs-12 col-sm-3 col-md-3 right-border'>
                            <h3 class='footer-title'><?php echo $this->lang->line("Contact"); ?></h3>
                            <div id='c-info' class='full'>
                                <div class='full'>
                                   <div class='icon'><i class='fa fa-map-marker'></i></div>
                                   <div class='c-details'><?php echo $this->config->item("institute_address1"); ?></div>
                                </div>
                                <div class='full'>
                                   <div class='icon'><i class='fa fa-envelope'></i></div>
                                   <div class='c-details'>info@sitedoctor.online</div>
                                </div>
                            </div>
                            <ul class='social'>
                            	<li><a href='https://whiteinternet.com'><i class='fa fa-paw'></i></a></li> 
                                <li><a href=''><i class='fa fa-facebook'></i></a></li>   
                                <li><a href=''><i class='fa fa-twitter'></i></a></li> 
                                <li><a href='https://www.linkedin.com/in/iwhite/'><i class='fa fa-linkedin'></i></a></li> 
                            </ul>
                        </div>
                        <div id='footer-navigation' class='col-xs-12 col-sm-3 col-md-3 scrollspy smooth-scroll'>
                            <h3 class='footer-title'><?php echo $this->lang->line('navigation'); ?></h3>
                            <ul>
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
                                <li><a href="<?php echo site_url('about');?>">About Site Doctor</a></li>
                            </ul>
                            <div id='copyright' class='full'>
                                <p><?php echo $this->config->item("product_short_name")." ".$this->config->item("product_version"); ?> &copy; <?php echo date("Y");?> <a href="https://whiteinternet.com>">White Internet</a>.</p>
                            </div> 
                        </div>
                    </div>
                </div>
            </div> <!-- end footer -->
        </div> <!-- end wrapper -->
    </body>

    <!-- <script>
        $(function(){
            $('#menu').slicknav({
                label:'',
                prependTo:'#top_nav'
            });
        });
    </script> -->
</html>