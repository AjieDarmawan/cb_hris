<?php ?>

<script>

function is_touch() {  return 'ontouchstart' in window || 'onmsgesturechange' in window; };
var isDesktop = window.screenX != 0 && is_touch() ? false : true;

alert(isDesktop);
</script> 