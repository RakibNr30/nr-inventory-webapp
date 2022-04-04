<?php

namespace App\Helpers;

/**
 * Class that summarizes processing related to CSV
 * Class CsvManager
 * @package App\Helpers
 */
class CsvManager
{
    /**
     * Read data from csv file
     *
     * @param $csvFilePath string csv file path
     * @param $arrSeparator array Setting delimiters
     * @return array
     */
    static public function readCsv(string $csvFilePath, $arrSeparator = ['delimiter' => ',']): array
    {
        $lineOfText = [];
        $fileHandle = fopen($csvFilePath, 'r');
        while (!feof($fileHandle)) {
            $lineOfText[] = fgetcsv($fileHandle, 0, $arrSeparator['delimiter']);
        }
        fclose($fileHandle);
        return $lineOfText;
    }
}
