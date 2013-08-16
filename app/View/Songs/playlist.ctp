<?php
            if($this->Paginator->hasPrev()){
              $songs['previous'] = $this->Paginator->prev('Back',array('tag'=>'li','class'=>'previous'));  
            }
            if($this->Paginator->hasNext()){
              $songs['next'] = $this->Paginator->Next('Next',array('tag'=>'li','class'=>'next'));  
            }
            echo json_encode($songs);
?>