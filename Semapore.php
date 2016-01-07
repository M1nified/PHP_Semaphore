<?php
/**
 * Semaphore
 */
class Semaphore
{
  private $id = null;
  private $key = null;
  private $seg = null;
  function __construct($id=null)
  {
    if($id==null){
      $id=93219941;
    }
    $this->id=$id;
    if(!($this->seg=sem_get($this->id))){
      throw new Exception("WRONG KEY", 1);

    }
    @ob_flush();
    @flush();
    if($sem = sem_acquire($this->seg)){
      //LOCKED
    }else{
      throw new Exception("NO ACCESS");
    }
  }
  function __destruct(){
    sem_release($this->seg);
    sem_remove($this->seg);
    //FREE
  }
}


?>
