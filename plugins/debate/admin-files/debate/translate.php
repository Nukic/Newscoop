<?php
camp_load_translation_strings("plugin_debate");

// Check permissions
if (!$g_user->hasPermission('plugin_debate_admin')) {
    camp_html_display_error(getGS('You do not have the right to manage debates.'));
    exit;
}

$allLanguages = Language::GetLanguages();

$f_debate_nr = Input::Get('f_debate_nr', 'int');
$f_fk_language_id = Input::Get('f_fk_language_id', 'int');

$debate = new Debate($f_fk_language_id, $f_debate_nr);

if ($debate->exists()) {
    foreach ($debate->getTranslations() as $translation) {
        $existing[$translation->getLanguageId()] = true;
    }
    $title = $debate->getProperty('title');
    $question = $debate->getProperty('question');
    $is_used_as_default = false;
}

echo camp_html_breadcrumbs(array(
    array(getGS('Plugins'), $Campsite['WEBSITE_URL'] . '/admin/plugins/manage.php'),
    array(getGS('Debates'), $Campsite['WEBSITE_URL'] . '/admin/debate/index.php'),
    array(getGS('Translate Debate'), ''),
));
?>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="1" class="action_buttons" style="padding-top: 5px;">
<TR>
    <TD><A HREF="index.php"><IMG SRC="<?php echo $Campsite["ADMIN_IMAGE_BASE_URL"]; ?>/left_arrow.png" BORDER="0"></A></TD>
    <TD><A HREF="index.php"><B><?php  putGS("Debate List"); ?></B></A></TD>
</TR>
</TABLE>

<?php
include_once($GLOBALS['g_campsiteDir']."/$ADMIN_DIR/javascript_common.php");
camp_html_display_msgs();
?>

<P>
<FORM NAME="edit_debate" METHOD="POST" ACTION="do_translate.php" onsubmit="return <?php camp_html_fvalidate(); ?>;">
<?php echo SecurityToken::FormParameter(); ?>
<?php if ($debate) { ?>
<INPUT TYPE="HIDDEN" NAME="f_debate_nr" VALUE="<?php  p($debate->getNumber()); ?>">
<INPUT TYPE="HIDDEN" NAME="f_fk_language_id" VALUE="<?php  p($debate->getLanguageId()); ?>">
<?php } ?>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="6" class="table_input">
<TR>
    <td valign="top">
        <table>
          <TR>
            <TD ALIGN="RIGHT" ><?php  putGS("Language"); ?>:</TD>
            <TD style="padding-top: 3px;">
                <?php if (count($allLanguages) > 1) { ?>
                <SELECT NAME="f_target_language_id" alt="select" emsg="<?php putGS("You must select a language.")?>" class="input_select">
                <option value="0"><?php putGS("---Select language---"); ?></option>
                <?php
                 foreach ($allLanguages as $tmpLanguage) {
                   if (!array_key_exists($tmpLanguage->getLanguageId(), $existing)) {
                     camp_html_select_option($tmpLanguage->getLanguageId(),
                                             @$f_target_language_id,
                                             $tmpLanguage->getNativeName());
                   }
                }
                ?>
                </SELECT>
                <?php } else {
                    $tmpLanguage = array_pop($allLanguages);
                    echo '<b>'.htmlspecialchars($tmpLanguage->getNativeName()).'</b>';
                    ?>
                    <input type="hidden" name="f_target_language_id" value="<?php p($tmpLanguage->getLanguageId()); ?>">
                    <?php
                }
                ?>

            </TD>
        </TR>
        <tr>
            <TD ALIGN="RIGHT" ><?php  putGS("Title"); ?>:</TD>
            <TD>
            <INPUT TYPE="TEXT" NAME="f_title" SIZE="40" MAXLENGTH="255" class="input_text" alt="blank" emsg="<?php putGS('You must fill in the $1 field.', getGS('Title')); ?>" value="<?php echo htmlspecialchars($title); ?>">
            </TD>
        </TR>
        <tr>
            <TD ALIGN="RIGHT" ><?php  putGS("Question"); ?>:</TD>
            <TD>
            <TEXTAREA NAME="f_question" class="input_textarea" cols="28" alt="blank" emsg="<?php putGS('You must fill in the $1 field.', getGS('Question')); ?>"><?php echo htmlspecialchars($question); ?></TEXTAREA>
            </TD>
        </TR>
        <?php
        foreach ($debate->getAnswers() as $answer) {
            ?>
            <tr>
                <TD ALIGN="RIGHT" ><?php  putGS("Answer $1", $answer->getNumber()); ?>:</TD>
                <TD>
                <INPUT TYPE="TEXT" NAME="f_answer[<?php p($answer->getNumber()); ?>]" SIZE="40" MAXLENGTH="255" class="input_text" alt="blank" emsg="<?php putGS('You must fill in the $1 field.', getGS('Answer $1', $answer->getNumber())); ?>" value="<?php p(htmlspecialchars($answer->getProperty('answer'))); ?>">
                </TD>
            </TR>
            <?php
        }
        ?>
      </table>
    </td>
</tr>
<TR>
    <TD COLSPAN="2" align="center">
        <HR NOSHADE SIZE="1" COLOR="BLACK">
        <INPUT TYPE="submit" NAME="save" VALUE="<?php  putGS('Save'); ?>" class="button">
    </TD>
</TR>
</TABLE>
</FORM>
