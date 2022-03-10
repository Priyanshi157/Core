<?php Ccc::loadClass('Controller_Admin_Action') ?>
<?php

class Controller_Category_Media extends Controller_Admin_Action
{
	public function __construct()
	{
		if(!$this->authentication())
		{
			$this->redirect('login','admin_login');
		}
	}
	
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$mediaGrid = Ccc::getBlock('Category_Media_Grid');
		$content->addChild($mediaGrid,'Grid');
		$this->renderLayout();
	}

	public function saveAction()
	{
		try 
		{
			$mediaModel = Ccc::getModel('Category_Media');
			$categoryModel = Ccc::getModel('Category');
			$request = $this->getRequest();
			$id = $request->getRequest('id');
			if($request->isPost())
			{
				if(!$request->getPost())
				{
					$mediaData = $mediaModel;
					$mediaData->categoryId = $id;
					$file = $request->getFile();
					$ext = explode('.',$file['name']['name']);
					$fileExt = end($ext);
					$fileName = prev($ext)."".date('Ymdhis').".".$fileExt;
					$fileName = str_replace(" ","_",$fileName);
					$mediaData->name = $fileName;
					$extension = array('jpg','jpeg','png','Jpg','Jpeg','Png','JPEG','JPG','PNG');
				
					if(in_array($fileExt, $extension))
					{
						$result = $mediaModel->save();
						if(!$result)
						{
							throw new Exception("System is unable to save your data.", 1);
						}	
						move_uploaded_file($file['name']['tmp_name'],$this->getView()->getBaseUrl("Media/category/").$fileName);
					}
				}
				else
				{
					$categoryData = $categoryModel;
					$categoryData->categoryId = $id;
					$mediaData = $mediaModel;
					$mediaData->categoryId = $id;
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
							unlink($this->getView()->getBaseUrl("Media/category/"). $media->name);
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
					}
	
					if(array_key_exists('gallery',$postData['media']))
					{
						$mediaData->gallery = 2;
						$result = $mediaModel->save('categoryId');
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
						$result = $mediaModel->save('categoryId');
					}
					unset($mediaData->gallery);

					if(array_key_exists('base',$postData['media']))
					{
						$categoryData->base = $postData['media']['base'];	
						$result = $categoryModel->save();
						if(!$result)
						{
							throw new Exception("System is unable to set base", 1);
						}
						unset($categoryData->base);
					}

					if(array_key_exists('thumb',$postData['media']))
					{
						$categoryData->thumb = $postData['media']['thumb'];
						$result = $categoryModel->save();
						if(!$result)
						{
							throw new Exception("System is unable to set thumb", 1);
						}
						unset($categoryData->thumb);
					}

					if(array_key_exists('small',$postData['media']))
					{
						$categoryData->small = $postData['media']['small'];
						$result = $categoryModel->save();
						if(!$result)
						{
							throw new Exception("System is unable to set small", 1);
						}
						unset($categoryData->small);
					}
				}
			}
			$this->getMessage()->addMessage('Image saved Successfully.'); 	
			$this->redirect('grid','category_media',['id' => $id],true);	
		}
		catch (Exception $e) 
		{
			$this->redirect('grid','category_media',['id' => $id],true);
		}	
	}
}

