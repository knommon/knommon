all: assets links dirs configs
	chmod -R 755 app/storage/

assets:
	grunt make

links:
	ln -s ../app/assets/public/css public/css
	ln -s ../app/assets/public/images public/images
	ln -s ../app/assets/public/js public/js

dirs:
	mkdir -p  app/assets/public/images
	mkdir -p app/assets/public/js
	mkdir -p app/assets/public/css

configs:
	cp -n app/config/database.php.default app/config/database.php
	cp -n app/config/mail.php.default app/config/mail.php

