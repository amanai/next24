Пользователь <a href="<?php echo $this -> createUrl('User', 'Profile', null, $this->user->login);?>"><?=$this->user->login;?></a> создал новую категорию под названием "<?=$this->category->name; ?>" в закладках.
Вы можете <a onclick="window.open('<?=$this->createUrl('Bookmarks', 'CategoryForm', array('id'=>$this->category->id, 'type'=>1)); ?>','miniwin','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=320,height=250'); return false;" href="<?=$this->createUrl('Bookmarks', 'CategoryForm', array('id'=>$this->category->id, 'type'=>1)); ?>">одобрить</a> или <a onclick="window.open('<?=$this->createUrl('Bookmarks', 'CategoryForm', array('id'=>$this->category->id, 'type'=>0)); ?>','miniwin','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,width=320,height=250'); return false;" href="<?=$this->createUrl('Bookmarks', 'CategoryForm', array('id'=>$this->category->id, 'type'=>0)); ?>">отклонить</a> категорию.