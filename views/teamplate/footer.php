<div id="content-before-footer">
    <div class="wrap">
        <div id="ads_widget-4" class="widget caia_ads_widget">
            <div class="widget-wrap">
                <div class="ads_content_widget"><a href="#" target="blank"><img src="" atl=""/></a></div>
            </div>
        </div>
    </div>
</div>
<div id="footer" class="footer">
</div>

<script type="text/javascript" src="../public/js/addthis_widget.js#pubid=ra-561f22cba0f108c3" async="async"></script>
<div class="scroll-back-to-top-wrapper">
    <span class="scroll-back-to-top-inner">
    <i class="fa fa-2x fa-chevron-circle-up"></i>
    </span>
</div>
<script type='text/javascript' src='../public/js/jquery.form.min.js'></script>

<script type='text/javascript' src='../public/js/scripts.js'></script>

<script type='text/javascript' src='../public/js/superfish.min.js'></script>
<script type='text/javascript' src='../public/js/superfish.args.min.js'></script>
<script type='text/javascript' src='../public/js/superfish.compat.min.js'></script>
<script type='text/javascript' src='../public/js/jquery-3.2.1.js'></script>
<?php if (isset($_SESSION['login_or_signUp'])) :?>
<Script>
    $(function () {
        alert('<?= $_SESSION['login_or_signUp'] ?>')
    })
</Script>
<?php endif; ?>
<?php if (isset($_SESSION['success_register'])) :?>
    <Script>
        $(function () {
            alert('<?= $_SESSION['success_register'] ?>')
        })
    </Script>
<?php endif; ?>
<?php if (isset($_SESSION['success_login'])) :?>
    <Script>
        $(function () {
            alert('<?= $_SESSION['success_login'] ?>')
        })
    </Script>
<?php endif; ?>

<?php
    if (isset($_SESSION['login_or_signUp'])) {
        unset($_SESSION['login_or_signUp']);
    }
    if (isset($_SESSION['success_register'])) {
        unset($_SESSION['success_register']);
    }
    if (isset($_SESSION['success_login'])) {
        unset($_SESSION['success_login']);
    }
?>
