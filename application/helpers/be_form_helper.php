<?php

if (!function_exists('htmlTableGenerator')) {
function htmlTableGenerator($table) {
		$str = "";
	  $headerAksi = "";
		$button = "";
		$title = array_key_exists("title", $table) ? $table['title'] : null;
		$class = array_key_exists("class", $table) ? $table['class'] : strtolower("table table-hover table-bordered datatable");
		$pathDelete = array_key_exists("pathDelete", $table) ? $table['pathDelete'] : array();
		$modalEdit = array_key_exists("modalEdit", $table) ? $table['modalEdit'] : '';
		$pathJsonToEdit = array_key_exists("pathJsonToEdit", $table) ? $table['pathJsonToEdit'] : '';
		if ($title) {
			$str .= "<h2 class=\"table-title\">$title</h2>";
		}
		$str .= "<table class=\"$class\" style=\"width: 100%;\">";
		if (array_key_exists("header", $table)) {
			$str .= "<thead>";
			$numOfColumn =	count($table['header']);

			if ($numOfColumn > 0 && array_key_exists("buttonAction", $table)) {
				$headerAksi .= "<th class=\"nosort\">#</th>";
			}

			$str .= "<tr><th>No</th>";

			for ($i = 0; $i < $numOfColumn; $i++) {
				$str .= "<th>";
				$str .= $table['header'][$i];
				$str .= "</th>";
			}

			$str .= $headerAksi;
			$str .= "</tr></thead><tbody>";

			if (array_key_exists("data", $table)) {
				for ($i = 0; $i < count($table['data']); $i++) {
					$no = $i + 1;
					$dataId = $table['data'][$i][0];
					$str .= "<tr><td>$no</td>";
					for ($j = 1; $j < count($table['data'][$i]); $j++) {
						if ($table['data'][$i][$j] == null || !isset($table['data'][$i][$j])) {
							$nilai = "&nbsp;";
						} else {
							$nilai = $table['data'][$i][$j];
						}
						$str .= "<td>";
						$str .= $nilai;
						$str .= "</td>";
					}

					$button = "";
					$arrPathDelete = $pathDelete;
					$arrPathJsonToEdit = $pathJsonToEdit;

					if (array_key_exists("buttonAction", $table)) {
						array_push($arrPathDelete, $dataId);
						$strPathDelete = site_url($arrPathDelete);

						array_push($arrPathJsonToEdit, $dataId);
						$strPathJsonToEdit = site_url($arrPathJsonToEdit);

						$button .= "<td>";
						$button .= "<div class=\"btn-group\">";
						$button .= "<button type=\"button\" class=\"btn btn-xs btn-info dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Pilih <span class=\"caret\"></span></button>";
						$button .= "<ul class=\"dropdown-menu dropdown-menu-right\">";
						$view = in_array("view", $table['buttonAction']) ? "<li><a href=\"#\" class=\"lihat-data\" data-id=\"$dataId\">Lihat</a></li>" : "";
						$edit = in_array("edit", $table['buttonAction']) ? "<li><a href=\"#\" class=\"ubah-data\" data-path=\"$strPathJsonToEdit\" data-target=\"$modalEdit\">Ubah</a></li>" : "";
						$delete = in_array("delete", $table['buttonAction']) ? "<li><a href=\"#\" class=\"hapus-data\" data-path=\"$strPathDelete\">Hapus</a></li>" : "";
						$endmenu = "</ul></div>";
						$button .= $view.$edit.$delete.$endmenu;
						$button .= "</td>";
					}

					$str .= $button;
					$str .= "</tr>";
				}
			} else {
				// handler data kosong ada di custom.js
			}
		} else {
			$str = "<div class='alert alert-danger'>Header untuk tiap kolom table harus di definisikan</div>";
		}
		$str .= "</tbody></table>";
		echo $str;
	}
}

