<?php
require_once($GLOBALS['g_campsiteDir']."/$ADMIN_DIR/articles/article_common.php");
require_once($GLOBALS['g_campsiteDir']."/classes/Log.php");

if (!SecurityToken::isValid()) {
    camp_html_display_error(getGS('Invalid security token!'));
    exit;
}

// Check permissions
if (!$g_user->hasPermission('Publish')) {
	camp_html_display_error(getGS("You do not have the right to change this article.  You may only edit your own articles and once submitted an article can only be changed by authorized users." ));
	exit;
}

// Get input
$f_publication_id = Input::Get('f_publication_id', 'int', 0);
$f_issue_number = Input::Get('f_issue_number', 'int', 0);
$f_section_number = Input::Get('f_section_number', 'int', 0);
$f_language_id = Input::Get('f_language_id', 'int', 0);
$f_language_selected = Input::Get('f_language_selected', 'int', 0);
$f_article_language = Input::Get('f_article_language', 'int', 0);
$f_article_number = Input::Get('f_article_number', 'int', 0);
$f_move = Input::Get('f_move', 'string', 'up_rel');
$f_position = Input::Get('f_position', 'int', 1, true);

if (!Input::IsValid()) {
	camp_html_display_error(getGS('Invalid input: $1', Input::GetErrorString()));
	exit;
}


$publicationObj = new Publication($f_publication_id);
if (!$publicationObj->exists()) {
	camp_html_display_error(getGS('Publication does not exist.'));
	exit;
}

$issueObj = new Issue($f_publication_id, $f_language_id, $f_issue_number);
if (!$issueObj->exists()) {
	camp_html_display_error(getGS('Issue does not exist.'));
	exit;
}

$sectionObj = new Section($f_publication_id, $f_issue_number, $f_language_id, $f_section_number);
if (!$sectionObj->exists()) {
	camp_html_display_error(getGS('Section does not exist.'));
	exit;
}

$articleObj = new Article($f_article_language, $f_article_number);
if (!$articleObj->exists()) {
	camp_html_display_error(getGS('Article does not exist.'));
	exit;
}

switch ($f_move) {
case 'up_rel':
	$articleObj->positionRelative('up', 1);
	break;
case 'down_rel':
	$articleObj->positionRelative('down', 1);
	break;
case 'abs':
	$articleObj->positionAbsolute($f_position);
	break;
default: ;
}

$url = "/$ADMIN/articles/index.php"
		."?f_publication_id=".$articleObj->getPublicationId()
		."&f_issue_number=".$articleObj->getIssueNumber()
		."&f_section_number=".$articleObj->getSectionNumber()
		."&f_article_number=".$articleObj->getArticleNumber()
		."&f_language_selected=$f_language_selected"
		."&f_language_id=".$f_language_id;
camp_html_add_msg(getGS("Article order changed."), "ok");
camp_html_goto_page($url);
?>