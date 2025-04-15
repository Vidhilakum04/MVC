<?php class Admin_Block_Widget_Grid_Toolbar extends Admin_Block_Widget_Grid
{
    protected $_collection;
    protected $_limit = 5;
    protected $_page = 1;
    public function __construct()
    {
        $this->setTemplate('admin/widget/grid/toolbar.phtml');
    }
    public function getTotalRecords()
    {
        return count($this->_collection->getData());
    }

    public function getLimit()
    {
        return $this->_limit;
    }

    public function getPage()
    {
        return $this->_page;
    }
    public function prepareToolbar()
    {
        $page = $this->getLayout()
            ->getRequest()
            ->getQuery('page');
        $limit = $this->getLayout()
            ->getRequest()
            ->getQuery('limit');

        $this->_limit = (is_numeric($limit)) ? $limit : $this->_limit;
        $this->_page = (is_numeric($page)) ? $page : $this->_page;

        $this->_collection = clone $this->getParent()
            ->getCollection();

        $this->getParent()->getCollection()
            ->limit($this->_limit, $this->_page)
            ->getData();
    }
}
