<?php

abstract class Insert 
{
    public function makeRegister(array $keys, array $data, string $fileRoute) : void
    {
        $contentFile = file_get_contents($fileRoute);
        $currentData = json_decode($contentFile,true);
        $currentData[] = array_combine($keys,$data);
        $archive = fopen($fileRoute,'w');
        fwrite($archive,json_encode($currentData));
        fclose($archive);
    }
}