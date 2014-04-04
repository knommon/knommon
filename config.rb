# Require any additional compass plugins here.
development = (environment != :production)

# Set this to the root of your project when deployed:
project_path = "app/assets"
#http_path = "/"
css_dir = "public/css"
sass_dir = "sass"
images_dir = "images"
generated_images_dir = "public/images"
javascripts_dir = "public/js"
http_generated_images_path = "/images"

# You can select your preferred output style here (can be overridden via the command line):
# output_style = :expanded or :nested or :compact or :compressed
if development
	output_style = :expanded
else
	output_style = :compressed
end

# To enable relative paths to assets via compass helper functions. Uncomment:
relative_assets = true

# To disable debugging comments that display the original location of your selectors. Uncomment:
# line_comments = false

