<?
include "lib_admin.php";
 define('DIR','UserFiles/article/');
   $tpl=load_tpl_var('cms_admin/public/form_img.tpl');
 if (empty($_FILES))
 {

//  $tpltr=pars_reg($tpl, 'TR');
    echo $tpl;

 }
 else
 {
     $filename=@upload_file();
    if ($filename)
    {
        $text="<script>
        window.opener.document.getElementById('foto').value='$filename';
        close();
        </script>";
    }
    else
    {
       $text='';
    }
    $tpltr=pars_reg($tpl, 'FORM');
    $tpl=str_replace($tpltr, $text, $tpl);

    echo $tpl;

 }

function upload_file()
{
    global $user_data;
    if (is_uploaded_file(preg_replace('[\s+]', '_', $_FILES["yourfile"]["tmp_name"] )))
        {
            if (!$max_width)
                      $max_width = 150;
                    if (!$max_height)
                      $max_height = 350;

                               $w_h=GetImageSize($_FILES["yourfile"]["tmp_name"]);
                            $width=$w_h[0];
                            $height=$w_h[1];

                    $x_ratio = $max_width / $width;
                    $y_ratio = $max_height / $height;

                    if ( ($width <= $max_width) && ($height <= $max_height) ) {
                      $tn_width = $width;
                      $tn_height = $height;
                    }
                    else if (($x_ratio * $height) < $max_height) {
                      $tn_height = ceil($x_ratio * $height);
                      $tn_width = $max_width;
                    }
                    else {
                      $tn_width = ceil($y_ratio * $width);
                      $tn_height = $max_height;
                    }

            $type=$_FILES['yourfile']['type'];

            $_FILES["yourfile"]["tmp_name"] = preg_replace('[\s+]', '_', $_FILES["yourfile"]["tmp_name"]);
            $filename=$_FILES["yourfile"]["name"] = basename(preg_replace('[\s+]', '_', $_FILES["yourfile"]["name"]));
         //   $filename=md5($filename).'.jpg';
            $filename= $user_data['login']."_".mktime().'.jpg';
            $allowed_types = array("image/jpeg","image/pjpeg" );
            $size=$_FILES['yourfile']['size'];

        if ((in_array($type,$allowed_types)))// && $size<40*1024)
           {
                   $res = move_uploaded_file($_FILES["yourfile"]["tmp_name"], DIR.$filename );
                    resize_image($tn_width,$tn_height, DIR.$filename, DIR.$filename );

                 if ($res)  return $filename;
                           else
                           {
                                echo "not movi";
                                 return 0;
                           }
           }
         else
         {
          echo "not jpg";
          return 0;
         }
        }
    else
    {
      return 0;
    }
}



function resize_image($width, $height, $source, $destination) {
     $src = imagecreatefromjpeg($source);
      $img = imagecreatetruecolor($width, $height);
      imagecopyresampled($img, $src, 0, 0, 0, 0, $width, $height, imagesx($src),imagesy($src));
//    @unlink($destination);
      imageJPEG($img, $destination);
}
?>