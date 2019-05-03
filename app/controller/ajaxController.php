<?php
class ajaxController extends Controller {
    public function index(){
        header("Location: /mywebsite.com/home");
        exit();
    }
    public function autocomplete(){
        if (filter_has_var(INPUT_POST, "getData")) {
            $input = json_decode($_POST["getData"]);
            $this->model("Restaurants");
            $this->model->getRestaurantName($input);
            if ($this->model->getResult() == 0) {
                echo json_encode(["output"=>false]);
                exit();
            }
            $output = "<ul class='autocomplete' >";
            foreach ($this->model->getResult() as $v) {
                $output .= "<li class='autocomplete-li'>{$v["name"]}</li>";
            }
            $output .= "</ul>";
            echo json_encode([
                "output" => $output
                    ]);
        }
        else {
            header("Location: /mywebsite.com/home");
            exit();
        }
    }
}
