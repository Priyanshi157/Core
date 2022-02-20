<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 

class Controller_Product extends Controller_Core_Action
{
	public function gridAction()
	{
		Ccc::getBlock('Product_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Product_Add')->toHtml();
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
			$product = $productModel->fetchRow("SELECT * FROM product WHERE productId = {$pid}");
			if(!$product)
			{
				throw new Exception("System is unable to find record.", 1);
				
			}
			Ccc::getBlock('Product_Edit')->addData('product',$product)->toHtml();	
		} 
		catch (Exception $e) 
		{
			throw new Exception("System is unable to find record.", 1);
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
			
			$result = $productModel->delete($productId);
			if(!$result)
			{
				throw new Exception("Unable to Delet Record.", 1);
				
			}
		    $this->redirect($this->getView()->getUrl('product','grid',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('product','grid',[],true));
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

			if (array_key_exists('productId',$postData))
			{
				if(!(int)$postData['productId'])
				{
					throw new Exception("Invalid Request.", 1);
				}
				$productId = $postData["productId"];
				$postData['updatedAt']  = date('Y-m-d H:m:s');
				$update = $productModel->update($postData,$productId);
				if(!$update)
				{
					throw new Exception("System is unable to Update.", 1);
				}
			}
			else
			{
				$postData['createdAt'] = date('Y-m-d H:m:s');
				$insert = $productModel->insert($postData);
				if(!$insert)
				{
					throw new Exception("System is unable to Insert.", 1);
				}
			}
			$this->redirect($this->getView()->getUrl('product','grid',[],true));
		} 
		catch (Exception $e) 
		{
			$this->redirect($this->getView()->getUrl('product','grid',[],true));
		}
	}
}

?>