<?php
namespace Aht\Blog\Block\Adminhtml;

class Post extends \Magento\Backend\Block\Widget\Grid\Container
{

	protected function _construct()
	{
		$this->_controller = 'adminhtml_post';
		$this->_blockGroup = 'Aht_Blog';
		$this->_headerText = __('Posts');
		$this->_addButtonLabel = __('Create New Post');
		parent::_construct();
	}
}