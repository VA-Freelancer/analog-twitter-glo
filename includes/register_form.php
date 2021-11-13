
<section class="wrapper">
    <h2 class="tweet-form__title"><?=$title;?></h2>
    <?php if($error):?>
        <div class="tweet-form__error"><?=$error;?></div>
    <?php endif; ?>
    <form class="tweet-form" action="<?=get_url('includes/sign_up.php'); ?>" method="post">
        <div class="tweet-form__wrapper_inputs">
            <input type="text" class="tweet-form__input" placeholder="Логин" autocomplete="off" name="login" required>
            <input type="password" class="tweet-form__input" placeholder="Пароль" autocomplete="off" name="pass" required>
            <input type="password" class="tweet-form__input" placeholder="Пароль повторно" autocomplete="off" name="pass2" required>
        </div>
        <div class="tweet-form__btns_center">
            <button class="tweet-form__btn_center" type="submit">Зарегистрироваться</button>
        </div>
    </form>
</section>
