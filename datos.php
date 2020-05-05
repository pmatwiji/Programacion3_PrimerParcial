<?php

class Datos {


    public static function guardarUno($archivo,$objeto) {
        $file = fopen($archivo,'w');
        $rta = fwrite($file,serialize($objeto));
        fclose($file);
        echo  "Cargado exitosamente".PHP_EOL;
    }

    public static function guardarJson($archivo,$objeto) {
        $arrayJSON = array();
        $arrayJSON = Datos::leerJson($archivo);
        $repetido = false;

        foreach($arrayJSON as $value)
        {
            if($value->email == $objeto->email)
            {
                $repetido = true;
            }
        }
        if(!$repetido) {
            array_push($arrayJSON,$objeto);
            $file = fopen($archivo, 'w');
            $rta = fwrite($file,serialize($arrayJSON));
            fclose($file);
            echo "Cargado exitosamente".PHP_EOL;
        } else {
            $rta = false;
            echo "Entrada repetida";
        }
        return $rta;
    }

    public static function guardarMateria($archivo,$objeto) {
        $arrayJSON = array();
        $arrayJSON = Datos::leerJson($archivo);
        
        array_push($arrayJSON,$objeto);
        $file = fopen($archivo, 'w');
        $rta = fwrite($file,serialize($arrayJSON));
        fclose($file);
        
        return $rta;
    }

    public static function guardarProfesor($archivo,$objeto) {
        $arrayJSON = array();
        $arrayJSON = Datos::leerJson($archivo);
        
        array_push($arrayJSON,$objeto);
        $file = fopen($archivo, 'w');
        $rta = fwrite($file,serialize($arrayJSON));
        fclose($file);
        
        return $rta;
    }


    public static function leerJson($archivo) {
        $arrayJSON = array();
        $file = fopen($archivo, 'r');
        //$arrayString = fread($file, filesize($archivo));
        $arrayString = fgets($file);
        $arrayJSON = unserialize($arrayString);
        fclose($file);
        return $arrayJSON;
    }

    public static function marcaDeAgua($original, $watermark, $destino, $margenX, $margenY, $transparencia)
    {
        $imagenBase  = imagecreatefromjpeg($original);
        $imagenMarca = imagecreatefrompng($watermark);
        
        $width = imagesx($imagenMarca);
        $height = imagesy($imagenMarca);

        $imagenMarca = imagescale($imagenMarca,124,124);

        if(file_exists($original) && file_exists($watermark))
        {
            if($transparencia < 0 || $transparencia > 100)
            {
                $transparencia = 0;
            }
            imagecopymerge($imagenBase,$imagenMarca,imagesx($imagenBase)-$width-$margenX,imagesy($imagenBase)-$height-$margenY,0,0,$width,$height,$transparencia);
            imagepng($imagenBase,$destino);
            imagedestroy($imagenBase);
            return true;
        }
        else
        {
            return false;
        }
    }

}

?>