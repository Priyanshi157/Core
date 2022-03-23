<?php Ccc::loadClass('Controller_Admin_Action'); ?>
<?php 

class Controller_Product extends Controller_Admin_Action
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
		$this->setTitle('Product_Grid');
		$content = $this->getLayout()->getContent();
		$productGrid = Ccc::getBlock('Product_Grid');
		$content->addChild($productGrid,'Grid');
		$menu = Ccc::getBlock('Core_Layout_Menu');
		$message = Ccc::getBlock('Core_Layout_Message');
		$header = $this->getLayout()->getHeader()->addChild($menu,'menu')->addChild($message,'message');
		$this->renderLayout();
	}

	public function addAction()
	{
		$this->setTitle('Product_Add');
		$productModel = Ccc::getModel('Product');
		$content = $this->getLayout()->getContent();
		$productAdd = Ccc::getBlock('Product_Edit')->setData(['product'=>$productModel]);
		$content->addChild($productAdd,'Add');
		$menu = Ccc::getBlock('Core_Layout_Menu');
		$header = $this->getLayout()->getHeader()->addChild($menu,'menu');
		$this->renderLayout();
	}

	public function editAction()
	{
		try 
		{
			$this->setTitle('Product_Edit');
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
			$productEdit = Ccc::getBlock('Product_Edit')->setData(['product'=>$productData]);
			$content->addChild($productEdit,'Edit');
			$menu = Ccc::getBlock('Core_Layout_Menu');
			$header = $this->getLayout()->getHeader()->addChild($menu,'menu');
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
			$categoryIds = $request->getPost('category');
			if(!$postData)
			{
				throw new Exception("Invalid data posted.", 1);
			}

			$product = $productModel;
			$type = $request->getPost('discountMethod');
			$product->setData($postData);
			if($type == 1)
			{
				$product->discount = $product->price * $product->discount / 100 ;
			}

			if(!($product->costPrice <= ($product->price-$product->discount) && $product->price-$product->discount <= $product->price) || $product->discount<0)
			{
				$this->getMessage()->addMessage('Not Valid Discount.',3);
				throw new Exception("Discount not valid.", 1);
			}

			if(!($product->productId))
			{
				$product->createdAt = date('y-m-d h:m:s');
				unset($product->productId);
			}
			else
			{
				if(!(int)$product->productId)
				{
					throw new Exception("Invalid Request.", 1);
				}
				$product->updatedAt = date('y-m-d h:m:s');
			}

			$result = $product->save();
			if(!$result)
			{
				$this->getMessage()->addMessage('Unable to save.',3);
			}

			if(!$categoryIds)
			{
				$categoryIds['exists'] = [];
			}
			
			$product->saveCategories($categoryIds);
			$this->getMessage()->addMessage('Data saved Successfully.',1);
			$this->redirect('grid','product',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('grid','product',[],true);
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
			$this->getMessage()->addMessage('Deleted Successfully.');
		    $this->redirect('grid','product',[],true);
		} 
		catch (Exception $e) 
		{
			$this->redirect('grid','product',[],true);
		}		
	}
}

