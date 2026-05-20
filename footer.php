<?php get_template_part("./modules/common/footer") ?>

<?php wp_footer() ?>

<?php
$current_language = get_locale();
?>
<script type="text/javascript">
function googleTranslateElementInit() {
	new google.translate.TranslateElement({
		pageLanguage: '<?php echo $current_language ?>',
		layout: google.translate.TranslateElement.InlineLayout.VERTICAL,
		includedLanguages: 'en,vi',
	}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>
</body>

</html>