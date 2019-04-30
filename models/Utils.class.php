<?php

final class Utils
{
    # Method that replace \n by <br> in any string
    public static function html_replace_enter_by_br($string)
    {
        return str_replace("\n", '<br>', $string);
    }

    public static function verify_member_liked($answer, $memberId)
    {
        if ($memberId != null) {
            if ($answer->check_member_liked($memberId)) {
                echo 'btn btn-primary';
            } else {
                echo 'btn btn-dark';
            }
        } else {
            echo 'btn btn-dark';
        }
    }


    public static function verify_member_disliked($answer, $memberId)
    {
        if ($memberId != null) {
            if ($answer->check_member_disliked($memberId)) {
                echo 'btn btn-danger';
            } else {
                echo 'btn btn-dark';
            }
        } else {
            echo 'btn btn-dark';
        }
    }

    public static function verify_displaying_best_answer_button($member, $answer, $authorLogin)
    {
        if ($member->login() == $authorLogin && $answer->author()->memberId() != $member->memberId())
            return true;
        return false;
    }
}