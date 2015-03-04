<?php

namespace nill\statical;

class Module extends \yii\base\Module {

    public $controllerNamespace = 'nill\statical\controllers';

    /**
     * @var integer Posts per page
     */
    public $recordsPerPage = 20;

    /**
     * @var boolean Whether posts need to be moderated before publishing
     */
    public $moderation = true;

    /**
     * @var string Preview path
     */
    public $previewPath = '@statics/web/statical/previews/';

    /**
     * @var string Image path
     */
    public $imagePath = '@statics/web/statical/images/';

    /**
     * @var string Files path
     */
    public $contentPath = '@statics/web/statical/content';

    /**
     * @var string Images temporary path
     */
    public $imagesTempPath = '@statics/temp/statical/images/';

    /**
     * @var string Preview URL
     */
    public $previewUrl = '/statics/statical/previews';

    /**
     * @var string Image URL
     */
    public $imageUrl = '/statics/statical/images';

    /**
     * @var string Files URL
     */
    public $contentUrl = '/statics/statical/content';

    /**
     * @var string Files URL
     */
    public $fileUrl = '/statics/statical/files';
    
    /**
     * @var string Files path
     */
    public $filePath = '@statics/web/statical/files';

    public function init() {
        parent::init();

        // custom initialization code goes here
    }

}
