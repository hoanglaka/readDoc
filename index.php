
<?php
require_once 'vendor/autoload.php';

use \PhpOffice\PhpWord\IOFactory;

$source = __DIR__ . "/test.docx";
$phpWord = IOFactory::load($source);

readWord($phpWord);

function readWord($phpWord)
{
    $sections = $phpWord->getSections();
    // List all section in Doc
    foreach ($sections as $key => $value) {
        $sectionElement = $value->getElements();
        foreach ($sectionElement as $elementKey => $elementValue) {
            $secondSectionElement = $elementValue->getElements();
            if ($elementValue instanceof \PhpOffice\PhpWord\Element\TextRun) {
                foreach ($secondSectionElement as $secondSectionElementKey => $secondSectionElementValue) {
                    if ($secondSectionElementValue instanceof \PhpOffice\PhpWord\Element\Text) {
                        $text = $secondSectionElementValue->getText();
                        echo $text;
                    } else if ($secondSectionElementValue instanceof PhpOffice\PhpWord\Element\Image) {
                        $text = $secondSectionElementValue->getSource(true);
                        echo $text;
                    }
                }
                echo '<br/>';
            }
        }
    }
}
