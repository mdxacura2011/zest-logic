<?php
declare(strict_types=1);

namespace Home\FeaturedProducts\Block\Widget;

use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\CatalogWidget\Block\Product\ProductsList;

/**
 * Product List for Featured Products
 */
class ProductList extends ProductsList
{
    /**
     * @inheritdoc
     */
    public function createCollection()
    {
        /** @var $collection Collection */
        $collection = $this->productCollectionFactory->create();

        if ($this->getData('store_id') !== null) {
            $collection->setStoreId($this->getData('store_id'));
        }

        $collection->setVisibility($this->catalogProductVisibility->getVisibleInCatalogIds());

        $collection = $this->_addProductAttributesAndPrices($collection)
            ->addStoreFilter()
            ->addAttributeToSort('entity_id', 'desc')
            ->addFieldToFilter('featured_products', 1)
            ->setPageSize($this->getPageSize())
            ->setCurPage($this->getRequest()->getParam($this->getData('page_var_name'), 1));

        $conditions = $this->getConditions();
        $conditions->collectValidatedAttributes($collection);
        $this->sqlBuilder->attachConditionToCollection($collection, $conditions);

        $collection->distinct(true);

        return $collection;
    }
}
