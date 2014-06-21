<?php
class SpecialHi extends SpecialPage{
public function __construct(){
parent::__construct('Hi');
}
public function execute($sub){
	global $wgOut;
	$dbr = wfGetDB( DB_SLAVE );
	$wgOut->setPageTitle( wfMessage('Hi') );
	$wgOut->addWikiMsg('hi-hell');
		$this->getOutput()->setPageTitle( 'Add New Material' );
		$formDescriptor = array(
			'myfield1' => array(
				'class' => 'HTMLTextField',
				'label' => 'Material Name',
			),
			'myfield2' => array(
				'class' => 'HTMLTextField',
				'label' => 'UserId',
			),
			'myfield3' => array(
				'class' => 'HTMLTextField',
				'label' => 'Material Privacy',
			),
			'myfield4' => array(
		                'type' => 'textarea',
		                'label' => 'Material Description',
		                'default' => 'A brief description of material', # Default string in field
		                'rows' => 3, # Display height of field
		                'cols' => 30 # Display width of field
			),
			'myfield5' => array(
				'class' => 'HTMLTextField',
				'label' => 'Material Type',
			),
			'myfield6' => array(
				'class' => 'HTMLTextField',
				'label' => 'Timestamp',
			),
			'omgaselectbox' => array(
				'class' => 'HTMLSelectField',
				'label' => 'Select Property',
				'options' => array(
					'Melting Point' => 'melting_point',
					'Boiling Point' => 'boiling-point',
					'Density' => 'density'
				),
			),
			'omgmultiselect' => array(
				'class' => 'HTMLMultiSelectField',
				'label' => 'Choose Properties',
				'options' => array(	
					'Melting Point' => 'melting_point',
					'Boiling Point' => 'boiling_point',
					'Density' => 'density'
			),
				'default' => array( 'Tensile Strength' ),
			),

		);
 
		$htmlForm = new HTMLForm( $formDescriptor, $this->getContext(), 'testform' );
 
		$htmlForm->setSubmitText( 'submit' );
		$htmlForm->setSubmitCallback( array( 'SpecialTestForm', 'trySubmit' ) );
 
		$htmlForm->show();
	}
 
	static function trySubmit( $formData ) {
		if ( $formData['myfield1'] == 'Fleep' ) {
			return true;
		}
 
		return 'Failed! Please fill again';
	}
}
 
$wgSpecialPages['TestForm'] = 'SpecialTestForm';


