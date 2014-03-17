# Require any additional compass plugins here.
development = true

# Set this to the root of your project when deployed:
http_path = "/"
css_dir = "app/assets/public/css"
sass_dir = "app/assets/sass"
images_dir = "app/assets/images"
generated_images_dir = "app/assets/public/images"
javascripts_dir = "app/assets/public/js"
http_generated_images_path = "images"

# You can select your preferred output style here (can be overridden via the command line):
# output_style = :expanded or :nested or :compact or :compressed
# Development
if development
	#output_style = :expanded
	#environment = :development
else # Production
	#output_style = :compressed
	#environment = :production
end

# To enable relative paths to assets via compass helper functions. Uncomment:
# relative_assets = true

# To disable debugging comments that display the original location of your selectors. Uncomment:
# line_comments = false

