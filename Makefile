all: links
	chmod -R 755 app/storage/
	grunt make

links:
	ln -s app/assets/public/css public/css
	ln -s app/assets/public/images public/images
	ln -s app/assets/public/js public/js
