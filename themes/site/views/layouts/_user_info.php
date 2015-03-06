<div class="user_box dark_box clearfix">
    <?php echo CHtml::image($this->themeUrl.'/images/interface/profile.jpg',  Yii::app()->name,array("width"=>"55")) ?>
    <h2><?php echo Yii::app()->user->username ?></h2>
    <h3>&nbsp;</h3>
    <ul>
        <li><?php echo CHtml::link('Profile',array('/admin/default/profile')); ?><span class="divider">|</span></li>
        <li><a href="#">Settings</a><span class="divider">|</span></li>
        <li><?php echo CHtml::link('Logout',array('/admin/default/logout')); ?></li>
    </ul>
</div>