<?php

class Controller_Scientificprofile extends Controller {

    function __construct() {
        Route::loggedUser();
        $this->model = new Model_Scientificprofile();
        $this->view = new View();
    }

    const SN = "\n";

    ////////////ІМЕНА НАСТУПНИХ КОНСТАНТ ВІДПОВІДАЮТЬ ІМЕНАМ класів ВІДПОВІДНИХ ОБЄКТІВ
    const globalContainer = 'div-content'; //!!! id !!контейнер робочого контенту сторінки !!! НЕ ЗМІНЮВАТИ НАЗВУ
    const Container = 'div-container'; //імя класу блочного контейнера
    const divCheckbox = 'div-checkbox';
    const divRadio = 'div-radio';
    const divText = 'div-text'; //input type=text
    const divSelect = 'div-select';
    const divTextArea = 'div-textarea';
    const divUpload = 'div-upload';
    const divResult = 'div-result';
    const spanResult = 'span-result';
    const spanText = 'span-text';
    const spanNote = 'span-note';
    const spanUpload = 'span-upload';

    ///////////////СПЕЦИФІКАТОРИ ОБЄКТІВ////////////////////////////////////////////////
    const InputText = "Input"; //поле введення text
    const CheckBox = "CheckBox"; //прапорці
    const RadioButton = "RadioButton"; //радіокнопки
    const Select = "Select"; //випадний список
    const Text = "Text"; //звичайний текст
    const Note = "Note"; //примітка
    const Upload = "Upload"; //кнопка завантаження файлу
    const Equation = "Equation"; //формула розрахунку
    ///////////////////////////////////////////////////////////////////////////////////
    public $codeHTML = ""; //код body
    //public $codeHEAD =""; //код head
    //public $codeJS =""; //код javascript
    //private $codeTemplateUpload =""; //код шаблону форми завантаження файлів засобами FormData
    ///////////////////////////////////////////////////////////////////////////////////
    private $CheckBoxId = 1; //ідентифікатор груп прапорців
    private $ContainerId = 1; //ідентифікатор груп обєктів контейнерів
    private $NameId = 1; //ідентифікатор унікального суфікса імені поля (для збору даних)

    public function Parser($input_arr=array()) { //розбір вхідного масиву структури сторінки

        $this->codeHTML .= '<div id="'.self::globalContainer.'">'.self::SN.'<form>'.self::SN;

        //розбір вхідного масиву що містить елементи структури майбутнього шаблону сторінки
        foreach ($input_arr as $prefix => $arr_bloc) { //$prefix=0; //ідентифікатор блоку
            $this->codeHTML .= '<br />';
            $this->codeHTML .= '<div class="'.self::Container.'">'.self::SN;
            //$this->codeHTML .= '<div class="'.self::container0.'" id="'.self::container0.'_'.$prefix.'">'.self::SN;
            $id_name = $this->ContainerId++;

            foreach ($arr_bloc as $type => $value) {
                //list($type,$id)= explode('_',$key); //id-внутрішній ідентифікатор обєкту
                //$class_name = $type.'_'.$prefix;
                //$id_name = $type.'_'.$prefix.'_'.$id;
                if($type == self::CheckBox) $id_CheckBox = $this->CheckBoxId++;
                //$id_name = $this->ContainerId++;

                switch($type){
                    case self::RadioButton: $this->CreateRadioButton($id_name,$value); break;
                    case self::CheckBox: $this->CreateCheckBox($idN, $id_CheckBox, $value); break;
                    case self::Select: $this->CreateSelect($idN, $value); break;
                    case self::InputText: $this->CreateInputText($idN, $value); break;
                    case self::Text: $this->CreateText($value); break;
                    case self::Note: $this->CreateNote($value); break;
                    case self::Upload: $this->CreateUpload($id_name,$value); break;
                    case self::Equation: $this->CreateEquation ($id_name, $value); break;
                }
            }
            $this->codeHTML .= "</div>".self::SN;
        }
        $this->codeHTML .= "</form>".self::SN."</div>".self::SN; //globalContainer
    }

    private function v($value) {
        return (isset($value)) ? $value: '';
    }

