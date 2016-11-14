<?php

class Model_Scientificprofile extends Model {
    public function get_data() {
        //НАУКОВА АНКЕТА
        return array(

            array(
                "Text"=>"Вчене звання",
                "RadioButton"=>array(
                    "name"=>"vchzv",
                    "data"=>array(
                        array("label"=>"професор","value"=>"80","options"=>"disabled"),
                        array("label"=>"доцент","value"=>"40","options"=>""),
                    ),
                    "listsep"=>"<br />",
                    "container"=>""
                ),
                "Note"=>"За наявності диплома",
                "Equation"=>"vchzv",
                "Upload"=>array(
                    "label"=>"Скан диплома",
                    "type"=>"jpg, jpeg, png",
                    "max"=>"8"
                )
            )
        ,

            array(
                "Text"=>"Звання",
                "RadioButton"=>array(
                    "name"=>"zvv",
                    "data"=>array(
                        array("label"=>"Заслужений...","value"=>"200","options"=>"disabled"),
                        array("label"=>"майстер спорту","value"=>"200","options"=>""),
                    ),
                    "listsep"=>"<br />"
                ),
                "Note"=>"За наявності документа",
                "Equation"=>"zvv",
                "Upload"=>array(
                    "label"=>"Скан документа",
                    "type"=>"jpg, jpeg, png",
                    "max"=>"8"
                )
            )
        ,

            array(
                "Text"=>"Членство в державних академіях наук",
                "RadioButton"=>array(
                    "name"=>"chda",
                    "data"=>array(
                        array("label"=>"академік","value"=>"200","options"=>""),
                        array("label"=>"член-кореспондент","value"=>"150","options"=>""),
                    ),
                    "listsep"=>"<br />"
                ),
                "Note"=>"За наявності документа",
                "Equation"=>"chda",
                "Upload"=>array(
                    "label"=>"Скан документа",
                    "type"=>"jpg, jpeg, png",
                    "max"=>"8"
                )
            )
        ,

            array(
                "Text"=>"Членство в зарубіжних академіях наук",
                "RadioButton"=>array(
                    "name"=>"chza",
                    "data"=>array(
                        array("label"=>"академік","value"=>"200","options"=>""),
                        array("label"=>"член-кореспондент","value"=>"150","options"=>""),
                    ),
                    "listsep"=>"<br />"
                ),
                "Note"=>"За наявності документа",
                "Equation"=>"chza",
                "Upload"=>array(
                    "label"=>"Скан документа",
                    "type"=>"jpg, jpeg, png",
                    "max"=>"8"
                )
            )
        ,

            array(
                "Text"=>"Почесний ступінь (звання) зарубіжного університету",
                "RadioButton"=>array(
                    "name"=>"pochst",
                    "data"=>array(
                        array("label"=>"почесний доктор наук","value"=>"100","options"=>""),
                        array("label"=>"почесний професор","value"=>"100","options"=>""),
                    ),
                    "listsep"=>"<br />"
                ),
                "Note"=>"За наявності документа",
                "Equation"=>"pochst",
                "Upload"=>array(
                    "label"=>"Скан документа",
                    "type"=>"jpg, jpeg, png",
                    "max"=>"8"
                )
            )

        );
    }
}