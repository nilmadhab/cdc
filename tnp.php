
    <?php
        require_once('simple_html_dom.php');
        function db_connect(){

    $con = mysqli_connect("localhost","root","25011994","tnp_new");
    
    // Check connection
    if (mysqli_connect_errno())
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
  
    
    return $con;
}
$conn = db_connect();

    ?>

    <?php 
        function single_page($url){
           $conn = db_connect();
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             curl_setopt($ch ,CURLOPT_PROXY, '10.3.100.207');
            curl_setopt($ch, CURLOPT_PROXYPORT,'8080');
            $page = curl_exec($ch);
            $page = str_get_html($page);
            //echo $page;
            //curl_close($ch);
            $count =0;
            $title = $page->find(".content-article-title",0);
           // echo "<h1> Title </h1>";
           // echo $title->plaintext."<br />";
            $title = mysqli_real_escape_string($conn,$title->plaintext);
           // echo "<h1> date </h1>";
            $date = $page->find(".date",0);
            // echo $date->plaintext."<br />";
              $date = mysqli_real_escape_string($conn,$date->plaintext);
             $content = $page->find(".main-article-content",0);
           //  echo "<h1> content </h1>";
            // echo $content->plaintext."<br />";
              $content = mysqli_real_escape_string($conn,$content->plaintext);
                $sql1 = "INSERT INTO `articles`( `url`, `title`, `date`, `content`) 
                VALUES ('$url','$title','$date','$content')";

                //echo $sql1."<br />";


                if( mysqli_query($conn,$sql1) ) {
                    echo "recoreds inserted sucessfully".$no_insert;//."<br />";
                    //echo "\n";
                    //$no_insert +=1;
                }else{
                    echo $sql1."<br />";
                    echo "\n";
                    echo "insertion failed".mysqli_error($conn);
                    echo "\n";
                }
               // return 0;

        }

       // single_page("http://www.northeasttoday.in/louis-berger-papers-missing-assam-cm-orders-cid-probe/");
       /* $url = "http://www.northeasttoday.in/category/arunachal-pradesh/";
        $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             curl_setopt($ch ,CURLOPT_PROXY, '10.3.100.207');
            curl_setopt($ch, CURLOPT_PROXYPORT,'8080');
            $page = curl_exec($ch);
            $page = str_get_html($page);
            //echo $page;
            curl_close($ch);
            $count =0;
            $content = $page->find(".main-content-left",0);
             $links = $content->find("h2");
            foreach ($links as $url1) {
                $url = $url1->find("a",0);
                $count +=1;
               // if(!preg_match("/northeasttoday.in/", subject))
                echo $count." : ".$url->plaintext."-->".$url->getAttribute("href")."<br />";

                single_page($url->getAttribute("href"));
            }*/



            $url = "http://tnp.webtutplus.com/file.html";
              $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             curl_setopt($ch ,CURLOPT_PROXY, '10.3.100.207');
            curl_setopt($ch, CURLOPT_PROXYPORT,'8080');
            $page = curl_exec($ch);
            $page = str_get_html($page);
            //echo $page;
            curl_close($ch);
            $count =0;
            $content = $page->find("body",0);
            // $links = $content->find("a");
            //echo $content;
            
            $rows = $content->find("row");
            foreach ($rows as $row) {
               // echo htmlentities($row);
                 $cells = $row->find("cell");

                 $count = 1;
                 foreach ($cells as $cell) {
                     $str = htmlentities($cell);
                    // $str = str_replace("\\", "", $str);
                 $main = explode("CDATA[", $str)[1];

                 $main = explode("]]", $main)[0];
                 if($count != 8)
                 $main =  str_replace("\\", "", strip_tags(html_entity_decode($main)) );
                    else
                 $main =  str_replace("\\", "", $main) ;
                   ${'cell_' . $count} = $main;
                //echo $ab; // hello there
                 $count +=1;
                // echo $main;
                 }
                 $cell_1 = mysqli_real_escape_string($conn,$cell_1);
                 echo $cell_1."<br />";
                   $cell_2 = mysqli_real_escape_string($conn,$cell_2);
                     $cell_3 = mysqli_real_escape_string($conn,$cell_3);
                       $cell_4 = mysqli_real_escape_string($conn,$cell_4);
                         $cell_5 =  mysqli_real_escape_string($conn,$cell_5);
                           $cell_6 = mysqli_real_escape_string($conn,$cell_6);
                             $cell_7 =  mysqli_real_escape_string($conn,$cell_7);
                               $cell_8 = mysqli_real_escape_string($conn,$cell_8); 
                                $cell_9 = mysqli_real_escape_string($conn,$cell_9);
                                 $cell_10 = mysqli_real_escape_string($conn,$cell_10);
                /* echo $cell_2."<br />";
                 echo $cell_3."<br />";
                 echo $cell_4."<br />";
                 echo $cell_5."<br />";
                 echo $cell_6."<br />";
                 echo $cell_7."<br />";
                 echo $cell_8."<br />";
                 echo $cell_9."<br />";
                 echo $cell_10."<br />";*/
                  $sql1 = "INSERT INTO `data`(`cell1`, `cell2`, `cell3`, `cell4`, `cell5`, `cell6`, `cell7`, `cell8`, `cell9`, `cell10`) 
                  VALUES ('$cell_1','$cell_2','$cell_3','$cell_4','$cell_5',
                    '$cell_6','$cell_7','$cell_8','$cell_9','$cell_10')";

                //echo $sql1."<br />";


                if( mysqli_query($conn,$sql1) ) {
                    echo "recoreds inserted sucessfully".$no_insert."<br />\n";
                    //echo "\n";
                    //$no_insert +=1;
                }else{
                    echo $sql1."<br />";
                    echo "\n";
                    echo "insertion failed".mysqli_error($conn);
                    echo "\n";
                }
                // echo htmlentities($cell[0]);

                //break;

            }

    ?>

