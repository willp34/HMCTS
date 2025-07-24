
			Dolphin web App
			
				1. Only php 7 is used with no database, No MVC or CMS implemented
				2. jquery and bootstrap running
				run localy http://localhost/Dolphin/
				3  file size to ne uploaded no more than 6.25kb if file larger  change to following in anangram.php
								if($_FILES["fileToupload"]["size"] >50000000)  (line 20)
				4 if same file is uploaded twice no processing is done
				
				5 anangram is filtered in setter method
						i) words with no anagrams are removed
						ii) anargrams are then order by number of anangrams asc order
				6. number of records and execution time is shown
				
			improvements
				1. Data returned is quite large I would adde pagenation using (datatables pluging)
				2. use jquery cookie to keep on screen