
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <title>Check the price 4U</title>
</head>
<body>
  <h1>Check the price 4U</h1>
<?php
  include_once('simple_html_dom.php');

  //get html content from the site.
  
  if($_SERVER['REQUEST_METHOD']== "POST"){
    $filename = "items.txt";
         $file = fopen( $filename, "r" );
         
         if( $file == false ) {
            echo ( "Error in opening file" );
            
         }
         else
         {

            $filesize = filesize( $filename );
            //empty file
            if($filesize==0){echo "Empty file"; exit();}
            $filetext = fread( $file, $filesize );
            fclose( $file );
            $pieces = explode(" ", $filetext);
            foreach ($pieces as $item) {
              $amazon = file_get_html("https://www.amazon.com/s?k=$item", false);
              //Amazon
              //Example:<span class="a-price-whole">59<span class="a-price-decimal">.</span></span>
              preg_match("'<span class=\"a-price-whole\">(.*?)<span class=\"a-price-decimal\">.</span></span>'si", $amazon, $amazonMatch);
              $url_amazon = "<a href='https://www.amazon.com/s?k=$item'> $item</a>";
              if($amazonMatch){
                echo "Amazon" . " -- " . $url_amazon . " -- " . $amazonMatch[1]. '$'."<br>";
              }
              else{
                echo "was not found in amazon <br>";
              }
            }


         }
         
        
  }


?>
 
</body>
</html>