<?php

namespace Aht\Blog\Controller\Adminhtml\Post;

class MassStatus extends \Aht\Blog\Controller\Adminhtml\Post
{
    protected $_postFactory;

    public function __construct(\Magento\Backend\App\Action\Context $context, 
    \Magento\Framework\Registry $coreRegistry, 
    \Aht\Blog\Model\PostRepository $postRepository, 
    \Aht\Blog\Model\PostFactory $postFactory)
    {
        $this->_coreRegistry = $coreRegistry;
        $this->_postRepository = $postRepository;
        $this->_postFactory = $postFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $ids = $this->getRequest()->getPost('ids');
        if (!is_array($ids)) {
            $this->messageManager->addError(__('Please select item(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = $this->_postFactory->create()
                        ->load($id)
                        ->setStatus($this->getRequest()->getPost('status'))
                        ->save();
                }
                $this->messageManager->addSuccess(__('Total of %1 record(s) were successfully updated.', count($ids)));

            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}