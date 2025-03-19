<?php
//LA CLASSE ABSTRAITE AbstractController.php

abstract class AbstractController {
    private ?ViewHeader $header;
    private ?ViewFooter $footer;
    private ?InterfaceModel $model;

    public function __construct(?ViewHeader $header, ?ViewFooter $footer, ?InterfaceModel $model){
        $this->header = $header;
        $this->footer = $footer;
        $this->model = $model;
    }

    // GETTERS & SETTERS
    /**
         * Get the value of header
         */
        public function getHeader() {
            return $this->header;
    }

    /**
     * Set the value of header
     */
    public function setHeader($header): self {
            $this->header = $header;
            return $this;
    }

    /**
     * Get the value of footer
     */
    public function getFooter() {
            return $this->footer;
    }

    /**
     * Set the value of footer
     */
    public function setFooter($footer): self {
            $this->footer = $footer;
            return $this;
    }

    /**
     * Get the value of model
     */
    public function getModel() {
            return $this->model;
    }

    /**
     * Set the value of model
     */
    public function setModel($model): self {
            $this->model = $model;
            return $this;
    }

}
?>