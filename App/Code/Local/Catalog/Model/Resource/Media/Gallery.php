<?php
class Catalog_Model_Resource_Media_Gallery extends Core_Model_resource_Abstract
{
    public function __construct()
    {
        $this->init('catalog_media_gallery', 'media_id');
    }
}
