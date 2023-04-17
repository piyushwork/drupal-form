<?php 
function form_views_data() {
  $data = array();

  $data['custom_table']['table']['group'] = t('My custom table');
  $data['custom_table']['table']['base'] = array(
    'title' => t('My custom table'),
    'help' => t('My custom table'),
    'database' => 'default',
    'weight' => -10,
  );

  $data['custom_table']['id'] = array(
    'title' => t('ID'),
    'help' => t('The ID of the person.'),
    'field' => array(
      'id' => 'standard',
    ),
  );

  $data['custom_table']['name'] = array(
    'title' => t('Name'),
    'help' => t('The name of the person.'),
    'field' => array(
      'id' => 'standard',    
    ),
  );

  $data['custom_table']['dob'] = array(
    'title' => t('Date of Birth'),
    'help' => t('The date of birth of the person.'),
    'field' => array(
      'id' => 'standard',
    ),
  );
  return $data;
}
?>


      