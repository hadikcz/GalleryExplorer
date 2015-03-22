<?php
/**
    The MIT License (MIT)

    Copyright (c) 2015 @author Vladimír Novák<hadikcze@gmail.com>

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
 **/
class TemplateManager {
    
    /**
     * Directory for CSS, images in templates
     * @var string
     */
    private $dataDirecotry;
    
    /**
     * Template settings
     * @var string
     */
    private $templateSettings;
    
    function __construct($dataDir, $settings) {
        $this->dataDirecotry = $dataDir;
        $this->templateSettings = $settings;
    }
    
    public function render($data){
        $template = new stdClass();
        $template->data = $data;
        $template->dataDir = $this->dataDirecotry;
        $template->directoryCount = count($data);
        $template->backgroundImage = $this->templateSettings->backgroundImage;
        $template->textColor = $this->templateSettings->textColor;
       require(dirname(__DIR__).'/template/main.phtml');
    }
}