if (!function_exists('htmlFormGenerator')) {
	function htmlFormGenerator($form) {
    $class = array_key_exists("class", $form) ? $form['class'] : "form-horizontal";
		$id = array_key_exists("id", $form) ? $form['id'] : "noFormID";
		?>
		<div class="mainForm">
     <form class="<?php echo $class; ?>" enctype="multipart/form-data" id="<?php echo $id; ?>">
	     <fieldset>
		     <div class="control-group">
         <?php
				 			htmlFormElement($form);
					?>
				 </div> <!-- end control-group -->
       </fieldset>
     </form>
     <div class="result"></div>
    </div>
	  <?php
  }
}

if (!function_exists('htmlFormElement')) {
  function htmlFormElement($form) {
		for ($i = 0; $i < count($form['formElement']); $i++) {
			$label = $form['formElement'][$i]['label'];
			$inputType = $form['formElement'][$i]['type'];
			$inputName = array_key_exists("name", $form['formElement'][$i]) ? $form['formElement'][$i]['name'] : strtolower($label);
			$inputId = array_key_exists("id", $form['formElement'][$i]) ? $form['formElement'][$i]['id'] : $form['formElement'][$i]['name'];
			$inputClass = array_key_exists("class", $form['formElement'][$i]) ? $form['formElement'][$i]['class'] : "span5";
			$options = array_key_exists("options", $form['formElement'][$i]) ? $form['formElement'][$i]['options'] : NULL;
			$maxlength = array_key_exists("maxlength", $form['formElement'][$i]) ? "maxlength=".$form['formElement'][$i]['maxlength'] : NULL;
			$value = array_key_exists("value", $form['formElement'][$i]) ? $form['formElement'][$i]['value'] : NULL;
			$placeholder = array_key_exists("placeholder", $form['formElement'][$i]) ? "placeholder=".$form['formElement'][$i]['placeholder'] : NULL;
			$required = array_key_exists("required", $form['formElement'][$i]) ? "required=required" : NULL;
			$readonly = array_key_exists("readonly", $form['formElement'][$i]) ? "readonly=readonly" : NULL;
            $onchange = array_key_exists("onchange", $form['formElement'][$i]) ? "onchange=".$form['formElement'][$i]['onchange'] : NULL;
			switch ($inputType) {
				case 'password':
					$strInput = '<input type="'.$inputType.'" name="'.$inputName.'" class="'.$inputClass.'" '.$required.' >';
					htmlFormGroup($label, $strInput, $required);
					break;

				case 'text':
						/*
						input type TEXT
						cara menggunakan:
						[
							'label' => 'Kode Barang',
							'type' => 'text',
							'name' => 'kodeBarang',
							'class' => 'form-control',
							'required' => true,
							'value' => 'default value',
							'readonly' => true
						]
						catatan:
						- apabila tidak wajib diisi, 'required' bisa dihapus atau dikasi nilai => false
						- untuk input angka, tambah inputClass dengan 'numeric-input'
						- untuk input tanggal, tambah inputClass dengan 'datepicker'
						*/

				    $strInput = '<input type="'.$inputType.'" name="'.$inputName.'" class="'.$inputClass.'" value="'.$value.'" '.$required.' '.$placeholder.' '.$maxlength.' '.$readonly.' '.$onchange.'>';
            htmlFormGroup($label, $strInput, $required);
						break;

						case 'hidden':
					/*
					input type HIDDEN
					cara menggunakan:
					[
						'label' => 'value_input_hidden',
						'type' => 'hidden',
						'name' => 'nama_input'
					]
					*/
					echo ('<input type="'.$inputType.'" name="'.$inputName.'" value="'.$label.'">');
					break;

					case 'textarea':
					/*
					input type TEXTAREA
					cara menggunakan:
					[
						'label' => 'Label Textarea',
						'type' => 'textarea',
						'name' => 'nama_input',
						'class' => 'form-control'
					]
					*/
					$strInput = '<textarea name="'.$inputName.'" class="'.$inputClass.'"></textarea>';
					htmlFormGroup($label, $strInput, $required);
					break;

					case 'radio':
					/*
					input type RADIO
					cara menggunakan:
					[
						'label' => 'Label Input',
						'type' => 'radio',
						'name' => 'nama_input',
						'class' => 'form-control',
						'options' => [
							['label' => 'Option 1', 'value' => 'abc'],
							['label' => 'Option 2', 'value' => 'def'],
							['label' => 'Option 3', 'value' => 'ghi']
						],
						'defaultValue' => 'def'
					]
					*/
					$strInput = '';
					for ($j = 0; $j < count($options); $j++) {
						if ($options[$j]['value'] == $form['formElement'][$i]['defaultValue']) {
							$checked = 'checked="checked"';
						} else {
							$checked = '';
						}
						$strInput .= '<label class="radio-inline"><input type="radio" '.$checked.' name="'.$inputName.'" value="'.$options[$j]['value'].'">'.$options[$j]['label'].'</label>';
					}
					htmlFormGroup($label, $strInput, $required);
					break;

					case 'select':
					/*
					input type SELECT
					cara menggunakan:
					[
						'label' => 'Label Input',
						'inputType' => 'select',
						'inputName' => 'nama_input',
						'inputClass' => 'form-control',
						'options' => [
							['label' => 'Option 1', 'value' => 'abc'],
							['label' => 'Option 2', 'value' => 'def'],
							['label' => 'Option 3', 'value' => 'ghi']
						],
						'defaultValue' => 'def'
					]
					*/
					//$listOpt = $form['formElement'][$i]['options'];
					//$placeholder = array_key_exists("placeholder", $form['formElement'][$i]) ? $form['formElement'][$i]['placeholder'] : 'Pilih..';
					$strInput = '<select id="'.$inputId.'" name="'.$inputName.'" class="'.$inputClass.'">';
					$defaultValue = array_key_exists("defaultValue", $form['formElement'][$i]) ? $form['formElement'][$i]['defaultValue'] : NULL;
			  		for ($j = 0; $j < count($options); $j++) {
							if ($options[$j]['value'] == $defaultValue) {
					  			$strInput .= '<option value="'.$options[$j]['value'].'" selected>'.$options[$j]['label'].'</option>';
							} else {
					  			$strInput .= '<option value="'.$options[$j]['value'].'">'.$options[$j]['label'].'</option>';
							}
			  		}
			  		$strInput .= '</select>';
						//print_r($form['formElement'][$i]);
			  		htmlFormGroup($label, $strInput, $required);
			  		break;

		}
  }
}
}


if (!function_exists('htmlFormGroup')) {
	function htmlFormGroup($label, $strInput, $required) {
    ?>
		<label class="control-label" for="typeahead">
			<?php 
			echo $label; 
			if($required != NULL) {
						echo '&nbsp;<font color=red>*</font>';
				 }
			?>
		</label>
		<?php
   
		?>
			<div class="controls">
			<?php 
			  
				 echo $strInput; 
				 
			 ?>
			</div>
	  <?php
	}
}

if(! function_exists('ActiveSelect')) {
    function ActiveSelect($label) {
    	$cc = explode(" ", $label);
		$jum = count($cc);
		$ccv = strtolower($cc[0]);
		if($jum > 1) {
		   for($i=1; $i < count($cc); $i++) {
			 $ccv .= ucfirst($cc[$i]);
		   }
		} else {
			$ccv = strtolower($cc[0]);
		}
		
        $str = array(
	      'label' => $label,
	      'type' => 'select',
	      'name' => $ccv,
	      'options' => array(
							array('label' => 'Active', 'value' => '1'),
							array('label' => 'Inactive', 'value' => '0'),
					 ),
		  'defaultValue' => '1'
	     
	    );
        return $str;
    }
}
