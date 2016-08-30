<?php

/*
 * LegalPress Home Page Template for Visual Composer
 */

add_action( 'vc_load_default_templates_action','legalpress_home_page_template_for_vc' );

function legalpress_home_page_template_for_vc() {
	$data               = array();
	$data['name']       = _x( 'LegalPress: Front Page', 'backend' , 'legalpress-pt' );
	$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/vendor/proteusthemes/visual-composer-elements/assets/images/pt.svg' );
	$data['custom_class'] = 'legalpress_home_page_template_for_vc_custom_template';
	$data['content']    = <<<CONTENT
		[vc_row css=".vc_custom_1440406566113{margin-bottom: 45px !important;}"][vc_column width="1/4"][vc_column_text]
<h3 class="widget-title"><span class="widget-title__inline">We are London based law firm focused on excellence.</span></h3>
Headed by one of the most distinguished and experienced lawyers in the country, George Hilton, our firm have a sound base in the law fraternity, and we aim to put our resources to effective use for the success of our clients. Backed by hundreds of successful cases in different fields of law, and having being the preferred law firm for many Fortune 500 companies, you can rest assured that your case is in safe hands with us.

<a class="more-link" href="http://www.google.com">Read More</a>[/vc_column_text][/vc_column][vc_column width="1/4"][pt_vc_featured_page page="102" layout="block" read_more_text="Read more"][/vc_column][vc_column width="1/4"][pt_vc_featured_page page="303" layout="block" read_more_text="Read more"][/vc_column][vc_column width="1/4"][pt_vc_featured_page page="93" layout="block" read_more_text="Read more"][/vc_column][/vc_row][vc_row css=".vc_custom_1440407022886{margin-bottom: 40px !important;}"][vc_column width="1/3"][pt_vc_icon_box icon="fa fa-university" title="Comercial Law" text="Our banking lawyers are highly experience and the amongth neither." new_tab=""][/vc_column][vc_column width="1/3"][pt_vc_icon_box icon="fa fa-university" title="Criminal Law" text="Our banking lawyers are highly experience and the amongth neither." new_tab=""][/vc_column][vc_column width="1/3"][pt_vc_icon_box icon="fa fa-university" title="Civil Rights Law" text="Our banking lawyers are highly experience and the amongth neither." new_tab=""][/vc_column][/vc_row][vc_row css=".vc_custom_1440407029336{margin-bottom: 80px !important;}"][vc_column width="1/3"][pt_vc_icon_box icon="fa fa-university" title="Personal Injury Law" text="Our banking lawyers are highly experience and the amongth neither." new_tab=""][/vc_column][vc_column width="1/3"][pt_vc_icon_box icon="fa fa-university" title="Corporate Law" text="Our banking lawyers are highly experience and the amongth neither." new_tab=""][/vc_column][vc_column width="1/3"][pt_vc_icon_box icon="fa fa-university" title="Comercial Law" text="Our banking lawyers are highly experience and the amongth neither." new_tab=""][/vc_column][/vc_row][vc_row full_width="stretch_row" css=".vc_custom_1440407523954{margin-bottom: 80px !important;background-color: #45414d !important;}"][vc_column width="1/1"][pt_vc_call_to_action title="Want to be an intern at our law firm?" subtitle="Sign up now and get your internship!"]

[button]APPLY NOW[/button] [button style="default"]READ MORE[/button]

[/pt_vc_call_to_action][/vc_column][/vc_row][vc_row css=".vc_custom_1440407579833{margin-bottom: 80px !important;}"][vc_column width="1/4"][vc_column_text]
<h3 class="widget-title"><span class="widget-title__inline">Meet the team</span></h3>
Our commitment to serve each and every client of ours respectfully, discreetly, professionally and has helped us win the loyalty of comprehensive clients of all starting from individuals troubled with family lawsuits or giant corporate dealing with default lawsuits. At our firm, we aim to you but the best legal solution for your case. Our law firm consists of remarkable team of expert trial attorneys in just about every field of law you can name, and it is because of this nature of the legal services we provide, our firm has been able to stay ahead of its league for decades.

<a class="more-link" href="/about-us">Read More</a>[/vc_column_text][/vc_column][vc_column width="1/4"][pt_vc_person_profile name="George Hilton" title="CEO" image_url="http://xml-io.proteusthemes.com/legalpress/wp-content/uploads/sites/26/2015/06/110.jpg" introduction="I'm a London based lawyer and I was born and raised in Manchester. I completed my Masters in Law. I'm the CEO of this firm." social_links="https://www.facebook.com/ProteusThemes|fa-facebook-square
https://twitter.com/proteusthemes|fa-twitter-square
https://www.youtube.com/user/ProteusNetCompany/|fa-youtube-square" new_tab=""][/vc_column][vc_column width="1/4"][pt_vc_person_profile name="Jennifer Willinger" title="Paralegal" image_url="http://xml-io.proteusthemes.com/legalpress/wp-content/uploads/sites/26/2015/06/52.jpg" introduction="I'm a paralegal based in London and I was born and raised in Manchester. I completed my Masters in Law. I'm a the best at what I do." social_links="https://www.facebook.com/ProteusThemes|fa-facebook-square
https://twitter.com/proteusthemes|fa-twitter-square
https://www.youtube.com/user/ProteusNetCompany/|fa-youtube-square" new_tab=""][/vc_column][vc_column width="1/4"][pt_vc_person_profile name="Michael Robertson" title="Lawyer" image_url="http://xml-io.proteusthemes.com/legalpress/wp-content/uploads/sites/26/2015/06/210.jpg" introduction="I'm an Oxford based lawyer and I was born and raised in Manchester. I completed my Masters in Law. I'm a the best at what I do." social_links="https://www.facebook.com/ProteusThemes|fa-facebook-square
https://twitter.com/proteusthemes|fa-twitter-square
https://www.youtube.com/user/ProteusNetCompany/|fa-youtube-square" new_tab="true"][/vc_column][/vc_row][vc_row css=".vc_custom_1440407717029{margin-bottom: 62px !important;padding-top: 60px !important;padding-bottom: 70px !important;background-image: url(http://xml-io.proteusthemes.com/legalpress/wp-content/uploads/sites/26/2015/06/our_pathway.png) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" full_width="stretch_row"][vc_column width="1/6"][vc_column_text]
[/vc_column_text][/vc_column][vc_column width="4/6"][vc_column_text]
<h3 style="text-align: center; font-size: 46px;">Our Pathway</h3>
<p style="text-align: center;"><span style="color: #ccb68d;"><strong>OUR CEO'S WORDS</strong></span></p>


<hr class="hr-quote" />
<p style="text-align: center; font-family: 'Alegreya', Georgia, 'Times New Roman', Times, serif; font-size: 22px;">We are passionate about the law and providing successful outcomes for our clients. Our promise to all our clients is to offer the very best legal advice and to consistently exceed your expectations.</p>
<p style="text-align: center;"><img class=" size-full wp-image-344 aligncenter" src="http://xml-io.proteusthemes.com/legalpress/wp-content/uploads/sites/26/2015/06/signature.png" alt="signature" width="232" height="58" /></p>

[/vc_column_text][/vc_column][vc_column width="1/6"][vc_column_text]
[/vc_column_text][/vc_column][/vc_row][vc_row css=".vc_custom_1440407814391{margin-bottom: 50px !important;}"][vc_column width="1/1"][vc_column_text]
<div class="widget-title--big">
<h3 class="widget-title"><span class="widget-title__inline">The News</span></h3>
</div>
[/vc_column_text][/vc_column][/vc_row][vc_row css=".vc_custom_1440407878723{margin-bottom: 58px !important;}"][vc_column width="1/3"][pt_vc_latest_news layout="block" order_number="1" order_number_from="1" order_number_to="3" show_more_link=""][/vc_column][vc_column width="1/3"][pt_vc_latest_news layout="block" order_number="2" order_number_from="1" order_number_to="3" show_more_link=""][/vc_column][vc_column width="1/3"][pt_vc_latest_news layout="inline" order_number="1" order_number_from="3" order_number_to="5" show_more_link="true"][/vc_column][/vc_row][vc_row full_width="stretch_row" css=".vc_custom_1440408336798{margin-bottom: 58px !important;padding-top: 65px !important;padding-bottom: 65px !important;background: #eeeeee url(http://xml-io.proteusthemes.com/legalpress/wp-content/uploads/sites/26/2015/06/pattern-background.png) !important;}"][vc_column width="1/1"][pt_vc_container_testimonials title="Testimonials" autocycle="no" interval="5000"][pt_vc_testimonial quote="I had never needed a lawyer before. Working with LegalPress WordPress theme was painless. They won my case, and won handsomely!" author="Margaret Curtis" author_description="PHP Developer"][pt_vc_testimonial quote="It is such a short time that I have had opportunity to meet with you and I have no hesitation in saying that I am your client for life time now." author="David Jackson" author_description="UX Designer"][pt_vc_testimonial quote="LegalPress is perhaps one of the finest WordPress theme one can find. It manages to balance it's knowledge with commercial acumen." author="Catherine Barnett" author_description="Startup Owner"][pt_vc_testimonial quote="It follows from this that benefits. Among the numerous faults of those who pass their lives recklessly and without due reflexion, my good friend Liberalis." author="Ryan Holland" author_description="Growth Hacker"][/pt_vc_container_testimonials][/vc_column][/vc_row][vc_row css=".vc_custom_1440408418373{margin-bottom: 40px !important;}"][vc_column width="1/1"][vc_column_text]
<div class="widget-title--big">
<h3 class="widget-title"><span class="widget-title__inline">Important Clients</span></h3>
</div>
[/vc_column_text][/vc_column][/vc_row][vc_row css=".vc_custom_1440408479077{margin-bottom: 80px !important;}"][vc_column width="1/1"][vc_column_text]
<div class="logo-panel">
<div class="row">
<div class="col-xs-12 col-sm-3"><img src="http://xml-io.proteusthemes.com/legalpress/wp-content/uploads/sites/26/2015/07/client_1.png" alt="Client logo" /></div>
<div class="col-xs-12 col-sm-3"><img src="http://xml-io.proteusthemes.com/legalpress/wp-content/uploads/sites/26/2015/07/client_2.png" alt="Client logo" /></div>
<div class="col-xs-12 col-sm-3"><img src="http://xml-io.proteusthemes.com/legalpress/wp-content/uploads/sites/26/2015/07/client_3.png" alt="Client logo" /></div>
<div class="col-xs-12 col-sm-3"><img src="http://xml-io.proteusthemes.com/legalpress/wp-content/uploads/sites/26/2015/07/client_4.png" alt="Client logo" /></div>
</div>
</div>
[/vc_column_text][/vc_column][/vc_row][vc_row full_width="stretch_row_content_no_spaces" css=".vc_custom_1440408677772{margin-bottom: 0px !important;}"][vc_column width="1/1"][pt_vc_container_google_map lat_long="51.517331,-0.127668" zoom="12" type="roadmap" style="LegalPress" height="380"][pt_vc_location title="London" locationlatlng="51.5112,-0.127716" custompinimage="http://xml-io.proteusthemes.com/legalpress/wp-content/uploads/sites/26/2015/07/pin.png"][/pt_vc_container_google_map][/vc_column][/vc_row][vc_row full_width="stretch_row" css=".vc_custom_1440408708129{margin-bottom: 0px !important;padding-top: 40px !important;padding-bottom: 40px !important;background-image: url(http://xml-io.proteusthemes.com/legalpress/wp-content/uploads/sites/26/2015/06/pattern-background.png) !important;}"][vc_column width="1/1"][vc_column_text]
<div class="featured-widget">
<div class="number-counter">
<div class="row">
<div class="col-xs-12 col-md-3">
<div class="number-counter__item">
<h2>1800+</h2>
Trusted Clients</div>
</div>
<div class="col-xs-12 col-md-3">
<div class="number-counter__item">
<h2>$5.000.000</h2>
Recovered For Our Clients</div>
</div>
<div class="col-xs-12 col-md-3">
<div class="number-counter__item">
<h2>98%</h2>
Successful Cases</div>
</div>
<div class="col-xs-12 col-md-3">
<div class="number-counter__item number-counter--last">
<h2>1520+</h2>
Cases Closed</div>
</div>
</div>
</div>
</div>
[/vc_column_text][/vc_column][/vc_row]
CONTENT;

	vc_add_default_templates( $data );
}