all: assets links dirs
	chmod -R 755 app/storage/

assets:
	grunt make

links:
	ln -s ../app/assets/public/css public/css
	ln -s ../app/assets/public/images public/images
	ln -s ../app/assets/public/js public/js

dirs:
	mkdir app/assets/public/ 
	mkdir app/assets/public/images
	mkdir app/assets/public/js
	mkdir app/assets/public/css
