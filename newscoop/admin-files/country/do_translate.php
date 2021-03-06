<?php
require_once($GLOBALS['g_campsiteDir']. "/$ADMIN_DIR/country/country_common.php");

if (!SecurityToken::isValid()) {
    camp_html_display_error(getGS('Invalid security token!'));
    exit;
}

if (!$g_user->hasPermission('ManageCountries')) {
	camp_html_display_error(getGS("You do not have the right to translate country names."));
	exit;
}

$f_country_code = Input::Get('f_country_code');
$f_country_orig_language = Input::Get('f_country_orig_language');
$f_country_new_language = Input::Get('f_country_new_language');
$f_country_name = trim(Input::Get('f_country_name'));

$country = new Country($f_country_code, $f_country_orig_language);
$language = new Language($f_country_new_language);
$correct = true;
$created = false;

if (empty($f_country_name)) {
	$correct = false;
	$errorMsgs[] = getGS("You must fill in the $1 field.", "<B>".getGS("Name")."</B>");
}

if (!$language->exists()) {
    $correct = false;
    $errorMsgs[] = getGS('You must select a language.');
}

if ($correct) {
	$newCountry = new Country($f_country_code, $f_country_new_language);
	$created = $newCountry->create(array('Name' => $f_country_name));
	if ($created) {
	    camp_html_goto_page("/$ADMIN/country/");
	} else {
		$errorMsgs[] = getGS('The country name $1 could not be translated','<B>'.$country->getName().'</B>');
	}
}

$crumbs = array();
$crumbs[] = array(getGS("Configure"), "");
$crumbs[] = array(getGS("Countries"), "/$ADMIN/country/");
$crumbs[] = array(getGS("Adding new translation"), "");
echo camp_html_breadcrumbs($crumbs);

?>
<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="8" class="message_box">
<TR>
	<TD COLSPAN="2">
		<B> <?php  putGS("Adding new translation"); ?> </B>
		<HR NOSHADE SIZE="1" COLOR="BLACK">
	</TD>
</TR>
<TR>
	<TD COLSPAN="2">
	<BLOCKQUOTE>
	<?PHP
	foreach ($errorMsgs as $errorMsg) { ?>
		<li><?php p($errorMsg); ?></li>
		<?php
	}
	?>
	</BLOCKQUOTE>
	</TD>
</TR>
<TR>
	<TD COLSPAN="2">
	<DIV ALIGN="CENTER">
	<INPUT TYPE="button" class="button" NAME="OK" VALUE="<?php  putGS('OK'); ?>" ONCLICK="location.href='/<?php p($ADMIN); ?>/country/'">
	</DIV>
	</TD>
</TR>
</TABLE>
<P>

<?php camp_html_copyright_notice(); ?>
