<?php $medias = $this->getMedia(); ?>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Image Id</th>
            <th>Category Id</th>
            <th>Name</th>
            <th>Base</th>
            <th>Thumb</th>
            <th>Small</th>
            <th>Gallery</th>
            <th>Remove</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!$medias): ?>
        <tr>
            <td colspan=8>No Records Found</td>
        </tr>
        <?php else: ?>
        <?php foreach ($medias as $media): ?>
        <tr>
            <div class="row">
                <div class="col-sm-10">
                    <td><?php echo $media->mediaId; ?></td>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <td><?php echo $media->categoryId; ?></td>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <td><img src="<?php  echo $media->getImagePath();?>" alt="No Image found" width=50 height=50></td>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-check">
                        <td>
                            <input type="radio" class="" name="media[base]" value = "<?php echo $media->mediaId ?>" <?php echo $this->selected($media->mediaId,'base'); ?> >
                        </td>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-10">
                    <div class="form-check">
                        <td>
                            <input type="radio" class="" name="media[thumb]" value = "<?php echo $media->mediaId ?>" <?php echo $this->selected($media->mediaId,'thumb'); ?> >
                        </td>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-10">
                    <div class="form-check">
                        <td>
                            <input type="radio" class="" name="media[small]" value = "<?php echo $media->mediaId ?>" <?php echo $this->selected($media->mediaId,'small'); ?> >
                        </td>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-10">
                    <div class="form-check">
                        <td>
                            <input type="checkbox" class="" name="media[gallery][]" value = "<?php echo $media->mediaId ?>" <?php echo $media->gallery == 1 ? 'checked' : ''; ?>>
                        </td>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-check">
                        <td>
                            <input type="checkbox" class="" name="media[remove][]" value = "<?php echo $media->mediaId ?>" >
                        </td>
                    </div>
                </div>
            </div>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<input type="file" name="name" id="image" onChange="fileUpload(this)">
<button type="button" id="uploadImageBtn" class="btn btn-primary">Upload</button>
<br><br>

<div class="card card-info">
    <div class="card-footer">
      <button type="button" name="submit" class="btn btn-primary w-25" id="categoryMediaUpdateBtn">Save</button>
      <button type="button" class="btn btn-primary w-25 float-right" id="categoryCancelBtn">Cancel</a></button>
    </div>
</div>

<script type="text/javascript">
    jQuery("#categoryCancelBtn").click(function(){
        admin.setData({'id' : null});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','category',['id' => null]); ?>");
        admin.load();
    });

    jQuery("#uploadImageBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('editBlock'); ?>");
        admin.load();
    });


    jQuery("#categoryMediaUpdateBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('saveMedia','category'); ?>");
        admin.load();
    });

    function fileUpload(fileData) {
        var file = fileData.files[0];
        var formData = new FormData();
        formData.append('name', file);

        $.ajax({
            type: "POST",
            url: "<?php echo $this->getUrl('saveMedia','category'); ?>",    
            contentType: false,
            processData: false,
            data: formData,
            success: function (data) {
                admin.manageElemants(data.elements);
            }
        });
    }
</script>
