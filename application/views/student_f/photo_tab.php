<style>
/*.demo{
    padding: 20px;
}
.image-wrapper{
    max-width: 600px;
    min-width: 200px;
}*/

#image-4-wrapper .rcrop-outer-wrapper{
    opacity: .75;
}
#image-4-wrapper .rcrop-outer{
    background: #000
}
#image-4-wrapper .rcrop-croparea-inner{
    border: 1px dashed #fff;
}

#image-4-wrapper .rcrop-handler-corner{
    width:12px;
    height: 12px;
    background: none;
    border : 0 solid #51aeff;
}
#image-4-wrapper .rcrop-handler-top-left{
    border-top-width: 4px;
    border-left-width: 4px;
    top:-2px;
    left:-2px
}
#image-4-wrapper .rcrop-handler-top-right{
    border-top-width: 4px;
    border-right-width: 4px;
    top:-2px;
    right:-2px
}
#image-4-wrapper .rcrop-handler-bottom-right{
    border-bottom-width: 4px;
    border-right-width: 4px;
    bottom:-2px;
    right:-2px
}
#image-4-wrapper .rcrop-handler-bottom-left{
    border-bottom-width: 4px;
    border-left-width: 4px;
    bottom:-2px;
    left:-2px
}
#image-4-wrapper .rcrop-handler-border{
    display: none;
}

#image-4-wrapper .clayfy-touch-device.clayfy-handler{
    background: none;
    border : 0 solid #51aeff;
    border-bottom-width: 6px;
    border-right-width: 6px;
}

#update{
    margin: 10px 0 0 60px ;
    padding: 10px 20px;
}

#cropped-original, #cropped-resized{
    padding: 20px;
    border: 4px solid #ddd;
    min-height: 60px;
    margin-top: 20px;
}
#cropped-original img, #cropped-resized img{
    margin: 5px;
}
</style>


<?php $session_nokp = trim($this->session->userdata('session_student')['user_id']); ?>

<!-- src image -->
<?php
if($userdata[0]->gambar != NULL) {
  //dbug(STORAGEPATH);
  $src_image = STORAGEPATH.$session_nokp."/".$userdata[0]->gambar;

  if ($handle = opendir($src_image)) {
    while (false !== ($entry = readdir($handle))) {
      $src_image = base_url('/').'img/'.$this->encryption->encrypt($src_image);
    }
  }

  //dbug($src_image);
} else {
  $src_image = base_url().'/assets/images/profile/profile.png';
}
 ?>


<div class="profile-head">
  <h3>Change Photo</h3>
</div>
<form class="edit-photo" method="post" enctype="multipart/form-data" action="<?php echo $action_save_tab_changephoto;?>">
  <div class="row justify-content-center pb-5">
    <div class="col-12">
    <div class="user-profile-thumb">
            <img id="blah" src="<?=$src_image?>" alt=""/>
        </div>
    </div>
    <div class="col-4">
    <input accept="image/png, image/jpg, image/jpeg" class="form-control" type='file' id="txt_photo" name="txt_photo" />
    </div>
  </div>

  <div class="row">
    <!--
    <div class="demo">
        <div class="image-wrapper" id="image-4-wrapper">
            <img id="image-4" src="<?=$src_image ?>">
        </div>
    </div> -->

  </div>

  <div class="modal-footer">
    <!--<button type="close" class="btn-secondry">Back</button>-->
    <input type="submit" class="btn btn-primary" id="btn_chngephoto" name="btn_chngephoto" value="Update">
  </div>

</form>
