<?php 
class Model_Core_Pager
{
	protected $perPageCount = 20;
	protected $totalCount = null;
	protected $pageCount = null;
	protected $start = 1;
	protected $end = null;
	protected $prev = null;
	protected $next = null;
	protected $current = null;
	protected $startLimit = null;
	protected $endLimit = 20;

	public function setPerPageCount($perPageCount)
	{
		$this->perPageCount = $perPageCount;
		return $this;
	}

	public function getPerPageCount()
	{
		return $this->perPageCount;
	}

	public function setTotalCount($totalCount)
	{
		$this->totalCount = $totalCount;
		return $this;
	}
	
	public function getTotalCount()
	{
		return $this->totalCount;
	}

	public function setPageCount($pageCount)
	{
		$this->pageCount = $pageCount;
		return $this;
	}
	
	public function getPageCount()
	{
		return $this->pageCount;
	}

	public function setStart($start)
	{
		$this->start = $start;
		return $this;
	}
	
	public function getStart()
	{
		return $this->start;
	}

	public function setEnd($end)
	{
		$this->end = $end;
		return $this;
	}
	
	public function getEnd()
	{
		return $this->end;
	}

	public function setPrev($prev)
	{
		$this->prev = $prev;
		return $this;
	}
	
	public function getPrev()
	{
		return $this->prev;
	}

	public function setNext($next)
	{
		$this->next = $next;
		return $this;
	}
	
	public function getNext()
	{
		return $this->next;
	}

	public function setCurrent($current)
	{
		$this->current = $current;
		return $this;
	}
	
	public function getCurrent()
	{
		return $this->current;
	}

	public function setStartLimit($startLimit)
	{
		$this->startLimit = $startLimit;
		return $this;
	}
	
	public function getStartLimit()
	{
		return $this->startLimit;
	}

	public function setEndLimit($endLimit)
	{
		$this->endLimit = $endLimit;
		return $this;
	}
	
	public function getEndLimit()
	{
		return $this->endLimit;
	}

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}

	public function execute($totalCount, $current)
	{
		$this->setTotalCount($totalCount);
        $this->setPageCount(ceil($this->getTotalCount() / $this->getPerPageCount()));
        $this->setCurrent(($current > $this->getPageCount()) ? $this->getPageCount() : $current);
        $this->setCurrent(($current < $this->getStart()) ? $this->getStart() : $this->getCurrent());
        $this->setStart(($this->getCurrent() == 1) ? null : 1);
        $this->setEnd($this->getCurrent() == $this->getPageCount() ? null : $this->getPageCount());
        $this->setStartLimit($this->getPerPageCount() * ($this->getCurrent() - 1));
        $this->setPrev(($this->getCurrent() == 1) ? null : $this->getCurrent() - 1);
        $this->setNext(($this->getCurrent() == $this->getPageCount()) ? null : $this->getCurrent() + 1);
	}

}