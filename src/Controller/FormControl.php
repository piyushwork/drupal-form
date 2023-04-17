<?php
namespace Drupal\form\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
class FormControl extends ControllerBase{
  
    public function display(){
        $build= [];
        $build['formkey'] = $this->formBuilder()->getForm('Drupal\form\Form\MyForm');
        return $build;
    }

    public function myView(){
        $database = Database::getConnection();
        $query = $database->query("SELECT * FROM {custom_table}");
        $results = $query->fetchAll();

      $table_rows = [];
     foreach ($results as $row) {
      $table_rows[] = [
        'data' => [
          $row->id,
          $row->name,
          $row->dob,
        ],
      ];
    }

    return [
      '#type' => 'table',
      '#header' => ['ID', 'Name', 'DOB'],
      '#rows' => $table_rows,
    ];
  }
}
?>