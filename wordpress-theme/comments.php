<?php
/**
 * Created by PhpStorm.
 * User: justa
 * Date: 5-4-2017
 * Time: 12:04
 */
if (comments_open()) : ?>
	<div id="disqus_thread" class="article__disqus entry-content"></div>
	<script>
		/**
		 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
		 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
		 */
		var canonical = document.querySelector("canonical").getAttribute("href");
//		 var disqus_config = function () {
//		 this.page.url = canonical;  // Replace PAGE_URL with your page's canonical URL variable
//		 this.page.identifier = "student-volgt-client"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
//		 };
		(function() {  // DON'T EDIT BELOW THIS LINE
			var d = document, s = d.createElement('script');

			s.src = '//EXAMPLE.disqus.com/embed.js';
 
			s.setAttribute('data-timestamp', + new Date());
			(d.head || d.body).appendChild(s);
		})();
	</script>
	<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<?php endif; // comments_open ?>