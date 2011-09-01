<?php
session_start();
class Test {
    private $_student;
    private $_num1;
    private $_num2;
    private $_operator1;
    private $_operator2;

    public function __construct(){
        if(isset($_POST['name']) ){
            $this->_student = $_POST['name'];
            $_SESSION['student'] = $this->_student;
            $this->_generateNumbers();
            $this->_firstTest();
            $correctAnswer = $this->_checkAnswer();
            $operator = $this->_operator1;
            $question = $this->_num1." ".$operator." ".$this->_num2;
            $name = $this->_student;
            require_once 'test.html';
        }
        elseif (isset($_POST['answer'])) {
            $msg = "";
            if ($_POST['answer']==$_POST['correctAnswer']){
                $this->_generateNumbers();
                $this->_secondTest();
                $correctAnswer = $this->_checkAnswer2();
                $operator = $this->_operator2;
                $question = $this->_num1." ".$operator." ".$this->_num2;
                $msg = 'correct';                
            }
            else
                $msg = 'incorrect';
            require_once 'result.html';
        }
        elseif (isset($_POST['sAnswer'])) {
            $msg = "";
            if($_POST['sAnswer']==$_POST['correctAnswer']){
                echo "You've just arrived to the paradise";
                echo "<a href='index.php'>home</a>";
            }
            else{
                echo $_POST['correctAnswer'];
                echo "Try again!";
            }
                
        }
        else
        $this->_showForm();
    }
    public function _showForm(){
        require_once 'main.html';
    }
    public function _generateNumbers(){
        $this->_num1 = rand(1,20);
        $this->_num2 = rand(1,20);
    }
    public function _firstTest(){
        $operator = array("+","-");
        $i = rand(0, 1);
        $this->_operator1 = $operator[$i];
    }
    public function _secondTest(){
        $operator = array("*","/");
        $i = rand(0, 1);
        $this->_operator2 = $operator[$i];
    }    
    public function _checkAnswer(){
        $operator = $this->_operator1;
        switch ($operator){
            case '+':
                return $this->_num1 + $this->_num2;
                break;
            case '-':
                  return $this->_num1 - $this->_num2;
                  break;
        }
    }
    public function _checkAnswer2(){
        $operator = $this->_operator2;
         switch ($operator){
            case '*':
                    return $this->_num1 * $this->_num2;
                    break;
            case '/':
                 return $this->_num1 / $this->_num2;
                    break;
         }
    }
}
?>
