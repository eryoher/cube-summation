<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class CubesController extends AppController
{
    private $cube = array();
    private $result = array();

    public function index(){
      $matrix = "2
4 5
UPDATE 2 2 2 4
QUERY 1 1 1 3 3 3
UPDATE 1 1 1 23
QUERY 2 2 2 4 4 4
QUERY 1 1 1 3 3 3
2 4
UPDATE 2 2 2 1
QUERY 1 1 1 1 1 1
QUERY 1 1 1 2 2 2
QUERY 2 2 2 2 2 2";
      $this->set('matrix', $matrix);
      $this->set('_serialize', ['matrix']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function check()
    {
        $numberCases = 0;
        if ($this->request->is('post')) {
          $data = $this->request->data;
          $matrix = explode("\r\n",$data['matrix']);
          $numberCases = (!empty($matrix[0]))?$matrix[0]:0;
          $n = 1;
          if($numberCases > 0 && $numberCases <= 50){
            for ($i=1; $i <= $numberCases ; $i++) {
              $this->result[] = "Matrix $i";
              $cube = explode(" ", $matrix[$n]);
              $numOperations = $cube[1] + $n;
              if($numOperations > 0 && $numOperations <= 1000){
                if($cube[0] > 0 && $cube[0] <= 100){
                  $this->initializeCube( $cube[0] );
                  for ($j=$n+1; $j <= $numOperations ; $j++) {
                    $method = substr($matrix[$j], 0, 6);
                    if ($method == "UPDATE") {
                      $this->update($matrix[$j], $cube[0]);
                    }else {
                      $this->query($matrix[$j] ,$cube[0]);
                    }
                  }
                }else{
                  $this->result[] = "the size of the matrix must be between 1 to 100 ";
                }
              }else{
                $this->result[] = "the number of operations must be between 1 to 1000 ";
              }
              $n = $numOperations + 1;
              // debug($n);
            }
          }else{
            $this->result[] = "the case test number must be between 1 and 51";
          }
        }

        $this->set('result', $this->result);
        $this->set('matrix', $data['matrix']);
        $this->set('_serialize', ['result', 'matrix']);
        $this->render('index');

    }


    public function initializeCube( $face ){
      $session = $this->request->session();
      for ($x=1; $x <= $face ; $x++) {
        for ($y=1; $y <= $face ; $y++) {
          for ($z=1; $z <= $face ; $z++) {
            $this->cube[$x][$y][$z]=0;
          }
        }
      }
      $session->write('cube', $this->cube);
    }

   public function query($data, $sizes){
     $session = $this->request->session();
     $this->cube = $session->read('cube');
     list($x1, $y1, $z1, $x2, $y2, $z2) = explode(" ", substr($data, 6));

     $sum = 0;
     $checkX = $this->validateCor($x1, $x2, $sizes, "X");
     $checkY = $this->validateCor($y1, $y2, $sizes, "Y");
     $checkZ = $this->validateCor($z1, $z2, $sizes, "Z");

     if($checkX['success']){
       for ($x=$x1; $x <= $x2; $x++) {
         if($checkY['success']){
           for ($y=$y1; $y <= $y2 ; $y++) {
             if($checkZ['success']){
               for ($z=$z1; $z <= $z2; $z++) {
                 $sum = $this->cube[$x][$y][$z]+$sum;
               }
             }else{
               $this->result[] = $checkZ['message'];
                break 2;
             }
           }
         }else{
           $this->result[] = $checkY['message'];
           break;
         }
       }
       $this->result[] = $sum;
     }else{
       $this->result[] = $checkX['message'];
     }
   }

   public function validateCor( $min, $max, $limit, $cordinate ){
     $success = true;
     $message = "";
     if( $min > $max ){
       $message = $cordinate . "2 must be greater than ". $cordinate ."1";
       $success = false;
     }
     if($max <= 0 || $limit < $max){
       $message = "The value of the cordinate $cordinate must be between 1 and $limit";
       $success = false;
     }

     $result = [ "message"  => $message, "success" => $success];
     return $result;
   }

   public function update($data, $sizes)
   {
     $max = pow(10,9);
     $min = pow(-10,9);
     $session = $this->request->session();
     $this->cube = $session->read('cube');
     list($x, $y, $z, $value) = explode(" ", substr($data, 7));
     if( isset( $this->cube[$x][$y][$z] ) ){
       if($value > $min && $value <= $max){
         $this->cube[$x][$y][$z] = $value;
         $this->result[] = "($x,$y,$z)=$value";
       }else{
         $this->result[] = "The value  must be between $min and $max";
       }
     }else{
       $this->result[] = "The value of the cordinate ($x,$y,$z) must be between 1 and $sizes";
     }
     $session->write('cube', $this->cube);

   }
}
