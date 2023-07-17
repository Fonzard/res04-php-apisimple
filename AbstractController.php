<?php
abstract class AbstractController {

    protected function render(string $view, array $values) : void
    {
        $this->template = $view;
        $this->data = $values;
        
        require "./templates/layout.phtml";
    }
    protected function renderJson(array $values)
    {
        echo json_encode($values);
    }
}
?>