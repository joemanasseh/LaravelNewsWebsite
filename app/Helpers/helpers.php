<?php

use Illuminate\Support\Facades\Auth;

// Slug Function

function slug($data) {
    $data = str_replace(' ','_',$data);
    $data = strtolower($data);
    $data = preg_replace('/[^a-zA-Z0-9_]+/', '_', $data);
    return $data;

}

function timeago( $ptime )
{
    $ptime = strtotime( $ptime );

    $estimate_time = time() - $ptime;

    if( $estimate_time < 1 )
    {
        return 'less than 1 second ago';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}

function strip_defined_tags($str, $tags, $stripContent = false) {
    $content = '';
    if (!is_array($tags)) {
      $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
      if(end($tags) == '') array_pop($tags);
    }
    foreach($tags as $tag) {
        if ($stripContent) {
            $content = '(.+</'.$tag.'(>|\s[^>]*>)|)';
            $str = preg_replace('#</?'.$tag.'(>|\s[^>]*>)'.$content.'#is', '', $str);
        }
    }
    return $str;
}

function makeTitle($title)
{
    $title = strtolower($title);
    $str = ucwords($title);     
    $exclude = 'a,an,the,for,and,nor,but,or,yet,so,such,as,at,around,by,after,along,for,from,of,on,to,with,without';        
    $excluded = explode(",",$exclude);
    foreach($excluded as $noCap){$str = str_replace(ucwords($noCap),strtolower($noCap),$str);}      
    return ucfirst($str);
}


// function titleCase($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = array("a", "an", "the", "for", "and", "nor", "but", "or", "yet", "so", "such", "as", "at", "around", "by", "after", "along", "for", "from", "of", "on", "to", "with", "without", "I", "II", "III", "IV", "V", "VI"))
// {
//     /*
//      * Exceptions in lower case are words you don't want converted
//      * Exceptions all in upper case are any words you don't want converted to title case
//      *   but should be converted to upper case, e.g.:
//      *   king henry viii or king henry Viii should be King Henry VIII
//      */
//     $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
//     foreach ($delimiters as $dlnr => $delimiter) {
//         $words = explode($delimiter, $string);
//         $newwords = array();
//         foreach ($words as $wordnr => $word) {
//             if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
//                 // check exceptions list for any words that should be in upper case
//                 $word = mb_strtoupper($word, "UTF-8");
//             } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
//                 // check exceptions list for any words that should be in upper case
//                 $word = mb_strtolower($word, "UTF-8");
//             } elseif (!in_array($word, $exceptions)) {
//                 // convert to uppercase (non-utf8 only)
//                 $word = ucfirst($word);
//             }
//             array_push($newwords, $word);
//         }
//         $string = join($delimiter, $newwords);
//    }//foreach
//    return $string;
// }




function titleCase($string) {
    //reference http://grammar.about.com/od/tz/g/Title-Case.htm
    // The below array contains the most commonly non-capitalized words in title casing - I'm not so sure about the commented ones that follow it...
    $minorWords = array('a','an','and','as','at','but','by','for','in','nor','of','on','or','per','the','to','with'); // but, is, if, then, else, when, from, off, out, over, into,
    // take the input string, trim whitespace from the ends, single out all repeating whitespace
    $string = preg_replace('/[ ]+/', ' ', trim($string));
    // explode string into array of words
    $pieces = explode(' ', $string);
    // for each element in array...
    for($p = 0; $p <= (count($pieces) - 1); $p++){
        // check if the whole word is capitalized (as in acronyms), if it is not...
        if(strtoupper($pieces[$p]) != $pieces[$p]){
            // reduce all characters to lower case
            $pieces[$p] = strtolower($pieces[$p]);
            // if the value of the element doesn't match any of the elements in the minor words array, and the index is not equal to zero, or the numeric key of the last element...
            if(!in_array($pieces[$p], $minorWords) || ($p === 0 || $p === (count($pieces) - 1))){
                // ...capitalize it.
                $pieces[$p] = ucfirst($pieces[$p]);
            }
            // check for hyphenated words?... apparently, even title casing, it's okay for a the second word to be lower case...
        }
    }
    // re-connect all words in array with a space
    $string = implode(' ', $pieces);
    // return title-cased string
    return $string;
}


function loggeduser() {
    return Auth::user()->role;
}


?>