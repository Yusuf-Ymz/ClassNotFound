<?php

final class Utils
{
    # Method that replace \n by <br> in any string
    public static function html_replace_enter_by_br($string)
    {
        return str_replace("\n", '<br>', $string);
    }

    # Verify if question's author is the logged member
    public static function verify_displaying_best_answer_button($member, $answer, $authorLogin)
    {
        if ($member->login() == $authorLogin && $answer->author()->memberId() != $member->memberId())
            return true;
        return false;
    }
}