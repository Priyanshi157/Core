<form action="<?php echo $this->getEditUrl() ?>" method="POST">
<?php $this->getTab()->toHtml(); ?>
<?php $this->getTabContent()->toHtml(); ?>
</form>
