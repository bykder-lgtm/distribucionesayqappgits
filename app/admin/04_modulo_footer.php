<!-- Start Footer  -->

    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">

                </div>
            </div>
        </div>
    </footer>

    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company"><?php
if (!empty($desarrollador_emp)) {
	echo htmlspecialchars($desarrollador_emp, ENT_QUOTES, 'UTF-8');
} elseif (!empty($nombre_emp)) {
	echo htmlspecialchars($nombre_emp, ENT_QUOTES, 'UTF-8');
}
?></p>
    </div>
    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
