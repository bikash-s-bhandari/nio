<?php
if(!defined('BASEPATH'))
	exit('No direct script acessed allowed');

function form_builder($variables)
{
	$attr=array('id'=>'formId','class'=>'','role'=>'form');//class for form
	$HTMLform=form_open_multipart($variables['action'],$attr);//$variable[action] ko action key ma form action auxa
	$HTMLform.='<div class="box-body">';
	foreach ($variables['fields'] as $field):
		
		$HTMLform.='<div class="form-group">';
		$HTMLform.='<label for="exampleInputEmail1">'.$field['label'].'</label>';
        if(isset($field['additional'])):
            $HTMLform .= '<div class="input-group">';
        $HTMLform .= '<span class="input-group-addon">'.$field['additional'].'</span>';
        endif;
		if ($field['type'] == 'text'):
            $HTMLform .= form_input($field);

        elseif ($field['type'] == 'password'):
            $HTMLform .= form_password($field);

        elseif ($field['type'] == 'textarea'):
            $HTMLform .= form_textarea($field);
        elseif ($field['type'] == 'file'):
            $HTMLform .= form_upload($field);
        elseif ($field['type'] == 'dropdown'):
            $selected = '';
            if (isset($field['selected'])):
                $selected = $field['selected'];
            endif;
        $HTMLform .= form_dropdown($field['name'], $field['option'], $selected, $field['class']);
        elseif ($field['type'] == 'radio'):
            $HTMLform .='<ul class="iCheck"  data-style="square" data-color="green">';
            foreach ($field[0] as $fields):
                $HTMLform .= '<li>';
                if ($fields['value'] == $field['selected']):

                    $fields['checked'] = TRUE;
                endif;

                $HTMLform .= form_radio($fields);
                $HTMLform .= $fields['label'];
                $HTMLform .= '</li>';
            endforeach;
            $HTMLform .='</ul>';
        elseif ($field['type'] == 'checkbox'):
            $HTMLform .='<div class="floatL mr10">';
            $HTMLform .= form_checkbox($field);
            $HTMLform .='</div>';
        elseif ($field['type'] == 'date'):
            $HTMLform .='<div class="input-group date form_datetime col-lg-4" data-picker-position="bottom-left"  data-date-format="dd MM yyyy">';
        $field['type']='date';    
        $HTMLform .= form_input($field);
        $HTMLform .='
        
            <span class = "input-group-btn">
           
            <button class = "btn btn-default" type = "button"><i class = "fa fa-calendar"></i></button>
            </span>
            </div>';
        endif;

        if(isset($field['additional'])):
            $HTMLform .= '</div>';
        endif;
        $HTMLform .= '</div>';//foreach ma vako div haru close
    endforeach;
     $HTMLform .='</div>';//foreach vanda mathi ko div haru close

    $HTMLform .= ' <div class="box-footer">';
    $formAction = array('value' => $variables['purpose'], 'class' => 'btn btn-primary');
    $HTMLform .= form_submit($formAction);
    $HTMLform.='</div>';
    $HTMLform .= form_close();
    return $HTMLform;
		












		 





                    
                    

}
