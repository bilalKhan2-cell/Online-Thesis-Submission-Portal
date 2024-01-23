<?php

function ShowAlertMessage($class, $content)
{
    return "<div class='card-alert card " . $class . "' lighten-5>
                <div class='card-content white-text'>
                    <span>" . $content . "</span>
                </div>
            </div>";
}
function InputField($colSize, $label, $options, $type, $value = '', $isDisabled = false)
{
    $str_input = "<div class='col " . $colSize . "'>";
    $str_input .= "<label>" . $label . "</label>";
    $str_input .= "<input type='" . $type . "' " . ($isDisabled == true ? "disabled = 'disabled'" : "") . " ";

    foreach ($options as $key => $value) {
        $str_input .= " " . $key . "='" . $value . "'";
    }

    $str_input .= " />";
    $str_input .= "</div>";

    return $str_input;
}

function SelectField($colSize, $label, $name, $collection, $key = '')
{
    $str_input = "<div class='col " . $colSize . "'>
    <label>" . $label . "</label>";
    $str_input .= "<select name='" . $name . "'>";

    foreach ($collection as $item) {
        $value = isset($item->name) ? $item->name : $item;
        $id = isset($item->id) ? $item->id : '';
        $selectedOption = ($id == $key) ? "selected" : "";

        $str_input .= "<option value='" . $id . "' " . $selectedOption . ">" . $value . "</option>";
    }

    $str_input .= "</select>
    </div>";

    return $str_input;
}

function submitAndCancelButton($label, $class, $divClass, $cancelButtonClass = 'btn red', $cancelButtonLabel = 'Cancel')
{
    return "<div class='col " . $divClass . "'>
        <button type='submit' class='" . $class . "'>" . $label . "</button>
        <a href='" . url()->previous() . "' class='" . $cancelButtonClass . "'>" . $cancelButtonLabel . "</a>
    </div>";
}

function StaticSelectField($colSize, $label, $name, $options, $key = '')
{
    $str_input = "<div class='col " . $colSize . "'>
    <label>" . $label . "</label>";
    $str_input .= "<select name='" . $name . "'>";

    foreach ($options as $key => $value) {
        $str_input .= "<option value='" . $value . "'>" . $value . "</option>";
    }

    $str_input .= "</select>
    </div>";

    return $str_input;
}

function GenerateTable($tableID, $tableClass, $tableHeadings)
{
    $table = "<table class='" . $tableClass . "' id='" . $tableID . "'>";
    $table .= "<tr>
    <thead>";
    foreach ($tableHeadings as $key => $value) {
        $table .= "<th>" . $value . "</th>";
    }
    $table .= "</tr>
    </thead>
    <tbody></tbody>";
    $table .= "</table>";

    return $table;
}

function Button($label, $class, $options)
{
    $btnString = "<button type='button' class='" . $class . "'";

    foreach ($options as $key => $value) {
        $btnString .= " " . $key . "='" . $value . "'";
    }

    $btnString .= "/>" . $label;
    $btnString .= "</button>";

    return $btnString;
}
