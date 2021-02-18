<?php

/**
* @category controller
* class Admin
*/

class update extends CI_Controller
{
      
    public function __construct()
    {
        parent::__construct();   
        $this->load->database();
        $this->load->model('basic');
        set_time_limit(0);
    }

    public function index()
    {
      $this->v1_5_3to_v1_5_4();
    }

    public function v1_5_3to_v1_5_4()
    {
        $lines="ALTER TABLE `site_check_report` ADD `mobile_loadingexperience_metrics` TEXT NOT NULL AFTER `mobile_ready_data`, ADD `mobile_originloadingexperience_metrics` TEXT NOT NULL AFTER `mobile_loadingexperience_metrics`, ADD `mobile_lighthouseresult_configsettings` TEXT NOT NULL AFTER `mobile_originloadingexperience_metrics`, ADD `mobile_lighthouseresult_audits` LONGTEXT NOT NULL AFTER `mobile_lighthouseresult_configsettings`, ADD `mobile_lighthouseresult_categories` TEXT NOT NULL AFTER `mobile_lighthouseresult_audits`;

            ALTER TABLE `site_check_report` ADD `desktop_loadingexperience_metrics` TEXT NOT NULL AFTER `mobile_lighthouseresult_categories`, ADD `desktop_originloadingexperience_metrics` TEXT NOT NULL AFTER `desktop_loadingexperience_metrics`, ADD `desktop_lighthouseresult_configsettings` TEXT NOT NULL AFTER `desktop_originloadingexperience_metrics`, ADD `desktop_lighthouseresult_audits` LONGTEXT NOT NULL AFTER `desktop_lighthouseresult_configsettings`, ADD `desktop_lighthouseresult_categories` TEXT NOT NULL AFTER `desktop_lighthouseresult_audits`;

            ALTER TABLE `site_check_report` ADD `desktop_google_api_error` TEXT NOT NULL AFTER `desktop_lighthouseresult_categories`;
            ALTER TABLE `site_check_report` ADD `mobile_google_api_error` TEXT NOT NULL AFTER `mobile_lighthouseresult_categories`;
            ALTER TABLE `site_check_report` ADD `mobile_perfomence_score` DOUBLE NOT NULL AFTER `mobile_google_api_error`;
            ALTER TABLE `site_check_report` ADD `desktop_perfomence_score` DOUBLE NOT NULL AFTER `desktop_google_api_error`;
            ALTER TABLE `site_check_report` ADD `perfomence_category` VARCHAR(255) NOT NULL AFTER `mobile_google_api_error`;

            ALTER TABLE `site_check_report` DROP `response_code`, DROP `pagestat`, DROP `speed_score`, DROP `avoid_landing_page_redirects`, DROP `gzip_compression`, DROP `leverage_browser_caching`, DROP `main_resource_server_response_time`, DROP `minify_css`, DROP `minify_html`, DROP `minify_javaScript`, DROP `minimize_render_blocking_resources`, DROP `optimize_images`, DROP `prioritize_visible_content`, DROP `response_code_mobile`, DROP `speed_score_mobile`,  DROP `pagestat_mobile`, DROP `avoid_interstitials_mobile`, DROP `avoid_plugins_mobile`, DROP `configure_viewport_mobile`, DROP `size_content_to_viewport_mobile`, DROP `size_tap_targets_appropriately_mobile`, DROP `use_legible_font_sizes_mobile`, DROP `avoid_landing_page_redirects_mobile`, DROP `gzip_compression_mobile`, DROP `leverage_browser_caching_mobile`, DROP `main_resource_server_response_time_mobile`, DROP `minify_css_mobile`, DROP `minify_html_mobile`, DROP `minify_javaScript_mobile`, DROP `minimize_render_blocking_resources_mobile`, DROP `optimize_images_mobile`, DROP `prioritize_visible_content_mobile`, DROP `mobile_ready_data`, DROP `screenshot`, DROP `speed_usability_mobile`";
                      
        // Loop through each line

        $lines=explode(";", $lines);
        $count=0;
        foreach ($lines as $line) 
        {
            $count++;      
            $this->db->query($line);
        }
        echo "Item has been updated to v1.5.4 successfully.".$count." queries executed.";
    }

    public function v1_5_1to_v1_5_2()
    {

        $lines="ALTER TABLE `site_check_report` ADD `screenshot` LONGTEXT NOT NULL AFTER `overall_score`";
                      
        // Loop through each line

        $lines=explode(";", $lines);
        $count=0;
        foreach ($lines as $line) 
        {
            $count++;      
            $this->db->query($line);
        }
        echo "Item has been updated to v1.5.2 successfully.".$count." queries executed.";
        //$this->delete_update();        
    }

    public function v1_2to_v1_3()
    {

        $lines="ALTER TABLE `site_check_report` ADD `overall_score` DOUBLE NOT NULL AFTER `email`;
                ALTER TABLE `site_check_report` ADD `alexa_rank` TEXT NULL AFTER `email`;
                ALTER TABLE `site_check_report` ADD `domain_ip_info` TEXT NULL AFTER `email`";
                      
        // Loop through each line

        $lines=explode(";", $lines);
        $count=0;
        foreach ($lines as $line) 
        {
            $count++;      
            $this->db->query($line);
        }
        echo "Item has been updated to v1.3 successfully.".$count." queries executed.";
        //$this->delete_update();        
    }
  
 
    public function v1_to_v1_1()
    {

        $lines=" ALTER TABLE `site_check_report` CHANGE `title` `title` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL";
      
        // Loop through each line

        $lines=explode(";", $lines);
        $count=0;
        foreach ($lines as $line) 
        {
            $count++;      
            $this->db->query($line);
        }
        echo "Item has been updated to v1.1 successfully.".$count." queries executed.";
        //$this->delete_update();        
    }
  

    function delete_update()
    {
        unlink(APPPATH."controllers/update.php");
    }
 


}
