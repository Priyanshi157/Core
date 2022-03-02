<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 

class Controller_Product extends Controller_Core_Action
{
	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$productGrid = Ccc::getBlock('Product_Grid');
		$content->addChild($productGrid,'Grid');
		$this->renderLayout();
	}

	public function addAction()
	{
		$productModel = Ccc::getModel('Product');
		$content = $this->getLayout()->getContent();
		$productAdd = Ccc::getBlock('Product_Edit')->setData(['product'=>$productModel]);
		$content->addChild($productAdd,'Add');
		$this->renderLayout();
	}

	public function editAction()
	{
		try 
		{
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			$pid = (int)$request->getRequest('id');
			if(!$pid)
			{
				throw new Exception("Invalid Request", 1);
			}
			$product = $productModel;
			$productData = $product->load($pid);
			if(!$productData)
			{
				throw new Exception("System is unable to find record.", 1);
				
			}
			$content = $this->getLayout()->getContent();
			$productEdit = Ccc::getBlock('Product_Edit')->setData(['product'=>$product]);
			$content->addChild($productEdit,'Edit');
			$this->renderLayout();
		} 
		catch (Exception $e) 
		{
			throw new Exception("System is unable to find record.", 1);
		}
	}

	public function saveAction()
	{
		try 
		{
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			if(!$request->getPost('product'))
			{
				throw new Exception("Invalid Request", 1);
			}	
			$postData = $request->getPost('product');
			if(!$postData)
			{
				throw new Exception("Invalid data posted.", 1);	
			}

			$product = $productModel;
			$product->setData($postData);
			if(!($product->productId))
			{
				$product->createdAt = date('y-m-d h:m:s');
				unset($product->productId);
				$product->save();
				$insert = $product->save();
				if(!$insert)
				{
					throw new Exception("System is unable to Insert.", 1);
				}
			}
			else
			{
				if(!(int)$product->productId)
				{
					throw new Exception("Invalid Request.", 1);
				}
				$product->productId = $postData["productId"];
				$product->updatedAt = date('y-m-d h:m:s');
				$update = $product->save();
				if(!$update)
				{
					throw new Exception("System is unable to Update.", 1);
				}
			}
			$this->redirect($this->getView()->getUrl('grid','product',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('grid','product',[],true));
		}
	}

		public function deleteAction()
	{
		try 
		{
			$productModel = Ccc::getModel('Product');
			$request = $this->getRequest();
			if(!$request->getRequest('id'))
			{
				throw new Exception("Invalid Request.", 1);
			}

			$productId = $request->getRequest('id');
			if(!$productId)
			{
				throw new Exception("Unable to fetch ID.", 1);
				
			}
			$product = $productModel;
			$datas = $product->fetchAll("SELECT name FROM product_media WHERE  productId='$productId'");
			
			foreach ($datas as $data) 
			{
				unlink($this->getView()->getBaseUrl("Media/Product/"). $data->name);
			}

			$result = $productModel->load($productId)->delete();
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 1);
				
			}
		    $this->redirect($this->getView()->getUrl('grid','product',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('grid','product',[],true));
		}		
	}
}

?>