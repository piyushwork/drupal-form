<?php
namespace Drupal\form\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\views\Views;

class MyForm extends FormBase{
    
    public function getFormId(){
        return 'piy_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state){
     
        $form['name'] = ['#type'=>'textfield','#title'=> $this->t('Name'),'#required'=>TRUE,'#maxlength'=>20,'#placeholder'=>t('enter your name')];
        $form['dob'] = ['#type'=>'date','#title'=> $this->t('D.O.B')];
        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = ['#type' => 'submit','#value' => $this->t('Save'),
             '#button_type' => 'primary'];
        return $form;
    }
    public function validateForm(array &$form, FormStateInterface $form_state){
        $name = $form_state->getValue('name');
        $dob = $form_state->getValue('dob');
        $date = date("d-m-y");
        if(strlen($name) < 3){
            $form_state->setErrorByName('name', $this->t('The Name is too short. Please enter a name with more than 3 digits.'));
    }
    if ($dob === "" || $dob > $date ){
        $form_state->setErrorByName('dob', $this->t('Please enter a valid Date.'));
    }
}

public function submitForm(array &$form, FormStateInterface $form_state) {
    try {
      $conn = Database::getConnection();
      $field = $form_state->getValues();  
  
      $fields["name"] = $field['name'];
      $fields["dob"] =$field['dob'];
      $conn->insert('custom_table')
        ->fields($fields)
        ->execute();
        \Drupal::messenger()->addStatus($this->t('hello @name your data has been saved succesfully ', ['@name' => $form_state->getValue('name')] ));
    }
    catch (Exception $exception) {
      \Drupal::logger('form')->error($exception->getMessage());
    }
  }
}
    

?>