<?php

namespace App\Extensions;

class ReplaybookDataConvert
{
    public static function convertChampionName($name){
        switch(strtolower($name)){
            case "twistedfate":
                return 4;
            case "xinzhao":
                return 5;
            case "masteryi":
                return 11;
            case "nunu":
                return 20;
            case "missfortune":
                return 21;
            case "chogath":
                return 31;
            case "drmundo":
                return 36;
            case "jarvaniv":
                return 59;
            case "monkeyking":
                return 62;
            case "leesin":
                return 64;
            case "kogmaw":
                return 96;
            case "khazix":
                return 121;
            case "aurelionsol":
                return 136;
            case "kaisa":
                return 145;
            case "velkoz":
                return 161;
            case "tahmkench":
                return 223;
            case "reksai":
                return 421;
            case "belveth":
                return 200;
            default:
                return null;
        }
    }

    public static function convertRoleNames($role){
        switch(strtolower($role)){
            case "bottom":
                return "adc";
            case "utility":
                return "support";
            default:
                return strtolower($role);
        }
    }
}