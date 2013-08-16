<?php
App::uses( 'File','Utility');

class SongsController extends AppController {

    public $name = 'Songs';

    public $components = array('Auth', 'Session', 'Cookie');

    public $paginate = array(
        'fields' => array('Song.id', 'Song.song', 'Song.status', 'Song.album', 'Song.dedicate_to', 'Song.message', 'Song.created'),
        'maxLimit' => 5,
        //'conditions' => array('Post.status' => 1),
        'order' => array('Song.created' => 'asc')
    );
        
    public function beforeFilter() {
        parent::beforeFilter();
        $this -> Auth -> allow('index', 'current');
        $this -> Auth -> authError = 'Did you really think you are allowed to see that?';
    }

    public function beforeSave(){
    	$this->request->data['Song']['ip']=$this->request->clientIp();
        $this->request->data['Song']['status'] = 0;
    }

    public function isAuthorized($user){
        if ($this -> action === 'add') {
            return true;
        }
        // The owner of a post can edit and delete it
        if (in_array($this -> action, array('delete'))) {
            $postId = $this -> request -> params['pass'][0];
            if ($this -> Post -> isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function index() {
        //$this->Song->recursive = -1;
        //$data = $this -> paginate('Post');
        //$this -> set('posts', $data);
    }

    public function view($id = null) {
        /*$this->Post->recursive = 1;
        $this->paginate['fields']  = array('Post.id', 'Post.title', 'Post.content', 'Post.created');
        if($this->request->is('ajax')){
            $this->layout = 'ajax';
        }
        $this->paginate['conditions'] = array('Post.status'=>1,'Post.id'=>$id);
        $this->paginate['maxLimit'] = 2;
        if ($id == null || empty($id)) {
            $this -> set('post', null);
            $this->set('title_for_layput','Post not found');
        } else {
            $post = $this->paginate('Post');
            $this->set('post',$post);
            $this->set('title_for_layout',$post[0]['Post']['title']);
        }*/
    }

    public function request() {
        if ($this -> request -> is('post')) {
            $this -> request -> data['Song']['user_id'] = $this -> Auth -> user('id');
            $this->layout = 'ajax';
            $this->response->type(array('json'=>'application/json'));
            $this->response->type('json');
            $this->Song->set($this->request->data);
            if ($this -> Song -> validates()) {
            	$this->Song->create();
            	$this->request->data['Song']['ip']=$this->request->clientIp();
                $this->request->data['Song']['status']=0;
            	if($this->Song->save($this -> request -> data)){
            		$msg['type']='success';
                	$msg['message']='Your request has been added to the queue.';
            	}
            	else{
            		$msg['type']='error';
                	$msg['message']='There was an error while saving your request.';
            	}
                $this->set('msg',$msg);
            } else {
               	$msg['type']='error';
                $msg['message']=$this->Song->validationErrors;
                $this->set('msg',$msg);
            }
        }
    }

    public function edit($id = null) {
        $this->layout='ajax';
        //print_r($this->request->data);
        if ($id == null || empty($id)) {
            $auth=false;
            $song['type']='error';
            $song['message']='You need to provide a song id.';
        }
        else {
            $this -> Song -> id = $id;
            $songs = $this -> Song -> read();
            if($songs['Song']['status']==1){
                if($this->Auth->user('role')=='admin'){
                        $auth=true;
                }else{
                        $auth=false;
                        $song['type']='error';
                        $song['message']='You can only edit a pending song.';
                }
            }elseif($songs['Song']['user_id']==$this->Auth->user('id') || $this->Auth->user('role')=='admin'){
                    $auth=true;
            }
            else{
                    $auth=false;
                    $song['type']='error';
                    $song['message']='You need to be admin or owner of the song to edit it.';
            }
            if($this->request->is('get')){
                $this -> request -> data = $this -> Song -> read();
            }
            else if ($this -> request -> is('post')) {
                if ($this -> Song -> save($this -> request -> data)) {
                    $auth=false;
                    $song['type']='success';
                    $song['message']='Your song has been successfully updated.';
                } else {
                    $auth=false;
                    $song['type']='error';
                    $song['message']='Your song could not be updated.';
                }
            }
            if($auth==false){
                $this->response->type(array('json'=>'application/json'));
                $this->response->type('json');
                $this->set('song',$song);
            }
            $this->set('auth',$auth);
        }
    }

    public function current(){
        $this->layout = 'ajax';
        if($this->request->is('get')){
            if($song=@file_get_contents('http://localhost:8000/song.xsl')){
                $this->set('song',$song);
            }
            else{
                $this->set('song','error');
            }
        }else{
            //$this->redirect('/');
        }
    }

    public function search(){
        /*$this->Post->recursive = -1;
        $q = $this->request->query['q'];
        //$qs = explode(' ', $q);
        $this->paginate['fields'] = array('Post.id', 'Post.title', 'Post.created','Post.desc');
        $this->paginate['conditions'] = array('Post.status'=>1, 'OR' => array(
            'Post.title LIKE' =>'%'.$q.'%',
            'Post.content LIKE' =>'%'.$q.'%',
            'Post.desc LIKE' =>'%'.$q.'%'
        ));
        /*if(is_array($qs)){
            foreach ($qs as $query) {
                $this->paginate['conditions']['OR']['Post.title LIKE'] = '%'.$query.'%';
                $this->paginate['conditions']['OR']['Post.content LIKE'] = '%'.$query.'%'
            }
        }*/
        /*$posts = $this -> paginate('Post');
        $this->set('u',$q);
        $this->set('posts',$posts);*/
    }

    public function delete($id = null) {
        $this->layout='ajax';
        $this->response->type(array('json'=>'application/json'));
        $this->response->type('json');
        if ($this -> request -> is('get')) {
            //$this -> Session -> setFlash('You cannot access that page directly.', 'flash_info');
            //$this -> redirect(array('action' => 'index'));
            $song['type']='error';
            $song['message']='You cannot access this page directly.';
        } elseif ($id == null || empty($id)) {
            $song['type']='error';
            $song['message']='Valid song needed for deletion.';
        } else {
            $this -> Song -> id = $id;
            $songs = $this -> Song -> read();
            if($songs['Song']['user_id']==$this->Auth->user('id') || $this->Auth->user('role')=='admin'){
                if($songs['Song']['status']==1){
                    $song['type']='error';
                    $song['message']='You cannot delete completed requests.';
                }
                elseif ($this -> Song -> delete($id)) {
                    $song['type']='success';
                    $song['message']='This song was successfully deleted.';
                }else{
                    $song['type']='error';
                    $song['message']='There was some error with song deletion.';
                }
            }
            else{
                $song['type']='error';
                $song['message']='You need to be the owner or admin to delete the song.';
            }
        }
        $this->set('song',$song);
    }

    public function playnext($id=null){
        $this->layout='ajax';
        $path = WWW_ROOT.DS.'files'.DS.'now_playing.json';
        $file = new File($path,true);
        if(!$id){
            if($this->request->is('post') && $this->Auth->user('role')=='admin'){
                $current['song'] = $this->request->data['Song']['song'];
                $current['album'] = $this->request->data['Song']['album'];
                $current['artist'] = $this->request->data['Song']['artist'];
                $current['message'] = (isset($this->request->data['Song']['message']) && !empty($this->request->data['Song']['message']))?$this->request->data['Song']['message']:'Enjoy listening and dedicating.';
                $file->write(json_encode($current),'w',true);
                $song['type']='success';
                $song['message']='Now playing file updated.';
            }
            /*else{
                $song['type']='error';
                $song['message']='You need to provide an id.';
            }*/
        }
        else{
            $this->Song->id = $id;
            if($this->Auth->user('role')=='admin' && $this->request->is('post')){
                $songs = $this->Song->read();
                if($songs['Song']['status']==1){
                    $song['type']='error';
                    $song['message']='This song request has already been completed.';
                }else{
                    $current['song_id'] = $songs['Song']['id'];
                    $current['song'] = $songs['Song']['song'];
                    $current['album'] = $songs['Song']['album'];
                    $current['dedicate_to'] = $songs['Song']['dedicate_to'];
                    $current['user_id'] = $songs['Song']['user_id'];
                    $current['username'] = $songs['User']['username'];
                    $current['message'] = $songs['Song']['message'];
                    if($file->exists()){
                        $this->request->data['Song']['status']=1;
                        if($file->write(json_encode($current),'w',true) && $this->Song->save($this->request->data)){
                            $song['type']='success';
                            $song['message']='Song added to now playing.';
                        }
                        else{
                            $song['type']='error';
                            $song['message']='There was problem updating file/updating DB.';
                        }
                    }else{
                        if($file->create()){
                            if($file->write(json_encode($current),'w',true) && $this->Song->save($this->request->data)){
                                $song['type']='success';
                                $song['message']='Song added to now playing.';
                            }
                            else{
                                $song['type']='error';
                                $song['message']='There was problem updating file/updating DB.';
                            }
                        }else{
                            $song['type']='error';
                            $song['message']='Error updating file.';
                        }
                    }
                }
            }
            elseif($this->Auth->user('role')=='admin' && $this->request->is('get')){
                $this -> request -> data = $this -> Song -> read();
            }
            else{
                $song['type']='error';
                $song['message']='This is restricted path.';
            }
        }
        if(isset($song) && !empty($song)){
            $this->set('song',$song);
        }
    }

    public function playlist(){
            if($this->Auth->user('role')=='admin'){
                $this->paginate['fields'] = array('Song.id','Song.user_id', 'Song.song', 'Song.status', 'Song.album', 'Song.dedicate_to', 'Song.message','User.username');
                $this->paginate['order'] = array('Song.status'=>'asc','Song.created' => 'asc');
                $this->paginate['maxLimit'] = 20;
                $this->paginate['conditions'] = array('Song.status'=>0);
                if($this->params['requested']){
                    return $this->paginate('Song');
                }else{
                    $this->layout='ajax';
                    $this->response->type(array('json'=>'application/json'));
                    $this->response->type('json');
                    $songs['type']='success';
                    $songs['message']=$this->paginate('Song');
                    $this->set('songs',$songs);
                }
            }else{
                $this->Song->recursive = -1;
                $this->paginate['conditions'] = array('Song.user_id'=>$this->Auth->user('id'));
                if($this->params['requested']){
                    return $this->paginate('Song');
                }else{
                    $this->layout='ajax';
                    $this->response->type(array('json'=>'application/json'));
                    $this->response->type('json');
                    $songs['type']='success';
                    $songs['message']=$this->paginate('Song');
                    $this->set('songs',$songs);
                }
            }
    }

}
?>