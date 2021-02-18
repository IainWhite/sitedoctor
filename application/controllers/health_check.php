<?php

require_once("home.php");

class health_check extends Home
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($base_site="")
    {
      $this->report();
    }

    public function report($id=0,$domain="")
    {
       
       if($id==0) exit();
       $where['where'] = array('id'=>$id);
       $data["site_info"] = $this->basic->get_data("site_check_report",$where);
    
       if(isset($data["site_info"][0])) $page_title= strtolower($data["site_info"][0]["domain_name"]);
       else exit();

       $data["page_title"]=str_replace(array("www.","http://","https://"), "", $page_title);

       $data['seo_meta_description']="web site healthy check report of ".$page_title." by ".$this->config->item("product_short_name");
       $data["load_css_js"]=0;
       $data["is_pdf"]=0;
       $data["compare_report"]=0;
       $data["body"]="site/report";
       $this->load->library("site_check");
       $this->config->load('recommendation_config');
       $this->_site_viewcontroller($data);
    }

   

    public function report_pdf($id=0,$domain="")
    {
       
       if($id==0) exit();
       $where['where'] = array('id'=>$id);
       $data["site_info"] = $this->basic->get_data("site_check_report",$where);


       if(isset($data["site_info"][0])) $page_title= strtolower($data["site_info"][0]["domain_name"]);
       else exit();

       $data["page_title"]=str_replace(array("www.","http://","https://"), "", $page_title);       
       $this->load->library("site_check");
       $data["load_css_js"]=1;
       $data["compare_report"]=0;
       $data["is_pdf"]=1;
       $this->config->load('recommendation_config');
       
       ob_start();
       $this->load->view("site/report",$data); 
       ob_get_contents();
       $html=ob_get_clean();   
       include("mpdf/mpdf.php");
       $mpdf=new mpdf('utf-8','Letter','','arialms');
       $mpdf->addPage();
       $mpdf->SetDisplayMode('fullpage');
       $mpdf->writeHTML($html);  
       // require_once APPPATH . '/vendor/autoload.php'; 
   
       // include(APPPATH ."vendor/mpdf/mpdf/src/Mpdf.php");
       // $mpdf2=new \Mpdf\Mpdf();
       // $mpdf2->addPage();
       // $mpdf2->SetDisplayMode('fullpage');
       // $mpdf2->writeHTML($html);         
       $domain=str_replace("/","", $data["page_title"]);
       $domain=trim($domain);
       $download_id=$this->session->userdata('download_id_front').$this->_random_number_generator(10);
       $file_name="download/health_check_report_".$domain."_".$download_id.".pdf";
       $mpdf->output($file_name, 'F');
       return $file_name;
          
    }

             
   
    public function send_download_link()
    {
        if($_POST)
        {
            $lead_config=$this->basic->get_data("lead_config");
            if(is_array($lead_config) && isset($lead_config[0]))
            {
              $allowed_download_per_email=$lead_config[0]["allowed_download_per_email"];
              $unlimited_download_emails=$lead_config[0]["unlimited_download_emails"];
            }
            else
            {
              $allowed_download_per_email=10;  
              $unlimited_download_emails="";
            }
            
            $unlimited_download_emails=explode(',',$unlimited_download_emails);
            
            $email=$this->input->post("email");
            $name=$this->input->post("name");
            $id=$this->input->post("hidden_id");

           
            $data=array("firstname"=>$name,"email"=>$email);

            $where['where'] = array('id'=>$id);
            $data["site_info"] = $this->basic->get_data("site_check_report",$where);
            $domain="";
            if(isset($data["site_info"][0])) $domain= strtolower($data["site_info"][0]["domain_name"]);
            $domain=str_replace(array("www.","http://","https://"), "", $domain);  
            
            
            if($this->basic->is_exist($table="leads",$where=array("email"=>$email,"no_of_search >="=>$allowed_download_per_email),$select="id"))
            {
              if(!in_array($email,$unlimited_download_emails))
              $ret_val= "0"; // crossed limit
              else $ret_val="1"; 
            }
            else $ret_val="1";
            
            if($ret_val=="1")
            {               
                if($this->basic->is_exist($table="leads",$where=array("email"=>$email),$select="id"))
                {
                    $this->basic->execute_complex_query("UPDATE leads SET name='".$name."',no_of_search=no_of_search+1,domain=trim(both ',' from concat(domain, ', ".$domain."')),date_time='".date("Y-d-m G:i:s")."' WHERE email='".$email."'");
                    $this->basic->execute_complex_query("UPDATE site_check_report SET email=trim(both ',' from concat(email, ', ".$email."')) WHERE id='".$id."'");
                    $ret_val= "2"; // updated               
                }
                else 
                {
                    $this->basic->insert_data("leads",array("name"=>$name,"domain"=>$domain,"email"=>$email,"date_time"=>date("Y-d-m G:i:s")));            
                    $this->load->library("google");
                    $this->google->syncMailchimp($data);
                    $ret_val= "3"; // inserted
                }

                $file_name=$this->report_pdf($id);
                $product=$this->config->item('product_name');
                $subject=$product." | "."Health Check Report : ".$domain;
                $download_link="<a href='".base_url().$file_name."'> health check report of ".$domain."</a>";
                $message="Hello {$name}, <br/> Thank you for using {$product}.<br/> Please follow the link to download report: {$download_link}<br/><br/><br/>{$product} Team";

                $this->_mail_sender($from = '', $to = $email, $subject, $message, $mask = $product, $html = 1);
            }          

            echo $ret_val;
            
        }
    }



    public function direct_download()
    {
        if($_POST)
        {
            
            $id=$this->input->post("hidden_id");            
            $file_name=$this->report_pdf($id);
            $download_link=base_url().$file_name;
            echo '<div class="box-body chart-responsive minus"><div class="col-xs-12"><div class="alert text-center" style="font-size:18px">'.$this->lang->line("pdf report has been generated"). '<br/> <br/><a href="'.$download_link.'" target="_BLANK" style="font-size:20px"> <i class="fa fa-cloud-download"></i> '.$this->lang->line("click here to download").'</a></div></div></div>';
                 
        }
    }


    public function comparison_report($id=0)
    {
       
       if($id==0) exit();

       $where['where'] = array('comparision.id'=>$id);
       $select=array("comparision.base_site","comparision.competutor_site","comparision.searched_at","comparision.id as id");
       $data["comparision_info"] = $this->basic->get_data("comparision",$where,$select);
       if(!isset($data["comparision_info"][0])) exit();    

       $where['where'] = array('id'=>$data["comparision_info"][0]["base_site"]);
       $data["site_info"] = $this->basic->get_data("site_check_report",$where);
       if(!isset($data["site_info"][0])) exit();

       $where['where'] = array('id'=>$data["comparision_info"][0]["competutor_site"]);
       $data["site_info2"] = $this->basic->get_data("site_check_report",$where);
       if(!isset($data["site_info2"][0])) exit();
  

       $data["comparision_info"][0]["base_domain"]=$data["site_info"][0]["domain_name"];
       $data["comparision_info"][0]["competutor_domain"]=$data["site_info2"][0]["domain_name"];
       $page_title= strtolower($data["comparision_info"][0]["base_domain"])." Vs ".strtolower($data["comparision_info"][0]["competutor_domain"]);

       $page_title=str_replace(array("www.","http://","https://"), "", $page_title);
       $data["page_title"]=$page_title;       
       $data['seo_meta_description']="web site healthy check report of ".$page_title." by ".$this->config->item("product_short_name");

       $data["load_css_js"]=0;
       $data["is_pdf"]=0;
       $data["compare_report"]=1; // this is for generating general and comaparative health report with one view file


       $data["body"]="site/comparison_report";
       $this->load->library("site_check");
       $this->config->load('recommendation_config');
       $this->_site_viewcontroller($data);
    }



    public function comparision_report_pdf($id=0)
    {
       
       if($id==0) exit();
     
       $where['where'] = array('comparision.id'=>$id);
       $select=array("comparision.base_site","comparision.competutor_site","comparision.searched_at","comparision.id as id");
       $data["comparision_info"] = $this->basic->get_data("comparision",$where,$select);
       if(!isset($data["comparision_info"][0])) exit();
       
       $where['where'] = array('id'=>$data["comparision_info"][0]["base_site"]);
       $data["site_info"] = $this->basic->get_data("site_check_report",$where);
       if(!isset($data["site_info"][0])) exit();

       $where['where'] = array('id'=>$data["comparision_info"][0]["competutor_site"]);
       $data["site_info2"] = $this->basic->get_data("site_check_report",$where);
       if(!isset($data["site_info2"][0])) exit();

       $data["comparision_info"][0]["base_domain"]=$data["site_info"][0]["domain_name"];
       $data["comparision_info"][0]["competutor_domain"]=$data["site_info2"][0]["domain_name"];
       $page_title= strtolower($data["comparision_info"][0]["base_domain"])." Vs ".strtolower($data["comparision_info"][0]["competutor_domain"]);

       $page_title=str_replace(array("www.","http://","https://"), "", $page_title);
       $data["page_title"]=$page_title;       
    
       $this->load->library("site_check");
       $data["load_css_js"]=1;
       $data["compare_report"]=1;
       $data["is_pdf"]=1;
       $this->config->load('recommendation_config');
       
       ob_start();
       $this->load->view("site/comparison_report",$data); 
       ob_get_contents();
       $html=ob_get_clean();   
       include("mpdf/mpdf.php");
       $mpdf=new mpdf('utf-8','Letter','','arialms');
       $mpdf->addPage();
       $mpdf->SetDisplayMode('fullpage');
       $mpdf->writeHTML($html);  
       // require_once APPPATH . '/vendor/autoload.php'; 
       
       // include(APPPATH ."vendor/mpdf/mpdf/src/Mpdf.php");
       // $mpdf2=new \Mpdf\Mpdf();
       // $mpdf2->addPage();
       // $mpdf2->SetDisplayMode('fullpage');
       // $mpdf2->writeHTML($html);     
       $domain=str_replace(array("/"," "),"", $data["page_title"]);
       $domain=trim($domain);
       $download_id=$this->session->userdata('download_id_front').$this->_random_number_generator(10);
       $file_name="Website_health_comparision_report_".$domain."_".$download_id.".pdf";
       $mpdf->output($file_name, 'F');
       return $file_name;
    }



    public function send_download_link_comparision()
    {
        if($_POST)
        {
            $lead_config=$this->basic->get_data("lead_config");
            if(is_array($lead_config) && isset($lead_config[0]))
            {
              $allowed_download_per_email=$lead_config[0]["allowed_download_per_email"];
              $unlimited_download_emails=$lead_config[0]["unlimited_download_emails"];
            }
            else
            {
              $allowed_download_per_email=10;  
              $unlimited_download_emails="";
            }
            
            $unlimited_download_emails=explode(',',$unlimited_download_emails);
            
            $email=$this->input->post("email");
            $name=$this->input->post("name");
            $id=$this->input->post("hidden_id");

           
            $data=array("firstname"=>$name,"email"=>$email);

            $where['where'] = array('comparision.id'=>$id);
            $join=array('site_check_report as base_site_table'=>"base_site_table.id=comparision.base_site,left",'site_check_report as competutor_site_table'=>"competutor_site_table.id=comparision.competutor_site,left");
            $select=array("base_site_table.domain_name as base_domain","competutor_site_table.domain_name as competutor_domain","comparision.base_site","comparision.competutor_site","comparision.searched_at","comparision.id as id");
            $comparision_info = $this->basic->get_data("comparision",$where,$select,$join);

            $domain="";
            if(isset($comparision_info[0]))
            {
              $domain= strtolower($comparision_info[0]["base_domain"]).", ".strtolower($comparision_info[0]["competutor_domain"]);
              $domain=str_replace(array("www.","http://","https://"), "", $domain);
            }             
            
            if($this->basic->is_exist($table="leads",$where=array("email"=>$email,"no_of_search >="=>$allowed_download_per_email),$select="id"))
            {
              if(!in_array($email,$unlimited_download_emails))
              $ret_val= "0"; // crossed limit
              else $ret_val="1"; 
            }
            else $ret_val="1";
            
            if($ret_val=="1")
            {               
                if($this->basic->is_exist($table="leads",$where=array("email"=>$email),$select="id"))
                {
                    $this->basic->execute_complex_query("UPDATE leads SET name='".$name."',no_of_search=no_of_search+1,domain=trim(both ',' from concat(domain, ', ".$domain."')),date_time='".date("Y-d-m G:i:s")."' WHERE email='".$email."'");
                    $ret_val= "2"; // updated               
                }
                else 
                {
                    $this->basic->insert_data("leads",array("name"=>$name,"domain"=>$domain,"email"=>$email,"date_time"=>date("Y-d-m G:i:s")));            
                    $this->load->library("google");
                    $this->google->syncMailchimp($data);
                    $ret_val= "3"; // inserted
                }

                $this->basic->execute_complex_query("UPDATE comparision SET email=trim(both ',' from concat(email, ', ".$email."')) WHERE id='".$id."'");
       
                $file_name=$this->comparision_report_pdf($id);
                $product=$this->config->item('product_name');
                $subject=$product." | "."Health Comparison Report : ".str_replace(", "," Vs ", $domain);
                $download_link="<a href='".base_url().$file_name."'> health comparison report of ".str_replace(", "," Vs ", $domain)."</a>";
                $message="Hello {$name}, <br/> Thank you for using {$product}.<br/> Please follow the link to download report: {$download_link}<br/><br/><br/>{$product} Team";

                $this->_mail_sender($from = '', $to = $email, $subject, $message, $mask = $product, $html = 1);
            }          

            echo $ret_val;
            
        }
    }



    public function direct_download_comparision()
    {
        if($_POST)
        {            
            $id=$this->input->post("hidden_id");
            $file_name=$this->comparision_report_pdf($id);
            $download_link=base_url().$file_name;
            echo '<div class="box-body chart-responsive minus"><div class="col-xs-12"><div class="alert text-center" style="font-size:18px">'.$this->lang->line("pdf report has been generated"). '<br/> <br/><a href="'.$download_link.'" target="_BLANK" style="font-size:20px"> <i class="fa fa-cloud-download"></i> '.$this->lang->line("click here to download").'</a></div></div></div>';
           
        }
    }




 


   
    
    
}
