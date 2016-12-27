<?php

/**
 * Created by PhpStorm.
 * User: Евгения
 * Date: 19.12.2016
 * Time: 19:12
 */
class Parser
{
    private $arFileLines = array();
    public $textContent;
    public $arQuestion = array();
    public $arParsedData = array();

    public function __construct($fileName)
    {
        $this->arFileLines = file($fileName);
        foreach ($this->arFileLines as $line)
            $this->textContent .= $line;
        //$this->textContent = file_get_contents($fileName);
    }

    private function printArray($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    private function printArrayDirectly($array)
    {
        foreach ($array as $key => $element)
        {
            echo '<br>['.$key.'] => '.$element.'<br>';
        }
    }

    public function parseQuestions()
    {
        $arQuestion = explode('QUESTION', $this->textContent);
        //$this->printArray($arQuestion);
        foreach ($arQuestion as $key => $question)
        {
            $this->parsePartsOfQuestion($question, $key);
        }

        //$this->printArray($this->arParsedData);
    }

    private function parseThat($regex, $question)
    {
        if(preg_match($regex, $question, $matches))
            return $matches[1];
        return null;
    }

    private function parsePartsOfQuestion($question, $questionNumber)
    {
        $arRegex = array(
            "A" => '/A\.([\s\S]*?)B\./', //find answer A
            "B" => '/B\.([\s\S]*?)(Correct|C\.)/', //find answer B
            "C" => '/C\.([\s\S]*?)(Correct|D\.)/', //find answer C
            "D" => '/D\.([\s\S]*?)(Correct|E\:)/', //find answer D
            "E" => '/E\:([\s\S]*?)(Correct|F\:)/', //find answer E
            "F" => '/F\:([\s\S]*?)(Correct|G\:)/', //find answer F
            "G" => '/G\:([\s\S]*?)Correct/', //find answer G
        );

        $this->arParsedData[$questionNumber]['question'] = $this->parseThat('/[0-9]([\s\S]*?)A\./',$question); //find question

        foreach($arRegex as $key => $value)
        {
            $this->arParsedData[$questionNumber]['answers'][$key] = $this->parseThat($value,$question);
        }

        $this->arParsedData[$questionNumber]['correct'] = $this->parseThat('/Answer\:([\s\S]*?)Section\:/',$question); //find correct answer
        $this->arParsedData[$questionNumber]['all'] = $question;
    }

}