
<script >

	$("document").ready(function(){	
		$("a.share_button").click(function(e) {
	    var width = window.innerWidth * 0.66 ;
	    var height = width * window.innerHeight / window.innerWidth ;
	    window.open(this.href , 'newwindow', 'width=' + width + ', height=' + height + ', top=' + ((window.innerHeight - height) / 2) + ', left=' + ((window.innerWidth - width) / 2));
		e.preventDefault();
	
	});
	
	});

</script>

<?php 	$share_current_url=current_url();     /***This will be current URL ***/ ?>




<!-- Facebook -->
<a class="share_button" href="http://www.facebook.com/sharer.php?u=<?php echo $share_current_url;  ?>" target="_blank">
<img src="<?php echo base_url("assets/images/button");?>/facebook.png" alt="Facebook" style="height: 60px !important; width: 60px !important;"/>
</a>

<!-- Twitter -->
<a class="share_button" href="https://twitter.com/share?url=<?php echo $share_current_url;  ?>" target="_blank">
<img src="<?php echo base_url("assets/images/button");?>/twitter.png" alt="Twitter" style="height: 60px !important; width: 60px !important;"/>
</a>

<!-- Google+ -->
<a class="share_button" href="https://plus.google.com/share?url=<?php echo $share_current_url;  ?>" target="_blank">
<img src="<?php echo base_url("assets/images/button");?>/google.png" alt="Google" style="height: 60px !important; width: 60px !important;"/>
</a>

<!-- LinkedIn -->
<a class="share_button" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $share_current_url;  ?>" target="_blank">
<img src="<?php echo base_url("assets/images/button");?>/linkedin.png" alt="LinkedIn" style="height: 60px !important; width: 60px !important;"/>
</a>

<!-- Pinterest -->
<a  href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
<img src="<?php echo base_url("assets/images/button");?>/pinterest.png" alt="Pinterest" style="height: 60px !important; width: 60px !important;"/>
</a>

<!-- Reddit -->
<a class="share_button" href="http://reddit.com/submit?url=<?php echo $share_current_url;  ?>;title=SEO Analysis" target="_blank">
<img src="<?php echo base_url("assets/images/button");?>/reddit.png" alt="Reddit" style="height: 60px !important; width: 60px !important;"/>
</a>

<!-- StumbleUpon-->
<a href="http://www.stumbleupon.com/submit?url=<?php echo $share_current_url;  ?>;title=SEO Analysis" target="_blank">
<img src="<?php echo base_url("assets/images/button");?>/stumbleupon.png" alt="StumbleUpon" style="height: 60px !important; width: 60px !important;"/>
</a>
<!-- Tumblr-->
<a class="share_button" href="http://www.tumblr.com/share/link?url=<?php echo $share_current_url;  ?>;title=SEO Analysis" target="_blank">
<img src="<?php echo base_url("assets/images/button");?>/tumblr.png" alt="Tumblr" style="height: 60px !important; width: 60px !important;"/>
</a>

<!-- Buffer -->
<a class="share_button" href="https://bufferapp.com/add?url=<?php echo $share_current_url;  ?>" target="_blank">
<img src="<?php echo base_url("assets/images/button");?>/buffer.png" alt="Buffer" style="height: 60px !important; width: 60px !important;"/>
</a>

<!-- Digg -->
<a class="share_button" href="http://www.digg.com/submit?url=<?php echo $share_current_url;  ?>" target="_blank">
<img src="<?php echo base_url("assets/images/button");?>/diggit.png" alt="Digg" style="height: 60px !important; width: 60px !important;"/>
</a>