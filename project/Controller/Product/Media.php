<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Product_Media extends Controller_Core_Action{

	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$mediaGrid = Ccc::getBlock('Product_Media_Grid');
		$content->addChild($mediaGrid,'Grid');
		$this->renderLayout();
	}

	public function saveAction()
	{
		try 
		{
			$mediaModel = Ccc::getModel('Product_Media');
			$request = $this->getRequest();
			$productId = $request->getRequest('id');
		
			if($request->isPost())
			{
				if(!$request->getPost())
				{
					$mediaData = $mediaModel;
					$mediaData->productId = $productId;
					$file = $request->getFile();
					$ext = explode('.',$file['name']['name']);
					$fileExt = end($ext);
					$fileName = prev($ext)."".date('Ymdhis').".".$fileExt;
					$fileName = str_replace(" ","_",$fileName);
					$mediaData->name = $fileName;
					$extension = array('jpg','jpeg','png','JPG','JPEG','PNG','Jpg','Jpeg','Png');
				
					if(in_array($fileExt, $extension))
					{
						$result = $mediaModel->save();

						if(!$result)
						{
							throw new Exception("System is unable to save your data.", 1);
						}	
						move_uploaded_file($file['name']['tmp_name'],$this->getView()->getBaseUrl("Media/Product/").$fileName);
					}
				}
				else
				{
					$mediaData = $mediaModel;
					$mediaData->productId = $productId;
					$postData = $request->getPost();
					if(array_key_exists('remove',$postData['media']))
					{
						foreach($postData['media']['remove'] as $remove)
						{
							$media = $mediaModel->load($remove);
							$result = $media->delete();
							if(!$result)
							{
								throw new Exception("Invalid request", 1);
							}
							unlink($this->getView()->getBaseUrl("Media/Product/"). $media->name);
							
							if($postData['media']['base'] == $remove)
							{
								unset($postData['media']['base']);
							}
							if($postData['media']['thumb'] == $remove)
							{
								unset($postData['media']['thumb']);
							}
							if($postData['media']['small'] == $remove)
							{
								unset($postData['media']['small']);
							}
						}
						$this->getMessage()->addMessage('Image removed Successfully.');	
					}
	
					if(array_key_exists('gallery',$postData['media']))
					{
						$mediaData->gallery = 2;
						$result = $mediaModel->save('productId');
						$mediaData->gallery = 1;
						foreach ($postData['media']['gallery'] as $gallery) 
						{
							$mediaData->mediaId = $gallery;
							$result = $mediaModel->save();
							if(!$result)
							{
								throw new Exception("Invalid request", 1);
							}
						}
						unset($mediaData->mediaId);
					}
					else
					{
						$mediaData->gallery = 2;
						$result = $mediaModel->save('productId');
					}
					unset($mediaData->gallery);

					if(array_key_exists('base',$postData['media']))
					{
						$mediaData->base = $postData['media']['base'];
						$result = $mediaModel->save('productId','product');
						if(!$result)
						{
							throw new Exception("System is unabel to set base", 1);
						}
						unset($mediaData->base);
					}
					if(array_key_exists('thumb',$postData['media']))
					{
						$mediaData->thumb = $postData['media']['thumb'];
						$result = $mediaModel->save('productId','product');
						if(!$result)
						{
							throw new Exception("System is unabel to set thumb", 1);
						}
						unset($mediaData->thumb);
					}
					if(array_key_exists('small',$postData['media']))
					{
						$mediaData->small = $postData['media']['small'];
						$result = $mediaModel->save('productId','product');
						if(!$result)
						{
							throw new Exception("System is unabel to set small", 1);
						}
						unset($mediaData->small);
					}
					$this->getMessage()->addMessage('Image saved Successfully.');	
				}
			}
			$this->redirect($this->getView()->getUrl('grid','product_media',['id' => $productId],true));	
		}
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('grid','product_media',['id' => $productId],true));
		}
	}

}
