<?php

/**
* this is a PHP class which converts text to voice
* It uses TTS-API and Google APIs
* Version: 1.4.1
*
* Usage:
* $tts = new tts(); 
* $d = $tts->say("text to convert", "language_code");
*
* Language Codes can be found at http://portalas.org/scripts/tts/docs/
*
* Author: Portalas - http://portalas.org/scripts/tts/
*/

$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
DEFINE('BASE_URL', $protocol . $_SERVER['HTTP_HOST'] . substr(__DIR__, strlen($_SERVER[ 'DOCUMENT_ROOT' ])) . DIRECTORY_SEPARATOR);
DEFINE('ROOT_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR );

$read = str_replace("'", "", $_POST['read']);
$read = str_replace("&", "and", $read);
$read = str_replace('"', "", $read);
$read = filter_var($read,FILTER_SANITIZE_STRING);
$lang = filter_var(strtolower($_POST['lang']),FILTER_SANITIZE_STRING);


if ($read != "") { 

 $tts = new tts(); 
 $d = $tts->say($read, $lang);

echo $d;
}


class tts {

/**
* @const audio folder location
*
*/
  const audioDir = "audio/";


/**
* @public $text
*
*/
  public $text;


/**
* @public $fetcher
*
*/
  private $fetcher;

      public function __construct($fetcher = null, $text='') {

        if (!isset($this->fetcher)) {
          $this->fetcher = (function_exists('curl_version')) ? curl : fgc;

        }
    }

/**
* returns mp3 file from text
*
* @param - $text - holds text which will be converted to voice.
*
*/

  public function say($text,$lang) {

    $this->text = $this->sanitize($text);
    $lang = $this->sanitize($lang);
    $this->lang_code = $lang;

    $this->lang = $this->setLang($lang);

  if ($this->lang_code == "en_us" || $this->lang_code == "en") {
        
        $file_url = $this->fetch("http://tts-api.com/tts.mp3?return_url=1&q=" . str_replace(" ","+",$this->text));

    }

    else {

      $this->fileName_hashed = $this->hash($this->text); 
      $isCached = $this->isCached($this->fileName_hashed);

      if ($isCached === true) {
        $file_url = $this->makeURL($this->fileName_hashed); 
      }

      else {
        $array_splitText = $this->split($this->text);
        $size_of = sizeof($array_splitText);

        for ($i = 0; $i < $size_of; $i++) {
          $encoded = urlencode($array_splitText[$i]);
          $_encoded = explode("UUUiL",$encoded);
          $writeToFile = $this->create($_encoded[0]);
        }

        $file_url = $this->makeURL($this->fileName_hashed); 
      }
    }
    return $file_url;
  }
  

public function setLang($lang) {

 switch ($lang) {
    case "en-us":
        $this->lang = "usenglishfemale";
        $this->exclude_chars = "-9139";
        break;

    case "en_gb":
        $this->lang = "ukenglishfemale";
        $this->exclude_chars = "-9139";
        break;

    case "en_au":
        $this->lang = "auenglishfemale";
        $this->exclude_chars = "-11939";
        break;

    case "mx":
        $this->lang = "usspanishmale";
        $this->exclude_chars = "-15139";
        break;

    case "zh-cn":
    case "zh":
        $this->lang = "chchinesefemale";
        break;

    case "jp":
    case "ja":
        $this->lang = "jpjapanesefemale";
        break;

    case "kr":
    case "ko":
        $this->lang = "krkoreanfemale";
        break;

    case "ar":
        $this->lang = "arabicmale";
        break;


    case "hu":
        $this->lang = "huhungarianfemale";
        break;


    case "pt-br":
    case "br":
        $this->lang = "brportuguesefemale";
        break;


    case "pt":
        $this->lang = "eurportuguesefemale";
        break;


    case "es":
        $this->lang = "eurspanishfemale";
        $this->exclude_chars = "-13939";
        break;


    case "ca":
        $this->lang = "eurcatalanfemale";
        $this->exclude_chars = "-10939";
        break;

    case "cs":
    case "cz":
        $this->lang = "eurczechfemale";
        break;


    case "da":
    case "dk":
        $this->lang = "eurdanishfemale";
        break;

    case "fi":
        $this->lang = "eurfinnishfemale";
        break;

    case "fr":
        $this->lang = "eurfrenchfemale";
        break;

    case "no":
        $this->lang = "eurnorwegianfemale";
        break;


    case "pl":
        $this->lang = "eurpolishfemale";
        break;

    case "it":
        $this->lang = "euritalianfemale";
        break;


    case "tr":
        $this->lang = "eurturkishfemale";
        break;

    case "gr":
    case "el":
        $this->lang = "eurgreekfemale";
        break;


    case "de":
        $this->lang = "eurgermanfemale";
        break;


    case "ru":
        $this->lang = "rurussianfemale";
        break;


    case "se":
    case "sv":
        $this->lang = "swswedishfemale";
        break;


    default:
        $this->lang = "usenglishfemale";
 }
  return $this->lang;
}

/**
* filters and sanitizes text
*
* @param - $text - text which to be filtered
*
*/

function sanitize($text) {

    if ($text == null) { 
      $text = "hey! the input is empty. type something in there!"; 
    }

    $var = filter_var($text, FILTER_SANITIZE_STRING);
    $var = str_replace(PHP_EOL, '', $var);
    $var = urldecode($var);

    return $var;
}


/**
* If a number of chars is bigger than 100, the variable is split into peaces, as google API allows to convert text
* which is up to 100 chars
* @param - $text - text to split
*
*/
  private function split($text, $i=0) {

      $text_split = array();
      $text_words = explode(' ', $text);
      $text_split[$i] = NULL;

foreach ($text_words as $w) {
                 $w = trim($w);
                 $w = stripslashes($w);
                 if (strlen($text_split[$i] . ' ' . strip_tags($w)) < 100) {
                    $text_split[$i] = $text_split[$i] . ' ' . $w;
                          if (preg_match('/[,.!?-]$/', $w)) { $i++; }
                          } else {
                          $text_split[++$i] = $w;

          } 
      }
      return $text_split;
  }


/**
* checking IF the same text was converted before, IF yes returning cached file
* 
* @param - $fileName_hashed - hashed (md5) text
*
*/

  private function isCached($fileName_hashed) {

    if (!isset($fileName_hashed) && $this->text != NULL) {

       $fileName_hashed = $this->hash($this->text);
    }
    
    
         if (file_exists(ROOT_DIR.self::audioDir.$fileName_hashed. '.mp3')) {
             return true;
         }
         else { return false; }

  }


/**
* converting split text strings into a mp3 file.
* 
* @param - $line - split text string
*
*/
  public function create($line) {
    if (!file_exists($this->makePathURL($this->fileName_hashed))) {
        $fetched = $this->fetch("http://www.ispeech.org/p/generic/getaudio?speed=0&action=convert&voice=".$this->lang."&text=".$line);
        $fetched = ( !empty($this->exclude_chars) || isset($this->exclude_chars) ) ? substr($fetched, 0, $this->exclude_chars) : $fetched;
        file_put_contents($this->makePathURL($this->fileName_hashed), $fetched) or die("cannot create mp3 file. Check folder permissions. - $this->fileName_hashed - $fetched");
    }

    else { 
      $fetched = $this->fetch("http://www.ispeech.org/p/generic/getaudio?speed=0&action=convert&voice=".$this->lang."&text=".$line);
      $fetched = ( !empty($this->exclude_chars) || isset($this->exclude_chars) ) ? substr($fetched, 0, $this->exclude_chars) : $fetched;
      file_put_contents($this->makePathURL($this->fileName_hashed), $fetched, FILE_APPEND); }
  }


/**
* Formatting URL of mp3
* 
* @param - $hash - hashed (md5) text
*
*/
  public function makeURL($hash) {

    $location = BASE_URL . self::audioDir . $hash . '.mp3';
    return $location;

  }
  public function makePathURL($hash) {

    $location = ROOT_DIR . self::audioDir . $hash . '.mp3';
    return $location;

  }

  private function hash($hash) { 

    if ($hash) { 
      $hash = $hash."_".$this->lang;
      $hashed = md5($hash);
      return $hashed;
    }
    
  }
  
  public function fetch($url) {
  
   if ($this->fetcher == "curl") { $fetched = $this->curl($url); }
   
   if ($this->fetcher == "fgc") {  $fetched = $this->fgc($url);  }
  
   return $fetched;
  }
  
  

    public function fgc($url) {
      $ret = @file_get_contents($url);
      return $ret;
    }

    public function curl($url) {
      $curl = curl_init();
      $useragent="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";
      curl_setopt($curl, CURLOPT_USERAGENT, $useragent);
      curl_setopt($curl, CURLOPT_REFERER, "http://www.google.com/");
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_HEADER, 0);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $ret = curl_exec($curl);
      curl_close($curl);


      return $ret;
    }
}


?>