    private function CreateRadioButton($idN = '', $arr=array()) {
        $this->codeHTML .= '<div class="'.self::divRadio.'">'.self::SN;
        $name = $this->v($arr["name"]);
        $data = $this->v($arr["data"]);
        $listsep = $this->v($arr["listsep"]);
        $container = $this->v($arr["container"]);
        //$localId = 0;
        foreach($data as $input){
            //$localId++;
            $labelTXT = $this->v($input["label"]);
            $value = $this->v($input["value"]);
            $options = $this->v($input["options"]);
            if ($container != '') $this->codeHTML .= '<'.$container.'>';
            $this->codeHTML .='<label><input type="radio" name="'.$name.'" value="'.$value.'" '.$options.' data-id="'.$idN.'" />'.$labelTXT.'</label>'.$listsep.self::SN;
            if ($container != ''){
                $this->codeHTML .= '</'.$container.'>';
                $this->codeHTML .= self::SN;
            }
        }
        $this->codeHTML .= "</div>".self::SN;
    }

    private function CreateCheckBox($idN = '', $id_CheckBox = '', $arr=array()){
        $this->codeHTML .= '<div class="'.self::divCheckbox.'">'.self::SN;
        $name = $this->v($arr["name"]);
        $data = $this->v($arr["data"]);
        $listsep = $this->v($arr["listsep"]);
        $container = $this->v($arr["container"]);
        foreach($data as $input){
            $nameI= $name.$this->NameId++;
            $labelTXT = $this->v($input["label"]);
            $value = $this->v($input["value"]);
            $options = $this->v($input["options"]);
            if ($container != '') $this->codeHTML .= '<'.$container.'>';
            $this->codeHTML .='<label><input type="checkbox" name="'.$nameI.'" value="'.$value.'" '.$options.' data-id="'.$idN.'" data-checkbox="'.$id_CheckBox.'"/>'.$labelTXT.'</label>'.$listsep.self::SN;
            if ($container != ''){
                $this->codeHTML .= '</'.$container.'>';
                $this->codeHTML .= self::SN;
            }
        }
        $this->codeHTML .='<input type="hidden" name="'.$name.'" value="" data-checkbox-result="'.$idN.'" />'.$listsep.self::SN;
        $this->codeHTML .= "</div>".self::SN;
    }

    private function CreateText($text=''){
        $this->codeHTML .= '<span class="'.self::spanText.'">'.$text.'</span>'.self::SN;
    }
    private function CreateNote($text=''){
        $this->codeHTML .= '<span class="'.self::spanNote.'">'.$text.'</span>'.self::SN;
    }

    private function CreateInputText($idN = '', $arr=array()){
        $name = $this->v($arr["name"]);
        $left_text = $this->v($arr["left_text"]);
        $right_text = $this->v($arr["right_text"]);
        $options = $this->v($arr["options"]);
        $this->codeHTML .= '<div class="'.self::divInputText.'">'.self::SN;
        if ($left_text != '') $this->codeHTML .= '<span class="'.self::spanText.'">'.$left_text.'</span>'.self::SN;
        $this->codeHTML .= '<input type="text" name="'.$name.'" value="" '.$options.' data-id="'.$idN.'"/>'.self::SN;
        if ($right_text != '') $this->codeHTML .= '<span class="'.self::spanText.'">'.$right_text.'</span>'.self::SN;
        $this->codeHTML .= "</div>".self::SN;

    }

    private function CreateSelect($idN = '', $arr=array()){
        $name = $this->v($arr["name"]);
        $data = $this->v($arr["data"]);
        $global_options = $this->v($arr["options"]);
        if($global_options != '') $global_options .= ' ';
        $this->codeHTML .= '<div class="'.self::divSelect.'">'.self::SN;
        $this->codeHTML .= '<select '.$global_options.'name="'.$name.'" data-id="'.$idN.'">'.self::SN;
        foreach($data as $input){
            $labelTXT = $this->v($input["label"]);
            $value = $this->v($input["value"]);
            $options = $this->v($input["options"]);
            if($options != '') $options .= ' ';
            $this->codeHTML .= '<option '.$options.'value="'.$value.'">'.$labelTXT.'</option>'.self::SN;
        }
        $this->codeHTML .= '</select>'.self::SN;
        $this->codeHTML .= "</div>".self::SN;
    }

