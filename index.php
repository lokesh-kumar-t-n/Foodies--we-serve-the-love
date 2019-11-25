<HTML>
<HEAD>
<TITLE>Welcome to Foodies - we serve the love!</TITLE>
<style type="text/css">
@import url(style.css);
   a:link {color: #ffffff}
   a:visited {color: #ffffff}
   a:hover {color: #ffffff}
   a:active {color: #ffffff}
</style>
<script type="text/javascript">
	obj = {
		order: function(){
			window.location.replace("http://localhost/Foodies/order");
		},
		index: function(){
			window.location.replace("http://localhost/Foodies/home");
		}
	}
</script>
</HEAD>
<BODY background="background1.jpg">
<?php include("header.php"); ?>
<FONT size="5" color="white">
<SECTION align="center"><A onclick="obj.index()" HREF="home"><IMG SRC="logo.png" alt="Home" id="logo"></IMG></A></SECTION>
<SECTION>
<MAIN>
<B><P>We are available only at the following regions.<BR> Please select any one:</P></B></FONT>
<SECTION align="center"><IMG src="clickhere.gif" width="100" height="50"></IMG></SECTION>
<TABLE >
<TR><TD><FONT size="6"  color="white">
<A HREF="order" style="text-decoration: none">1)Bangalore West</A></FONT></TD></TR>
<TR><TD><FONT size="6"  color="white">
<A HREF="order" style="text-decoration: none">2)Bangalore East</A></FONT></TD></TR>
<TR><TD><FONT size="6"  color="white">
<A HREF="order" style="text-decoration: none">3)Bangalore North</A></FONT></TD></TR>
<TR><TD><FONT size="6"  color="white">
<A HREF="order" style="text-decoration: none">4)Bangalore South</A></FONT></TD></TR>
</TABLE>
</SECTION>
</MAIN><BR><HR width="1000">
<FOOTER >
<FONT size="2" color="white">
By continuing past this page, you agree to our Terms of Service, Cookie Policy, Privacy Policy and Content Policies. &copy 2019-2020 - Foodies Media Pvt Ltd. All rights reserved.</FONT>
</FOOTER>
</BODY>
</HTML>