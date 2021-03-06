<?php
	class Form{
		private $sHTML;
		private $aData;
		private $aError;

		public function __construct(){
			$this->sHTML = '<form action="" method="POST">';
			$this->aData = array();
			$this->aError = array();
		}

		public function renderTextInput($sLABEL, $sCONTROL_NAME,$sClassName=""){

			$sData ="";

			if(isset($this->aData[$sCONTROL_NAME])){
				$sData = $this->aData[$sCONTROL_NAME];
			}

			$sError="";

			if(isset($this->aError[$sCONTROL_NAME])){
				$sError = $this->aError[$sCONTROL_NAME];
			}

			$this->sHTML .= '<label for="'.$sCONTROL_NAME.'">'.$sLABEL.'</label>';
			$this->sHTML .= '<input type="text" class="'.$sClassName.'" name="'.$sCONTROL_NAME.'" id="'.$sCONTROL_NAME.'" placeholder="required" value ="'.$sData.'"/>';
			$this->sHTML .= '<span id="'.$sCONTROL_NAME.'Message">'.$sError.'</span>';
		}

		public function renderTextarea($sLABEL,$sCONTROL_NAME){

			$sData ="";

			if(isset($this->aData[$sCONTROL_NAME])){
				$sData = $this->aData[$sCONTROL_NAME];
			}

			$sError="";

			if(isset($this->aError[$sCONTROL_NAME])){ 
				$sError = $this->aError[$sCONTROL_NAME];
			}

			$this->sHTML .= '<textarea name="'.$sCONTROL_NAME.'" id="'.$sCONTROL_NAME.'" placeholder="'.$sLABEL.'"/>'.$sData.'</textarea>';
			$this->sHTML .= '<span class="errorMessage">'.$sError.'</span>';
		}

		public function renderDateInput($sLABEL,$sCONTROL_NAME){
			$sData = '';

			if(isset($this->aData[$sCONTROL_NAME])){
				$sData = $this->aData[$sCONTROL_NAME];
			}

			$sError="";

			if(isset($this->aError[$sCONTROL_NAME])){
				$sError = $this->aError[$sCONTROL_NAME];
			}

			$this->sHTML.= '<label for="'.$sCONTROL_NAME.'">'.$sLABEL.'</label>';
			$this->sHTML.= '<input type="date" name="'.$sCONTROL_NAME.'" id="'.$sCONTROL_NAME.'" value="'.$sData.'"/>';
		}

		public function renderTimeInput($sLABEL,$sCONTROL_NAME){
			$sData = '';

			if(isset($this->aData[$sCONTROL_NAME])){
				$sData = $this->aData[$sCONTROL_NAME];
			}

			$sError="";

			if(isset($this->aError[$sCONTROL_NAME])){
				$sError = $this->aError[$sCONTROL_NAME];
			}
			
			$this->sHTML.= '<label for="'.$sCONTROL_NAME.'">'.$sLABEL.'</label>';
			$this->sHTML.= '<input type="time" name="'.$sCONTROL_NAME.'" id="'.$sCONTROL_NAME.'" value="'.$sData.'"/>';
		}

		public function renderSelectInput($sCONTROL_NAME,$aPRODUCTS){

			$sHTML ='';
			$sHTML .='<select name="'.$sCONTROL_NAME.'" id="'.$sCONTROL_NAME.'">';

			
			for($iCount = 0; $iCount<count($aPRODUCTS); $iCount++){
				$oProduct = $aPRODUCTS[$iCount];
				$sHTML .='<option value="'.$oProduct->ProductName.'">'.$oProduct->ProductName.'</option>';			
			}

			$sHTML .= '</select>';
		}

		public function renderPasswordInput($sLABEL, $sCONTROL_NAME){

			$sError="";

			if(isset($this->aError[$sCONTROL_NAME])){
				$sError = $this->aError[$sCONTROL_NAME];
			}

			$this->sHTML .= '<label for="'.$sCONTROL_NAME.'">'.$sLABEL.'</label>';
			$this->sHTML .= '<input type="password" name="'.$sCONTROL_NAME.'" id="'.$sCONTROL_NAME.'" placeholder="required"/>';
			$this->sHTML .= '<span class="errorMessage">'.$sError.'</span>';
		}

		public function renderSubmitInput($sLABEL, $sCONTROL_NAME){
			$this->sHTML .= '<input type="'.$sCONTROL_NAME.'" name="'.$sCONTROL_NAME.'" value="'.$sLABEL.'">';
		}

		public function renderHiddenInput($sCONTROL_NAME,$sValue){
			$this->sHTML .= '<input type="hidden" name="'.$sCONTROL_NAME.'" value="'.$sValue.'">';
		}

		public function checkFilled($sCONTROL_NAME){
			$sData = "";

			if(isset($this->aData[$sCONTROL_NAME])){
				$sData = $this->aData[$sCONTROL_NAME];
			}

			if(trim($this->aData[$sCONTROL_NAME])== ""){
				$this->aError[$sCONTROL_NAME] = "Must be filled";
			}
		}
		public function checkMatch($sCONTROL_NAME_1, $sCONTROL_NAME_2) { //checks if the password and confirm password match or not
	
			$sPasswordInput1 = "";

			if(isset($this->aData[$sCONTROL_NAME_1])) {
				$sPasswordInput1 = $this->aData[$sCONTROL_NAME_1];
			}

			$sPasswordInput2 = "";
			if(isset($this->aData[$sCONTROL_NAME_2])) {
				$sPasswordInput2 = $this->aData[$sCONTROL_NAME_2];
			}

			if($sPasswordInput1 !== $sPasswordInput2) {
				$this->aError[$sCONTROL_NAME_2] = "Must match"; //if doesn't match, then place this error message into the aError array so that a new customer cannot be saved
			} 

		}

		public function renderErrorMessage($sCONTROL_NAME, $sMESSAGE){
			
			$this->aError[$sCONTROL_NAME] = $sMESSAGE;
		}

		public function __get($VAR){
			switch($VAR){
				case "HTMLcode":
					return $this->sHTML.'</form>';
					break;
				
				case "isValid":
					if((count($this->aError)) == 0){
						return true;
					}else{
						return false;
					}
					break;
				
				default:
					die($VAR." does not exist.");

			}
		}

		public function __set($VAR, $VALUE){
			switch($VAR){
				case "Data":
					$this->aData=$VALUE;
					break;
				
				default:
					die($VAR ."fails");
			}
		}
	}
?>