    private function CreateTextArea ($idN = '', $arr=array()){
        $name = $this->v($arr["name"]);
        $options = $this->v($arr["options"]);
        if($options != '') $options .= ' ';
        $data = $this->v($arr["data"]);
        $cols = $this->v($arr["cols"]);
        if ($cols == '') $cols = 40;
        $rows = $this->v($arr["rows"]);
        if ($rows == '') $rows = 3;
        $wrap = $this->v($arr["wrap"]);
        if ($wrap == '') $wrap = "physical";
        $this->codeHTML .= '<div class="'.self::divTextArea.'">'.self::SN;
        $this->codeHTML .= '<textarea '.$options.'name="'.$name.'" wrap="'.$wrap.'" cols="'.$cols.'" rows="'.$rows.'" data-id="'.$idN.'">'.$data.'</textarea>'.self::SN;
        $this->codeHTML .= "</div>".self::SN;
    }

    private function CreateUpload($idN = '', $arr=array()){
        $text = $this->v($arr['label']);
        $MbMax = $this->v($arr['max']);
        $TypeF = $this->v($arr['type']);
        $i = $this->NameId++;
        $this->codeHTML .= '<div class="'.self::divUpload.'">'.self::SN;

        $this->codeHTML .= '<span class="'.self::spanUpload.'">'.$text.'</span>'.self::SN;
        $this->codeHTML .= '<div class="status button_container" data-id="'.$idN.'"></div>'.self::SN;

        $this->codeHTML .= '<div class="button_container">'.self::SN;
        $this->codeHTML .= '<input type="hidden" class="filetype" name="filetype'.$i.'" value="'.$TypeF.'" data-id="'.$idN.'"/>'.self::SN;
        $this->codeHTML .= '<input type="hidden" class="maxfilesize" name="maxfilesize'.$i.'" value="'.$MbMax.'" data-id="'.$idN.'" />'.self::SN;
        $this->codeHTML .= '<label class="button">Файл<input type="file" class="myfile" name="myfile" data-id="'.$idN.'"/></label>'.self::SN;
        $this->codeHTML .= '<label class="button">Завантажити<input type="button" class="upload" value="upload" data-id="'.$idN.'" /></label>'.self::SN;
        $this->codeHTML .= '<a href="#" class="quickbox button" style="display: none" data-file="'.$idN.'">Переглянути</a>'.self::SN;
        $this->codeHTML .= '<input type="hidden" class="fileurl" name="fileurl'.$i.'" value="" data-url="'.$idN.'"/>'.self::SN;
        $this->codeHTML .= "</div>".self::SN;

        $this->codeHTML .= '<div class="progressBar">'.self::SN;
        $this->codeHTML .= '<progress class="pBar" min="0" max="100" value="0" style="display: none" data-id="'.$idN.'">'.self::SN;
        $this->codeHTML .= '0% complete'.self::SN;
        $this->codeHTML .= '</progress>'.self::SN;
        $this->codeHTML .= '</div>'.self::SN;

        $this->codeHTML .= "</div>".self::SN;
    }

    private function CreateEquation($idN = '', $text=''){
        $i = $this->NameId++;
        $this->codeHTML .= '<div class="'.self::divResult.'">'.self::SN;
        $this->codeHTML .= '<input type="hidden" name="equation'.$i.'" value="'.$text.'" data-equation="'.$idN.'"/>'.self::SN;
        $this->codeHTML .= '<span class="'.self::spanResult.'" data-view="'.$idN.'"></span>'.self::SN;
        $this->codeHTML .= '<input class="hidden-result" type="hidden" name="result'.$i.'" value="" data-result="'.$idN.'"/>'.self::SN;
        $this->codeHTML .= '</div>'.self::SN;
    }

    function action_index() {
        $na = $this->model->get_data();
        $this->Parser($na); // з асоціативного масиву $na утворюються елементи(поля) форми

        $BODY_Content = $this->codeHTML;
        $this->view->generate('scientificprofile_view.php', 'template_view.php', $BODY_Content);
    }
}