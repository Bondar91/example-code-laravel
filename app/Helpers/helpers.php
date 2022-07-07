<?php

if(!function_exists('convertToTotalPrice'))
{
    function convertToTotalPrice(int $value)
    {
        return $value/100;
    }
}

if(!function_exists('convertToChangePrice'))
{
    function convertToChangePrice(float $value)
    {
        return $value*100;
    }
}

if(!function_exists('removeCharactersFromString'))
{
    function removeCharactersFromString(string $value)
    {
        $characters = array(" ", "/", "-");
        $new_value = str_replace($characters, '', $value);
        return $new_value;
    }
}


if(!function_exists('generateZipCodeWithCorrectFormat'))
{
    function generateZipCodeWithCorrectFormat(string $site_lang, string $zipCode): string
    {
        if($site_lang === "PL")
        {
            $zipCodeWithoutSpacesAndSpecialCharacters = str_replace(['.', '+', '*', '?', '^', '$', '(', ')', '[', ']', '{', '}', '|', '-', '_', '=', ' '], '', $zipCode);

            $str1 = substr($zipCodeWithoutSpacesAndSpecialCharacters, 0, 2);
            $str2 = substr($zipCodeWithoutSpacesAndSpecialCharacters, 2);

            return $str1."-".$str2;
        }

        return $zipCode;
    }
}

if(!function_exists('validateFirstName'))
{
    function validateFirstName(string $sentence): string
    {
        return ucfirst(strtolower(explode(' ',trim($sentence))[0]));
    }
}
