<?php

class GetId
{
    static function idCount(string $file) :int
    {
        $contenidoArchivo = file_get_contents($file);
        $usuarios = json_decode($contenidoArchivo,true);
        return $usuarios[0]['total_historic'];
    }

    static function updateIdCount(string $file) :void
    {
        $contentFile = file_get_contents($file);
        $currentData = json_decode($contentFile,true);
        $currentData[0]['total_historic'] += 1;
        $archive = fopen($file,'w');
        fwrite($archive,json_encode($currentData));
        fclose($archive);
    }
}