<?php
namespace KapLayout\Entity;

/*
 * 
 */

class ViewModel
{
    protected $id;
    protected $handle;
    protected $label;
    protected $tamplate;
    protected $options;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getHandle() {
        return $this->handle;
    }

    public function setHandle($handle) {
        $this->handle = $handle;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function getTamplate() {
        return $this->tamplate;
    }

    public function setTamplate($tamplate) {
        $this->tamplate = $tamplate;
    }

    public function getOptions() {
        return $this->options;
    }

    public function setOptions($options) {
        $this->options = $options;
    }


}

