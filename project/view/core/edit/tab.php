<?php $tabs = $this->getTabs(); ?>
<?php foreach($tabs as $key => $tab): ?>
    <div class="btn-group m-2">
    <button type="button" class="btn btn-block btn-primary loadTab w-25" value="<?php echo $tab['url'] ?>" <?php echo ($this->getCurrentTab() == $key) ? 'style ="color:white";' : 'style ="color:yellow";' ; ?>><?php echo $tab['title'];?></button>
    </div>
<?php endforeach;?>

<script>
    jQuery(".loadTab").click(function(){
        admin.setUrl($(this).val());
        admin.setType('GET');
        admin.load();
    });
</script>