<?php

class BBCodeParser {

    public $parsers = [
            'bold' => [
                'pattern' => '/\[b\](.*?)\[\/b\]/s',
                'replace' => '<strong>$1</strong>',
                'content' => '$1'
            ],
            'italic' => [
                'pattern' => '/\[i\](.*?)\[\/i\]/s',
                'replace' => '<em>$1</em>',
                'content' => '$1'
            ],
            'underline' => [
                'pattern' => '/\[u\](.*?)\[\/u\]/s',
                'replace' => '<u>$1</u>',
                'content' => '$1'
            ],
            'linethrough' => [
                'pattern' => '/\[s\](.*?)\[\/s\]/s',
                'replace' => '<strike>$1</strike>',
                'content' => '$1'
            ],
            'size' => [
                'pattern' => '/\[size\=([1-7])\](.*?)\[\/size\]/s',
                'replace' => '<font size="$1">$2</font>',
                'content' => '$2'
            ],
            'color' => [
                'pattern' => '/\[color\=(#[A-f0-9]{6}|#[A-f0-9]{3})\](.*?)\[\/color\]/s',
                'replace' => '<font color="$1">$2</font>',
                'content' => '$2'
            ],
            'center' => [
                'pattern' => '/\[center\](.*?)\[\/center\]/s',
                'replace' => '<div style="text-align:center;">$1</div>',
                'content' => '$1'
            ],
            'left' => [
                'pattern' => '/\[left\](.*?)\[\/left\]/s',
                'replace' => '<div style="text-align:left;">$1</div>',
                'content' => '$1'
            ],
            'right' => [
                'pattern' => '/\[right\](.*?)\[\/right\]/s',
                'replace' => '<div style="text-align:right;">$1</div>',
                'content' => '$1'
            ],
            'quote' => [
                'pattern' => '/\[quote\](.*?)\[\/quote\]/s',
                'replace' => '<blockquote>$1</blockquote>',
                'content' => '$1'
            ],
            'namedquote' => [
                'pattern' => '/\[quote\=(.*?)\](.*)\[\/quote\]/s',
                'replace' => '<blockquote><small>$1</small>$2</blockquote>',
                'content' => '$2'
            ],
            'link' => [
                'pattern' => '/\[url\](.*?)\[\/url\]/s',
                'replace' => '<a href="$1">$1</a>',
                'content' => '$1'
            ],
            'namedlink' => [
                'pattern' => '/\[url\=(.*?)\](.*?)\[\/url\]/s',
                'replace' => '<a href="$1">$2</a>',
                'content' => '$2'
            ],
            'image' => [
                'pattern' => '/\[img\](.*?)\[\/img\]/s',
                'replace' => '<img src="$1">',
                'content' => '$1'
            ],
            'orderedlistnumerical' => [
                'pattern' => '/\[list=1\](.*?)\[\/list\]/s',
                'replace' => '<ol>$1</ol>',
                'content' => '$1'
            ],
            'orderedlistalpha' => [
                'pattern' => '/\[list=a\](.*?)\[\/list\]/s',
                'replace' => '<ol type="a">$1</ol>',
                'content' => '$1'
            ],
            'unorderedlist' => [
                'pattern' => '/\[list\](.*?)\[\/list\]/s',
                'replace' => '<ul>$1</ul>',
                'content' => '$1'
            ],
            'listitem' => [
                'pattern' => '/\[\*\](.*)/',
                'replace' => '<li>$1</li>',
                'content' => '$1'
            ],
            'code' => [
                'pattern' => '/\[code\](.*?)\[\/code\]/s',
                'replace' => '<code>$1</code>',
                'content' => '$1'
            ],
            'youtube' => [
                'pattern' => '/\[youtube\](.*?)\[\/youtube\]/s',
                'replace' => '<iframe width="560" height="315" src="//www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>',
                'content' => '$1'
            ],
            'linebreak' => [
                'pattern' => '/\r\n/',
                'replace' => '<br />',
                'content' => ''
            ],
            'sub' => [
              'pattern' => '/\[sub\](.*?)\[\/sub\]/s',
              'replace' => '<sub>$1</sub>',
              'content' => '$1'
            ],
            'sup' => [
              'pattern' => '/\[sup\](.*?)\[\/sup\]/s',
              'replace' => '<sup>$1</sup>',
              'content' => '$1'
            ],
            'small' => [
              'pattern' => '/\[small\](.*?)\[\/small\]/s',
              'replace' => '<small>$1</small>',
              'content' => '$1'
            ]
        ];

        private $enabledParsers;

        public function __construct() {
            $this->enabledParsers = $this->parsers;
        }

        public function parse($source, $caseInsensitive = false) {
            foreach ($this->enabledParsers as $name => $parser) {
                $pattern = ($caseInsensitive) ? $parser['pattern'].'i' : $parser['pattern'];
                $source = $this->searchAndReplace($pattern, $parser['replace'], $source);
            }
            return $source;
        }

        public function stripBBCodeTags($source) {
            foreach ($this->parsers as $name => $parser) {
                $source = $this->searchAndReplace($parser['pattern'].'i', $parser['content'], $source);
            }
            return $source;
        }

        protected function searchAndReplace($pattern, $replace, $source) {
            while (preg_match($pattern, $source)) {
                $source = preg_replace($pattern, $replace, $source);
            }
            return $source;
        }
}
