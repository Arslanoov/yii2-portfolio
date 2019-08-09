<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;

?>

<?php $this->registerJsFile('/js/404/starsky.js') ?>
<?php $this->registerCss('
    #error-page {
        background: linear-gradient(45deg, rgba(0,0,0,1) 0%,rgba(5,5,5,1) 15%,rgba(8,8,28,1) 60%,rgba(10,10,10,1) 100%);
    }
         
    #space {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 0;
    }
    
    #error {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    #error p {
        width: 400px;
        padding: 15px;
        color: white;
    }
') ?>

<section id="error-page" style="height: 100vh">
    <div class="full-width intro">
        <div class="full-height">
            <div class="container" id="error">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center" id="text">
                            <h2><p><?= Html::encode($this->title) ?></p></h2>
                            <p><?= nl2br(Html::encode($message)) ?></p>
                        </div>
                    </div>
                </div>
                <canvas id="space"></canvas>
            </div>
        </div>
    </div>
</section>