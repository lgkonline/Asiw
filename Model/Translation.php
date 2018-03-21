<?php

namespace Asiw\Model
{
    class Translation
    {
        public $Id;
        public $Keyword;
        public $English;
        public $German;

        function __construct($id, $keyword, $english, $german)
        {
            $this->Id = $id;
            $this->Keyword = $keyword;
            $this->English = $english;
            $this->German = $german;
        }

        private function decodeContent($content)
        {
            return str_replace("{r}", \Asiw\Config::$RootUrl, $content);
        }

        private function encodeContent($content)
        {
            return str_replace(\Asiw\Config::$RootUrl, "{r}", $content);
        }

        public function GetContent()
        {
            $language = \Asiw\Config::$Language;
            return $this->decodeContent($this->{$language});
        }

        public static function GetTranslationByKeyword($translations, $keyword)
        {
            for ($i = 0; $i < count($translations); $i++)
            {
                if ($translations[$i]->Keyword == $keyword)
                    return $translations[$i];
            }

            throw new \RuntimeException("A translation with the keyword '$keyword' could not be found.");

            return null;
        }
    }
}