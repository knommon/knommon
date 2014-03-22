<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-us" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="MobileOptimized" content="width">
	<meta name="HandheldFriendly" content="true">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=no">
    <title>
    	@yield('subject')
    </title>
    <style type="text/css">
    	@media only screen and (max-width: 520px) {
			/* /\/\/\/\/\/\/ CLIENT-SPECIFIC MOBILE STYLES /\/\/\/\/\/\/ */
			body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:none !important;} /* Prevent Webkit platforms from changing default text sizes */
            body{width:100% !important; min-width:100% !important;} /* Prevent iOS Mail from adding padding to the body */

			/* /\/\/\/\/\/\/ MOBILE RESET STYLES /\/\/\/\/\/\/ */
			/*#bodyCell{padding:0px !important;border:none !important;}*/

			/* /\/\/\/\/\/\/ MOBILE TEMPLATE STYLES /\/\/\/\/\/\/ */

			/* ======== Page Styles ======== */
			#templateContainer{
				max-width:600px !important;
				/*@editable*/ width:100% !important;
				border: none !important;
			}
			h1{
				/*@editable*/ font-size:24px !important;
				/*@editable*/ line-height:100% !important;
			}
			h2{
				/*@editable*/ font-size:20px !important;
				/*@editable*/ line-height:100% !important;
			}
			h3{
				/*@editable*/ font-size:18px !important;
				/*@editable*/ line-height:100% !important;
			}

			h4{
				/*@editable*/ font-size:16px !important;
				/*@editable*/ line-height:100% !important;
			}

			/* ======== Header Styles ======== */
			#templatePreheader{display:none !important;} /* Hide the template preheader to save space */

			#headerImage{
				height:auto !important;
				/*@editable*/ max-width:600px !important;
				/*@editable*/ width:100% !important;
			}

			.headerContent{
				/*@editable*/ font-size:20px !important;
				/*@editable*/ line-height:125% !important;
			}

			/* ======== Body Styles ======== */

			#bodyImage{
				height:auto !important;
				/*@editable*/ max-width:560px !important;
				/*@editable*/ width:100% !important;
			}

			.bodyContent{
				/*@editable*/ font-size:18px !important;
				/*@editable*/ line-height:125% !important;
			}

			/* ======== Footer Styles ======== */

			.footerContent{
				/*@editable*/ font-size:14px !important;
				/*@editable*/ line-height:115% !important;
			}

			/*.footerContent a{display:block;}*/ /* Place footer social and utility links on their own lines, for easier access */
		}
    </style>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;margin: 0;padding: 0;height: 100%;width: 100%;">
	<!-- HTML EMAIL goes here -->
	@yield('body')
</body>
</html>