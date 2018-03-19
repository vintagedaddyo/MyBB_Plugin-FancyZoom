<?php
/*
 * MyBB: FancyZoom
 *
 * File: fancyzoom.php
 * 
 * Authors: Sebastian Wunderlich & Vintagedaddyo
 *
 * MyBB Version: 1.8
 *
 * Plugin Version: 1.4
 * 
 */

// Disallow direct access to this file for security reasons
if(!defined("IN_MYBB"))
{
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

$plugins->add_hook("pre_output_page","fancyzoom");

function fancyzoom_info()
{
    global $lang;

    $lang->load("fancyzoom");
    
    $lang->fancyzoom_Desc = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="float:right;">' .
        '<input type="hidden" name="cmd" value="_s-xclick">' . 
        '<input type="hidden" name="hosted_button_id" value="AZE6ZNZPBPVUL">' .
        '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">' .
        '<img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1">' .
        '</form>' . $lang->fancyzoom_Desc;

    return Array(
        'name' => $lang->fancyzoom_Name,
        'description' => $lang->fancyzoom_Desc,
        'website' => $lang->fancyzoom_Web,
        'author' => $lang->fancyzoom_Auth,
        'authorsite' => $lang->fancyzoom_AuthSite,
        'version' => $lang->fancyzoom_Ver,
        'compatibility' => $lang->fancyzoom_Compat
    );
}

function fancyzoom($page)
{
	global $mybb,$db;
	if(THIS_SCRIPT=="showthread.php")
	{
		$result=$db->simple_select("threads","fid","tid='".intval($mybb->input["tid"])."'",array("limit"=>1));
		$thread=$db->fetch_array($result);
		$permissions=forum_permissions($thread["fid"]);
		if(!empty($thread)&&$permissions["candlattachments"]==1)
		{
			$page=str_replace("</head>",'<script type="text/javascript" src="'.$mybb->settings["bburl"].'/jscripts/fancyzoom/FancyZoom.js"></script>
<script type="text/javascript" src="'.$mybb->settings["bburl"].'/jscripts/fancyzoom/FancyZoomHTML.js"></script>
</head>',$page);
			$page=preg_replace('/\<body(.*)\>/Usi','<body$1 onload="setupZoom()">',$page);
			$page=preg_replace('/\<a href="attachment.php\?aid=([0-9]+)" target="_blank"\>\<img/Usi','<a href="attachment.php?aid=$1" rel="fancyzoom"><img',$page);
			return $page;
		}
	}
    if(THIS_SCRIPT=="portal.php")
    {

    {
    $page=str_replace("</head>",'<script type="text/javascript" src="'.$mybb->settings["bburl"].'/jscripts/fancyzoom/FancyZoom.js"></script>
<script type="text/javascript" src="'.$mybb->settings["bburl"].'/jscripts/fancyzoom/FancyZoomHTML.js"></script>
</head>',$page);
           $page=preg_replace('/\<body(.*)\>/Usi','<body$1 onload="setupZoom()">',$page);
           $page=preg_replace('/\<a href="attachment.php\?aid=([0-9]+)" target="_blank"\>\<img/Usi','<a href="attachment.php?aid=$1" rel="fancyzoom"><img',$page);
           return $page;
        }
    }


}

?>