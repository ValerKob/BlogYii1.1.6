<?php $this->pageTitle = Yii::app()->name; ?>

<h1>Добро пожаловать в <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<div class="row">
    <?php
    foreach ($rows as $row) {
        echo '<div class="col-12 col-sm-6 col-md-4 d-flex justify-content-center mb-5">
                <div class="card" style="width: 18rem; display: block; border: 0px;">
                    <div class="card-body d-flex flex-column justify-content-between" style="
                    border: var(--bs-card-border-width) solid var(--bs-card-border-color);
                    border-radius: 15px;">
                        <div>
                            <h5 class="card-title">' . $row['name'] . '</h5>
                            <p class="card-text">' . $row['content'] . '</p>
                        </div>
                        <div class="d-flex justify-content-between mt-3" style="color: #8e8e8e;">
                            <div class="card-title text-start"> Дата: <b style="color: #000;">' . $row['date_post'] . '</b></div>
                            <div class="card-title text-end"> Автор:  <b style="color: #000;">' . $row['username_user'] . '</b></div>
                        </div>
                    </div>
                </div>
            </div>';
    }
    ?>
</div>